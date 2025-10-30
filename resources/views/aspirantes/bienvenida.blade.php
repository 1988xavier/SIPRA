<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - UPB</title>
    @vite(['resources/css/app.css'])
    <style>
        /* Fondo con degradado suave */
        body {
            background: linear-gradient(180deg, #003366 0%, #0066cc 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        img {
            width: 160px;
            margin-bottom: 25px;
            animation: fadeIn 1.5s ease-in-out;
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            animation: slideDown 1.2s ease-in-out;
        }

        p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 35px;
            animation: fadeIn 2s ease-in-out;
        }

        a {
            background: white;
            color: #003366;
            padding: 12px 50px;
            border-radius: 25px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        a:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <img src="{{ asset('images/logo_upb.png') }}" alt="Logo UPB">

    <h1>Universidad Politécnica de Bacalar</h1>
    <p>“Formando profesionales con visión, liderazgo e innovación.”</p>

    <a href="{{ route('carreras.index.public') }}">Continuar</a>

</body>
</html>
