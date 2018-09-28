@extends('layouts.principal')

@section('banner')
	<div class="jumbotron">
	  <div class="container">
	  	<h1 class="display-4">Estudiantes</h1>
	  	<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
	  </div>
	</div>
@endsection

@section('contenido')
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-right" style="padding: 10px;">
				<button class="btn btn-success add-modal">Nuevo Estudiante</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Fecha Nacimiento</th>
				      <th scope="col">Correo</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($estudiantes as $estudiante)
					    <tr>
					      <th scope="row">{{ $estudiante->id }}</th>
					      <td>{{ $estudiante->nombre }}</td>
					      <td>{{ $estudiante->fecha_nacimiento }}</td>
					      <td>{{ $estudiante->email }}</td>
					      <td>
					      	<button class="show-modal btn btn-primary" data-id="{{ $estudiante->id }}" data-nombre="{{ $estudiante->nombre }}" data-fechan="{{ $estudiante->fecha_nacimiento }}" data-email="{{ $estudiante->email }}"><i class="fas fa-eye"></i></button>
					      	<button class="edit-modal btn btn-warning" data-id="{{ $estudiante->id }}" data-nombre="{{ $estudiante->nombre }}" data-fechan="{{ $estudiante->fecha_nacimiento }}" data-email="{{ $estudiante->email }}"><i class="fas fa-pen-square"></i></button>
					      	<button class="delete-modal btn btn-danger" data-id="{{ $estudiante->id }}" data-nombre="{{ $estudiante->nombre }}" data-fechan="{{ $estudiante->fecha_nacimiento }}" data-email="{{ $estudiante->email }}"><i class="fas fa-trash-alt"></i></button>
					      </td>
					    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
		</div>
	</div>
@endsection


@section('modals')

	<!-- Modal Mostrar Estudiante -->
	<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Estudiante</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <table class="table">
			  <tbody>
			    <tr>
			      <th scope="row">Código</th>
			      <td id="id_show"></td>
			    </tr>
			    <tr>
			      <th scope="row">Nombre</th>
			      <td id="nombre_show"></td>
			    </tr>
			    <tr>
			      <th scope="row">Fecha Nacimiento</th>
			      <td id="fechan_show"></td>
			    </tr>
			    <tr>
			      <th scope="row">Email</th>
			      <td id="email_show"></td>
			    </tr>
			  </tbody>
			</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
	      </div>
	    </div>
	  </div>
	</div>


	<!-- Modal Nuevo Estudiante -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Nuevo Estudiante</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
                <div class="form-group row">
                    <label class="control-label col-sm-3" for="nombre_add">Nombre:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nombre_add" autofocus>
                        <small>Min: 2, Max: 32</small>
                        <p class="errorNombre text-center alert alert-danger d-none"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3" for="fechan_add">Fecha Nacimiento:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="fechan_add">
                        <small>date</small>
                        <p class="errorFecha text-center alert alert-danger d-none"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3" for="email_add">Correo:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email_add">
                        <small>valid email</small>
                        <p class="errorEmail text-center alert alert-danger d-none"></p>
                    </div>
                </div>
            </form>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-success add" data-dismiss="modal">
                <span id="" class='glyphicon glyphicon-check'></span> Guardar
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <span class='glyphicon glyphicon-remove'></span> Cancelar
            </button>
	      </div>
	    </div>
	  </div>
	  
	</div>

@endsection


@section('scripts')
	<script>
		// show modal
		$('.show-modal').click(function () {
			$('.modal-title').text('Datos');
			$('#id_show').html($(this).data('id'));
			$('#nombre_show').html($(this).data('nombre'));
			$('#fechan_show').html($(this).data('fechan'));
			$('#email_show').html($(this).data('email'));
			$('#showModal').modal('show');
		});

		// add modal
        $('.add-modal').click(function() {
            $('.modal-title').text('Nuevo');
            $('#addModal').modal('show');
        });
        $('.modal-footer .add').click(function() {
        	
            $.ajax({
                type: 'POST',
                url: 'students',
                data: {
                    '_token': $('meta[name=_token]').attr('content'),
                    'nombre': $('#nombre_add').val(),
                    'fecha_nacimiento' : $('#fechan_add').val(),
                    'email': $('#email_add').val()
                },
                success: function(data) {
                	
                    $('.errorNombre').addClass('d-none');
                    $('.errorFecha').addClass('d-none');
                    $('.errorEmail').addClass('d-none');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nombre) {
                            $('.errorNombre').removeClass('d-none');
                            $('.errorNombre').text(data.errors.nombre);
                        }
                        if (data.errors.fecha_nacimiento) {
                            $('.errorFecha').removeClass('d-none');
                            $('.errorFecha').text(data.errors.fecha_nacimiento);
                        }
                        if (data.errors.email) {
                            $('.errorEmail').removeClass('d-none');
                            $('.errorEmail').text(data.errors.email);
                        }
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" + data.id + " '></td><td>Just now!</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                        /*$('.new_published').iCheck({
                            checkboxClass: 'icheckbox_square-yellow',
                            radioClass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.new_published').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.new_published').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: "",
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
                        });*/
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                },
            });
        });
	</script>
@endsection