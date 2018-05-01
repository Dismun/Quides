@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


        

        
        <h1>&nbsp;Turnos</h1>
        
      
    </div>
    <div class="col-sm-8">
       
        <blockquote class="blockquote">
           
            <h2> {{$turno->descripcion}}</h2>
            <div class="row" style="background-color: lightgray;">
                <div class="col-sm-2">
                    <b>Código</b>
                </div>
                <div class="col-sm-8">
                    {{$turno->codigo}} 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <b>Hora de Inicio</b> 
                </div>
                <div class="col-sm-8">
                    {{$turno->desde}} 
                </div>
            </div>

            <div class="row"  style="background-color: lightgray;">
                <div class="col-sm-2">
                    <b>Hora de Fin</b> 
                </div>
                <div class="col-sm-8">
                    {{$turno->hasta}} 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <b>Horas</b> 
                </div>
                <div class="col-sm-8">
                    {{$turno->horas}} 
                </div>
            </div>

            <div class="row" >
                <div class="col-sm-2">
                    <b>Estado</b> 
                </div>
                <div class="col-sm-8">
                    @if ($turno->activo)
                        ACTIVO 
                    @else
                        INACTIVO 
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <p>
                <form method="GET" action ="{{action('Maestros\TurnosController@getEdit', $turno->id)}}" style="display:inline" >
                    <input class="btn btn-danger" type="submit" value='Editar' />
                </form>
                <form method="GET" action ="{{action('Maestros\TurnosController@getIndex')}}" style="display:inline" >
                    <input class="btn btn-success" type="submit" value='Volver al Listado'/>
                </form>
                <form method="POST" action ="{{action('Maestros\TurnosController@postDelete', $turno->id)}}" style="display:inline" >
                     {{ csrf_field() }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el turno {{$turno->descripcion}}?')" value='Eliminar' />
                </form>
                </p>
            </div> 
        </blockquote>
    </div>
        
</div>

@stop