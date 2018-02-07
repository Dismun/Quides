@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Personal Externo</h2>
            <h3>Editando.....</h3>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Nombre
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Categoría
	 	</div>
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Lugar de trabajo
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Predisposición
	 	</div>
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Desde
	 	</div>
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Hasta
	 	</div>


	 	<div class="col-md-1" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	
    	@foreach( $arrayExternos as $key => $externo )
    	<div class="row" style="margin: 5px 5px 5px 5px; background-color:{{$externo->color}}; ">
			

        		<div class="col-md-3">
	 				{{$externo->nombre}}
	 			</div>
	 			<div class="col-md-2">
	 				{{$externo->descripcion}}
	 			</div>
	 			<div class="col-md-2">
	 				{{$externo->lugar_trabajo}}
	 			</div>
	 			<div class="col-md-1">
	 				{{$externo->predisposicion}}
	 			</div>
	 			<div class="col-md-1">
	 				
	 					{{$externo->desde->format('d/m/y')}}
	 				
	 			</div>
	 			<div class="col-md-2">
	 				@if ($externoe->id == $externo->id)
	 					@if($externoe->hasta)
	 						<input name="hasta" id="hasta" size="10" form="ediex" type="date" value="{{ $externoe->hasta->format('Y-m-d') }}" min="{{ $externoe->desde->format('Y-m-d') }}"  />
	 					@else
	 						<input name="hasta" id="hasta" size="10" form="ediex" type="date" value="" min="{{ $externoe->desde->format('Y-m-d') }}" />
	 					@endif
	 				@else
	 				   @if($externo->hasta)
	 				      {{ $externo->hasta->format('d/m/y') }}
	 				    @endif
	 				@endif
	 			</div>
			

	 		
			
	 		<div class="col-md-1">
	 			@if ($externoe->id == $externo->id)
					<form method="POST" id='ediex' action="{{action('Relacionados\ExternosController@postUpdate', $externo->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayExternos)}} </b>

          				

@stop