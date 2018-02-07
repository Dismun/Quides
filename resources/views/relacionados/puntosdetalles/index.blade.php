@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Detalle de Puntos</h2>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
        	<br>
        	<form action= "puntos_detalle/create" method="GET" style="display:inline">
        		
         		<input  type="submit" class="btn btn-success" value="Nueva línea de detalle de punto" />
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
	 	<div class="col-md-4" style="background-color: Grey; color:#FFFFFF;">
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Lu
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Ma
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Mi
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Ju
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Vi
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Sá
		 	</div>
		 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
		 		Do
		 	</div>
		 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
		 		Festivos
		 	</div>
		 </div>
	 	


	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	
    	@foreach( $arrayPuntosdetalles as $key => $puntosdetalle )
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:{{$puntosdetalle->color}}; ">
    		
			

        		<div class="col-md-3">
	 				{{$puntosdetalle->descp}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$puntosdetalle->desct}}
	 			</div>
				<div class="col-md-4">
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->lunes)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->martes)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->miercoles)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->jueves)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>

		 			<div class="col-md-1">
		 				@if ($puntosdetalle->viernes)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->sabado)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->domingo)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 			<div class="col-md-1">
		 				@if ($puntosdetalle->festivo)
		 					Si
		 				@else
		 					No
		 				@endif
		 			</div>
		 		</div>
			

	 		
			
	 		<div class="col-md-2">
	 			
				<form method="GET" action="{{action('Relacionados\PuntosdetalleController@getEdit', $puntosdetalle->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-pencil-square-o"></i>
						</button>
				</form>
					
				<form method="POST" action="{{action('Relacionados\PuntosdetalleController@postDelete', $puntosdetalle->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar el detalle de punto?')" >
							<i class="fa fa-eraser"></i>
						</button>
				</form>
	 			
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayPuntosdetalles)}} </b>

          				

@stop