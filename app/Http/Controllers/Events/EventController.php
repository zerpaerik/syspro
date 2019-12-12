<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pacientes\Paciente;
use App\Models\Personal;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Creditos;
use App\Models\Events;
use App\Models\Ciex;
use App\Models\Historiales;
use App\User;
use Calendar;
use Carbon\Carbon;
use DB;
use PDF;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Historial;
use App\Consulta;
use Toastr;

class EventController extends Controller
{

  public function index(Request $request)
  {
	 $personal = DB::table('personals as e')
    ->select('e.id','e.name','e.lastname','e.dni')
    ->join('events as p','p.profesional','=','e.id')
	->groupBy('p.profesional')
    ->get();
	

	
    if($request->isMethod('get')){
      $calendar = false;
      return view('events.index', ["calendar" => $calendar, "especialistas" => $personal]);
    }else{
      $calendar = Calendar::addEvents($this->getEvents($request->especialista))
      ->setOptions([
        'locale' => 'es',
      ]);
      return view('events.index',[ "calendar" => $calendar, "especialistas" => $personal]);
    }
  }

  public function all(Request $request)
  {

    if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    

    $event = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.tipo','e.usuario','e.created_at','e.tipo','e.atendido','e.title','e.sede','e.monto','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','cr.tipo_ingreso')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('creditos as cr','cr.id_event','e.id')
    ->whereBetween('e.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
    ->where('e.sede','=',$request->session()->get('sede'))
    ->orderBy('EventId','desc')
    ->get();

  } else {

    $event = DB::table('events as e')
   ->select('e.id as EventId','e.paciente','e.tipo','e.usuario','e.created_at','e.tipo','e.atendido','e.title','e.sede','e.monto','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','cr.tipo_ingreso')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('creditos as cr','cr.id_event','e.id')
    ->whereDate('e.created_at', '=',Carbon::today()->toDateString())
    ->where('e.sede','=',$request->session()->get('sede'))
    ->orderBy('EventId','desc')
    ->get();


  }




    return view('consultas.index',[
      'eventos' => $event
    ]);
  }

  public function delete_consulta($id)
  {
    $consulta = Event::find($id);
    $consulta->delete();


    $creditos = Creditos::where('id_event','=',$id);
    $creditos->delete();


    return back();
  } 

    public function atendido($id)
  {
    $consulta = Event::find($id);
    $consulta->atendido=1;
    $consulta->update();

    Toastr::success('Atendido Exitosamente.', 'Consulta!', ['progressBar' => true]);
    return back();
  } 

  public function editView_consulta($id)
  {
  
    $paciente = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.title','e.profesional','e.date','e.monto','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->where('e.id','=',$id)
    ->first();

    $especialistas =  Personal::where('tipo','=','Especialista')->orwhere('tipo','=','Tecnòlogo')->orwhere('tipo','=','ProfSalud')->where('estatus','=','1')->get();

    $tiempos = RangoConsulta::all();
    
    $ciex = Ciex::all();

    return view('consultas.edit',[
      'paciente' => $paciente,
      'especialistas' => $especialistas,
      'tiempos' => $tiempos,
      'ciex' => $ciex
    ]);   
  
  }

  public function edit_consulta(Request $request)
  {
    DB::table('events')
            ->where('id', $request->event)
            ->update([
              'profesional' => $request->especialista,
              'paciente' => $request->paciente,
            //  'date' => Carbon::createFromFormat('d/m/Y', $request->date),
              'time' => $request->time,
              'tipo' => $request->tipo,
              'monto' => $request->monto
            ]);

    DB::table('creditos')
            ->where('id_event', $request->event)
            ->update([
              'monto' => $request->monto,
              'tipo_ingreso' => $request->tipopago
            ]);        
     


  return redirect('consulta');            
  }

