@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Composición de Equipos</h2>
            <h3>Editando.....</h3>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Nombre equipo
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Nombre
	 	</div>
	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Desde
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Hasta
	 	</div>


	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	
    	@foreach( $arrayCompoequipos as $key => $compoequipo )
    	<div class="row" style="margin: 5px 5px 5px 5px; background-color:{{$compoequipo->color}}; ">
			

        		<div class="col-md-3">
	 				{{$compoequipo->descripcion}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$compoequipo->nombre}}
	 			</div>
	 			<div class="col-md-2">
	 				
	 					{{$compoequipo->desde->format('d/m/y')}}
	 				
	 			</div>
	 			<div class="col-md-2">
	 				@if ($compoequipoe->id == $compoequipo->id)
	 					@if($compoequipoe->hasta)
	 						<input name="hasta" id="hasta" size="10" form="edicomp" type="date" value="{{ $compoequipoe->hasta->format('Y-m-d') }}" min="{{ $compoequipoe->desde->format('Y-m-d') }}"  />
	 					@else
	 						<input name="hasta" id="hasta" size="10" form="edicomp" type="date" value="" min="{{ $compoequipoe->desde->format('Y-m-d') }}" />
	 					@endif
	 				@else
	 				   @if($compoequipo->hasta)
	 				      {{ $compoequipo->hasta->format('d/m/y') }}
	 				    @endif
	 				@endif
	 			</div>
			

	 		
			
	 		<div class="col-md-2">
	 			@if ($compoequipoe->id == $compoequipo->id)
					<form method="POST" id='edicomp' action="{{action('Relacionados\CompoequiposController@postUpdate', $compoequipo->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayCompoequipos)}} </b>

          				

@stop