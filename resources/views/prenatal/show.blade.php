@extends('layouts.app')
@section('content')
<br>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="box-name">
          <i class="fa fa-users"></i>
          <span><strong>Control Prenatal del Paciente: {{$data->nombres}},{{$data->apellidos}}</strong></span>
            <span><strong>Fecha: {{$data->created_at}}</strong></span>
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
          {{ csrf_field() }}

            <h3>I. Antecedentes Obstetricos</h3>

            <label class="col-sm-1 control-label">Gestas</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gesta" value="{{$data->gesta}}" placeholder="gesta" data-toggle="tooltip" data-placement="bottom" title="gesta" readonly="">
            </div>

            <label class="col-sm-1 control-label">Aborto</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="aborto" value="{{$data->aborto}}"  placeholder="Noabortombres" data-toggle="tooltip" data-placement="bottom" title="aborto" readonly="">
            </div>

            <label class="col-sm-1 control-label">Vaginales</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="vaginales" value="{{$data->vaginales}}"  placeholder="vaginales" data-toggle="tooltip" data-placement="bottom" title="vaginales" readonly="">
            </div>

            <label class="col-sm-1 control-label">Nac.Vivos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="vivos" placeholder="vivos" value="{{$data->vivos}}" data-toggle="tooltip" data-placement="bottom" title="vivos" readonly="">
            </div>

              <label class="col-sm-1 control-label">Nac.Muertoss</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="muertos" placeholder="muertos" value="{{$data->muertos}}" data-toggle="tooltip" data-placement="bottom" title="muertos" readonly="">
            </div>

              <label class="col-sm-1 control-label">Viven</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="viven" placeholder="viven" value="{{$data->viven}}" data-toggle="tooltip" data-placement="bottom" title="viven" readonly="">
            </div>

              <label class="col-sm-1 control-label">Mueren.1Sem</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="semana1" placeholder="semana1" value="{{$data->semana1}}" data-toggle="tooltip" data-placement="bottom" title="semana1" readonly="">
            </div>

              <label class="col-sm-1 control-label">Despues.1Sem</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="semana2" placeholder="semana2" value="{{$data->semana2}}"  data-toggle="tooltip" data-placement="bottom" title="semana2" readonly="">
            </div>

              <label class="col-sm-1 control-label">Cesarea</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="cesaria" placeholder="cesarea" value="{{$data->cesaria}}" data-toggle="tooltip" data-placement="bottom" title="cesaria" readonly="">
            </div>

            <label class="col-sm-1 control-label">Partos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="parto" placeholder="parto" value="{{$data->parto}}" data-toggle="tooltip" data-placement="bottom" title="parto" readonly="">
            </div>

              <label class="col-sm-1 control-label">0 ó +3</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="num" placeholder="" value="{{$data->num}}"  data-toggle="tooltip" data-placement="bottom" title="" readonly="">
            </div>

            <label class="col-sm-1 control-label">250gr</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gr" placeholder="250gr"  value="{{$data->gr}}"  data-toggle="tooltip" data-placement="bottom" title="250gr" readonly="">
            </div>

            <label class="col-sm-1 control-label">Gemelar</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gemelar" placeholder="gemelar" value="{{$data->gemelar}}"  data-toggle="tooltip" data-placement="bottom" title="gemelar" readonly="">
            </div>
                        <label class="col-sm-3 control-label">37 Sem.</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="m37m" placeholder="m37m" value="{{$data->m37m}}"  data-toggle="tooltip" data-placement="bottom" title="m37m" readonly="">
            </div>

          <br>

          <div class="row">

            <div class="col-md-6">


               <h3>II. Antecedentes Familiares</h3>
              <p>
              
                         <div class="col-sm-12">
                          {{$data->af}}

            
            </div>
            </p>

                      </div>

                    <div class="col-md-6">


               <h3>III. Antecedentes Personales</h3>
              <p>
              
                         <div class="col-sm-12">
                          {{$data->ap}}
             
            </div>
            </p>

                      </div>


          </div>

          <br>

          <div class="row">


            <h3>IV. Fin Gestacion Anterior</h3>
                        <div class="col-md-3">

            <p>
            <label for="">Fecha</label>
             {{$data->fecha_terminacion}}
            
            </p>  

      </div>

                  <div class="col-md-3">


            <label for="">Fecha</label>
             Fecha:{{$data->fecha_terminacion}}
            <br>
          </div>

                  <div class="col-md-3">

            <label for="">Si fue aborto que tipo de aborto</label>
          
                {{$data->aborto_gestacion}}
            
          </div>

        <div class="col-md-3">

            <label for="">RN de mayor peso</label>
            <input readonly="true" type="text"  value="{{$data->peso_gestacion}}" disabled="">Gr
            <br>
          </div>

    </div>
                      
            <div class="row">
            <h3>V. Peso y Talla</h3>
            <div class="col-md-3">
            <label for="">Peso Gr.</label>
            <input type="text" name="peso_pregestacional" value="{{$data->peso_pregestacional}}" disabled="">
              </div>
              <div class="col-md-3">
            <label for="">Talla (Cm)</label>
            <input type="text" name="talla_pregestacional" value="{{$data->talla_pregestacional}}" disabled="">>
            </div>

            <div class="col-md-3">
            <label for="">Conclusiòn</label>
         

                            {{$data->conclusion}}

            </div>

            <div class="col-md-3">
            <label for="">IMC</label>
         

                            {{$data->imc}}

            </div>

            </div>
            <br>

            <div class="row">
          <div class="col-md-4">    


            <h3>VI. Tipo de Sangre</h3> 
            <div class="col-md-2">  
            <label for="">Grupo</label>
              <p>

                 {{$data->sangre}}

            </p>
               </div>
               <div class="col-md-2">
            <label for="">RH</label>
              <p>
              
      
                             {{$data->sangrerh}}

            </p>
               </div>
           </div>
           <div class="col-md-8">

               <h3>VI. F.U.M</h3> 

               <div class="col-md-2">
                        <label for="">FUM</label>
            <input type="date" name="ultima_menstruacion" value="{{$data->ultima_menstruacion}}" style="line-height: 20px" disabled="">
               </div>


               <div class="col-md-2">
                        <label for="">FPP</label>
            <input type="date" name="parto_probable" value="{{$data->parto_probable}}"  style="line-height: 20px" disabled>
               </div>

                <div class="col-md-2">
                        <label for="">Eco: EG</label>
            <input type="date" name="eco_eg" value="{{$data->eco_eg}}"  style="line-height: 20px" disabled=""> 
               </div>



            </div>


          </div>

          <div class="row">

          <div class="col-md-2">

          <h3>Orina</h3>  
          <p>
              
                    {{$data->orina}}


            <input type="date" name="orinad" style="line-height: 20px" value="{{$data->orinad}}" disabled=""> 
            </p>

          </div>  

          <div class="col-md-2">

          <h3>Urea</h3> 
          <p>
              
            <input type="text" name="urea" style="line-height: 20px" value="{{$data->urea}}" disabled=""> 

            <input type="date" name="uread" style="line-height: 20px" value="{{$data->uread}}" disabled="">  
            </p>

          </div>  

          <div class="col-md-2">

          <h3>Creati.</h3>  
          <p>
              
            <input type="text" placeholder="creatinina" name="creatinina" style="line-height: 20px" value="{{$data->creatinina}}" disabled="">  

            <input type="date" name="creatininad" style="line-height: 20px" value="{{$data->creatininad}}" disabled="">  
            </p>

          </div>

          <div class="col-md-2">

          <h3>BK</h3>  
          <p>
              
          
                                {{$data->bic}}


            <input type="date" name="bicd" style="line-height: 20px" value="{{$data->bicd}}" disabled=""> 
            </p>

          </div>  

          <div class="col-md-2">

          <h3>TORCH</h3>  
          <p>
              
            
                                            {{$data->torch}}


            <input type="date" name="torchd" style="line-height: 20px" value="{{$data->torchd}}" disabled=""> 
            </p>

          </div>    


            
          </div>

           @foreach($control as $c)

    <h2>Control Mensual de {{$data->nombres}} {{$data->apellidos}}</h2>
    <h2>Fecha {{$c->created_at}}</h2>

     <div class="row">

            <label class="col-sm-1 control-label">Gestaciòn</label>
            <div class="col-sm-3">
              {{$c->gesta_semanas}}
            </div>

            <label class="col-sm-1 control-label">PesoMadre.</label>
            <div class="col-sm-3">
             
              {{$c->peso_madre}}
            </div>

            <label class="col-sm-1 control-label">Temp.</label>
            <div class="col-sm-3">
              {{$c->temp}}
            </div>

            </div>
            <div class="row">

            <label class="col-sm-1 control-label">Tensiòn.</label>
            <div class="col-sm-3">
              {{$c->tension}}
            </div>

             <label class="col-sm-1 control-label">Alt.Ute.</label>
            <div class="col-sm-3">
            {{$c->altura_uterina}}
            </div>

            <label class="col-sm-1 control-label">Presentaciòn.</label>
            <div class="col-sm-3">
               {{$c->presentacion}}
            </div>

            </div>

                        <div class="row">


            <label class="col-sm-1 control-label">F.C.F.</label>
            <div class="col-sm-3">
              {{$c->fcf}}
            </div>

             <label class="col-sm-1 control-label">Movimiento.</label>
            <div class="col-sm-3">
               {{$c->movimiento_fetal}}
            </div>

             <label class="col-sm-1 control-label">Edema.</label>
            <div class="col-sm-3">
               {{$c->edema}}
            </div>
        </div>

                    <div class="row">


             <label class="col-sm-1 control-label">Pulso.</label>
            <div class="col-sm-3">
               {{$c->pulso_materno}}
            </div>


             <label class="col-sm-1 control-label">Consejeria</label>
            <div class="col-sm-3">
              {{$c->consejeria}}
            </div>


             <label class="col-sm-1 control-label">Vitaminas.</label>
            <div class="col-sm-3">
              {{$c->sulfato}}
            </div>

        </div>

                    <div class="row">



             <label class="col-sm-1 control-label">Perfil.</label>
            <div class="col-sm-3">
              {{$c->perfil_biofisico}}
            </div>


             <label class="col-sm-1 control-label">Visita.</label>
            <div class="col-sm-3">
               {{$c->visita_domicilio}}
            </div>

             <label class="col-sm-1 control-label">Establ.</label>
            <div class="col-sm-3">
            
               {{$c->establecimiento_atencion}}
            </div>

        </div>

             <label class="col-sm-1 control-label">Responsable.</label>
            <div class="col-sm-3">

                             {{$c->responsable_control}}

            </div> 

            <label class="col-sm-1 control-label">Examenes.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="EXAMENES" placeholder="EXAMENES" data-toggle="tooltip" data-placement="bottom" title="responsable_control" readonly="true">
            </div> 


            <label class="col-sm-1 control-label">.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="EXAMENES" placeholder="EXAMENES" data-toggle="tooltip" data-placement="bottom" title="responsable_control" readonly="true">
            </div> 



          
                    <div class="row">



             <label class="col-sm-1 control-label">Serologia</label>
            <div class="col-sm-2">
            <strong>Resultado:</strong>:{{$c->sero}}
             <strong>Fecha:</strong>:{{$c->serod}}


            </div>


             <label class="col-sm-1 control-label">Glucosa</label>
            <div class="col-sm-2">
                 <strong>Resultado:</strong>:{{$c->glu}}
             <strong>Fecha:</strong>:{{$c->glud}}

            </div>

             <label class="col-sm-1 control-label">VIH</label>
            <div class="col-sm-2">
                  <strong>Resultado:</strong>:{{$c->vih}}
             <strong>Fecha:</strong>:{{$c->vihd}}

            </div>

            <label class="col-sm-1 control-label">Hemoglobina</label>
            <div class="col-sm-2">
                  <strong>Resultado:</strong>:{{$c->hemo}}
             <strong>Fecha:</strong>:{{$c->hemod}}

            </div>

        </div>


   @endforeach



            
          </div>
          </div>                                                                                                                    
          </div>
        </div>
        </form>
      </div>  
    </div>
  </div>
</div>

@endsection