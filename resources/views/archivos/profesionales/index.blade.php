@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Archivos/Profesionales</span>
				    <a href="{{route('profesionales.create')}}" class="btn btn-success">Agregar</a>

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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Còdigo</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>DNI</th>
							<th>Especialidad</th>
							<th>Centro</th>
							<th>Registrado Por:</th>
							<th>Acciones:</th>


						</tr>
					</thead>
					<tbody>
					@foreach($profesionales as $p)					
						<tr>
						<td>{{$p->codigo}}</td>
						<td>{{$p->name}}</td>
						<td>{{$p->apellidos}}</td>
						<td>{{$p->dni}}</td>
						<td>{{$p->especialidad}}</td>
						<td>{{$p->centro}}</td>
						<td>{{$p->user}}</td>
						<td>
						<a href="profesionales-edit-{{$p->id}}" class="btn btn-primary">Editar</a>
												      @if(\Auth::user()->role_id == 4)							 

						<a href="profesionales-delete-{{$p->id}}" class="btn btn-danger"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>
						@endif

						</td>
						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Còdigo</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>DNI</th>
							<th>Especialidad</th>
							<th>Centro</th>
							<th>Registrado Por:</th>
							<th>Acciones:</th>
						</tr>
					</tfoot>
				</table>
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
