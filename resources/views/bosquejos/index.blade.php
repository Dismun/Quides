@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
        <h4>
            <label>Bosquejo Diario del 
            	<?php 
            		$f1 = get_class($fecha)::createFromFormat('Y-m-d', $fecha->format('Y-m-d')); 
            		$f2 = get_class($fecha)::createFromFormat('Y-m-d', $fecha->format('Y-m-d'));  
            	?>
            
            	<a href="{{ url('/bosquejos/'.$f1->subDay()->format('Y-m-d')) }}">
					<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
					</button>
				</a>
            	{{$fecha->format('d/m/Y')}}
            	<a href="{{ url('/bosquejos/'.$f2->addDay()->format('Y-m-d')) }}">
					<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-arrow-right" aria-hidden="true"></i>
					</button>
				</a>
			</label>
		</h4>
            	
        </center>
       
    </div>
    <div class="col-md-4" > 
    	
        <center>
        	<form action= "edita" method="GET" style="display:inline">
        		<label>Elige el día
        			<input type="date"  name="fecha" id="fecha" value='' class="form-control" required />
        		</label>
        		
         			<button class="btn btn-success" type="submit" aria-label="Editar">
         			
						<i class="fa fa-check"></i>
					</button>
			</form>
			
        </center>
    	
       
    </div>

    <div class="col-md-4" > 
    	<h5>
        <center>
        	@if (count($arrayBosquejos)>0)
        	  <?php $bosquejo = $arrayBosquejos[0]; ?>
        	@else
        	  <?php $bosquejo = (object) 0;
        	  		$bosquejo->bloqueado=0; ?>
        	@endif

        	@if ($bosquejo->bloqueado == 0)
			<form action= "create" method="GET" style="display:inline" >
				<label>Añadir Línea</label>
				<input type="hidden" value="{{$fecha->format('Y-m-d')}}" name="fecha" id="fecha">
           		<button class="btn btn-success" type="submit" aria-label="Añadir">         			
						<i class="fa fa-plus" aria-hidden="true"></i>
				</button>
			</form>
			
			<form action="{{action('Bosquejos\BosquejoController@postBloqueo', $fecha->format('Y-m-d'))}}" method="POST" style="display:inline" >
				{{ csrf_field() }}
				<label>Bloquear día</label>
           	<button class="btn btn-success" type="submit" aria-label="Bloquear" onclick="return confirm('Estas Seguro de querer BLOQUEAR EL DIA del bosquejo? \n Este día no podrá ser modificado por Quides una vez bloaqueado')" >         			
						<i class="fa fa-lock" aria-hidden="true"></i>
					</button>
			</form>
			@endif

        </center>
    	</h5>
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 15px 5px">
	 	<div class="col-md-1" style="background-color: Grey; color:#FFFFFF;">
	 		Centro
	 	</div>	 	
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Turno
	 	</div>
	 	<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Punto
	 	</div>
	 	<div class="col-md-3" style="background-color: Grey; color:#FFFFFF;">
	 		Persona
	 	</div>
		<div class="col-md-2" style="background-color: Grey; color:#FFFFFF;">
	 		Equipo
	 	</div>
	 	<div class="col-md-2" style="background-color: Black; color:#FFFFFF;">
	 		Acciones
	 	</div>
	 

 
    	
    	@foreach( $arrayBosquejos as $key => $bosquejo )
    		<div class="row" style="margin: 5px 5px 5px 5px;  ">
        		<div class="col-md-1" style="color:{{$bosquejo->ccolor}} ;">
	 				{{$bosquejo->codigo}}
	 			</div>

	 			<div class="col-md-2">
	 				{{$bosquejo->descturno}}
	 			</div>

	 			<div class="col-md-2" style="background-color:{{$bosquejo->ncolor}} ;">
	 				{{$bosquejo->descpunto}}
	 			</div>
	 			
	 			
	 			<div class="col-md-3" style="background-color:{{$bosquejo->ecolor}} ;">
	 				  {{$bosquejo->nombre}}
	 			</div>
				<div class="col-md-2" style="background-color:{{$bosquejo->ecolor}} ;">
	 				{{$bosquejo->equipo}} - {{$bosquejo->idequipo}} - {{$bosquejo->ordenidequipo}}
	 			</div>
			
	 		<div class="col-md-2">
	 			@if ($bosquejo->bloqueado==0)
				<form method="GET" action="{{action('Bosquejos\BosquejoController@getEdit', $bosquejo->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-pencil-square-o"></i>
						</button>
				</form>
					
				<form method="POST" action="{{action('Bosquejos\BosquejoController@postDelete', $bosquejo->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar la línea del bosquejo?')" >
							<i class="fa fa-eraser"></i>
						</button>
				</form>
	 			@endif
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayBosquejos)}} </b>

          				         				

@stop