@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
        <h4>
            <label>Bosquejo Diario del 
            	 {{$bosquejoe->fecha->format('d/m/Y')}}         
        		Editando.....
        	</label>
    	</h4>
        </center>
       
    </div>
    <div class="col-md-8"> 
        
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 
	 	
	 	
	 	
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Centro
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Punto
	 	</div> 	
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Persona
	 	</div>

	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
	
    	@foreach( $arrayBosquejos as $key => $bosquejo )
    		<div class="row" style="margin: 5px 5px 5px 5px;  ">
        		<div class="col-md-1" style="color:{{$bosquejo->ccolor}} ;">
	 				{{$bosquejo->codigo}}
	 			</div>
	 			<div class="col-md-3">
	 				{{$bosquejo->descturno}}
	 			</div>
	 			<div class="col-md-3" style="background-color:{{$bosquejo->ncolor}} ;">
	 				{{$bosquejo->descpunto}}
	 			</div>
	 			
	 			
	 			<div class="col-md-3">
	 				@if ($bosquejoe->id == $bosquejo->id)
	 					<select name='idpersona' id='idpersona' value="{{ $bosquejoe->idpersona}}" class="form-control" form='bosq' required>
	 						<option value=''> Selecciona persona </option>
	 						@foreach( $arrayPersonas as $key2 => $persona )
	 							<option value="{{ $persona->id }}" > {{ $persona->nombre }} </option>	 							
	 						@endforeach
	 					</select>	
	 				@else
	 				    {{$bosquejo->nombre}}
	 				@endif
	 			</div>
				
	 		
			
	 		<div class="col-md-2">
	 			@if ($bosquejoe->id == $bosquejo->id)
					<form method="POST" id='bosq' action="{{action('Bosquejos\BosquejoController@postUpdate', $bosquejo->id)}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/bosquejos/{{$bosquejoe->fecha->format('Y-m-d') }}'; ">
						<i class="fa fa-window-close"></i>
						</button>
					</form>	
				@endif	
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayBosquejos)}} </b>

          				

@stop