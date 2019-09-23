<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Models\Config\{Medida, Categoria, Sede, Proveedor};
use DB;
use App\Models\Creditos;
use App\Models\Descarga;
use Toastr;
use Auth;


class ProductoController extends Controller
{

    public function index(){
		//	$producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 1)->orderBy('nombre','ASC')->get();
			return view('generics.index5', [
				"icon" => "fa-list-alt",
				"model" => "existencias",
        "model1" => "Productos en Almacen Central",
				"headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
				"data" => $producto,
				"fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
			]);    	
    }

      public function index2(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->orderBy('nombre','ASC')->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Local",
        "headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

    
   public function entrada(Request $request){
    
          $p = Producto::find($request->producto);
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();
          Toastr::success('La Entrada se Registro Exitosamente.', 'Producto!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@index', ["created" => false]);
  
    }

    public function createView($extraArgs = []){
    	return view('existencias.create', ["categorias" => Categoria::all(), "medidas" => Medida::all()] + $extraArgs);
    }

    public function editView($id){
      $p = Producto::find($id);

      return view('existencias.edit', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa,"categoria" => $p->categoria]);
      
    }

   /* public function productInView(){
      return view('existencias.entrada', [
        "productos" => Producto::where('sede_id', '=', 1)->get(['id', 'nombre']),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);
    }*/

