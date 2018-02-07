<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quides') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/102f348eb9.js"></script>
</head>
<body>
    <div id="app">
        <?php 
                                    $ini = Date("Y-m-d");

                                    $fi7 = strtotime ( '+7 day' , strtotime ( $ini ) ) ;
                                    $fi7 = date ( 'Y-m-d' , $fi7 );
                                    $fi15 = strtotime ( '+15 day' , strtotime ( $ini ) ) ;
                                    $fi15 = date ( 'Y-m-d' , $fi15 );
                                    $fi30 = strtotime ( '+30 day' , strtotime ( $ini ) ) ;
                                    $fi30 = date ( 'Y-m-d' , $fi30 );
                                    $fi90 = strtotime ( '+90 day' , strtotime ( $ini ) ) ;
                                    $fi90 = date ( 'Y-m-d' , $fi90 );
                                   
                                ?>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        @if (!Auth::guest())
                        @if (Auth::user()->admin)
                         <li class="dropdown">
                            <a href="{{ url('#') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="   false" >Maestros  <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/centros') }}">Centros</a></li>
                                    <li><a href="{{ url('/personal') }}">Personal</a></li>
                                    <li><a href="{{ url('/equipos') }}">Equipos</a></li>
                                    <li><a href="{{ url('/turnos') }}">Turnos</a></li>
                                    <li><a href="{{ url('/tipoincidencias') }}">Tipos de Incidencias</a></li>
                                    <li><a href="{{ url('/dias') }}">Calendario Laboral</a></li>
                                    <li><a href="{{ url('/categorias') }}">Categorías personal externo</a></li>
                                    <li><a href="{{ url('/niveles') }}">Niveles</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="{{ url('#') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="   false" >Relacionados  <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/clave') }}">Clave (Cadencia)</a></li>
                                    <li><a href="{{ url('/puntos') }}">Puntos (Ubicaciones)</a></li>
                                    <li><a href="{{ url('/puntos_detalle')}}"> Detalle Puntos</a></li>
                                    <li><a href="{{ url('/chamanes') }}">Chamanes</a></li>
                                    <li><a href="{{ url('/compoequipos') }}">Composición de Equipos</a></li>
                                    <li><a href="{{ url('/externos') }}">Personal Externo</a></li>                                
                                    
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="{{ url('#') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="   false" >Movimientos  <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/incidencias') }}">Incidencias</a></li>
                                    <li><a href="{{ url('/sustituciones') }}">Sustituciones</a></li>
                                    
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="{{ url('#') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="   false" >Bosquejos  <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/calcular') }}">Calcular</a></li>
                                    <li><a href="{{ url('/bosquejos/null?') }}">Edicion Diaria</a></li>
                                     <li><a href="/presenta?fechai={{ $ini }}&fechaf={{ $fi7 }}">Mostrar Bosquejo</a></li>
                                    
                            </ul>
                        </li>
                       @endif
                       @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Inicio de Sesión</a></li>
                            <li><a href="{{ route('register') }}">Registro</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/muestra?fechai={{ $ini }}&fechaf={{ $fi7 }}">Planing a 1 Semana</a></li>
                                    <li><a href="/muestra?fechai={{ $ini }}&fechaf={{ $fi15 }}">Planing a 15 Días</a></li>
                                    <li><a href="/muestra?fechai={{ $ini }}&fechaf={{ $fi30 }}">Planing a 1 Mes</a></li>
                                    <li><a href="/muestra?fechai={{ $ini }}&fechaf={{ $fi90 }}">Planing a 3 Meses</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        @if (Session::has('message'))
            <p class="alert alert-success"> {{Session::get('message')}} </p>
        @endif
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

    function tomafecha(arrayp) {
        
        for (x=0 ; x<arrayp.length ; x++)
        {
            
            if (arrayp[x].id == document.getElementById("idpersona").value ){
                
                document.getElementById('hasta').value = arrayp[x].fhasta;
                document.getElementById('hasta').max = arrayp[x].fhasta;
                if (arrayp[x].fhasta) {
                    document.getElementById('hasta').required = true;
                } else {
                    document.getElementById('hasta').required = false;
                }
            }
        }
        
    }
</script>
</body>
</html>
