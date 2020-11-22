<head>
    <style type="text/css">
      {
        margin: 0;
        padding: 0;
      }
      .table-main{
       margin-left:-45px;
       margin-right:-56px;
      }
      .cl{
        margin: 0;
        padding: 0;

      }
      .truncate {
        width: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      @page {
        header: page-header;
        footer: page-footer;
      }
      footer {
        border:solid red;
      }
    </style>

    <meta charset="utf-8">

  </head>

    <body style="width:100%; position:fixed: top: 1px; ">

    <br><br>

	<div class="" style="font-size: 35px; text-align: center;margin-bottom: 15px;">
		<img src="/var/www/html/syspro/public/img/image.png"  style="width: 30%;"/>
	</div>

    <div  style="font-size: 15px; text-align: center;margin-bottom:-60px;margin-top: -30px;">
		<p><strong>SYSMEDIC PERU SAC - {{Session::get('sedeName')}}</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20606283980</strong></p>
		@if(Session::get('sedeName') == 'INDEPENDENCIA')
		<p><strong>Teléfono: 5265711</strong></p>
		<p><strong>WhatsApp: 940309507</strong></p>
		@else
		<p><strong>Teléfono: 5390547</strong></p>
		<p><strong>WhatsApp: 940309506</strong></p>
		@endif



    <p style="margin-top: -20px;"><strong>________________________________________________________</strong>  </p>
    <p style="margin-top: -15px;font-size: 14px;text-align: center;"><strong>RECIBO PAGO A CUENTA Nº:0000{{$recibo->id}}</strong></p>
    <p style="margin-top: -30px;"><strong>________________________________________________________</strong>  </p>

    <p style="margin-left: -80px;font-size: 14px;"><strong>FECHA:</strong> {{ $recibo->created_at}}</p>

	

	</div>
    <br><br>
    <div  style="font-size: 15px; text-align: left;margin-bottom:-20px;margin-top: 20px;">
		<p style="margin-left: -40px;"><strong>PACIENTE:</strong> {{ $recibo->nombres}},{{ $recibo->apellidos}}</p>
    <p style="margin-left: -40px;margin-top: -10px;"><strong>DNI:</strong> {{ $recibo->dni}}</p>
	
	</div>
  <br><br>

  
  <table width="100%" class="table-main">
      <thead>
        <tr>
          <th style="font-size: 15px"><center>Detalle.<center></th>
          <th style="font-size: 15px"><center>Monto.<center></th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td style="font-size: 15px; line-height: 30px;" align="center">COBRO</td>
            <td style="font-size: 15px; line-height: 30px;" align="center">{{ $recibo->monto}}</td>
          </tr>
      </tbody>
    </table>




    <br>

    <table width="100%">
      <tbody>
        <tr>
          <td style="width: 100%;">
            <table width="100%">
              <tbody>
                   

                    <tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">TOTAL</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $recibo->monto}}</td>
                    </tr>
					<tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">ABONADO</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $recibo->abono_parcial}}</td>
                    </tr>
                    <tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">TOTAL ABONADO</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $recibo->abono}}</td>
                    </tr>
					<tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">RESTA</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $recibo->pendiente}}</td>
                    </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

	<br><br>
	<center><p style="font-size: 15px;">COMUNICADO</p></center>
	<p style="text-align: justify;font-size: 15px;">Estimado cliente se informa, que todo estudio que quede pendiente de su realizaciòn <strong>tiene un plazo no mayor a 30 dias,</strong>contando desde la fecha de su cancelaciòn, <strong>pasado este tiempo quedarà como anulado dicho estudio</strong>. Asi mismo las <strong>consultas de reevaluaciòn tienen un plazo de 15 dias,</strong> pasado este tiempo el paciente deberà cancelar por su consulta.</p>

	

    

    </body>
