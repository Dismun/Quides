@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Calendario Laboral</h1>
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
						<b>Fecha</b>
					</div>
					<div class="col-sm-8">
						<input type="date"  class="form-control" name='fecha' id='fecha' value="" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Tipo de Festividad</b>
					</div>
					<div class="col-sm-8">
						<select name="tipo_fiesta" class="form-control" required>
							
  								<option value="Nacional">Nacional</option>
  							
  								<option value="Regional">Regional</option>
  							
  								<option value="Local">Local</option>
  							
  								<option value="Patronal">Patronal</option>
  							
  								<option value="Otra">Otra</option>
  							
  								
						</select>
					</div>
				</div>

				
				<hr>

				<div class="row">
					<input class="btn btn-danger" type="submit" value="Añadir Día Festivo" />
			    	<a href="{{ url('/niveles') }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
				</div>
			</form>
		</blockquote>
	</div>
</div>
@stop