     public function productInView(){
      $sedes = Sede::where("id",'=',1)->get(["id", "name"]);
      return view('existencias.entrada', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 1)->get(['id', 'nombre']),"sedes" => $sedes,"proveedores" => Proveedor::all()]);    
    }

    public function productOutView(){
      return view('existencias.salida', [
        "productos" => Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->get(['id', 'nombre','cantidad']),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);    
    }

    public function productTransView(){
      $sedes = Sede::whereNotIn("id", [\Session::get('sede')])->get(["id", "name"]);
      return view('existencias.transferir', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->get(['id', 'nombre']), "sedes" => $sedes]);    
    }

    public function getProduct($id){
      $p = Producto::find($id);
      return response()->json(["producto" => $p], 200);
    }

    public function addCant(Request $request){
	
       $searchProduct = DB::table('productos')
                    ->select('*')
                    ->where('almacen','=','2')
                    ->where('id','=', $request->producto)
                    ->first();   

                    $nombre = $searchProduct->nombre;
					$cantidadactual = $searchProduct->cantidad;
		if( $request->cantidadplus > $cantidadactual){
		 Toastr::error('Cantidad excede Maximo en stock', 'Error!', ['progressBar' => true]);
		 return redirect()->action('Existencias\ProductoController@index2', ["created" => true]);
		} else {
			
		  Producto::where('id', $request->producto)
                  ->update([
                      'cantidad' => $cantidadactual - $request->cantidadplus,
                  ]);
				  
		      $creditos = new Creditos();
              $creditos->origen = 'VENTA DE PRODUCTOS';
              $creditos->id_atencion = NULL;
              $creditos->monto= $request->monto;
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'VENTA DE PRODUCTOS';
              $creditos->save();
			  
       Toastr::success('Registrada Exitosamente', 'Venta!', ['progressBar' => true]);
      return redirect()->action('Existencias\ProductoController@index2', ["created" => true]);
		}
    
    }

    public function transfer(Request $request){
		
      $pfrom = Producto::where('sede_id', '=', \Session::get("sede"))
      ->where("id", '=', $request->id)
      ->get()->first();
      $pfrom->cantidad = $pfrom->cantidad - $request->cantidadplus;
      $wasSubs = $pfrom->save();

      $p = Producto::where('sede_id', '=', $request->sede)
      ->where("nombre", '=', $pfrom->nombre)
      ->get()->first();
      if($wasSubs){
        if($p){
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();
          return response()->json(["success" => $res, "producto" => $pfrom, "to" => $p]);
        }else{
          $newprod = Producto::create([
            "nombre" => $pfrom->nombre,
            "categoria" => $pfrom->getOriginal("categoria"),
            "medida" => $pfrom->getOriginal("medida"),
            "vence" => $pfrom->getOriginal("vence"),
            "cantidad" => $request->cantidadplus,
            "sede_id" => $request->sede,
            "almacen" => 2
          ]);
          return response()->json(["success" => true, "producto" => $pfrom, "to" => $newprod]);
        }
      }
    }

    public function edit(Request $request){
      $p = Producto::find($request->id);
      $p->cantidad = $request->cantidad;
      $res = $p->save();
      return redirect()->action('Existencias\ProductoController@index', ["edited" => $res]);
    }

    public function delete($id){
      $p = Producto::find($id);
      $res = $p->delete();
      
       Toastr::success('Eliminado Exitosamente.', 'Producto!', ['progressBar' => true]);
        return redirect()->action('Existencias\ProductoController@index2', ["created" => false]);
    }

    public function getExist($prod, $sede){
      $ex = Producto::where('id', '=', $prod)->where("sede_id", "=", $sede)->where("almacen",'=', 1)
      ->get(["cantidad"])->first();
      $prod = Producto::where('id', '=', $prod)->get()->first();
      if($ex){
        return response()->json(["existencia" => $ex, "exists" => true, "medida" => $prod->medida]);
      }else{
        return response()->json(["exists" => false, "medida" => $prod->medida]);
      }
    }


    public function codigoProduct(Request $request){

        $searchpacienteDNI = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('codigo','=', $request->codigo)
                    ->where('sede_id','=',$request->session()->get('sede'))
                    ->get();

           if (count($searchpacienteDNI) > 0){

              return true;
           } else {

              return false;
           }

    }

    public function create(Request $request){
      $validator = \Validator::make($request->all(), [
        'nombre' => 'required|unique:productos'
      ]);

        if($validator->fails()) {

          Toastr::error('Error Registrando.', 'Nombre de Producto ya EXISTE!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@createView', ['errors' => $validator->errors()]);

      } else {
    

       $producto = Producto::create([
        "nombre" => $request->nombre,
        "codigo" => $request->codigo,
        "categoria" => $request->categoria,
        "medida" => $request->medida,
        "preciounidad" => $request->preciounidad,
        "precioventa" => $request->precioventa,
        "vence" => $request->vence,
        "sede_id" => $request->session()->get('sede'),
        "almacen" => 1
      ]);

       }
	  
	    
       Toastr::success('Registrado Exitosamente.', 'Producto!', ['progressBar' => true]);
       return redirect()->action('Existencias\ProductoController@index', ["created" => true]);
       
     


   }
   
		

    public function historicoView(){
      return view('existencias.historico', ["transferencias" => $this->unique_multidim_array(Transferencia::all(), "code")]);
    }

    public function transView($code){
      $t = Transferencia::where('code', '=', $code)->get();
      return view('existencias.transferencia', ["transferencias" => $t, "code" => $code]);
    }

    function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }   



     public function descargar(Request $request){


        if(!is_null($request->fecha) && !is_null($request->fecha2)){

              $f1=$request->fecha;
              $f2=$request->fecha2; 

         $descargas= DB::table('descargar_mat as a')
                    ->select('a.id','a.producto','a.cantidad','a.sede','a.observacion','a.almacen','a.usuario','a.created_at','u.name','u.lastname','p.nombre','s.name as sede')
                    ->join('productos as p','a.producto','p.id')
                    ->join('users as u','u.id','a.usuario')
                    ->join('sedes as s','s.id','a.sede')
                    ->where('a.sede','=',$request->session()->get('sede'))
                    ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
                    ->get();


        }else{



          $f1=date('Y-m-d');
          $f2=date('Y-m-d'); 

         $descargas= DB::table('descargar_mat as a')
                    ->select('a.id','a.producto','a.cantidad','a.sede','a.observacion','a.almacen','a.usuario','a.created_at','u.name','u.lastname','p.nombre','s.name as sede')
                    ->join('productos as p','a.producto','p.id')
                    ->join('users as u','u.id','a.usuario')
                    ->join('sedes as s','s.id','a.sede')
                    ->where('a.sede','=',$request->session()->get('sede'))
                    ->whereBetween('a.created_at',[$f1,$f2])
                    ->get();



        }



      return view('existencias.descargar',compact('f1','f2','descargas'));


    }

    

    public function descargarcreate(Request $request){

      $producto= Producto::where('sede_id','=',$request->session()->get('sede'))->where('almacen','=',2)->get();


      return view('existencias.descargarcreate',compact('producto'));
    }


     public function procesarDescarga(Request $request){

      $produc= Producto::where('id',$request->producto)->first();


       Producto::where('id', $request->producto)
                  ->update([
                      'cantidad' => $produc->cantidad - $request->cantidad,
                  ]);


               $productom = new Descarga();
              $productom->producto = $request->producto;
              $productom->almacen = $request->almacen;
              $productom->cantidad= $request->cantidad;
              $productom->observacion= $request->observacion;;
              $productom->sede = $request->session()->get('sede');
              $productom->usuario= Auth::user()->id;
              $productom->save();


       Toastr::success('Registrada Exitosamente', 'Descarga!', ['progressBar' => true]);
           return redirect()->action('Existencias\ProductoController@descargar');
      

    }





}
