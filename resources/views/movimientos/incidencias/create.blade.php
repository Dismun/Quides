@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Incidencias</h2>
            <h3>Añadiendo.....</h3>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Incidencia
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
		<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Días
	 	</div>

	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
		<?php $sw=0; ?>
    	@foreach( $arrayIncidencias as $key => $incidencia)
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px; ">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray; ">
    		<?php $sw=0; ?>
    	@endif
			
				<div class="col-md-2">
	 				{{$incidencia->descripcion}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$incidencia->nombre}}
	 			</div>
	 			
	 			<div class="col-md-2">
	 				@if ($incidencia->desde)
	 					{{$incidencia->desde->format('d/m/y')}}
	 				@endif
	 			</div>
	 			<div class="col-md-2">
	 				@if ($incidencia->hasta)
	 				   {{$incidencia->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
	 			<div class="col-md-1">
	 				{{$incidencia->dias}}
	 			</div>	
			
		</div>
		@endforeach	
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF; ">
    			
    			<div class="col-md-2">
	 				<select name='idincidencia' id='ididincidencia' class="form-control" form='incidencia' required>
	 						<option value=''> Selecciona Incidencia </option>
	 						@foreach( $arrayTiposincidencias as $key2 => $tipoincidencia )
	 							<option value="{{ $tipoincidencia->id }}" > {{ $tipoincidencia->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			</div>
       			<div class="col-md-3">
        			<select name='idpersona' id='idpersona' class="form-control" form='incidencia' onchange ="javascript:tomafecha({{$arrayPersonas}});" required>
        					<option value=''> Selecciona persona </option>
	 						@foreach( $arrayPersonas as $key2 => $persona )
	 							<option value="{{ $persona->id }}" > {{ $persona->nombre }} </option>
	 						@endforeach
	 				</select>	
	 			
	 			
	 			</div>
	 			
	 			
	 			<div class="col-md-2">
	 					<input name="desde" id="desde" type="date" form="incidencia" value="{{$fdesde->format('Y-m-d')}}"readonly required />	
	 			</div>


	 			<div class="col-md-2">
	 				<input name="hasta" id="hasta" type="date" form="incidencia" min="{{$fdesde->format('Y-m-d')}}" />
	 			</div>
				<div class="col-md-1">
	 				
	 			</div>

	 		
			
	 		<div class="col-md-2">
	 			
					<form method="POST" id='incidencia' action="{{action('Movimientos\IncidenciasController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/incidencias'">
						<i class="fa fa-window-close"></i>
						</button>
					</form>	
				
	 		</div>
	 		
    	</div>

    	

    	

          				

@stop

