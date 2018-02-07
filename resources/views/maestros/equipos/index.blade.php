@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Equipos</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/equipos/create') }}"><h1 class="btn btn-success" >Nuevo Equipo</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Orden
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Descripción
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Código
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Color
	 	</div>
	 	<div class="col-md-3" style="background-color: Black; color:#FFFFFF;">
	 		Acción
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayEquipos as $key => $equipo )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray;">
    		<?php $sw=0; ?>
    	@endif
			
	 		<div class="col-md-2">
	 			{{$equipo->orden}}
	 		</div>
	 		<div class="col-md-3">
        		<a href="{{ url('/equipos/show/' . $equipo->id ) }}">
        			{{$equipo->descripcion}} </a>
        	</div>

        	<div class="col-md-2">
	 			{{$equipo->codigo}}
	 		</div>
	 		<div class="col-md-2" style="background-color: {{$equipo->color}}; ">
	 			{{$equipo->color}}
	 		</div>
	 		<div class="col-md-3">
	 			<form method="POST" action="{{action('Maestros\EquiposController@postDelete', $equipo->id)}}" style="display:inline">
	 				{{ csrf_field() }}
          			<input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el nivel {{$equipo->descripcion}}?')" value='Eliminar' />
	 			</form>
				<form method="GET" action="{{action('Maestros\EquiposController@getEdit', $equipo->id)}}" style="display:inline">
	 				<input class="btn btn-success" type="submit"  value='Editar' />
	 			</form>
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayEquipos)}} </b>

	

</div>

@stop