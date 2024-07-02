@extends('layouts.app')

@section('content')
<h1>Crear nuevo estudiante</h1>
<form action="{{ route('estudiantes.store') }}" method="POST">
    @csrf
    <div class="row">
       <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"required>
       </div>
       <div class="col-md-4">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
    </div>
    <div class="row">
       <div class="col-md-6">
            <label for="email" class="form-label">Correo electronico</label>
            <textarea class="form-control" id="email" name="email"></textarea>
       </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
@endsection