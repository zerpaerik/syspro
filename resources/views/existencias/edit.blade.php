@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar Producto</strong></span>
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
			<div class="box-content">
				<h4 class="page-header"></h4>
				<form class="form-horizontal" role="form" method="post" action="producto/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" value="{{$nombre}}" title="Nombre">
						</div>

						
						<label class="col-sm-1 control-label">Unit.</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="preciounidad" value="{{$preciounidad}}" placeholder="preciounidad" data-toggle="tooltip" data-placement="bottom" title="preciounidad">
						</div>

						<label class="col-sm-1 control-label">Venta.</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="precioventa" value="{{$precioventa}}" placeholder="precioventa" data-toggle="tooltip" data-placement="bottom" title="precioventa">
						</div>

						<label class="col-sm-1 control-label">Cantidad.</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="cantidad" value="{{$cantidad}}" placeholder="cantidad" data-toggle="tooltip" data-placement="bottom" title="cantidad">
						</div>


						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('productos.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection