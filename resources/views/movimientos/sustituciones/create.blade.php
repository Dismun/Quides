@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Sustituciones</h2>
            <h3>Añadiendo.....</h3>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Sustituido
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Sustituto
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
    	@foreach( $arraySustituciones as $key => $sustitucion)
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px; ">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray; ">
    		<?php $sw=0; ?>
    	@endif
			
				<div class="col-md-2">
	 				{{$sustitucion->sustituido}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$sustitucion->sustituto}}
	 			</div>
	 			
	 			<div class="col-md-2">
	 				@if ($sustitucion->desde)
	 					{{$sustitucion->desde->format('d/m/y')}}
	 				@endif
	 			</div>
	 			<div class="col-md-2">
	 				@if ($sustitucion->hasta)
	 				   {{$sustitucion->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
	 			<div class="col-md-1">
	 				{{$sustitucion->dias}}
	 			</div>	
			
		</div>
		@endforeach	

    	

    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF; ">
    			
    			<div class="col-md-2">
	 				<select name='idpersona' id='idpersona' class="form-control" form='sust' required>
	 						<option value=''> Selecciona persona a sustituir </option>
	 						@foreach( $arrayPersonas as $key2 => $sustituido )
	 							<option value="{{ $sustituido->id }}" > {{ $sustituido->nombre }} </option>	 							
	 						@endforeach
	 				</select>	
	 				
	 			</div>
       			<div class="col-md-3">
        			<select name='idpersona_externa' id='idpersona_externa' class="form-control" form='sust' required>
        					<option value=''> Selecciona sustituto </option>
	 						@foreach( $arrayExternos as $key2 => $sustituto )
	 							<option value="{{ $sustituto->id }} "  > {{ $sustituto->nombre }} -> {{ $sustituto->descripcion }}</option>
	 						@endforeach
	 				</select>	
	 			
	 			
	 			</div>
	 			
	 			
	 			<div class="col-md-2">
	 					<input name="desde" id="desde" type="date" form="sust" value="{{$fdesde->format('Y-m-d')}}" readonly required />	
	 			</div>


	 			<div class="col-md-2">
	 				<input name="hasta" id="hasta" type="date" form="sust" min="{{$fdesde->format('Y-m-d')}}"/>
	 			</div>
				<div class="col-md-1">
	 				
	 			</div>

	 		
			
	 		<div class="col-md-2">
	 			
					<form method="POST" id='sust' action="{{action('Movimientos\SustitucionesController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/sustituciones'">
						<i class="fa fa-window-close"></i>
						</button>
					</form>	
				
	 		</div>
	 		
    	</div>
@stop

