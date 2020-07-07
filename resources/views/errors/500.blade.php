<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 500</title>
    <style>
        h1{
            font-size: 150px;
            color: white;
            margin: 0;
        }
        p{
            font-size: 30px;
            color: white;
        }
        .has-overlay-dark {
            margin: 0;
            position: relative;
            z-index: 1;
            background: url("{{asset('images/abuelos.jpg')}}") center center / cover no-repeat;
        }
        .has-overlay-dark::before {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            background: rgba(17, 17, 17, 0.44);
            z-index: -1;
        }
        .center{
            width: 100%;
            text-align: center;
        }
        .logo{
            width: 250px;
        }
        .fondo{
            width: 100%;
            height: 100vh;
        }
        .btn{
            text-decoration: none;
            display: inline-block;
            font-weight: 400;
            color: #858796;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .35rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .btn-primary{
            color: #fff;
            background-color: #ff4949;
            border-color: #ff4949;
        }

    </style>
</head>
<body class="has-overlay-dark">
    <div class="fondo">
        <div class="center">
            <img class="logo" src="{{asset('images/logos/logo_sgam.png')}}" alt="Logo SGAM">
            <h1>500</h1>
            <p>Lo sentimos, ocurrió un problema.</p>
            <a class="btn btn-primary" href="{{route('home')}}">Volver al inicio</a>
        </div>
    </div>
<a href="https://www.freepik.es/fotos/personas" style="display: none">Foto de Personas creado por freepik - www.freepik.es</a>

</body>
</html>
