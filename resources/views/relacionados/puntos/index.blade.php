@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Puntos <span style="display:inline; font-size:0.5em"> por orden de prioridad </span></h2>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
        </center>      
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Descripción del Punto
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Código
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Nivel
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Centro
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Guardia
	 	</div>
	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	
    	@foreach( $arrayPuntos as $key => $punto )
    	
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:{{$punto->color}}; ">
    		
			

        		<div class="col-md-3">
	 				{{$punto->descripcion}}
	 			</div>
	 			<div class="col-md-1">
	 				{{$punto->codigo}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$punto->descn}}
	 			</div>
	 			<div class="col-md-2">
	 				{{$punto->descc}}
	 			</div>
	 			<div class="col-md-1">
	 				@if ($punto->guardia)
	 				   SI
	 				@else
	 				   NO
	 				@endif
	 			</div>

	 		<div class="col-md-2">

	 			<form method="GET" action="{{action('Relacionados\PuntosController@getSubir', $punto->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Subir">
						<i class="fa fa-arrow-up"></i>
						</button>
					</form>
					<form method="GET" action="{{action('Relacionados\PuntosController@getBajar', $punto->id)}}" style="display:inline">	
						<button type="submit" class="btn btn-success" aria-label="Bajar">
						<i class="fa fa-arrow-down"></i>
						</button>
					</form>
					<form method="GET" action="{{action('Relacionados\PuntosController@getInsertar', $punto->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Insertar">
						<i class="fa fa-plus"></i>
						</button>
					</form>

					
					<form method="POST" action="{{action('Relacionados\PuntosController@postDelete', $punto->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar el punto {{$punto->descripcion}} ?')" >
							<i class="fa fa-eraser"></i>
						</button>
					</form>
	 			
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayPuntos)}} </b>

          				

@stop