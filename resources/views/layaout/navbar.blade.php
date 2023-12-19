<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/stye.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Cafeteria</title>
  </head>
  <body>
      <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand eslogan" href="#">Cafeteria <i class="fa-solid fa-mug-hot"></i></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Inicio <i class="fa-solid fa-house"></i></a>
                      </li>
                  @if(auth()->user()->can('administrar'))
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('productos.index') }}">Productos <i class="fa-brands fa-product-hunt"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('usuarios.index') }}">Usuarios <i class="fa-regular fa-user"></i></a>
                  </li>
                  @endif
                  @if(auth()->user()->can('vender'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('venta') }}">Ventas <i class="fa-brands fa-shopify"></i></a>
                  </li>
                  @endif
                  @if(auth()->user()->can('consultar'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('consulta') }}">Consultas <i class="fa-solid fa-magnifying-glass"></i></a>
                  </li>
                  @endif
                  <li>
                    <form method="post" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="btn">Salir <i class="fa-solid fa-right-from-bracket"></i></button>
                  </form>
                  </li>
              </div>
            </div>
          </nav>
      </header>


      <div class="container-fluid">

        @yield('contenido')

        
      </div>


      <script>
        // Ocultar alertas dentro del contenido después de 5 segundos
        setTimeout(function() {
            document.querySelectorAll('.container-fluid .alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 5000);
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>


