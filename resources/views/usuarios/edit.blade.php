@extends('layaout.navbar')
@section('contenido')
<div class="row">
    @if($errors->any())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-lg-12">
        <h6 class="mt-4 text-center" style="color: white"><strong>Actualizar usuario</strong></h6>
        <form action="{{ route('usuarios.update',$usuario->id) }}" class="formu-registro" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mt-4">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ $usuario->name }}" required>
                </div>
                <div class="col-md-6 mt-4">
                    <label for="" class="mt-3 mt-md-0">Correo</label>
                    <input type="text" class="form-control" name="email" value="{{ $usuario->email }}" required>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6 mt-4">
                        <label for="rol">Rol:</label>
                        <select class="form-control" id="rol" name="rol">
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->name }}" {{ $usuario->hasRole($rol->name) ? 'selected' : '' }}>
                                {{ $rol->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <button type="submit" class="btn btn-success mt-4 mb-4">Actualizar</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-warning">Volver</a>
        </form>
    </div>
</div>

@endsection