@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col-sm-4">


        

        
        <h1>&nbsp;Datos Personales</h1>
        
      
    </div>
    <div class="col-sm-8">
       
        <blockquote class="blockquote">
            <img src="/storage/{{$persona->urlfoto}}" width="100"  />
            <h2> {{$persona->nombre}}</h2>
            <div class="row" style="background-color: lightgray;">
                <div class="col-sm-2">
                    <b>Email</b>
                </div>
                <div class="col-sm-8">
                    {{$persona->email}} 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <b>Teléfonos</b> 
                </div>
                <div class="col-sm-8">
                    {{$persona->telefonos}} 
                </div>
            </div>

            <div class="row" style="background-color: lightgray;" >
                <div class="col-sm-2">
                    <b>Estado</b> 
                </div>
                <div class="col-sm-8">
                    @if ($persona->activo)
                        ACTIVO 
                    @else
                        INACTIVO 
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <p>
                <form method="GET" action ="{{action('Maestros\PersonalController@getEdit', $persona->id)}}" style="display:inline" >
                    <input class="btn btn-danger" type="submit" value='Editar' />
                </form>
                <form method="GET" action ="{{action('Maestros\PersonalController@getIndex')}}" style="display:inline" >
                    <input class="btn btn-success" type="submit" value='Volver al Listado'/>
                </form>
                <form method="POST" action ="{{action('Maestros\PersonalController@postDelete', $persona->id)}}" style="display:inline" >
                     {{ csrf_field() }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar ala persona {{$persona->nombre}}?')" value='Eliminar' />
                </form>
                </p>
            </div> 
        </blockquote>
    </div>
        
</div>

@stop