  public function show(Request $request,$id)
  {
    $event = DB::table('events as e')
    ->select('e.id as evento','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->where('e.id','=',$id)
    ->first();

    $evento= DB::table('events')
    ->select('*')
    ->where('id','=',$id)
    ->first();


    $edad = Carbon::parse($event->fechanac)->age;
    $historial = Historial::where('paciente_id','=',$event->pacienteId)->first();
    $consultas = Consulta::where('paciente_id','=',$event->pacienteId)->get();
    $personal = Personal::where('estatus','=',1)->get();
	$productos = Producto::where('almacen','=',2)->where("sede_id", "=", $request->session()->get('sede'))->get();
    $ciex = Ciex::all();
    return view('events.show',[
      'data' => $event,
      'historial' => $historial,
      'consultas' => $consultas,
      'personal' => $personal,
	  'productos' => $productos,
      'ciex' => $ciex,
      'edad' => $edad,
      'evento' => $evento
    ]);
  }

  public function ticket_ver($id) 
  {
    $paciente = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.tipo','e.title','e.profesional','e.date','e.monto','e.time','e.created_at','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','cr.tipo_ingreso')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('creditos as cr','cr.id_event','e.id')
    ->where('e.id','=',$id)
    ->first();

    $view = \View::make('consultas.ticket_consulta')->with('paciente', $paciente);
    $pdf = \App::make('dompdf.wrapper');
      $pdf->setPaper(array(0,0,800.00,3000.00));
    $pdf->loadHTML($view);
    
    return $pdf->stream('ticket_ver');
  }

  private static function toggleType($type){
    switch ($type) {
      case "0":
        return "#43D12C";
        break;
      
      default:
        return '#f05050';
        break;
    }
  }

  private function getEvents($args = null){
    $events = [];
    $data = ($args) ? Event::where('profesional', '=', $args)->get() : Event::all();
    if($data->count()) {
      foreach ($data as $key => $value) {
        $datetime = RangoConsulta::find($value->time);
        $events[] = Calendar::event(
          $value->title,
          false,
          new \DateTime($value->date." ".$datetime->start_time),
          new \DateTime($value->date." ".$datetime->end_time),
          null,
          [
            'color' => self::toggleType($value->entrada),
            'url' => 'event-'.$value->id
          ]
        );
      }
    }
    return $events;    
  }

  public function create(Request $request){
    $validator = \Validator::make($request->all(), [
      "paciente" => "required", 
      "especialista" => "required", 
      "date" => "required", 
      "time" => "required",
      "title" => "required"
    ]);

    if($validator->fails()){
      $this->createView([
        "fail" => true,
        "errors" => $validator->errors()
      ]);
    }

    $paciente = Paciente::find($request->paciente);

    $user = User::where('id','=',Auth::user()->id);

  
    
        $evt = new Event;
        $evt->paciente=$request->paciente;
        $evt->profesional=$request->especialista;
        $evt->date=Carbon::today()->toDateString();
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=$request->monto;
        $evt->sede=$request->session()->get('sede');
        $evt->usuario= $user->name . " " . $user->lastname;
        $evt->tipo=$request->tipo;
        $evt->save();

      $credito = Creditos::create([
        "origen" => 'CONSULTAS',
        "descripcion" => 'CONSULTAS',
        "monto" => $request->monto,
        "tipo_ingreso" => $request->tipopago,
        "id_sede" => $request->session()->get('sede'),
        "id_event" => $evt->id
      ]);
	  
	 
   
    return redirect()->action('Events\EventController@all');

  }

  public function availableTime($e, $d, $m, $y){
    $times = Event::where('date', '=', $y."/".$m."/".$d)
    ->where('profesional', '=', $e)->get(['time']);
    $arrTimes = [];
    if($times){
      foreach ($times as $time) {
        array_push($arrTimes, $time->time);
      }
      return response()->json(RangoConsulta::whereNotIn("id", $arrTimes)->get(["start_time", "end_time", "id"]));
    }
    return response()->json(RangoConsulta::all()); 
  }

  public function createView($extra = []){
    $data = [
	  "especialistas" => Personal::where('tipo','=','Especialista')->orwhere('tipo','=','Tecnòlogo')->orwhere('tipo','=','ProfSalud')->where('estatus','=','1')->get(),
      "pacientes" => Paciente::where('estatus','=',1)->get(),
      "tiempos" => RangoConsulta::all(),
	  "ciex" => Ciex::all(),
    ];
    return view('consultas.create', $data + $extra);
  }
}