@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Calendario Laboral</h1>
        <h3>&nbsp; Editando......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
    		
    	
			
			<form method="POST">
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			
				<div class="row" >
					<div class="col-sm-3">
   						<b>Descripcion</b>
   					</div>

   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name='descripcion' id='descripcion' value="{{$dia->descripcion}}" required />
					</div>
				</div>
				<div class="row" >
					<div class="col-sm-3">
						<b>Fecha </b> 
					</div>
					<div class="col-sm-8">
						<input type="date" class="form-control"  size="10" name='fecha' id='fecha' value="{{$dia->fecha->format('Y-m-d')}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-3">
						<b>Tipo de Festividad</b>
					</div>
					<div class="col-sm-8">
						<select name="tipo_fiesta" value="{{$dia->tipo_fiesta}}" class="form-control" required>
							@if ($dia->tipo_fiesta == 'Nacional')
  								<option value="Nacional" selected>Nacional</option>
  							@else
  								<option value="Nacional">Nacional</option>
  							@endif
  							@if ($dia->tipo_fiesta == 'Regional')
  								<option value="Regional" selected>Regional</option>
  							@else
  								<option value="Regional">Regional</option>
  							@endif
  							@if ($dia->tipo_fiesta == 'Local')
  								<option value="Local" selected>Local</option>
  							@else
  								<option value="Local">Local</option>
  							@endif
  							@if ($dia->tipo_fiesta == 'Patronal')
  								<option value="Patronal" selected>Patronal</option>
  							@else
  								<option value="Patronal">Patronal</option>
  							@endif
  							@if ($dia->tipo_fiesta == 'Otra')
  								<option value="Otra" selected>Otra</option>
  							@else
  								<option value="Otra">Otra</option>
  							@endif
  								
						</select>
						
					</div>
				</div>				
				<hr>
				<div class="row">
					<p>
						<input class="btn btn-danger" type="submit" value="Modificar Datos" />
			   			<a href="{{ url('/dias/show/' . $dia->id ) }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
			   		</p>
			   	</div>


			</form>
		</blockquote>
	</div>
</div>
@stop

