@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Datos del Centro</h1>
        <h3>&nbsp; Editando......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
    		<p>
    			<img src="/storage/{{$centro->imagen}}" width="150" />
			</p>
			<form method="POST" enctype="multipart/form-data" >
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	
   				<div class="row">
                	<div class="col-sm-2">
   						<b>Código</b>
   					</div>
   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="5" size="6" name='codigo' id='codigo' value="{{$centro->codigo}}" required />
					</div>
				</div>


				<div class="row">
                	<div class="col-sm-2">
   						<b>Descripción</b>
   					</div>
   					<div class="col-sm-8">
   						<input type="text" class="form-control" maxlength="45" size="35" name='descripcion' id='descripcion' value="{{$centro->descripcion}}"  required />
   					</div>
   				</div>

				<div class="row">
                	<div class="col-sm-2">
   						<b>Dirección</b>
   					</div>
   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name="direccion" id="direccion" value="{{$centro->direccion}}" required />
					</div>
				</div>

				<div class="row">
                	<div class="col-sm-2">
   						<b>Población</b>
   					</div>
   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="20" size="25" name="poblacion" id="poblacion" value="{{$centro->poblacion}}" required />
					</div>
				</div>

				<div class="row">
                	<div class="col-sm-2">
   						<b>Teléfonos</b>
   					</div>
   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="25" size="25" name="telefonos" id="telefonos" value="{{$centro->telefonos}}" required />
					</div>
				</div>
			
			 	<div class="row">
                	<div class="col-sm-2">
   						<b>Color</b>
   					</div>
   					<div class="col-sm-8">
						<input type="color" class="form-control"  name="color" id="color" value="{{$centro->color}}" required />
					</div>
				</div>

			 	<div class="row">
                	<div class="col-sm-2">
   						<b>Imagen</b>
   					</div>
   					<div class="col-sm-8">
						<input type="file" class="form-control" id="imagen" name="imagen"  value="{{$centro->imagen}}"/>
					</div>
				</div>
				<hr>
				<div class="row">
                	<p>
   						<input class="btn btn-danger" type="submit" value="Modificar Centro" />
						<a href="{{ url('/centros/show/' . $centro->id ) }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
					</p>
				</div>
			</form>
		</blockquote>
	</div>
</div>
@stop
