@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Composición de Equipos</h2>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
        	<form action= "compoequipos/create" method="GET" style="display:inline">
        		<label>Desde el día
        			<input type="date" name="fdesde" id="fdesde" value='' required />
        		</label>
         		<input  type="submit" class="btn btn-success" value="Nueva línea de Equipo" />
           </form>
        </center>
       
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
	 				@if ($compoequipo->hasta)
	 				   {{$compoequipo->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
			

	 		
			
	 		<div class="col-md-2">
	 			
				<form method="GET" action="{{action('Relacionados\CompoequiposController@getEdit', $compoequipo->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-pencil-square-o"></i>
						</button>
				</form>
					
				<form method="POST" action="{{action('Relacionados\CompoequiposController@postDelete', $compoequipo->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar el registro {{$compoequipo->nombre}} ?')" >
							<i class="fa fa-eraser"></i>
						</button>
				</form>
	 			
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayCompoequipos)}} </b>

          				

@stop