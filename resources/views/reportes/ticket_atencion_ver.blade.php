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
	<title>Ticket de Atención</title>
</head>
<body>
	
	<div class="" style="font-size: 35px; text-align: center; margin-bottom: -15px;">
		<img src="/var/www/html/syspro/public/img/image.png"  style="width: 30%;"/>
	</div>

 <div class="" style="font-size: 40px; text-align: center;margin-bottom:-60px;margin-top: 2px;">
		<p><strong>MADRE TERESAA - {{Session::get('sedeName')}}</strong></p>
		<p><strong>RUC: 20601183961</strong></p>
		@if(Session::get('sedeName') == 'INDEPENDENCIA')
		<p><strong>Teléfono: 5265711</strong></p>
		@else
		<p><strong>Teléfono: 5390547</strong></p>
		@endif
	    <p><strong>TICKET:{{ $ticket->id}}</strong></p>
	</div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>FECHA:{{ date('d/m/Y', strtotime($ticket->created_at)) }}</strong></p>
	</div>



	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>PACIENTE:{{ $ticket->nombres}},{{ $ticket->apellidos}} {{ $ticket->dni}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>DETALLE:{{ $ticket->detalle}}
		</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>ORIGEN:{{ $ticket->nompac}},{{ $ticket->apepac}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>MONTO: {{ $ticket->monto}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>PAGADO:{{ $ticket->abono}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;">
		<p><strong>RESTA: {{ $ticket->pendiente}}</strong></p>
	</div>

	<br><br><br><br><br><br><br><br>
	<center><p style="font-size: 60px;">COMUNICADO</p></center>
	<p style="text-align: justify;font-size: 30px;">Estimado cliente se informa, que todo estudio que quede pendiente de su realizaciòn <strong>tiene un plazo no mayor a 30 dias,</strong>contando desde la fecha de su cancelaciòn, <strong>pasado este tiempo quedarà como anulado dicho estudio</strong>. Asi mismo las <strong>consultas de reevaluaciòn tienen un plazo de 15 dias,</strong> pasado este tiempo el paciente deberà cancelar por su consulta.</p>

	

	



</body>
</html>
