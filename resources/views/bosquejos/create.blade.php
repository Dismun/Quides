@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
        <h4>
            <label>Bosquejo Diario del 
            	 {{$fecha->format('d/m/Y')}}         
        		Añadiendo.....
        	</label>
    	</h4>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Centro
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Punto
	 	</div> 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Persona
	 	</div>

	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
		@foreach( $arrayBosquejos as $key => $bosquejo )
    		<div class="row" style="margin: 5px 5px 5px 5px;  ">
        		<div class="col-md-1" style="color:{{$bosquejo->ccolor}} ;">
	 				{{$bosquejo->codigo}}
	 			</div>

	 			<div class="col-md-3">
	 				{{$bosquejo->descturno}}
	 			</div>
	 			
	 			<div class="col-md-3" style="background-color:{{$bosquejo->ncolor}} ;">
	 				{{$bosquejo->descpunto}}
	 			</div>
	 			
	 			
	 			<div class="col-md-3">
	 				  {{$bosquejo->nombre}}
	 			</div>
	 		
    		</div>

    	@endforeach	
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF; ">
    	
       			<div class="col-md-1" id="centro">	 			
	 			
	 			</div>
	 			<div class="col-md-3">
	 				<select name='idturno' id='idturno' class="form-control" form='bosq' onchange="javascript:PuntosFiltro({{$arrayPuntos}},{{$arrayBosquejos}});" required>
	 						<option value=''> Selecciona turno </option>
	 						@foreach( $arrayTurnos as $key2 => $turno )
	 							<option value="{{ $turno->id }}" > {{ $turno->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			</div>
	 			<div class="col-md-3" id="Puntos">
	 				<select name='idpunto' id='idpunto' class="form-control" form='bosq' required>
	 						<option value=''> Selecciona punto </option>
	 						@foreach( $arrayPuntos as $key2 => $punto )
	 							<option value="{{ $punto->id }}" > {{ $punto->descripcion }} </option>
	 						@endforeach
	 					</select>	
	 			</div>
	 			<div class="col-md-3">
	 				
	 				<select name='idpersona' id='idpersona' value="" class="form-control" form='bosq' required>
	 						<option value=''> Selecciona persona </option>
	 						@foreach( $arrayPersonas as $key2 => $persona )
	 							<option value="{{ $persona->id }}" > {{ $persona->nombre }} </option>	 							
	 						@endforeach
	 					</select>	
	 				
	 			</div>
			

	 		
			
	 		<div class="col-md-1">
	 			
					<form method="POST" id='bosq' action="{{action('Bosquejos\BosquejoController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<input type="hidden" value="{{$fecha->format('Y-m-d')}}" name="fecha" id="fecha"/>
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/bosquejos/{{$fecha->format('Y-m-d') }}'; ">
							<i class="fa fa-window-close"></i>
						</button>
					</form>	
				
	 		</div>
	 		
    	</div>

    	

    	

          				

@stop

<script type="text/javascript">

	function PuntosFiltro(p,b)
	{
		var htmljs="";

		Object.keys(b).forEach(function(key){
			var val = b[key];
  			if (val.idturno == document.getElementById("idturno").value )
  				{
  					Object.keys(p).forEach(function(ind) {
  						if (val.idpunto == p[ind].id ){
  							delete p[ind];
  						}
  					});
   				}

		});

		htmljs = "<select name='idpunto' id='idpunto' class='form-control' form='bosq' required> <option value=''> Selecciona punto </option>";

		
		Object.keys(p).forEach(function(ind) {
  						
  						htmljs=htmljs + "<option value='" + p[ind].id +"' > "+p[ind].descripcion+ " </option>";
  					});
		
	 				
	 	htmljs=htmljs + "</select>";
	 	document.getElementById("Puntos").innerHTML = htmljs;	
	}

</script>
