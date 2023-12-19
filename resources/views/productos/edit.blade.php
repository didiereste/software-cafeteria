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
        <h6 class="mt-4 text-center" style="color: white"><strong>Actualizar producto</strong></h6>
        <form action="{{ route('productos.update',$producto->id) }}" class="formu-registro" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mt-4">
                    <label for="">Nombre producto</label>
                    <input type="text" class="form-control" name="nombre_producto" value="{{ $producto->nombre_producto }}" required>
                </div>
                <div class="col-md-6 mt-4">
                    <label for="" class="mt-3 mt-md-0">Referencia</label>
                    <input type="text" class="form-control" name="referencia" value="{{ $producto->referencia }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-4">
                    <label for="" class="">Precio</label>
                    <input type="text" class="form-control" name="precio" value="{{ $producto->precio }}" required>
                </div>
                <div class="col-md-6 mt-4">
                    <label for="" class="mt-3 mt-md-0">Peso</label>
                    <input type="text" class="form-control" name="peso" value="{{ $producto->peso }}"required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="mt-3">Categoria</label>
                    <input type="text" class="form-control" name="categoria" value="{{ $producto->categoria }}" required>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="" class="mt-3 mt-md-0">Stock</label>
                    <input type="text" class="form-control" name="stock" value="{{ $producto->stock }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4 mb-4">Actualizar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-warning">Regresar</a>
        </form>
    </div>
</div>

@endsection