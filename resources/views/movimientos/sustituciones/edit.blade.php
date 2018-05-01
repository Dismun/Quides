@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Sustituciones</h2>
            <h3>Editando.....</h3>
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
    	@foreach( $arraySustituciones as $key => $sustitucion )
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
	 				
	 					{{$sustitucion->desde->format('d/m/y')}}
	 				
	 			</div>
	 			<div class="col-md-2">
	 				@if ($sustitucione->id == $sustitucion->id)
	 					@if($sustitucione->hasta)
	 						@if($fhasta)
	 							<input name="hasta" id="hasta" size="10" form="edisust" type="date" value="{{ $sustitucione->hasta->format('Y-m-d') }}"  min="{{ $sustitucione->desde->format('Y-m-d') }}"  max="{{$fhasta}}" required />
	 						@else
	 							<input name="hasta" id="hasta" size="10" form="edisust" type="date" value="{{ $sustitucione->hasta->format('Y-m-d') }}"  min="{{ $sustitucione->desde->format('Y-m-d') }}"  />
	 						@endif

	 					@else
	 						<input name="hasta" id="hasta" size="10" form="edisust" type="date" value="" min="{{ $sustitucione->desde->format('Y-m-d') }}"  max="{{$fhasta}}" />
	 					@endif
	 				@else
	 				   @if($sustitucion->hasta)
	 				      {{ $sustitucion->hasta->format('d/m/y') }}
	 				    @endif
	 				@endif
	 			</div>
				<div class="col-md-1">
	 				{{$sustitucion->dias}} 
	 			</div>

	 		
			
	 		<div class="col-md-1">
	 			@if ($sustitucione->id == $sustitucion->id)
					<form method="POST" id='edisust' action="{{action('Movimientos\SustitucionesController@postUpdate', $sustitucion->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arraySustituciones)}} </b>

          				

@stop