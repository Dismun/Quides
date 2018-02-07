@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Sábados y Domingos</h2>
            <h3>Añadiendo.....</h3>
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
    	@foreach( $arraySabadosydomingos as $key => $sabadosydomingo)
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
	 				@if ($sabadosydomingo->desde)
	 					{{$sabadosydomingo->desde->format('d/m/y')}}
	 				@endif
	 			</div>
	 			<div class="col-md-2">
	 				@if ($sabadosydomingo->hasta)
	 				   {{$sabadosydomingo->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
			
		</div>
		@endforeach	
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF; ">
    	
       			<div class="col-md-3">
        			<select name='idpunto' id='idpunto' class="form-control" form='sabadosydomingo' required>
        					<option value=''> Selecciona Punto </option>
	 						@foreach( $arrayPuntos as $key2 => $punto )
	 							<option value="{{ $punto->id }}" > {{ $punto->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 			
	 			
	 			</div>
	 			<div class="col-md-3">
	 				<select name='idturno' id='idturno' class="form-control" form='sabadosydomingo' required>
	 						<option value=''> Selecciona turno </option>
	 						@foreach( $arrayTurnos as $key2 => $turno )
	 							<option value="{{ $turno->id }}" > {{ $turno->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			</div>
	 			<div class="col-md-1">
						<input type="checkbox" class="form-control" name="sabados" id="sabados" form="sabadosydomingo"/>
				</div>
				<div class="col-md-1">
						<input type="checkbox" class="form-control" name="domingos" id="domingos" form="sabadosydomingo"/>
				</div>

	 			<div class="col-md-1">
	 					<input name="desde" id="desde" type="date" form="sabadosydomingo" value='{{$fdesde}}' readonly required />	
	 			</div>


	 			<div class="col-md-2">
	 				<input name="hasta" id="hasta" type="date" form="sabadosydomingo" min="{{$fdesde}}" />
	 			</div>
			

	 		
			
	 		<div class="col-md-1">
	 			
					<form method="POST" id='sabadosydomingo' action="{{action('Relacionados\SabadosydomingosController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/sabadosydomingos'">
						<i class="fa fa-window-close"></i>
						</button>
					</form>	
				
	 		</div>
	 		
    	</div>

    	

    	

          				

@stop

