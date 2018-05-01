@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Turnos</h1>
        <h3>&nbsp; Añadiendo......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
			<form method="POST" >
	
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
						<b>Hora de Inicio</b>
					</div>
					<div class="col-sm-8">
						<input type="time" maxlength="45" class="form-control" size="35" name='desde' id='desde' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Hora de Fin</b>
					</div>
					<div class="col-sm-8">
						<input type="time" maxlength="45" class="form-control" size="35" name='hasta' id='hasta' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Horas</b>
					</div>
					<div class="col-sm-8">
						<input type="numbers" maxlength="45" class="form-control" size="35" name='horas' id='horas' value="" required />
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

				
				<hr>

				<div class="row">
					<input class="btn btn-danger" type="submit" value="Añadir Turno" />
			    	<a href="{{ url('/turnos') }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
				</div>
			</form>
		</blockquote>
	</div>
</div>
@stop