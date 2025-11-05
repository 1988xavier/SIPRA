<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#003366">
    <title>Bienvenida - UPB</title>

    @vite(['resources/css/app.css'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(6px);} 
            to { opacity:1; transform:translateY(0);} 
        }

        body { 
            -webkit-font-smoothing:antialiased; 
            -moz-osx-font-smoothing:grayscale; 
        }

        /* Logo directo sin fondo circular */
        .logo-wrap {
            display: flex;
            justify-content: center;
        }

        .logo-wrap img {
            width: 90vw;       /* más grande en móvil */
            max-width: 320px;  /* tamaño grande en desktops */
            height: auto;
            display: block;
            animation: fadeIn .6s ease both;
        }

        .title {
            margin-top: .9rem;
            font-weight: 600;
            color: #0b2540;
            font-size: 1.05rem;
            text-align: center;
        }
        .subtitle {
            margin-top: .45rem;
            color: #0f2b4a;
            text-align: center;
            opacity: .95;
            font-size: .95rem;
        }
        .cta {
            display:block;
            width:100%;
            max-width: 420px;
            margin: 1rem auto 0;
            text-align:center;
            padding: .85rem 1rem;
            border-radius: 9999px;
            background: #003366;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 10px 30px rgba(0,50,102,0.14);
        }
    </style>
</head>

<body class="min-h-screen bg-white font-sans relative overflow-auto">

<main 
    class="min-h-screen flex flex-col items-center justify-center px-4 safe-area-inset" 
    style="margin-top: 3vh;"  
>
    <!-- HEADER: logo + texto -->
    <header class="w-full max-w-lg flex flex-col items-center">
        <div class="logo-wrap">
            <img loading="lazy" src="{{ asset('images/logo_upb.png') }}" alt="Logo UPB">
        </div>

        <p class="title"></p>
        <p class="subtitle">“Formando profesionales con visión, liderazgo e innovación.”</p>
    </header>

    <!-- ESPACIO ENTRE LOGO Y BOTÓN -->
    <!-- 🔧 Puedes jugar con 'mt-' si quieres más/menos espacio -->
    <footer class="w-full max-w-lg mt-8 mb-4">
        <a href="{{ route('carreras.index.public') }}" class="cta" role="button" aria-label="Continuar a carreras">
            Continuar
        </a>
    </footer>
</main>

</body>
</html>
