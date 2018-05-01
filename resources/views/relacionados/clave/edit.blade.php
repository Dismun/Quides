@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Clave Cadencia de Turnos</h2>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          .....
         
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-4" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Código
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Horario
	 	</div>

	 	<div class="col-md-4" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayClave as $key => $clave )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px; font-size: 1.5em;">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray; font-size: 1.5em;">
    		<?php $sw=0; ?>
    	@endif
			
			@if ($clavee->id != $clave->id)

        		<div class="col-md-4">
	 				{{$clave->descripcion}}
	 			</div>
	 		@else
	 			<div class="col-md-4">
	 				
	 					<select name='idturno' id='idturno' class="form-control" form='selturnos' required>
	 						@foreach( $arrayTurnos as $key2 => $turno )
	 							<option value="{{ $turno->id }}" > {{ $turno->descripcion }} </option>
	 						@endforeach
	 					</select>	
	 					
	 			</div>
	 		@endif
	 			<div class="col-md-1">
	 				{{$clave->codigo}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$clave->desde.' - '.$clave->hasta}}
	 			</div>
			

	 		
			@if ($clavee->id == $clave->id)
	 			<div class="col-md-4">
	 				<div class="btn-group">
						<form method="POST" action="{{action('Relacionados\ClaveController@postInsertar', $clave->id)}}" id='selturnos' style="display:inline">
	 							{{ csrf_field() }}
	 					<button type="submit" class="btn btn-success" aria-label="Insertar">
								<i class="fa fa-check"></i>
						</button>
					</form>
							
					</div> 			
	 			</div>
	 		@endif
	 		
    		</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayClave)}} </b>

          				

@stop