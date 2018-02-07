<div class="row" style="margin-top:20px">

	<div class="col-md-offset-3 col-md-6">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<span class="glyphicon glyphicon-film" aria-hidden="true"></span>
					Añadir película
				</h3>
			</div>

			<div class="panel-body" style="padding:30px">
			
				{{-- TODO: Abrir el formulario e indicar el método POST --}}
				
					{{-- TODO: Protección contra CSRF --}}
    
    				<div class="form-group">
    					<label for="title">Título</label>
    					<input type="text" name="title" id="title" class="form-control">
					</div>

					<div class="form-group">
						{{-- TODO: Completa el input para el año --}}
					</div>

					<div class="form-group">
						{{-- TODO: Completa el input para el director --}}
					</div>

					<div class="form-group">
						{{-- TODO: Completa el input para el poster --}}
					</div>

					<div class="form-group">
						<label for="synopsis">Resumen</label>
    					<textarea name="synopsis" id="synopsis" class="form-control" rows="3"></textarea>
					</div>

					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
							Añadir película
						</button>
					</div>

				{{-- TODO: Cerrar formulario --}}

			</div>
		</div>
	</div>
</div>
@stop
