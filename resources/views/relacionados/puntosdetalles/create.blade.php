@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Detalle de Puntos</h2>
            <h3>Añadiendo.....</h3>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Punto
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-4" style="background-color: Grey; color:#FFFFFF;">
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Lu
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Ma
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Mi
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Ju
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Vi
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Sá
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Do
		 	</div>
		 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
		 		Festivos
		 	</div>
		 </div>
	 	


	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
		
    	@foreach( $arrayPuntosdetalles as $key => $puntosdetalle)
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:{{$puntosdetalle->color}}; ">
    		
			
				<div class="col-md-3">
	 				{{$puntosdetalle->descp}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$puntosdetalle->desct}}
	 			</div>
				<div class="col-md-4">
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->lunes)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->martes)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->miercoles)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->jueves)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->viernes)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->sabado)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->domingo)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->festivo)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 		</div>
			
		</div>
		@endforeach	
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF; ">
    	
       			<div class="col-md-3">
        			<select name='idpunto' id='idpunto' class="form-control" form='puntosdetalle' onchange="javascript:TurnosFiltro({{$arrayTurnos}},{{$arrayPuntosdetalles}});" required>
        					<option value=''> Selecciona Punto </option>
	 						@foreach( $arrayPuntos as $key2 => $punto )
	 							<option value="{{ $punto->id }}" > {{ $punto->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 			
	 			
	 			</div>
	 			<div class="col-md-3" id='turn'>
	 				<select name='idturno' id='idturno' class="form-control" form='puntosdetalle' required>
	 						<option value=''> Selecciona turno </option>
	 						@foreach( $arrayTurnos as $key2 => $turno )
	 							<option value="{{ $turno->id }}" > {{ $turno->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			</div>
	 			<div class="col-md-4">
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="lunes" id="lunes" form="puntosdetalle" checked />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="martes" id="martes" form="puntosdetalle" checked />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="miercoles" id="miercoles" form="puntosdetalle" checked />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="jueves" id="jueves" form="puntosdetalle" checked />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="viernes" id="viernes" form="puntosdetalle" checked />
					</div>
					
		 			<div class="col-md-1">
							<input type="checkbox" class="form-control" name="sabado" id="sabado" form="puntosdetalle" />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="domingo" id="domingo" form="puntosdetalle"/>
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="festivo" id="festivo" form="puntosdetalle"/>
					</div>
				</div>
			

	 		
			
	 		<div class="col-md-2">
	 			
					<form method="POST" id='puntosdetalle' action="{{action('Relacionados\PuntosdetalleController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/puntos_detalle'">
						<i class="fa fa-window-close"></i>
						</button>
					</form>	
				
	 		</div>
	 		
    	</div>

    	

    	

          				

@stop
<script type="text/javascript">

	function TurnosFiltro(t,p)
	{
		var htmljs="";

		Object.keys(p).forEach(function(key){
			var val = p[key];
  			if (val.idpunto == document.getElementById("idpunto").value )
  				{
  					Object.keys(t).forEach(function(ind) {
  						if (val.idturno == t[ind].id ){
  							delete t[ind];
  						}
  					});
   				}

		});

		htmljs = "<select name='idturno' id='idturno' class='form-control' form='puntosdetalle' required> <option value=''> Selecciona turno </option>";

		
		Object.keys(t).forEach(function(ind) {
  						
  						htmljs=htmljs + "<option value='" + t[ind].id +"' > "+t[ind].descripcion+ " </option>";
  					});
		
	 				
	 	htmljs=htmljs + "</select>";
	 	document.getElementById("turn").innerHTML = htmljs;	
	}

</script>

