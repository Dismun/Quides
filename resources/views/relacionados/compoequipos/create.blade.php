@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Composición de Equipos</h2>
            <h3>Añadiendo.....</h3>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Nombre equipo
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Nombre
	 	</div>
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Desde
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Hasta
	 	</div>


	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	@foreach( $arrayCompoequipos as $key => $compoequipo )
    	<div class="row" style="margin: 5px 5px 5px 5px; background-color:{{$compoequipo->color}}; ">
			
				<div class="col-md-3">
	 				{{$compoequipo->descripcion}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$compoequipo->nombre}}
	 			</div>
	 			<div class="col-md-2">
	 					{{$compoequipo->desde->format('d/m/y')}}	 				
	 			</div>
	 			<div class="col-md-2">
	 				@if ($compoequipo->hasta)
	 				    {{ $compoequipo->hasta->format('d/m/y') }}	
	 				@endif 				    
	 			</div>
				<div class="col-md-2">
				</div>
		</div>
		@endforeach
		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF}}; ">
        		<div class="col-md-3">
        			<select name='idequipo' id='idequipo' class="form-control" form='compe' required>
        					<option value=''> Selecciona Equipo </option>
	 						@foreach( $arrayEquipos as $key2 => $equipo )
	 							<option value="{{ $equipo->id }}" > {{ $equipo->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			
	 			</div>
	 			<div class="col-md-3">
	 				<select name='idpersona' id='idpersona' class="form-control" form='compe' onchange ="javascript:tomafecha({{$arrayPersonas}});" required>
	 						<option value=''> Selecciona persona </option>
	 						@foreach( $arrayPersonas as $key2 => $persona )
	 							<option value="{{ $persona->id }}" > {{ $persona->nombre }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			</div>
	 			
	 			<div class="col-md-2">
	 					<input name="desde" id="desde" type="date" form="compe" value='{{$fdesde}}' readonly required />	
	 			</div>


	 			<div class="col-md-2">
	 				<input name="hasta" id="hasta" type="date" form="compe" value='' min={{ $fdesde }} />
	 			</div>
			
	 	
	 		
			
	 		<div class="col-md-2">
	 			
					<form method="POST" id='compe' action="{{action('Relacionados\CompoequiposController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/compoequipos'">
						<i class="fa fa-window-close"></i>
						</button>
					</form>	
				
	 		</div>

	 		
    	</div>

@stop

<script type="text/javascript">
	function tomafecha(a) 
	{
		Object.keys(a).forEach(function(key) {
  			var val = a[key];
  			if (val.id == document.getElementById("idpersona").value ){
				document.getElementById('hasta').value = val.fhasta;
				document.getElementById('hasta').max = val.fhasta;
				if (val.fhasta) {
					document.getElementById('hasta').required = true;
				} else {
					document.getElementById('hasta').required = false;
				}


			}
		});	
		
		
		
	}
</script>