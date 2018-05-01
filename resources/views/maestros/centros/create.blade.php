@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Datos del Centro</h1>
        <h3>&nbsp; Añadiendo......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
			<form method="POST"  enctype="multipart/form-data">
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="row">
					<div class="col-sm-2">
   						<b>Código</b>
   					</div>
   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="5" size="6" name='codigo' id='codigo' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Descripción</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name='descripcion' id='descripcion' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Dirección</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name="direccion" id="direccion" value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Población</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="20" size="25" name="poblacion" id="poblacion" value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Teléfonos</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="25" size="25" name="telefonos" id="telefonos" value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Color</b>
					</div>
					<div class="col-sm-8">
						<input type="color" class="form-control"  name="color" id="color" value=""  required />
					</div>
				</div>
			
				<div class="row">
					<div class="col-sm-2">
						<b>Imagen</b>
					</div>
					<div class="col-sm-8">
						<input type="file" class="form-control"  name="imagen" id="imagen" value=""/>
					</div>
				</div>	

				<hr>
				<div class="row">	
					<input class="btn btn-danger" type="submit" value="Añadir Centro" />	
			   		<a href="{{ url('/centros') }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
			   	</div>

			</form>
		</blockquote>
	</div>
</div>
@stop