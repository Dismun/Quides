@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Detalle de Puntos</h2>
            <h3>Editando.....</h3>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
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
    	
    		<div class="row" style="margin: 5px 5px 5px 5px;">
    		
			

        		<div class="col-md-3">
	 				{{$puntosdetalle->descp}}
	 			</div>
	 			<div class="col-md-3"> 
	 				{{$puntosdetalle->desct}}
	 			</div>
	 			<div class="col-md-4">
	 			@if ($puntosdetallee->id == $puntosdetalle->id)
		 			<div class="col-md-1">
							<input type="checkbox" class="form-control" name="lunes" id="lunes" form="puntosdetalle" 
							@if ($puntosdetalle->lunes) 
								checked 
							@endif
							    />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="martes" id="martes" form="puntosdetalle" 
							@if ($puntosdetalle->martes) 
								checked 
							@endif
							    />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="miercoles" id="miercoles" form="puntosdetalle" 
							@if ($puntosdetalle->miercoles) 
								checked 
							@endif
							    />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="jueves" id="jueves" form="puntosdetalle" 
							@if ($puntosdetalle->jueves) 
								checked 
							@endif
							    />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="viernes" id="viernes" form="puntosdetalle" 
							@if ($puntosdetalle->viernes) 
								checked 
							@endif
							    />
					</div>
					
		 			<div class="col-md-1">
							<input type="checkbox" class="form-control" name="sabado" id="sabado" form="puntosdetalle" 
							@if ($puntosdetalle->sabado) 
								checked 
							@endif
							    />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="domingo" id="domingo" form="puntosdetalle"
							@if ($puntosdetalle->domingo) 
								checked 
							@endif
							    />
					</div>
					<div class="col-md-1">
							<input type="checkbox" class="form-control" name="festivo" id="festivo" form="puntosdetalle"
							@if ($puntosdetalle->festivo) 
								checked 
							@endif
							    />
					</div>
	 			@else
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
	 			@endif
	 			</div>
	 			
	 			
			

	 		
			
	 		<div class="col-md-2">
	 			@if ($puntosdetallee->id == $puntosdetalle->id)
					<form method="POST" id='puntosdetalle' action="{{action('Relacionados\PuntosdetalleController@postUpdate', $puntosdetalle->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayPuntosdetalles)}} </b>

          				

@stop