<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a {{ $datos['landinPage']['titulo_evento'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container img {
            width: 200px;
        }

        .container__titulo {
            display: inline-block;
        }

        .container__titulo img {
            width: 75px;
        }

        h1 {
            font-size: 25px;
        }

        h1,
        h2,
        h3,
        p {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container__titulo">
            {{-- <img src="{{ $logo }}" alt="Logo del evento"> --}}
            <h1>Bienvenido a {{ $datos['landinPage']['titulo_evento'] }}</h1>
        </div>
        <p>Hola <b>{{ $datos['nombre'] }}</b>,</p>
        <p>Nos emociona tenerte con nosotros en este emocionante evento de exposición. Te has registrado con éxito y estamos encantados de que te unas a nosotros.</p>
        <p>A continuación, te proporcionamos los detalles del evento:</p>
        <ul>
            <li>Fecha: <b>{{ $datos['landinPage']['fecha_evento'] }}</b></li>
            <li>Hora: <b>{{ $datos['landinPage']['hora_evento'] }}</b></li>
        </ul>
    
        <center>
            {{-- Mostrar el código QR adjunto --}}
            <img src="{{ $message->embed(public_path('qrcodes/qrcode.svg')) }}" alt="Código QR">
        </center>
    
        <p>Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con nosotros.</p>
        <p>¡Esperamos verte pronto!</p>
        <p>Saludos cordiales, <b></b></p>
    </div>
    
</body>

</html>