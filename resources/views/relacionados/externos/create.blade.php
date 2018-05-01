@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Personal Externo</h2>
            <h3>Añadiendo.....</h3>
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
	 	
	
    	<?php $sw=0; ?>
    	@foreach( $arrayExternos as $key => $externo )
    	@if ($sw==0)
    		<div class="row" style="margin: 5px 5px 5px 5px; ">
    		<?php $sw=1; ?>
    	@else
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:lightgray; ">
    		<?php $sw=0; ?>
    	@endif
			
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
	 				@if ($externo->desde)
	 					{{$externo->desde->format('d/m/y')}}
	 				@endif
	 			</div>
				<div class="col-md-2">
					@if ($externo->hasta)
						{{$externo->hasta->format('d/m/y')}}
					@endif
				</div>
				<div class="col-md-1">
				</div>
		</div>
		@endforeach
		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF}}; ">
        		<div class="col-md-3">
        			<select name='idpersona' id='idpersona' class="form-control" form='pex' onchange ="javascript:tomafecha({{$arrayPersonas}});" required>
        					<option value=''> Selecciona Persona </option>
	 						@foreach( $arrayPersonas as $key2 => $persona )
	 							<option value="{{ $persona->id }}" > {{ $persona->nombre}} </option>
	 						@endforeach
	 				</select>	
	 				
	 			
	 			</div>
	 			<div class="col-md-2">
	 				<select name='idcategoria' id='idcategoria' class="form-control" form='pex' required>
	 						<option value=''> Selecciona categoria </option>
	 						@foreach( $arrayCategorias as $key2 => $categoria )
	 							<option value="{{ $categoria->id }}" > {{ $categoria->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			</div>
	 			<div class="col-md-2">
	 				<input type="text" value="" class="form-control" form="pex" id="lugar_trabajo" name="lugar_trabajo" /> 
	 			</div>
	 			<div class="col-md-1">
	 				<input type="text" value="" class="form-control" form="pex" id="predisposicion" name="predisposicion" /> 
	 			</div>
	 			
	 			<div class="col-md-1">
	 					<input name="desde" id="desde" type="date" form="pex" value='{{$fdesde}}' readonly required />	
	 			</div>


	 			<div class="col-md-2">
	 				<input name="hasta" id="hasta" type="date" form="pex" value='' min={{ $fdesde }} />
	 			</div>
			
	 	
	 		
			
	 		<div class="col-md-1">
	 			
					<form method="POST" id='pex' action="{{action('Relacionados\ExternosController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/externos'">
						<i class="fa fa-window-close"></i>
						</button>
					</form>	
				
	 		</div>

	 		
    	</div>

@stop

<script type="text/javascript">
	function tomafecha(a) 
	{
		Object.keys(a).forEach(function(key) {
  			var val = a[key];
  			if (val.id == document.getElementById("idpersona").value ){
				document.getElementById('hasta').value = val.fhasta;
				document.getElementById('hasta').max = val.fhasta;
				if (val.fhasta) {
					document.getElementById('hasta').required = true;
				} else {
					document.getElementById('hasta').required = false;
				}


			}
		});	
		
		
		
	}
</script>