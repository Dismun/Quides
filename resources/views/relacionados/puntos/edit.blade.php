@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Puntos</h2>
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
    		@if (($puntoe->prioridad - $punto->prioridad) == 5)
				<div class="col-md-3">
	 				<input class="form-control" name="descripcion" id="descripcion" type="text" value = " {{$punto->descripcion}} " form='selpuntos' required />
	 			</div>
	 			<div class="col-md-1">
	 				<input class="form-control" name="codigo" id="codigo" type="text" form='selpuntos' value=" {{$punto->codigo}} " required />
	 			</div>
	 			<div class="col-md-3">
	 				<select name='idnivel' id='idnivel' class="form-control" form='selpuntos' value="{{$punto->idnivel}}" required >
	 				@foreach( $arrayNiveles as $ke2 => $nivel)
	 				   	@if ($nivel->id == $punto->idnivel) 
	 						<option value="{{$nivel->id}}" selected>{{ $nivel->descripcion }}</option>
	 					@else
	 						<option value="{{$nivel->id}}" >{{ $nivel->descripcion }}</option>
	 					@endif
	 				@endforeach
	 				</select>
	 			</div>
	 			<div class="col-md-2">
	 				<select name='idcentro' id='idcentro' class="form-control" form='selpuntos' value="{{$puntoe->idnivel}}" required >
	 				@foreach( $arrayCentros as $ke2 => $centro)
	 					@if ($centro->id == $punto->idcentro) 
	 						<option value="{{$centro->id}}" selected>{{$centro->descripcion}}</option>
	 					@else
	 						<option value="{{$centro->id}}" >{{$centro->descripcion}}</option>
	 					@endif

	 				@endforeach
	 				</select>
	 			</div>
	 			<div class="col-md-1">
	 				<input name='guardia' id='guardia' class="form-control" form='selpuntos' type="checkbox" @if($punto->guardia) checked @endif />
	 			</div>
	 			<div class="col-md-2">

	 				<form method="POST" action="{{action('Relacionados\PuntosController@postInsertar', $punto->id)}}" id='selpuntos' style="display:inline">
	 							{{ csrf_field() }}
	 					<button type="submit" class="btn btn-success" aria-label="Insertar">
								<i class="fa fa-check"></i>
						</button>
					</form>
	 			</div>

    		@else
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

	 				
	 			</div>
	 		@endif
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayPuntos)}} </b>

          				

@stop