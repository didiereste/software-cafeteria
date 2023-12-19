<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cafeteria | Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>

    <div class="login-box">
      
      <h1>Registrarse</h1>
      @if($errors->any())
      <div class="alert alert-danger mt-1">
          <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif      
     
      <form action="{{ route('registrar') }}" method="POST">
        @csrf

        <label for="username">Nombre</label>
        <input type="text" placeholder="Ingresar nombre" name="name" required>
       
        <label for="username">Correo</label>
        <input type="text" placeholder="Ingresar email" name="email" required>
        
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Ingresar contraseña" name="password" required>

        <input type="submit" value="Log In">
        <a href="{{ route('login') }}">Iniciar sesion</a><br>
        
      </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

