@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-6" >
        <center>
        <h4>
            <label>Bosquejos del {{$fechai->format('d-m-Y')}} al {{$fechaf->format('d-m-Y')}}</label>
		</h4>
            	
        </center>
       
    </div>
    <div class="col-md-6" > 
    	<center>
        	<form action= "muestra" method="GET" style="display:inline">
        		
        			<input type="date"  name="fechai" id="fechai" value= "{{$fechai->format('Y-m-d')}}"  />
        			<input type="date"  name="fechaf" id="fechaf" value="{{$fechaf->format('Y-m-d')}}"  />
        		
        		<label>Muestra
        			
        		
        		
         			<button class="btn btn-success" type="submit" aria-label="Editar">
         			
						<i class="fa fa-check"></i>
					</button>
				</label>
			</form>
			
        </center>
       
    	
       
    </div>

    
    
</div>



 
    	
    	

    	
          				         				

@stop