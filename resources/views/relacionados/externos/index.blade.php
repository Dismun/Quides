
@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
            <h2>Personal Externo</h2>
        </center>
       
    </div>
    <div class="col-md-8"> 
        <center>
        	<form action= "externos/create" method="GET" style="display:inline">
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
	 			
	 			<div class="col-md-2">
	 				@if ($externo->desde)
	 					{{$externo->desde->format('d/m/y')}}
	 				@endif
	 			</div>
	 			<div class="col-md-1">
	 				@if ($externo->hasta)
	 				   {{$externo->hasta->format('d/m/y')}}
	 				@endif
	 			</div>
			

	 		
			
	 		<div class="col-md-1">
	 			
				<form method="GET" action="{{action('Relacionados\ExternosController@getEdit', $externo->id)}}" style="display:inline">
						<button type="submit" class="btn btn-success" aria-label="Editar">
						<i class="fa fa-pencil-square-o"></i>
						</button>
				</form>
					
				<form method="POST" action="{{action('Relacionados\ExternosController@postDelete', $externo->id)}}" style="display:inline">
	 					{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" aria-label="Eliminar" onclick="return confirm('Estas Seguro de querer eliminar el registro {{$externo->nombre}} ?')" >
							<i class="fa fa-eraser"></i>
						</button>
				</form>
	 			
	 			
	 		</div>
	 		
    	</div>

    	@endforeach

    	<b>Total listados: {{ count($arrayExternos)}} </b>

          				

@stop