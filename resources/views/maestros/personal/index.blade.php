@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Personal</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/personal/create') }}"><h1 class="btn btn-success" >Nueva Persona</h1></a>
          <a href="{{ url('/personal2') }}"><h1 class="btn btn-default" >Cuadrícula</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Nombre
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Email
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Telefonos
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Estado
	 	</div>
	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayPersonal as $key => $persona )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray;">
    		<?php $sw=0; ?>
    	@endif
			
	 		<div class="col-md-3">
        		<a href="{{ url('/personal/show/' . $persona->id ) }}">
        			{{$persona->nombre}} </a>
        	</div>

        	<div class="col-md-3">
	 			{{$persona->email}}
	 		</div>

	 		<div class="col-md-3">
	 			{{$persona->telefonos}}
	 		</div>
			<div class="col-md-1">
	 			@if ($persona->activo)
	 				ACTIVO
	 			@else
	 				<span style="color: Red ;">INACTIVO</span>
	 			@endif
	 		</div>
	 		<div class="col-md-2">
	 			<form method="POST" action="{{action('Maestros\PersonalController@postDelete', $persona->id)}}" style="display:inline">
	 				{{ csrf_field() }}
          			<input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar ala persona {{$persona->nombre}}?')" value='Eliminar' />
	 			</form>
				<form method="GET" action="{{action('Maestros\PersonalController@getEdit', $persona->id)}}" style="display:inline">
	 				<input class="btn btn-success" type="submit"  value='Editar' />
	 			</form>
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayPersonal)}} </b>

	

</div>

@stop