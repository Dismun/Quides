@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


    	 <img src="{{$pelicula->poster}}" style="height:200px"/>

        {{-- TODO: Imagen de la película --}}

    </div>
    <div class="col-sm-8">
    	<blockquote class="blockquote-reverse">

    	<h2>{{$pelicula->title}}</h2>
    	<p><b>Año:</b> {{$pelicula->year}}<br>
    	<b>Director:</b> {{$pelicula->director}}</p>
    	<p class="text-justify"><b>Resumen:</b> {{$pelicula->synopsis}}</p>
		</blockquote>
    	@if (!$pelicula->rented )
    		<p>
    		<form method="POST" action="{{action('CatalogController@postRent', $pelicula->id)}}" style="display:inline" >
    			{{ csrf_field() }}
    		<input class="btn btn-success" type="submit" value='Disponible. Alquilar' style="background-color:green"/>
    		</form>
    	@else
    		<p>
    		<form method="POST" action="{{action('CatalogController@postReturn', $pelicula->id)}}" style="display:inline" >
				{{ csrf_field() }}
    		<input class="btn btn-success" type="submit" value='Alquilada. Devolver' style="background-color:red"/>
    		</form>
    	@endif
    	<form method="GET" action ="{{action('CatalogController@getEdit', $pelicula->id)}}" style="display:inline" >
    		<input class="btn btn-danger" type="submit" value='Editar' />
    	</form>
    	<form method="GET" action ="{{action('CatalogController@getIndex')}}" style="display:inline" >
    		<input class="btn btn-success" type="submit" value='Volver al Listado'/>
    	</form>
    	<form method="POST" action ="{{action('CatalogController@postDelete', $pelicula->id)}}" style="display:inline" >
  			 {{ csrf_field() }}
    		<input class="btn btn-danger" type="submit" value='Eliminar' />
    	</form></p>


    	
</div>

@stop