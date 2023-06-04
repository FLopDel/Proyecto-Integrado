<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de reserva en restaurante "LaFuente"</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 32px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 16px;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 16px 0;
        }

        p {
            font-size: 16px;
            margin: 8px 0;
        }

        a {
            color: #4285f4;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        img {
            max-width: 100%;
            margin-bottom: 16px;
        }

        @media (prefers-color-scheme: dark) {
        body {
            background-color: #ffffff;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Confirmación de reserva en restaurante "LaFuente"</h1>
        <img src="https://lafuenterestaurante.es/resources/img/logo2.png" alt="Logo del restaurante">
        <h2>Datos de la reserva</h2>
        <p>Nombre: <strong>{{ $last_nameClient }} {{ $nameClient }}</strong></p>
        <p>Email: <strong>{{ $email }}</strong></p>
        <p>Teléfono: <strong>{{ $phone }}</strong></p>
        <p>Número de comensales: <strong>{{ $people }}</strong></p>
        <p>Fecha: <strong>{{ $date }}</strong></p>
        <p>Hora: <strong>{{ $time }}</strong></p>

        <h3>Podrá visitar la web del restaurante desde este enlace: <a href="http://www.lafuenterestaurante.es">LaFuente Restaurante</a></h3>

        <p>Para cancelar la reserva, deberá ponerse en contacto con el restaurante. Gracias.</p>
    </div>
    
</body>
</html>