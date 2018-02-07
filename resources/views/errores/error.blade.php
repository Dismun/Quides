@extends('layouts.app')

@section('content')

<div class="container">
 
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">Error</div>
        <div class="panel-body">
          Este es el error  <br>  {{$exception->getMessage()}}<br>
        </div>
      </div>
    </div>
  </div>
</div>

@stop