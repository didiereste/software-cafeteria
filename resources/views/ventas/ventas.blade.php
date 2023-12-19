@extends('layaout.navbar')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/vender.css') }}">
@if(session('success'))
    <div class="alert alert-success mt-4 text-center"><strong>¡Exito!</strong>
        {{ session('success') }}
    </div>
@else
    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
@endif

@if($errors->any())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('vender') }}" method="POST">
    @csrf
    <div class="row justify-content-center text-center" style="margin-top:70px">
        <!-- Sección de Productos -->
        <div class="col-lg-6" style="background-color: rgba(251, 238, 224, 0.7); border-radius: 20px; box-shadow: 0 5px 15px 5px rgba(3, 89, 92, .5)">
            <h6 class="mt-4"><strong>Productos</strong></h6>
            <div>
                <input type="text" id="searchInput" placeholder="Buscar por nombre">
            </div>
            <div style="height:150px;overflow:auto">
                @foreach ($productos as $producto)
                <div class="mt-4 producto-item">
                    <label>
                        <input type="radio" name="producto_id" value="{{ $producto->id }}" required>
                        {{ $producto->nombre_producto }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="col-lg-12 mb-4 mt-4">
                <h6 class="mt-4"><strong>Cantidad</strong></h6>
                <input type="text" name="cantidad" required>
                <div>
                    <button type="submit" class="button mt-4 btn btn-success" role="button">Vender</button>
                </div>
            </div>
        </div> 
    </div>
</form>
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        var searchTerm = this.value.toLowerCase();
        var productoItems = document.querySelectorAll('.producto-item');

        productoItems.forEach(function (productoItem) {
            var productoNombre = productoItem.textContent.toLowerCase();
            // Mostrar u ocultar el elemento según si coincide con el término de búsqueda
            productoItem.style.display = productoNombre.includes(searchTerm) ? 'block' : 'none';
        });
    });
</script>
@endsection