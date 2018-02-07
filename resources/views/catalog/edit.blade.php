@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>Datos del Centro</h1>
        <h2>Editando......</h2>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
			<form method="POST">
	
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	
   			<label>Código
			<input type="text" name='codigo' id='codigo' value="{{$centro->codigo}}"/></label><br>
			<label>Descripción (Nombre)
			<input type="text" name='descripcion' id='descripcion' value="{{$centro->descripcion}}"/></label><br>
			<label>Dirección
			<input type="text" name="direccion" id="direccion" value="{{$centro->direccion}}"/></label><br>
			<label>Población
			<input type="text" name="poblacion" id="poblacion" value="{{$centro->poblacion}}"/></label><br>
			<label>Teléfonos
			<input type="text" name="telefonos" id="telefonos" value="{{$centro->telefonos}}"/></label><br>
			<label>Color
			<input type="text" name="color" id="color" value="{{$centro->color}}"/></label><br>
	
			<input class="btn-success" type="submit" value="Modificar Centro" />

			</form>
		</blockquote>
	</div>
</div>
@stop
