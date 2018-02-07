@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Centros</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/centros/create') }}"><h1 class="btn btn-success" >Nuevo Centro</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
    
    @foreach( $arrayCentros as $key => $centro )

    <div class="col-xs-4 col-sm-3 col-md-2 text-center">

        <a href="{{ url('/centros/show/' . $centro->id ) }}">
            <div class="row" >
                <img src="storage/{{$centro->imagen}}" width="150" />
            </div>
            <div class="row" >
                <h1 style="color:{{$centro->color}}"> {{$centro->codigo}} </h1>
                <h4 style="min-height:45px;margin:5px 0 10px 0">
                    {{$centro->descripcion}} <br>
                    {{$centro->telefonos}}<br>
                    {{$centro->poblacion}}
                </h4>
            </div>
        </a>

    </div>
    @endforeach

</div>

@stop