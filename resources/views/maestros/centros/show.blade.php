@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


    	

        
        <h1>&nbsp;Datos del Centro</h1>
        
      
    </div>
    <div class="col-sm-8">
       
    	<blockquote class="blockquote">
            <img src="/storage/{{$centro->imagen}}" width="150"  />
    	   <h2 style="color:{{$centro->color}};">{{$centro->codigo}}</h2>
    	   <h2> {{$centro->descripcion}}</h2>
            <div class="row" style="background-color: lightgray;">
                <div class="col-sm-2">
    	           <b>Dirección</b> 
                </div>
                <div class="col-sm-8">
                    {{$centro->direccion}}<br>
           
                </div>
            </div>

             <div class="row">
                <div class="col-sm-2">
    	           <b>Población</b>
                </div>
                <div class="col-sm-8">
                    {{$centro->poblacion}}
                </div>
            </div>

             <div class="row" style="background-color: lightgray;">
                <div class="col-sm-2">
    	           <b>Telefonos</b> 
                </div>
                <div class="col-sm-8">
                    {{$centro->telefonos}}
                </div>
            </div>

             <div class="row">
                <div class="col-sm-2">
    	           <b>Color</b>
                </div>
                <div class="col-sm-8">
                    <span style="background-color: {{$centro->color}};">{{$centro->color}}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <p>
                    <form method="GET" action ="{{action('Maestros\CentrosController@getEdit', $centro->id)}}" style="display:inline" >
    		          <input class="btn btn-danger" type="submit" value='Editar' />
    	           </form>
    	           <form method="GET" action ="{{action('Maestros\CentrosController@getIndex')}}" style="display:inline" >
    		          <input class="btn btn-success" type="submit" value='Volver al Listado'/>
    	           </form>
    	           <form method="POST" action ="{{action('Maestros\CentrosController@postDelete', $centro->id)}}" style="display:inline" >
  			           {{ csrf_field() }}
    		          <input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el Centro {{$centro->codigo}}?')" value='Eliminar' />
    	           </form>
                </p>
            </div>
        </blockquote>
    </div>
    	
</div>

@stop