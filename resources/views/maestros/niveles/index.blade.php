@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Niveles</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/niveles/create') }}"><h1 class="btn btn-success" >Nuevo Nivel</h1></a>
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
    	@foreach( $arrayNiveles as $key => $nivel )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray;">
    		<?php $sw=0; ?>
    	@endif
			
	 		<div class="col-md-2">
	 			{{$nivel->nivel}}
	 		</div>
	 		<div class="col-md-3">
        		<a href="{{ url('/niveles/show/' . $nivel->id ) }}">
        			{{$nivel->descripcion}} </a>
        	</div>

        	<div class="col-md-2">
	 			{{$nivel->codigo}}
	 		</div>

	 		<div class="col-md-2" style="background-color: {{$nivel->color}}; ">
	 			{{$nivel->color}}
	 		</div>
	 		
	 		<div class="col-md-3">
	 			<form method="POST" action="{{action('Maestros\NivelesController@postDelete', $nivel->id)}}" style="display:inline">
	 				{{ csrf_field() }}
          			<input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el nivel {{$nivel->descripcion}}?')" value='Eliminar' />
	 			</form>
				<form method="GET" action="{{action('Maestros\NivelesController@getEdit', $nivel->id)}}" style="display:inline">
	 				<input class="btn btn-success" type="submit"  value='Editar' />
	 			</form>
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayNiveles)}} </b>

	

</div>

@stop