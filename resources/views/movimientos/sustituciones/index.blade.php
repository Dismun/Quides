@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Sustituciones</h2>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
        	<form action= "sustituciones/create" method="GET" style="display:inline">
        		<label>Desde el día
        			<input type="date" name="fdesde" id="fdesde" value='' required />
        		</label>
         		<input  type="submit" class="btn btn-success" value="Nueva línea de Sustitucion" />
           </form>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Sustituido
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Sustituto
	 	</div>
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Desde
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Hasta
	 	</div>
		<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Días
	 	</div>

	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arraySustituciones as $key => $sustitucion )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px; ">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray; ">
    		<?php $sw=0; ?>
    	@endif
			

        		<div class="col-md-2">
	 				{{$sustitucion->sustituido}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$sustitucion->sustituto}}
	 			</div>
	 			
	 			<div class="col-md-2">
	 				{{$sustitucion->desde->format('d/m/y')}}
	 			</div>
	 			<div class="col-md-2">
	 				@if ($sustitucion->hasta)
	 				   {{$sustitucion->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
			
				<div class="col-md-1">
	 				{{$sustitucion->dias}}
	 			</div>
	 		
			
	 		<div class="col-md-2">
	 			
				<form method="GET" action="{{action('Movimientos\SustitucionesController@getEdit', $sustitucion->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-pencil-square-o"></i>
						</button>
				</form>
					
				<form method="POST" action="{{action('Movimientos\SustitucionesController@postDelete', $sustitucion->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar el sustitucion {{$sustitucion->descripcion}}  de {{$sustitucion->nombre}} ?')" >
							<i class="fa fa-eraser"></i>
						</button>
				</form>
	 			
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arraySustituciones)}} </b>

          				

@stop