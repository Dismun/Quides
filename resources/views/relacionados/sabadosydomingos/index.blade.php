@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Sábados y Domingos</h2>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
        	<form action= "sabadosydomingos/create" method="GET" style="display:inline">
        		<label>Desde el día
        			<input type="date" name="fdesde" id="fdesde" value='' required />
        		</label>
         		<input  type="submit" class="btn btn-success" value="Nueva línea Sabados y Domingos" />
           </form>
        </center>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Punto
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Sábados
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Domingos
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Desde
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Hasta
	 	</div>


	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arraySabadosydomingos as $key => $sabadosydomingo )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px; ">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray; ">
    		<?php $sw=0; ?>
    	@endif
			

        		<div class="col-md-3">
	 				{{$sabadosydomingo->descp}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$sabadosydomingo->desct}}
	 			</div>
	 			<div class="col-md-1">
	 				@if ($sabadosydomingo->sabados)
	 					Si
	 				@else
	 					No
	 				@endif
	 			</div>
	 			<div class="col-md-1">
	 				@if ($sabadosydomingo->domingos)
	 					Si
	 				@else
	 					No
	 				@endif
	 			</div>
	 			<div class="col-md-1">
	 				{{$sabadosydomingo->desde->format('d/m/y')}}
	 			</div>
	 			<div class="col-md-1">
	 				@if ($sabadosydomingo->hasta)
	 				   {{$sabadosydomingo->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
			

	 		
			
	 		<div class="col-md-2">
	 			
				<form method="GET" action="{{action('Relacionados\SabadosydomingosController@getEdit', $sabadosydomingo->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-pencil-square-o"></i>
						</button>
				</form>
					
				<form method="POST" action="{{action('Relacionados\SabadosydomingosController@postDelete', $sabadosydomingo->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar el sabadosydomingo {{$sabadosydomingo->nombre}} ?')" >
							<i class="fa fa-eraser"></i>
						</button>
				</form>
	 			
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arraySabadosydomingos)}} </b>

          				

@stop