@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Movimientos/Gastos</span>
					<a href="{{route('gastos.create')}}" class="btn btn-success">Agregar</a>

				</div>


				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>

				<div class="no-move"></div>
				
			</div>
			{!! Form::open(['method' => 'get', 'route' => ['gastos.index']]) !!}

			<div class="row">
				<div class="col-md-2">
					{!! Form::label('fecha', 'Seleccione una Fecha', ['class' => 'control-label']) !!}
					{!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha'))
					<p class="help-block">
						{{ $errors->first('fecha') }}
					</p>
					@endif

					
				</div>
				<div class="col-md-2">

					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
				
			</div>	

			<div class="box-content no-padding">
								<div class="box-content no-padding table-responsive">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Descripcion</th>
							<th>Recibido Por:</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Registrado Por:</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>

						@foreach($gastos as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->descripcion}}</td>
						<td>{{$d->nombre}}</td>
						<td>{{$d->monto}}</td>
						<td>{{$d->created_at}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						<td>
						@if(\Auth::user()->role_id <> 6)
						<a class="btn btn-success" href="gastos-edit-{{$d->id}}">Editar</a>	
						<a class="btn btn-warning" href="gastos-delete-{{$d->id}}"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	
						@endif
						 <a  href="{{asset('recibo_gasto_ver')}}/{{$d->id}}" class="btn btn-xs btn-danger">Recibo</a>
						</td>

				        @endforeach
				    </tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Descripcion</th>
							<th>Recibido Por:</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Registrado Por:</th>
							<th>Acciones:</th>
						</tr>
					</tfoot>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>

</body>



<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>




<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	TestTable1();
	TestTable2();
	TestTable3();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
	// Add Drag-n-Drop feature
	WinMove();
});
</script>
@endsection
