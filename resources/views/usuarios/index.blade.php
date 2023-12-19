@extends('layaout.navbar')

@section('contenido')
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

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    
                    <h6 class="mt-4 registrar-producto"><strong>Listado usuarios</strong></h6>
                    <div class="mt-4">
                        <input type="search" id="searchInput" placeholder="Buscar...">
                    </div>
                    <div class="mi-table">
                        <table class="table mt-4" id="tablaUsuarios">
                            <thead class="table-dark">
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            @foreach ($usuario->roles as $rol)
                                                {{ $rol->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}"><i class="fa-solid fa-pen-to-square edit"></i></a>
                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
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
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            var searchTerm = this.value.toLowerCase();
            var usuarioRows = document.querySelectorAll('#tablaUsuarios tbody tr');
    
            usuarioRows.forEach(function (row) {
                var rowText = row.textContent.toLowerCase();
                // Mostrar u ocultar la fila según si coincide con el término de búsqueda
                row.style.display = rowText.includes(searchTerm) ? 'table-row' : 'none';
            });
        });
    </script>
    <style>
        .mi-table{
            height: 400px;
            overflow: auto;
        }
        #tablaUsuarios thead th {
            position: sticky;
            top: 0;
        }
    </style>
@endsection