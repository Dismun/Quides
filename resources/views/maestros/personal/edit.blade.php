@extends('layouts.app')

@section('content')

 <div class="row">

    <div class="col-sm-4">

        {{-- TODO: Imagen del Centro --}}
        <h1>&nbsp;Datos Personales</h1>
        <h3>&nbsp; Editando......</h3>
    </div>

	<div class="col-sm-8">
       
    	<blockquote class="blockquote">
    		
    		<img src="/storage/{{$persona->urlfoto}}" width="100" />
			
			<form method="POST" enctype="multipart/form-data" >
	
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			
				<div class="row" >
					<div class="col-sm-2">
   						<b>Nombre</b>
   					</div>

   					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name='nombre' id='nombre' value="{{$persona->nombre}}" required />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Email</b>
					</div>
					<div class="col-sm-8">
						<input type="email" class="form-control"  maxlength="45" size="35" name='email' id='email' value="{{$persona->email}}"  />
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Teléfonos</b>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="45" size="35" name="telefonos" id="telefonos" value="{{$persona->telefonos}}" />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<b>Activo</b>
					</div>
					<div class="col-sm-8">
						<input type="checkbox"  class="form-control" name="activo" id="activo" value="{{$persona->activo}}" @if ($persona->activo)  checked @endif/>
					</div>
				</div>

				<div class="row" >
					<div class="col-sm-2">
						<b>Imagen</b>
					</div>
					<div class="col-sm-8">
						<input type="file" class="form-control" id="urlfoto" name="urlfoto"  value="{{$persona->urlfoto}}"/>
					</div>
				</div>
				<hr>
				<div class="row">
					<p>
						<input class="btn btn-danger" type="submit" value="Modificar Datos" />
			   			<a href="{{ url('/personal/show/' . $persona->id ) }}"> <input class="btn btn-success" type="button" value="Cancelar" style="display:inline"/></a>
			   		</p>
			   	</div>


			</form>
		</blockquote>
	</div>
</div>
@stop

