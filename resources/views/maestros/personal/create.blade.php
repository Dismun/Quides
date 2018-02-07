@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Datos Personales</h1>
        <h3>&nbsp; Añadiendo......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
			<form method="POST"  enctype="multipart/form-data">
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			
				<div class="row">
					<div class="col-sm-2">
						<b>Nombre</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name='nombre' id='nombre' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Email</b>
					</div>
					<div class="col-sm-8">
						<input type="email" maxlength="45"  class="form-control" size="35" name='email' id='email' value=""  />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Telefonos</b>
					</div>
					<div class="col-sm-8">
						<input type="text" maxlength="45" class="form-control" size="35" name='telefonos' id='telefonos' value="" />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Activo</b>
					</div>
					<div class="col-sm-8">
						<input type="checkbox"  name="activo" id="activo" value="0"  />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Imagen</b>
					</div>
					<div class="col-sm-8">
						<input type="file" class="form-control" name="urlfoto" id="urlfoto" value=""/>
					</div>
				</div>
				<hr>

				<div class="row">
					<input class="btn btn-danger" type="submit" value="Añadir Persona" />
			    	<a href="{{ url('/personal') }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
				</div>
			</form>
		</blockquote>
	</div>
</div>
@stop