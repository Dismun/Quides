<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap-->
    <link href={{ url('/assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">  
    <!-- Custom styles for this template -->
   
    <script src={{ url('/assets/bootstrap/js/bootstrap.min.js') }}> </script>
  </head>

  <body>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #000000;">


  <a class="navbar-brand" href="#" style="color:#FFFFFF;">Quides</a>
  <a class="nav-item nav-link active" href="#">Login<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Claves</a>
      <a class="nav-item nav-link" href="#">Distribución</a>
      <a class="nav-item nav-link disabled" href="#">Disabled</a> 
 
</nav>
  <div class="container">
    <br>
    @notification()
    
    @yield('content')
  </div><!-- /.container -->


   
  </body>
</html>
