@extends('layouts.app')

@section('content')
<form method="POST" >
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<label>Título
		<input type="text" name='title' id='title'/></label><br>
	<label>Año
		<input type="text" name='year' id='year'/></label><br>
	<label>Director
		<input type="text" name="director" id="director"/></label><br>
	<label>Poster
		<input type="text" name="poster" id="poster"/></label><br>
	<label>Resumen
		<input type="textarea" name="synopsis" id="synopsis"/></label><br>

		<input class="btn-success" type="submit" value="Añadir Película" name="editar"/>
</form>
   
@stop