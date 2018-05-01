@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Sábados y Domingos</h2>
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
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Sábado
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Domingos
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Desde
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Hasta
	 	</div>


	 	<div class="col-md-1" style="background-color: Black; color:#FFFFFF;">
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
	 			<div class="col-md-2">
	 				@if ($sabadosydomingoe->id == $sabadosydomingo->id)
	 					@if($sabadosydomingoe->hasta)
	 						@if($fhasta)
	 							<input name="hasta" id="hasta" size="10" form="edichan" type="date" value="{{ $sabadosydomingoe->hasta->format('Y-m-d') }}"  min="{{ $sabadosydomingoe->desde->format('Y-m-d') }}"  max="{{$fhasta}}" required />
	 						@else
	 							<input name="hasta" id="hasta" size="10" form="edichan" type="date" value="{{ $sabadosydomingoe->hasta->format('Y-m-d') }}"  min="{{ $sabadosydomingoe->desde->format('Y-m-d') }}"  />
	 						@endif

	 					@else
	 						<input name="hasta" id="hasta" size="10" form="edichan" type="date" value="" min="{{ $sabadosydomingoe->desde->format('Y-m-d') }}"  max="{{$fhasta}}" />
	 					@endif
	 				@else
	 				   @if($sabadosydomingo->hasta)
	 				      {{ $sabadosydomingo->hasta->format('d/m/y') }}
	 				    @endif
	 				@endif
	 			</div>
			

	 		
			
	 		<div class="col-md-1">
	 			@if ($sabadosydomingoe->id == $sabadosydomingo->id)
					<form method="POST" id='edichan' action="{{action('Relacionados\SabadosydomingosController@postUpdate', $sabadosydomingo->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arraySabadosydomingos)}} </b>

          				

@stop