<style>
	.paciente {

margin-left: 100px;
margin-top: 45px;
margin-bottom: 2px;
}
.fecha {

margin-left: 100px;
margin-top:-30px;


}
.servicios {

margin-left: 50px;
margin-top:40px;

}
.analisis {

margin-left: 50px;
margin-top:-30px;

}

.acuenta {

margin-left: 50px;
margin-top:40px;
margin-bottom: 1px;

}

.pendiente {

margin-left: 180px;
margin-top:-50px;

}

.origen {

margin-left: 50px;
margin-top:-60px;

}

.total {

margin-left: 410px;
margin-top: -20px;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket de Método</title>
</head>
<body>

	<div class="" style="font-size: 35px; text-align: center; margin-bottom: -15px;">
		<img src="/var/www/html/syspro/public/img/image.png"  style="width: 30%;"/>
	</div>

<div class="" style="font-size: 40px; text-align: center;">
		<p><strong>MADRE TERESA - {{Session::get('sedeName')}}</strong></p>
		<p><strong>RUC: 20601183961</strong></p>
		@if(Session::get('sedeName') == 'INDEPENDENCIA')
		<p><strong>Teléfono: 5265711</strong></p>
		@else
		<p><strong>Teléfono: 5390547</strong></p>
		@endif
	    <p><strong>TICKET:0000{{ $metodos->id}}</strong></p>
	</div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-15px;">
		<p><strong>FECHA:{{ $metodos->created_at}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-15px;">
		<p><strong>PACIENTE:{{ $metodos->nombres}},{{ $metodos->apellidos}}</strong></p>
	</div>

	
	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-15px;">
		<p><strong>MÈTODOS ANTICONCEPTIVOS:{{ $metodos->producto}}
		</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-15px;">
		<p><strong> MONTO TOTAL: {{ $metodos->monto}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-15px;">
		<p><strong> MONTO PAGADO: {{ $metodos->monto}}</strong></p>
	</div>

	
</body>
</html>
