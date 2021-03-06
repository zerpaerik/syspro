@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
						<a href="{{route($model.'.create')}}" class="btn btn-primary">Agregar</a>

			<div class="box-header">
				<div class="box-name">
					<i class="fa {{$icon}}"></i>
					<span><strong>{{ucfirst($model)}}</strong></span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
			               <div class="box-content no-padding table-responsive">				

				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<form action="/atenciones-search" method="get">
						<h5>Rango de fechas</h5>
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="" style="line-height: 20px">
						<label for="">Buscar</label>
						<input type="text" name="nombre" style="line-height: 20px">
						<input type="submit" class="btn btn-primary" value="Buscar">
					</form>
					<thead> 
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Abono</th>
							<th>Fecha</th>
							<th>TI</th>
							<th>RP:</th>
							<th>TCK</th>
							<th>EDT</th>
							<th>ELM</th>

						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->apellidos}},{{$d->nombres}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->monto}}</td>
						<td>{{$d->abono}}</td>
						<td>{{date('d-m-Y H:i', strtotime($d->created_at))}}</td>
						<td>{{$d->tipo_ingreso}}</td>
						<td>{{$d->user}},{{$d->userp}}</td>
						@if(\Auth::user()->role_id == 6)
						@if(Carbon\Carbon::now()->format('d-m-Y') == date('d-m-Y', strtotime($d->created_at)))
						<td><a target="_blank" class="btn btn-primary" href="{{$model1.'-ver-'.$d->id}}">Ver Ticket</a></td>
						@else
						@endif
						@endif 
						@if(\Auth::user()->role_id <> 6)							 
						<td><a target="_blank" class="btn btn-primary" href="{{$model1.'-ver-'.$d->id}}">TICK</a></td>
						<td><a class="btn btn-warning" href="{{$model . '-edit-' .$d->id}}">EDIT</a></td>

						<td>  <a class="btn btn-danger" href="{{$model.'-delete-'.$d->id}}">ELIM</a></td>
		                 @endif
						 
						</tr>
						@endforeach						
					</tbody>
					
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif

<script type="text/javascript">
	function del(id){
		$.ajax({
      url: "{{$model}}-delete-"+id,
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "delete",
      dataType: "json",
      data: {},
      success: function(res){
      	location.reload(true);
      }
    });
	}

	function closeModal(){
		$('#myModal').modal('hide');
	}

	function openmodal(){
		$("#myModal").show();
	}

</script>

<div id="myModal" class="modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Modal Body</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeModal()" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection
