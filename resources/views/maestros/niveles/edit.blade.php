@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Niveles</h1>
        <h3>&nbsp; Editando......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
    		
    	
			
			<form method="POST" >
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			
				<div class="row" >
					<div class="col-sm-2">
   						<b>Descripcion</b>
   					</div>

   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name='descripcion' id='descripcion' value="{{$nivel->descripcion}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Código</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control"  maxlength="5" size="7" name='codigo' id='codigo' value="{{$nivel->codigo}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Orden</b>
					</div>
					<div class="col-sm-8">
						<input type="number" class="form-control" maxlength="8" size="20" name="nivel" id="nivel" value="{{$nivel->nivel}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Color</b>
					</div>
					<div class="col-sm-8">
						<input type="color" class="form-control" maxlength="15" size="20" name="color" id="color" value="{{$nivel->color}}" required />
					</div>
				</div>

				

				
				<hr>
				<div class="row">
					<p>
						<input class="btn btn-danger" type="submit" value="Modificar Datos" />
			   			<a href="{{ url('/niveles/show/' . $nivel->id ) }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
			   		</p>
			   	</div>


			</form>
		</blockquote>
	</div>
</div>
@stop

