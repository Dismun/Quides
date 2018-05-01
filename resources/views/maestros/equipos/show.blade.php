@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


        

        
        <h1>&nbsp;Equipos</h1>
        
      
    </div>
    <div class="col-sm-8">
       
        <blockquote class="blockquote">
           
            <h2> {{$equipo->descripcion}}</h2>
            <div class="row" style="background-color: lightgray;">
                <div class="col-sm-2">
                    <b>Código</b>
                </div>
                <div class="col-sm-8">
                    {{$equipo->codigo}} 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <b>Color</b> 
                </div>
                <div class="col-sm-8" style="background-color: {{$equipo->color}};">
                    {{$equipo->color}} 
                </div>
            </div>

            <div class="row"  style="background-color: lightgray;">
                <div class="col-sm-2">
                    <b>Orden</b> 
                </div>
                <div class="col-sm-8">
                    {{$equipo->orden}} 
                </div>
            </div>

            
            <hr>
            <div class="row">
                <p>
                <form method="GET" action ="{{action('Maestros\EquiposController@getEdit', $equipo->id)}}" style="display:inline" >
                    <input class="btn btn-danger" type="submit" value='Editar' />
                </form>
                <form method="GET" action ="{{action('Maestros\EquiposController@getIndex')}}" style="display:inline" >
                    <input class="btn btn-success" type="submit" value='Volver al Listado'/>
                </form>
                <form method="POST" action ="{{action('Maestros\EquiposController@postDelete', $equipo->id)}}" style="display:inline" >
                     {{ csrf_field() }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el nivel {{$equipo->descripcion}}?')" value='Eliminar' />
                </form>
                </p>
            </div> 
        </blockquote>
    </div>
        
</div>

@stop