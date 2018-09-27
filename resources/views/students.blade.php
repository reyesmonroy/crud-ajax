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
			      	<button class="btn btn-primary"><i class="fas fa-eye"></i></button>
			      	<button class="btn btn-warning"><i class="fas fa-pen-square"></i></button>
			      	<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
			      </td>
			    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
@endsection