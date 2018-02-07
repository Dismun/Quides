@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


        

        
        <h1>&nbsp;Tipos de Incidencias</h1>
        
      
    </div>
    <div class="col-sm-8">
       
        <blockquote class="blockquote">
           
            <h2> {{$tipoincidencia->descripcion}}</h2>
            <div class="row" style="background-color: lightgray;">
                <div class="col-sm-2">
                    <b>Código</b>
                </div>
                <div class="col-sm-8">
                    {{$tipoincidencia->codigo}} 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <b>Color</b> 
                </div>
                <div class="col-sm-8" style="background-color: {{$tipoincidencia->color}};">
                    {{$tipoincidencia->color}} 
                </div>
            </div>


            
            <hr>
            <div class="row">
                <p>
                <form method="GET" action ="{{action('Maestros\TipoincidenciasController@getEdit', $tipoincidencia->id)}}" style="display:inline" >
                    <input class="btn btn-danger" type="submit" value='Editar' />
                </form>
                <form method="GET" action ="{{action('Maestros\TipoincidenciasController@getIndex')}}" style="display:inline" >
                    <input class="btn btn-success" type="submit" value='Volver al Listado'/>
                </form>
                <form method="POST" action ="{{action('Maestros\TipoincidenciasController@postDelete', $tipoincidencia->id)}}" style="display:inline" >
                     {{ csrf_field() }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el nivel {{$tipoincidencia->descripcion}}?')" value='Eliminar' />
                </form>
                </p>
            </div> 
        </blockquote>
    </div>
        
</div>

@stop