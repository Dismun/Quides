@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Turnos</h1>
        <h3>&nbsp; Editando......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
    		
    	
			
			<form method="POST">
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			
				<div class="row" >
					<div class="col-sm-2">
   						<b>Descripción</b>
   					</div>

   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name='descripcion' id='descripcion' value="{{$turno->descripcion}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Código</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control"  maxlength="5" size="7" name='codigo' id='codigo' value="{{$turno->codigo}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Hora de Inicio</b>
					</div>
					<div class="col-sm-8">
						<input type="time" class="form-control" maxlength="15" size="20" name="desde" id="desde" value="{{$turno->desde}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Hora de Fin</b>
					</div>
					<div class="col-sm-8">
						<input type="time" class="form-control" maxlength="15" size="20" name="hasta" id="hasta" value="{{$turno->hasta}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Horas</b>
					</div>
					<div class="col-sm-8">
						<input type="numbers" class="form-control" maxlength="15" size="20" name="horas" id="horas" value="{{$turno->horas}}" required />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Activo</b>
					</div>
					<div class="col-sm-8">
						<input type="checkbox"  class="form-control" name="activo" id="activo" value="{{$turno->activo}}" @if ($turno->activo)  checked @endif/>
					</div>
				</div>

				
				<hr>
				<div class="row">
					<p>
						<input class="btn btn-danger" type="submit" value="Modificar Datos" />
			   			<a href="{{ url('/turnos/show/' . $turno->id ) }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
			   		</p>
			   	</div>


			</form>
		</blockquote>
	</div>
</div>
@stop

