<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Guardias realizadas</title>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
 
    <main>
      <div id="details" class="clearfix">
        <div id="invoice">
        <center>
          <h4>Relación de Guardias entre las fechas {{ $fechai->format('d/m/Y') }} y {{ $fechaf->format('d/m/Y') }}</h4>
         </center>
        </div>
      </div>
      <table border="1" cellspacing="5" cellpadding="5" width="100%">
        <thead>
          <tr>
           
            <th class="desc">Nombre</th>
            <th class="unit">Turnos</th>
            
          </tr>
        </thead>
        <tbody>
        	@foreach ($data as $item)
          		<tr>
            	<td class="desc">{{ $item->nombre }}</td>
            	<td class="unit">{{ $item->guardias }}</td>
	          	</tr>
	        @endforeach
        </tbody>
        <tfoot>
          <tr>
            
            <td ></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
  </body>
</html>