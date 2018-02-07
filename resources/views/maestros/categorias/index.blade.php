@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Categorías Externos</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/categorias/create') }}"><h1 class="btn btn-success" >Nueva Categoría</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	<div class="col-md-5" style="background-color: Grey; color:#FFFFFF;">
	 		Descripción
	 	</div>
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Estado
	 	</div>
	 	<div class="col-md-4" style="background-color: Black; color:#FFFFFF;">
	 		Acción
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayCategorias as $key => $categoria )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray;">
    		<?php $sw=0; ?>
    	@endif
			
	 		<div class="col-md-5">
        		<a href="{{ url('/categorias/show/' . $categoria->id ) }}">
        			{{$categoria->descripcion}} </a>
        	</div>

     

	 		<div class="col-md-3">
	 			@if ($categoria->activa)
	 				ACTIVA
	 			@else
	 				<span style="color: Red ;">INACTIVA</span>
	 			@endif
	 		</div>
	 		
	 		<div class="col-md-4">
	 			<form method="POST" action="{{action('Maestros\CategoriasController@postDelete', $categoria->id)}}" style="display:inline">
	 				{{ csrf_field() }}
          			<input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar la categoria {{$categoria->descripcion}}?')" value='Eliminar' />
	 			</form>
				<form method="GET" action="{{action('Maestros\CategoriasController@getEdit', $categoria->id)}}" style="display:inline">
	 				<input class="btn btn-success" type="submit"  value='Editar' />
	 			</form>
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayCategorias)}} </b>

	

</div>

@stop