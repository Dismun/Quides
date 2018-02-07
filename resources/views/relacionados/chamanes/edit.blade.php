@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Chamanes</h2>
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
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Punto
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
    	@foreach( $arrayChamanes as $key => $chaman )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px; ">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray; ">
    		<?php $sw=0; ?>
    	@endif
			

        		<div class="col-md-3">
	 				{{$chaman->nombre}}
	 			</div>
	 			<div class="col-md-3"> 
	 				{{$chaman->desct}}
	 			</div>
	 			<div class="col-md-2">
	 				{{$chaman->descp}}
	 			</div>
	 			<div class="col-md-1">
	 				
	 					{{$chaman->desde->format('d/m/y')}}
	 				
	 			</div>
	 			<div class="col-md-2">
	 				@if ($chamane->id == $chaman->id)
	 					@if($chamane->hasta)
	 						@if($fhasta)
	 							<input name="hasta" id="hasta" size="10" form="edichan" type="date" value="{{ $chamane->hasta->format('Y-m-d') }}"  min="{{ $chamane->desde->format('Y-m-d') }}"  max="{{$fhasta}}" required />
	 						@else
	 							<input name="hasta" id="hasta" size="10" form="edichan" type="date" value="{{ $chamane->hasta->format('Y-m-d') }}"  min="{{ $chamane->desde->format('Y-m-d') }}"  />
	 						@endif

	 					@else
	 						<input name="hasta" id="hasta" size="10" form="edichan" type="date" value="" min="{{ $chamane->desde->format('Y-m-d') }}"  max="{{$fhasta}}" />
	 					@endif
	 				@else
	 				   @if($chaman->hasta)
	 				      {{ $chaman->hasta->format('d/m/y') }}
	 				    @endif
	 				@endif
	 			</div>
			

	 		
			
	 		<div class="col-md-1">
	 			@if ($chamane->id == $chaman->id)
					<form method="POST" id='edichan' action="{{action('Relacionados\ChamanesController@postUpdate', $chaman->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayChamanes)}} </b>

          				

@stop