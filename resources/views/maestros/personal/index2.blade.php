@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Personal</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/personal/create') }}"><h1 class="btn btn-success" >Nueva Persona</h1></a>
          <a href="{{ url('/personal') }}"><h1 class="btn btn-default" >Listado</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
    
    @foreach( $arrayPersonal as $key => $persona )

    <div class="col-xs-4 col-sm-3 col-md-2 text-center">

        <a href="{{ url('/personal/show/' . $persona->id ) }}">
            <div class="row" >
                <img src="storage/{{$persona->urlfoto}}" width="100" />
            </div>
            @if ($persona->activo)
            	<div class="row">
            @else
				<div class="row" style="background-color:lightgray;" >
            @endif
            	
            		
            	
                    <h3>  {{$persona->nombre}} </h3>
                
                <h4 style="min-height:45px;margin:5px 0 10px 0">
                    {{$persona->telefonos}} <br>
                    {{$persona->email}}
                </h4>
            </div>
        </a>

    </div>
    @endforeach

</div>

@stop