@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-6" >
        <center>
        <h4>
            <label>Parametrizacion Informe de Turnos   
            <?php 
            		$f1 = get_class($fecha)::createFromFormat('Y-m-d', $fecha->format('Y-m-d')); 
            		$f2 = get_class($fecha)::createFromFormat('Y-m-d', $fecha->format('Y-m-d'))->copy()->addMonth(3);  
            	?>                              	
			</label>
		</h4>
            	
        </center>
       
    </div>
    <div class="col-md-6" > 
    	
        
    	
       
    </div>

    
    
</div>
<div class="row">
    <div class="col-md-12" style=" color:blue;">
       <center>
            <form action= "relacionguardias" method="GET" style="display:inline">
              <div class="col-md-12" style=" color:blue;">  
                <label>Desde el día
                    <input type="date"  name="fechai" id="fechai" value= "{{$f1->format('Y-m-d')}}" class="form-control" required />
                </label>
                <label>Hasta el día
                    <input type="date"  name="fechaf" id="fechaf" value="{{$f2->format('Y-m-d')}}" class="form-control" required />
                </label>
            </div>
                <div class="col-md-12" style=" color:blue;">
                    <select name='idturno' id='idturno' class="form-control" required>
                            <option value=''> Selecciona turno </option>
                            @foreach( $arrayTurnos as $key2 => $turno )
                                <option value="{{ $turno->id }}" > {{ $turno->descripcion }} </option>
                            @endforeach
                    </select>
                </div>
                     <div class="col-md-3" style=" color:blue;">
                        <label>Chamanes
                            <input type="checkbox" class="form-control" name="chamanes" id="chamanes"  checked />
                        </label>
                    </div>
                     <div class="col-md-3" style=" color:blue;">
                        <label>Personal de equipos
                            <input type="checkbox" class="form-control" name="equipos" id="equipos"  checked />
                        </label>
                    </div>
                    <div class="col-md-3" style=" color:blue;">
                        
                            <label> Personal Externo
                                <input type="checkbox" class="form-control" name="externos" id="externos"  checked />
                            </label>
                       
                    </div>
                    <div class="col-md-3" style=" color:blue;">
                        
                            <label> Otros
                                <input type="checkbox" class="form-control" name="otros" id="otros"  checked />
                            </label>
                        
                    </div>
                 <div class="col-md-12" style=" color:blue;">
                    <button class="btn btn-success" type="submit"  onclick="javascript:preparando()">
                        
                        <i class="fa fa-check"></i>Aceptar
                    </button>
                </div>
            </form>
            
        </center> 
        
    </div>
	
	<div class="col-md-12" id="calcu" style=" color:blue;">
		
	</div>

</div>
<script type="text/javascript">
	function preparando(){
		document.getElementById("calcu").innerHTML = "<h3 >Preparando P D F.........</h3>";
	}
</script>
  				         				

@stop