@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-6" >
        <center>
        <h4>
            <label>Informe de Guardias   
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
        	<form action= "relacionguardias" method="GET" style="display:inline">
        		<label>Desde el día
        			<input type="date"  name="fechai" id="fechai" value= "{{$f1->format('Y-m-d')}}" class="form-control" required />
        		</label>
        		<label>Hasta el día
        			<input type="date"  name="fechaf" id="fechaf" value="{{$f2->format('Y-m-d')}}" class="form-control" required />
        		</label>
        		
         			<button class="btn btn-success" type="submit" aria-label="Editar" onclick="javascript:preparando()">
         			
						<i class="fa fa-check"></i>
					</button>
			</form>
			
        </center>
    	
       
    </div>

    
    
</div>
<div class="row">
	
	<div class="col-md-12" id="calcu" style=" color:blue;">
		
	</div>

</div>
<script type="text/javascript">
	function preparando(){
		document.getElementById("calcu").innerHTML = "<h1 >Preparando P D F.........</h1>";
	}
</script>
  				         				

@stop