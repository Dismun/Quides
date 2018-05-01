@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Turnos</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/turnos/create') }}"><h1 class="btn btn-success" >Nuevo Turno</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Descripción
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Código
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Hora Inicio
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Hora Fin
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Estado
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Horas
	 	</div>
	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayTurnos as $key => $turno )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray;">
    		<?php $sw=0; ?>
    	@endif
			
	 		<div class="col-md-2">
        		<a href="{{ url('/turnos/show/' . $turno->id ) }}">
        			{{$turno->descripcion}} </a>
        	</div>

        	<div class="col-md-2">
	 			{{$turno->codigo}}
	 		</div>

	 		<div class="col-md-2">
	 			{{$turno->desde}}
	 		</div>
	 		<div class="col-md-2">
	 			{{$turno->hasta}}
	 		</div>
			<div class="col-md-1">
	 			@if ($turno->activo)
	 				ACTIVO
	 			@else
	 				<span style="color: Red ;">INACTIVO</span>
	 			@endif
	 		</div>
	 		<div class="col-md-1">
	 			{{$turno->horas}}
	 		</div>
	 		<div class="col-md-2">
	 			<form method="POST" action="{{action('Maestros\TurnosController@postDelete', $turno->id)}}" style="display:inline">
	 				{{ csrf_field() }}
          			<input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el turno {{$turno->descripcion}}?')" value='Eliminar' />
	 			</form>
				<form method="GET" action="{{action('Maestros\TurnosController@getEdit', $turno->id)}}" style="display:inline">
	 				<input class="btn btn-success" type="submit"  value='Editar' />
	 			</form>
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayTurnos)}} </b>

	

</div>

@stop