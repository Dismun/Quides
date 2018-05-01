@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


        

        
        <h1>&nbsp;Calendario Laboral</h1>
        
      
    </div>
    <div class="col-sm-8">
       
        <blockquote class="blockquote">
           
            <h2> {{$dia->descripcion}}</h2>
            <div class="row" style="background-color: lightgray;">
                <div class="col-sm-3">
                    <b>Fecha</b>
                </div>
                <div class="col-sm-8">
                    {{$dia->fecha->format('d-m-y')}} 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <b>Tipo de Festividad</b> 
                </div>
                <div class="col-sm-8">
                    {{$dia->tipo_fiesta}} 
                </div>
            </div>

            

            
            <hr>
            <div class="row">
                <p>
                <form method="GET" action ="{{action('Maestros\CalendariolaboralController@getEdit', $dia->id)}}" style="display:inline" >
                    <input class="btn btn-danger" type="submit" value='Editar' />
                </form>
                <form method="GET" action ="{{action('Maestros\CalendariolaboralController@getIndex')}}" style="display:inline" >
                    <input class="btn btn-success" type="submit" value='Volver al Listado'/>
                </form>
                <form method="POST" action ="{{action('Maestros\CalendariolaboralController@postDelete', $dia->id)}}" style="display:inline" >
                     {{ csrf_field() }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el dia {{$dia->descripcion}}?')" value='Eliminar' />
                </form>
                </p>
            </div> 
        </blockquote>
    </div>
        
</div>

@stop