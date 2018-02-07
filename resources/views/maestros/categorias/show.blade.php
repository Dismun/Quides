@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


        

        
        <h1>&nbsp;Categorías Externos</h1>
        
      
    </div>
    <div class="col-sm-8">
       
        <blockquote class="blockquote">
           
            <h2> {{$categoria->descripcion}}</h2>
            <div class="row" style="background-color: lightgray;">
                <div class="col-sm-2">
                    <b>Estado</b>
                </div>
                <div class="col-sm-8">
                    @if ($categoria->activa)
                        ACTIVA
                    @else
                        INACTIVA 
                    @endif
                </div>
            </div>
            
            <hr>
            <div class="row">
                <p>
                <form method="GET" action ="{{action('Maestros\CategoriasController@getEdit', $categoria->id)}}" style="display:inline" >
                    <input class="btn btn-danger" type="submit" value='Editar' />
                </form>
                <form method="GET" action ="{{action('Maestros\CategoriasController@getIndex')}}" style="display:inline" >
                    <input class="btn btn-success" type="submit" value='Volver al Listado'/>
                </form>
                <form method="POST" action ="{{action('Maestros\CategoriasController@postDelete', $categoria->id)}}" style="display:inline" >
                     {{ csrf_field() }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar la categoría {{$categoria->descripcion}}?')" value='Eliminar' />
                </form>
                </p>
            </div> 
        </blockquote>
    </div>
        
</div>

@stop