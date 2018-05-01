@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Incidencias</h2>
            <h3>Editando.....</h3>
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
    	@foreach( $arrayIncidencias as $key => $incidencia )
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
	 				
	 					{{$incidencia->desde->format('d/m/y')}}
	 				
	 			</div>
	 			<div class="col-md-2">
	 				@if ($incidenciae->id == $incidencia->id)
	 					@if($incidenciae->hasta)
	 						@if($fhasta)
	 							<input name="hasta" id="hasta" size="10" form="ediinci" type="date" value="{{ $incidenciae->hasta->format('Y-m-d') }}"  min="{{ $incidenciae->desde->format('Y-m-d') }}"  max="{{$fhasta}}" required />
	 						@else
	 							<input name="hasta" id="hasta" size="10" form="ediinci" type="date" value="{{ $incidenciae->hasta->format('Y-m-d') }}"  min="{{ $incidenciae->desde->format('Y-m-d') }}"  />
	 						@endif

	 					@else
	 						<input name="hasta" id="hasta" size="10" form="ediinci" type="date" value="" min="{{ $incidenciae->desde->format('Y-m-d') }}"  max="{{$fhasta}}" />
	 					@endif
	 				@else
	 				   @if($incidencia->hasta)
	 				      {{ $incidencia->hasta->format('d/m/y') }}
	 				    @endif
	 				@endif
	 			</div>
				<div class="col-md-1">
	 				{{$incidencia->dias}} 
	 			</div>

	 		
			
	 		<div class="col-md-1">
	 			@if ($incidenciae->id == $incidencia->id)
					<form method="POST" id='ediinci' action="{{action('Movimientos\IncidenciasController@postUpdate', $incidencia->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayIncidencias)}} </b>

          				

@stop