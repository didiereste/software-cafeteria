
    @extends('layaout.navbar')
    @section('contenido')
    <link rel="stylesheet" href="{{ asset('css/producto.css') }}">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success mt-4 text-center"><strong>¡Exito!</strong>
            {{ session('success') }}
            </div>
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
        <div class="row">
            <div class="col-lg-5">
                <h6 class="mt-4 registrar-producto text-center"><strong>Registrar producto</strong></h6>
                <form action="{{ route('productos.store') }}" class="formu-registro" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label for="">Nombre producto</label>
                            <input type="text" class="form-control" name="nombre_producto" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="" class="mt-3 mt-md-0">Referencia</label>
                            <input type="text" class="form-control" name="referencia" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label for="" class="">Precio</label>
                            <input type="text" class="form-control" name="precio" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="" class="mt-3 mt-md-0">Peso</label>
                            <input type="text" class="form-control" name="peso" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="mt-3">Categoria</label>
                            <input type="text" class="form-control" name="categoria" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="" class="mt-3 mt-md-0">Stock</label>
                            <input type="text" class="form-control" name="stock" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 mb-4">Agregar</button>
                </form>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6 mt-4">
                
                <h6 class="mt registrar-producto"><strong>Listado productos</strong></h6>
                <div><input type="search" id="searchInput" placeholder="Buscar..."></div>
                <div class="mi-tabla">
                    <table class="table mt-4" id="tablaProductos">
                        <thead class="table-dark">
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Peso</th>
                            <th>Referencia</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                            <tr class="producto-row">
                                <td>{{ $producto->nombre_producto }}</td>
                                <td>{{ $producto->precio }}</td>
                                <td>{{ $producto->categoria }}</td>
                                <td>{{ $producto->peso }}</td>
                                <td>{{ $producto->referencia }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    <a href="{{ route('productos.edit',$producto->id) }}"><i class="fa-solid fa-pen-to-square edit"></i></a>
                                    <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
        var searchTerm = this.value.toLowerCase();
        var productoRows = document.querySelectorAll('.producto-row');

        productoRows.forEach(function (row) {
            var rowText = row.textContent.toLowerCase();
            // Mostrar u ocultar la fila según si coincide con el término de búsqueda
            row.style.display = rowText.includes(searchTerm) ? 'table-row' : 'none';
        });
    });
    </script>
    @endsection