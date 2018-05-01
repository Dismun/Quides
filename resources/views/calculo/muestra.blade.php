@extends('layouts.app')

@section('content')



<div class="row" style="background-color:lightgray;">
    <div class="col-md-4" >
        <center>
        <h4>
            <label>Bosquejos del {{$fechai->format('d-m-Y')}} al {{$fechaf->format('d-m-Y')}}</label>
		</h4>
            	
        </center>
       
    </div>
    <div class="col-md-4" > 
    	
       
    	
       
    </div>

    <div class="col-md-4" > 
    	
       
    </div>
    
</div>

<div class="row" style="margin: 5px 5px 5px 5px">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"><tbody>
		<?php $swf=$fechai->copy(); $mes=""; $celt=1;?>

		@while ($swf <= $fechaf)
			<?php $celt++; ?>  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<tr><th colspan="{{$celt}}" style="background-color: #000000 ; color: #FFFFFF ; "><center>E Q U I P O S</center></th>
		<tr><th>Génesis: {{$finicio->format('d-m-Y')}}</th>

		<?php $swf=$fechai->copy(); $mes=""; $cel=0;?>

		@while ($swf <= $fechaf)
			<?php $cel++; ?>

			@if ($mes != $swf->format(' m / Y'))

				@if ($cel > 1)

					<th colspan="{{$cel}}"><center>{{$mes}}</center></th>

				@endif

				<?php $mes= $swf->format(' m / Y'); $cel=0; ?>

			@endif

	  		<?php $swf->addDay(); ?>

	  	@endwhile
		<th colspan="{{$cel+1}}"><center>{{$mes}}</center></th>
		<tr><th>Nombre</th>
		<?php $swf=$fechai->copy(); ?>

	  	@while ($swf <= $fechaf)
	  		
	  		@if (App\Dia::where('fecha',$swf->format('Y-m-d'))->first())
	  			<th style="color : white; background-color : red ;" 
	  		@else
		  		@if (strtoupper($swf->format('l')) == 'SUNDAY')
		  			<th style="color:red" 
		  		@else
		  			@if (strtoupper($swf->format('l')) == 'SATURDAY')
		  				<th style="color:orange" 
		  			@else
		  				<th
		  			@endif
		  		@endif
		  	@endif
	  		><center>{{$swf->format('d')}}</center></th>
	  		<?php $swf->addDay(); ?>
	  	@endwhile
		
		<?php $nombre=""; ?>
	 	
	 	@foreach( $bosq as $key => $a )

	  		@if ($nombre != $a->nombre)

	  			<?php $nombre = $a->nombre;  $swf=$fechai->copy(); ?>
	  			</tr>	  				
	  			<tr><td style="background-color: {{$a->colorequipo}} ; ">{{$a->nombre}}</td>
	  				  		
	  		@endif

	  		@while ($swf->format('Y-m-d') < $a->fecha )
	  			<td></td>
	  			<?php $swf->addDay(); ?>
	  		@endwhile

			@if ($swf->format('Y-m-d') == $a->fecha)
	  			<?php $swf->addDay(); ?>
	  			<td align="center" style="background-color: {{$a->colornivel}} ; color: {{$a->colorcentro}} ; ">{{$a->codigoturno}}{{$a->codigopunto}} </td>
	  		@endif		
						
    	@endforeach
    	</tr>

 		<?php $swf=$fechai->copy(); $mes=""; $celt=1;?>

		@while ($swf <= $fechaf)
			<?php $celt++; ?>  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<tr><th colspan="{{$celt}}" style="background-color: #000000 ; color: #FFFFFF ; "><center>C H A M A N E S</center></th>   
	
		<tr><th>Génesis: {{$finicio->format('d-m-Y')}}</th>

		<?php $swf=$fechai->copy(); $mes=""; $cel=0;?>

		@while ($swf <= $fechaf)
			<?php $cel++; ?>
			@if ($mes != $swf->format(' m / Y'))

				@if ($cel > 1)
					<th colspan="{{$cel}}"><center>{{$mes}}</center></th>
				@endif

				<?php $mes= $swf->format(' m / Y'); $cel=0; ?>
			@endif
	  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<th colspan="{{$cel+1}}"><center>{{$mes}}</center></th>
		<tr><th>Nombre</th>

		<?php $swf=$fechai->copy(); ?>
	  	@while ($swf <= $fechaf)
	  		@if (App\Dia::where('fecha',$swf->format('Y-m-d'))->first())
	  			<th style="color : white; background-color : red ;" 
	  		@else
		  		@if (strtoupper($swf->format('l')) == 'SUNDAY')
		  			<th style="color:red" 
		  		@else
		  			@if (strtoupper($swf->format('l')) == 'SATURDAY')
		  				<th style="color:orange" 
		  			@else
		  				<th
		  			@endif
		  		@endif
		  	@endif
	  		><center>{{$swf->format('d')}}</center></th>
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<?php $nombre=""; ?>
	 	
	 	@foreach( $chamanes as $key => $a )

	  		@if ($nombre != $a->nombre)

	  			<?php $nombre = $a->nombre;  $swf=$fechai->copy(); ?>
	  			</tr>	  				
	  			<tr><td>{{$a->nombre}}</td>
	  				  		
	  		@endif

	  		@while ($swf->format('Y-m-d') < $a->fecha )
	  			<td></td>
	  			<?php $swf->addDay(); ?>
	  		@endwhile

			@if ($swf->format('Y-m-d') == $a->fecha)
	  			<?php $swf->addDay(); ?>
	  			<td align="center" style="background-color: {{$a->colornivel}} ; color: {{$a->colorcentro}} ; ">{{$a->codigoturno}}{{$a->codigopunto}} </td>
	  		@endif		
						
    	@endforeach
    	</tr>




		<?php $swf=$fechai->copy(); $mes=""; $celt=1;?>

		@while ($swf <= $fechaf)
			<?php $celt++; ?>  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<tr><th colspan="{{$celt}}" style="background-color: #000000 ; color: #FFFFFF ; "><center>E X T E R N O S</center></th>   
	
		<tr><th>Génesis: {{$finicio->format('d-m-Y')}}</th>

		<?php $swf=$fechai->copy(); $mes=""; $cel=0;?>

		@while ($swf <= $fechaf)
			<?php $cel++; ?>
			@if ($mes != $swf->format(' m / Y'))

				@if ($cel > 1)
					<th colspan="{{$cel}}"><center>{{$mes}}</center></th>
				@endif

				<?php $mes= $swf->format(' m / Y'); $cel=0; ?>
			@endif
	  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<th colspan="{{$cel+1}}"><center>{{$mes}}</center></th>
		<tr><th>Nombre</th>

		<?php $swf=$fechai->copy(); ?>
	  	@while ($swf <= $fechaf)
	  		@if (App\Dia::where('fecha',$swf->format('Y-m-d'))->first())
	  			<th style="color : white; background-color : red ;" 
	  		@else
		  		@if (strtoupper($swf->format('l')) == 'SUNDAY')
		  			<th style="color:red" 
		  		@else
		  			@if (strtoupper($swf->format('l')) == 'SATURDAY')
		  				<th style="color:orange" 
		  			@else
		  				<th
		  			@endif
		  		@endif
		  	@endif
	  		><center>{{$swf->format('d')}}</center></th>
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<?php $nombre=""; ?>
	 	
	 	@foreach( $externos as $key => $a )

	  		@if ($nombre != $a->nombre)

	  			<?php $nombre = $a->nombre;  $swf=$fechai->copy(); ?>
	  			</tr>	  				
	  			<tr><td>{{$a->nombre}}</td>
	  				  		
	  		@endif

	  		@while ($swf->format('Y-m-d') < $a->fecha )
	  			<td></td>
	  			<?php $swf->addDay(); ?>
	  		@endwhile

			@if ($swf->format('Y-m-d') == $a->fecha)
	  			<?php $swf->addDay(); ?>
	  			<td align="center" style="background-color: {{$a->colornivel}} ; color: {{$a->colorcentro}} ; ">{{$a->codigoturno}}{{$a->codigopunto}} </td>
	  		@endif		
						
    	@endforeach
    	</tr>

		<?php $swf=$fechai->copy(); $mes=""; $celt=1;?>

		@while ($swf <= $fechaf)
			<?php $celt++; ?>  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<tr><th colspan="{{$celt}}" style="background-color: #000000 ; color: #FFFFFF ; "><center>O T R O S</center></th>   
	
		<tr><th>Génesis: {{$finicio->format('d-m-Y')}}</th>

		<?php $swf=$fechai->copy(); $mes=""; $cel=0;?>

		@while ($swf <= $fechaf)
			<?php $cel++; ?>
			@if ($mes != $swf->format(' m / Y'))

				@if ($cel > 1)
					<th colspan="{{$cel}}"><center>{{$mes}}</center></th>
				@endif

				<?php $mes= $swf->format(' m / Y'); $cel=0; ?>
			@endif
	  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<th colspan="{{$cel+1}}"><center>{{$mes}}</center></th>
		<tr><th>Nombre</th>

		<?php $swf=$fechai->copy(); ?>
	  	@while ($swf <= $fechaf)
	  		@if (App\Dia::where('fecha',$swf->format('Y-m-d'))->first())
	  			<th style="color : white; background-color : red ;" 
	  		@else
		  		@if (strtoupper($swf->format('l')) == 'SUNDAY')
		  			<th style="color:red" 
		  		@else
		  			@if (strtoupper($swf->format('l')) == 'SATURDAY')
		  				<th style="color:orange" 
		  			@else
		  				<th
		  			@endif
		  		@endif
		  	@endif
	  		><center>{{$swf->format('d')}}</center></th>
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<?php $nombre=""; ?>
	 	
	 	@foreach( $otros as $key => $a )

	  		@if ($nombre != $a->nombre)

	  			<?php $nombre = $a->nombre;  $swf=$fechai->copy(); ?>
	  			</tr>	  				
	  			<tr><td>{{$a->nombre}}</td>
	  				  		
	  		@endif

	  		@while ($swf->format('Y-m-d') < $a->fecha )
	  			<td></td>
	  			<?php $swf->addDay(); ?>
	  		@endwhile

			@if ($swf->format('Y-m-d') == $a->fecha)
	  			<?php $swf->addDay(); ?>
	  			<td align="center" style="background-color: {{$a->colornivel}} ; color: {{$a->colorcentro}} ; ">{{$a->codigoturno}}{{$a->codigopunto}} </td>
	  		@endif		
						
    	@endforeach
    	</tr>















		<?php $swf=$fechai->copy(); $mes=""; $celt=1;?>

		@while ($swf <= $fechaf)
			<?php $celt++; ?>  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<tr><th colspan="{{$celt}}" style="background-color: #000000 ; color: #FFFFFF ; "><center>S I N&nbsp;&nbsp;&nbsp;C U B R I R</center></th>   
	
		<tr><th>Génesis: {{$finicio->format('d-m-Y')}}</th>

		<?php $swf=$fechai->copy(); $mes=""; $cel=0;?>

		@while ($swf <= $fechaf)
			<?php $cel++; ?>
			@if ($mes != $swf->format(' m / Y'))

				@if ($cel > 1)
					<th colspan="{{$cel}}"><center>{{$mes}}</center></th>
				@endif

				<?php $mes= $swf->format(' m / Y'); $cel=0; ?>
			@endif
	  			
	  		<?php $swf->addDay(); ?>
	  	@endwhile

		<th colspan="{{$cel+1}}"><center>{{$mes}}</center></th>
		<tr><th>Nombre</th>

		<?php $swf=$fechai->copy(); ?>
	  	@while ($swf <= $fechaf)
			@if (App\Dia::where('fecha',$swf->format('Y-m-d'))->first())
	  			<th style="color : white; background-color : red ;" 
	  		@else
		  		@if (strtoupper($swf->format('l')) == 'SUNDAY')
		  			<th style="color:red" 
		  		@else
		  			@if (strtoupper($swf->format('l')) == 'SATURDAY')
		  				<th style="color:orange" 
		  			@else
		  				<th
		  			@endif
		  		@endif
		  	@endif
	  		><center>{{$swf->format('d')}}</center></th>
	  		<?php $swf->addDay(); ?>
	  	@endwhile

	 	<tr><td>Vacios</td>
	 	<?php  $swf=$fechai->copy(); $swf2=""; $maspuntos=array() ;?>

		@foreach( $faltos as  $a )

			@if ($swf2==$a->fecha)
				<?php $maspuntos[]=$a; ?>
				
			@else

	  			@while ($swf->format('Y-m-d') < $a->fecha )
	  				<td></td>
	  				<?php $swf->addDay(); ?>
	  			@endwhile

				@if ($swf->format('Y-m-d') == $a->fecha)
	  				<?php $swf->addDay(); ?>
	  				<td align="center" style="background-color: {{$a->colornivel}} ; color: {{$a->colorcentro}} ;">{{$a->codigoturno}}{{$a->codigopunto}} </td>
	  			@endif	

	  		@endif

			<?php $swf2=$a->fecha; ?>	

    	@endforeach
        
        @while (count($maspuntos)>0)

    		<?php  $swf=$fechai->copy(); $swf2="";  ?>

			@foreach($maspuntos as $key => $a)

				@if ($swf2=="")
					</tr><tr><td>Vacios</td>
					<?php $swf2=$fechai->copy()->subDay()->format('Y-m-d'); ?>
				@endif

				@if ($swf2 < $a->fecha)
	  				@while ($swf->format('Y-m-d') < $a->fecha )
	  					<td></td>
	  					<?php $swf->addDay(); ?>
	  				@endwhile

					@if ($swf->format('Y-m-d') == $a->fecha)	  					
	  					<td align="center" style="background-color: {{$a->colornivel}} ; color: {{$a->colorcentro}} ;" >{{$a->codigoturno}}{{$a->codigopunto}} </td>
	  					<?php 
	  						unset($maspuntos[$key]);
	  					 	$swf->addDay(); 
	  					 	
	  					?>

	  				@endif
	  			@endif

				<?php $swf2=$a->fecha;  ?>

    		@endforeach

    	@endwhile
	

  
    	</tr>


	</tbody></table>
</div>

 
    	
    	

    	
          				         				

@stop