@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Chamanes</h2>
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
	 		Turno
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Punto
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Desde
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Hasta
	 	</div>


	 	<div class="col-md-1" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 	
		<?php $sw=0; ?>
    	@foreach( $arrayChamanes as $key => $chaman)
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
	 				@if ($chaman->desde)
	 					{{$chaman->desde->format('d/m/y')}}
	 				@endif
	 			</div>
	 			<div class="col-md-1">
	 				@if ($chaman->hasta)
	 				   {{$chaman->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
			
		</div>
		@endforeach	
    	
    		<div class="row" style="margin: 5px 5px 5px 5px; background-color:#FFFFFF; ">
    	
       			<div class="col-md-3">
        			<select name='idpersona' id='idpersona' class="form-control" form='chaman' onchange ="javascript:tomafecha({{$arrayPersonas}});" required>
        					<option value=''> Selecciona persona </option>
	 						@foreach( $arrayPersonas as $key2 => $persona )
	 							<option value="{{ $persona->id }}" > {{ $persona->nombre }} </option>
	 						@endforeach
	 				</select>	
	 			
	 			
	 			</div>
	 			<div class="col-md-2">
	 				<select name='idturno' id='idturno' class="form-control" form='chaman' onchange ="javascript:PuntosFiltro({{$arrayPuntos}},{{$arrayChamanes}},'{{$fdesde}}');" required>
	 						<option value=''> Selecciona turno </option>
	 						@foreach( $arrayTurnos as $key2 => $turno )
	 							<option value="{{ $turno->id }}" > {{ $turno->descripcion }} </option>
	 						@endforeach
	 				</select>	
	 				
	 			</div>
	 			<div class="col-md-2" id="Puntos">
	 				<select name='idpunto' id='idpunto' class="form-control" form='chaman' required>
	 						<option value=''> Selecciona punto </option>
	 						@foreach( $arrayPuntos as $key2 => $punto )
	 							<option value="{{ $punto->id }}" > {{ $punto->descripcion }} </option>
	 						@endforeach
	 					</select>	
	 			</div>
	 			<div class="col-md-2">
	 					<input name="desde" id="desde" type="date" form="chaman" value='{{$fdesde}}' readonly required />	
	 			</div>


	 			<div class="col-md-2">
	 				<input name="hasta" id="hasta" type="date" form="chaman" min="{{$fdesde}}" />
	 			</div>
			

	 		
			
	 		<div class="col-md-1">
	 			
					<form method="POST" id='chaman' action="{{action('Relacionados\ChamanesController@postInsertar')}}" style="display:inline">
							{{ csrf_field() }}
						<button type="submit" class="btn btn-success" aria-label="Grabar">
						<i class="fa fa-check"></i>
						</button>
						<button  type='button' class="btn btn-danger" aria-label="Cancelar" onclick="location.href='/chamanes'">
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

	function PuntosFiltro(p,c,fecha)
	{
		var htmljs="";
		fecha=fecha +" 00:00:00";
		Object.keys(c).forEach(function(key){
			var val = c[key];

  			if (val.idturno == document.getElementById("idturno").value )
  				{
  					 // alert('mirando si pasa con: '+val.desde+' y hasta' + val.hasta +' y la fecha es '+ fecha);
  					if ( ((val.desde <= fecha)&(val.hasta == null))
  						|((val.desde <= fecha)&(val.hasta >= fecha)) )
  					 {
  					 	 // alert('pasa con: '+val.desde+' y hasta' + val.hasta);
  						Object.keys(p).forEach(function(ind) {
  							if (val.idpunto == p[ind].id ){
  								delete p[ind];
  							}
  						});
  					}
   				}

		});

		htmljs = "<select name='idpunto' id='idpunto' class='form-control' form='chaman' required> <option value=''> Selecciona punto </option>";

		
		Object.keys(p).forEach(function(ind) {
  						
  						htmljs=htmljs + "<option value='" + p[ind].id +"' > "+p[ind].descripcion+ " </option>";
  					});
		
	 				
	 	htmljs=htmljs + "</select>";
	 	document.getElementById("Puntos").innerHTML = htmljs;	
	}
</script>
