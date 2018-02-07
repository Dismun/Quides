@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Tipos de Incidencias</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/tipoincidencias/create') }}"><h1 class="btn btn-success" >Nuevo Tipo de Incidencia</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	<div class="col-md-4" style="background-color: Grey; color:#FFFFFF;">
	 		Descripción
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Código
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Color
	 	</div>
	 	<div class="col-md-3" style="background-color: Black; color:#FFFFFF;">
	 		Acción
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayTipoincidencias as $key => $tipoincidencia )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray;">
    		<?php $sw=0; ?>
    	@endif
			
	 		
	 		<div class="col-md-4">
        		<a href="{{ url('/tipoincidencias/show/' . $tipoincidencia->id ) }}">
        			{{$tipoincidencia->descripcion}} </a>
        	</div>

        	<div class="col-md-2">
	 			{{$tipoincidencia->codigo}}
	 		</div>
	 		<div class="col-md-3" style="background-color: {{$tipoincidencia->color}}; ">
	 			{{$tipoincidencia->color}}
	 		</div>
	 		<div class="col-md-3">
	 			<form method="POST" action="{{action('Maestros\TipoincidenciasController@postDelete', $tipoincidencia->id)}}" style="display:inline">
	 				{{ csrf_field() }}
          			<input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el nivel {{$tipoincidencia->descripcion}}?')" value='Eliminar' />
	 			</form>
				<form method="GET" action="{{action('Maestros\TipoincidenciasController@getEdit', $tipoincidencia->id)}}" style="display:inline">
	 				<input class="btn btn-success" type="submit"  value='Editar' />
	 			</form>
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayTipoincidencias)}} </b>

	

</div>

@stop