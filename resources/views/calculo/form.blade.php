@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-6" >
        <center>
        <h4>
            <label>Cálculo de Bosquejo 
            	<?php 
            		$f1 = get_class($fecha)::createFromFormat('Y-m-d', $fecha->format('Y-m-d')); 
            		$f2 = get_class($fecha)::createFromFormat('Y-m-d', $fecha->format('Y-m-d'))->copy()->addMonth(3);  
            	?>
            
            	
			</label>
		</h4>
            	
        </center>
       
    </div>
    <div class="col-md-6" > 
    	
        <center>
        	<form action= "calcula" method="GET" style="display:inline">
        		<label>Desde el día
        			<input type="date"  name="fechai" id="fechai" value= "{{$f1->format('Y-m-d')}}" class="form-control" required />
        		</label>
        		<label>Hasta el día
        			<input type="date"  name="fechaf" id="fechaf" value="{{$f2->format('Y-m-d')}}" class="form-control" required />
        		</label>
        		
         			<button class="btn btn-success" type="submit" aria-label="Editar" onclick="javascript:calculando()">
         			
						<i class="fa fa-check"></i>
					</button>
			</form>
			
        </center>
    	
       
    </div>

    
    
</div>
<div class="row">
	 <div class="col-md-12" >
		<h2>Ojo, el proceso de cálculo de bosquejo, eliminará todas los cálculos previos no bloqueados, así como todas las modificaciones posteriores realizadas en los bosquejos calculados previamente entre las fechas especificadas.</h2>
	</div>
	<div class="col-md-12" id="calcu" style=" color:blue;">
		
	</div>

</div>
<script type="text/javascript">
	function calculando(){
		document.getElementById("calcu").innerHTML = "<h1 >C A L C U L A N D O........</h1>";
	}
</script>
  				         				

@stop