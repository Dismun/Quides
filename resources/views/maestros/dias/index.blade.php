@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h1 >Calendario Laboral</h1>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
          <a href="{{ url('/dias/create') }}"><h1 class="btn btn-success" >Nuevo Día Festivo</h1></a>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Fecha
	 	</div>
	 	<div class="col-md-4" style="background-color: Grey; color:#FFFFFF;">
	 		Descripción
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Tipo de Festividad
	 	</div>
	 	<div class="col-md-3" style="background-color: Black; color:#FFFFFF;">
	 		Acción
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayDias as $key => $dia )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray;">
    		<?php $sw=0; ?>
    	@endif
			
	 		<div class="col-md-2">
	 			{{ $dia->fecha->format('d-m-Y') }}
	 		</div>
	 		<div class="col-md-4">
        		<a href="{{ url('/dias/show/' . $dia->id ) }}">
        			{{$dia->descripcion}} </a>
        	</div>

        	<div class="col-md-3">
	 			{{$dia->tipo_fiesta}}
	 		</div>
	 		
	 		<div class="col-md-3">
	 			<form method="POST" action="{{action('Maestros\CalendariolaboralController@postDelete', $dia->id)}}" style="display:inline">
	 				{{ csrf_field() }}
          			<input class="btn btn-danger" type="submit" onclick="return confirm('Estas Seguro de querer eliminar el dia {{$dia->descripcion}}?')" value='Eliminar' />
	 			</form>
				<form method="GET" action="{{action('Maestros\CalendariolaboralController@getEdit', $dia->id)}}" style="display:inline">
	 				<input class="btn btn-success" type="submit"  value='Editar' />
	 			</form>
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayDias)}} </b>

	

</div>

@stop