<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="form">
        <form action="{{route('loginValidate')}}" method="GET">
            @csrf
            <h5>Iniciar sesión</h5>
            <br>
            <label>Usuario: </label>
            <input type="text" id="email" name="email">
            <br>
            <label for="">Contraseña</label>
            <input type="password" id="password" name="password">
            <br>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <br> 
        <a href="">¿No tienes una cuenta? ¡Regístrate!</a> 
    </div>
</body>
</html>