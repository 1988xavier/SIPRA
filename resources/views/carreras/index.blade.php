<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carreras | UPB</title>
@vite(['resources/css/app.css'])

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #E9F3FF; /* ✅ Fondo azul claro */
        color: #0B2540;
    }

    header {
        padding: 1rem;
        text-align: center;
        font-weight: 600;
        font-size: 1.3rem;
        color: #003366;
        border-bottom: 1px solid rgba(0,0,0,0.07);
        background: #fff;
    }

    .search-box {
        margin: 1rem auto;
        width: 90%;
        max-width: 500px;
    }

    .search-box input {
        width: 100%;
        padding: 0.9rem 1rem;
        border-radius: 12px;
        border: 1px solid #d5dbe5;
        font-size: .95rem;
        outline: none;
        transition: .2s;
    }
    .search-box input:focus {
        border-color: #0057B8;
        box-shadow: 0 0 6px rgba(0,87,184,.25);
    }

    .grid {
        padding: 1rem;
        max-width: 900px;
        margin: auto;
        display: grid;
        gap: 1.6rem;
    }

    .card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        transition: .25s;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 4px 12px rgba(0,0,0,0.06); /* ✅ ligera sombra para resaltar */
    }
    .card:hover {
        transform: translateY(-4px);
        border-color: rgba(0,0,0,0.12);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 1.3rem;
        text-align: left;
    }

    .card-body h3 {
        font-size: 1.05rem;
        font-weight: 600;
        margin: 0 0 .5rem;
        line-height: 1.3;
    }

    .btn-ver {
        display: inline-block;
        margin-top: .4rem;
        padding: .5rem 1.2rem;
        font-size: .85rem;
        font-weight: 600;
        border-radius: 8px;
        color: #fff;
        background: #003366;
        transition: .2s;
        text-decoration: none;
    }

    .btn-ver:hover {
        background: #0057B8;
    }
</style>
</head>

<body>

<header style="display:flex; align-items:center; justify-content:center; gap:10px; position:relative;">

    <!-- Logo izquierda -->
    <img src="{{ asset('images/logo_upb.png') }}" 
         alt="UPB Logo" 
         style="height:40px; position:absolute; left:15px;">

    <!-- Título centrado -->
    Carreras
</header>

<div class="search-box">
    <input type="text" placeholder="Buscar carrera..." id="buscador">
</div>

<div class="grid">
@foreach($carreras as $carrera)
    <div class="card">

        @php
            $multimedia = $carrera->multimedia->where('tipo','imagen')->sortBy('orden')->first();
            $imgPath = $multimedia ? $multimedia->ruta : null;
            $url = ($imgPath && Storage::disk('public')->exists($imgPath)) ? asset('storage/' . $imgPath) : asset('images/default-career.jpg');
        @endphp

        <img src="{{ $url }}" alt="{{ $carrera->nombre }}">

        <div class="card-body">
            <h3>{{ $carrera->nombre }}</h3>
            <a href="{{ route('carreras.show.public', $carrera->slug) }}" class="btn-ver">
                Ver carrera →
            </a>
        </div>
    </div>
@endforeach
</div>

<script>
const buscador = document.getElementById('buscador');
buscador.addEventListener('input', e => {
    const term = e.target.value.toLowerCase();
    document.querySelectorAll('.card').forEach(card => {
        const texto = card.innerText.toLowerCase();
        card.style.display = texto.includes(term) ? '' : 'none';
    });
});
</script>

</body>
</html>
