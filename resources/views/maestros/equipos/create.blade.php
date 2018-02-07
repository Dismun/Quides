@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Equipos</h1>
        <h3>&nbsp; Añadiendo......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
			<form method="POST">
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			
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
						<b>Código</b>
					</div>
					<div class="col-sm-8">
						<input type="text" maxlength="45"  class="form-control" size="35" name='codigo' id='codigo' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Orden</b>
					</div>
					<div class="col-sm-8">
						<input type="text" maxlength="45" class="form-control" size="35" name='orden' id='orden' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Color</b>
					</div>
					<div class="col-sm-8">
						<input type="color" maxlength="45" class="form-control" size="35" name='color' id='color' value="" required />
					</div>
				</div>

				
				<hr>

				<div class="row">
					<input class="btn btn-danger" type="submit" value="Añadir Equipo" />
			    	<a href="{{ url('/equipos') }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
				</div>
			</form>
		</blockquote>
	</div>
</div>
@stop