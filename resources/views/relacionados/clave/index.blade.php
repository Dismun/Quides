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
	 
	 	
	 	
	 	
	 	<div class="col-md-5" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Código
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Horario
	 	</div>

	 	<div class="col-md-3" style="background-color: Black; color:#FFFFFF;">
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
			

        		<div class="col-md-5">
	 				{{$clave->descripcion}}
	 			</div>
	 			<div class="col-md-1">
	 				{{$clave->codigo}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$clave->desde.' - '.$clave->hasta}}
	 			</div>
			

	 		
			
	 		<div class="col-md-3">
	 			<div class="btn-group">
	 					
					<form method="GET" action="{{action('Relacionados\ClaveController@getSubir', $clave->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Subir">
						<i class="fa fa-arrow-up"></i>
						</button>
					</form>
					<form method="GET" action="{{action('Relacionados\ClaveController@getBajar', $clave->id)}}" style="display:inline">	
						<button type="submit" class="btn btn-success" aria-label="Bajar">
						<i class="fa fa-arrow-down"></i>
						</button>
					</form>
					<form method="GET" action="{{action('Relacionados\ClaveController@getInsertar', $clave->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Insertar">
						<i class="fa fa-plus"></i>
						</button>
					</form>
						

				</div>
				<form method="POST" action="{{action('Relacionados\ClaveController@postDelete', $clave->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar el turno {{$clave->descripcion}} de la clave?')" >
							<i class="fa fa-eraser"></i>
						</button>
				</form>
	 			
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayClave)}} </b>

          				

@stop