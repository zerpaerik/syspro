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
    <title>Recibo de Gasto</title>
</head>
<body>
    
    <div class="" style="font-size: 35px; text-align: center; margin-bottom: -15px;">
        <img src="/var/www/html/syspro/public/img/image.png"  style="width: 30%;"/>
    </div>

 <div class="" style="font-size: 40px; text-align: center;margin-bottom:-60px;margin-top: 2px;">
        <p><strong>MADRE TERESA - {{Session::get('sedeName')}}</strong></p>
        <p><strong>RUC: 20601183961</strong></p>
        @if(Session::get('sedeName') == 'INDEPENDENCIA')
        <p><strong>Teléfono: 5265711</strong></p>
        @else
        <p><strong>Teléfono: 5390547</strong></p>
        @endif
        <p><strong>RECIBO Nº</strong>0000{{$gastos->id}}</p>d}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
        <p><strong>FECHA {{$gastos->created_at}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
        <p><strong>DESCRIPCIÒN:</strong>{{$gastos->descripcion}}</p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
        <p><strong>MONTO:</strong>{{$gastos->monto}}</p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
        <p><strong>RECIBIDO POR:</strong>{{$gastos->nombre}}</p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
        <p><strong>ENTREGADO POR:</strong>{{$gastos->name}},{{$gastos->lastname}}</p>
    </div>



</body>
</html>


	





   
  

     



 
</body>
</html>