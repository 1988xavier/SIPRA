<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $carrera->nombre }} | UPB</title>
@vite(['resources/css/app.css'])

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #E9F3FF;
        color: #0B2540;
    }

    header {
        padding: 1rem 1.2rem;
        color: #003366;
        border-bottom: 1px solid rgba(0,0,0,0.07);
        background: #fff;
    }

    .header-top {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:.6rem;
    }

    .social-icons img {
        height:28px;
        transition: .2s;
    }

    .social-icons img:hover {
        transform:scale(1.1);
    }

    .title {
        text-align:center;
        font-size:1.4rem;
        font-weight:700;
        margin:0;
    }

    .content {
        max-width: 900px;
        margin: 20px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .info {
        padding: 1.5rem;
    }

    iframe, video {
        width: 100%;
        height: 300px;
        border-radius: 12px;
        margin-top: 1rem;
    }

    .tab-buttons-wrap {
        overflow-x: auto;
        white-space: nowrap;
        border-bottom: 2px solid #ddd;
        margin: 15px 0;
        padding-bottom: 5px;
        scrollbar-width: thin;
    }

    .tab-buttons-wrap::-webkit-scrollbar {
        height: 6px;
    }

    .tab-buttons-wrap::-webkit-scrollbar-thumb {
        background: #aaa;
        border-radius: 5px;
    }

    .tab-buttons {
        display: inline-flex;
        gap: 18px;
    }

    .tab-buttons button {
        background: none;
        border: none;
        font-weight: 600;
        color: #003366;
        padding-bottom: 6px;
        cursor: pointer;
        font-size: 14px;
        position: relative;
    }

    .tab-buttons button.active {
        color: #0057B8;
    }

    .tab-buttons button.active::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 3px;
        background: #0057B8;
        border-radius: 2px;
    }

    .tab-content {
        display: none;
        font-size: .95rem;
        line-height:1.6;
        white-space: pre-line;
        padding-top: 10px;
    }

    .tab-content.active {
        display: block;
    }

    /* ✅ Centrado del botón final */
    .final-buttons {
        text-align:center;
        margin-top: 20px;
        margin-bottom: 30px;
    }

    .btn-primary {
        display:inline-block;
        padding: .7rem 1.4rem;
        background: #0057B8;
        color:#fff;
        border-radius:8px;
        font-weight:600;
        text-decoration:none;
        margin-bottom:10px;
    }

    .btn-secondary {
        display:inline-block;
        padding: .6rem 1rem;
        background:#666;
        color:white;
        border-radius:8px;
        text-decoration:none;
        font-size:.9rem;
        margin-top:5px;
    }
</style>
</head>

<body>

<header>
    <div class="header-top">
        <img src="{{ asset('images/logo_upb.png') }}" alt="UPB Logo" style="height:45px;">
        <div class="social-icons" style="display:flex; gap:12px;">
            <a href="https://www.facebook.com/UniversidadPolitecnicadeBacalar" target="_blank"><img src="{{ asset('images/facebook-icon.png') }}" alt="Facebook"></a>
            <a href="https://www.instagram.com/upb_oficial/?hl=es" target="_blank"><img src="{{ asset('images/instagram-icon.png') }}" alt="Instagram"></a>
        </div>
    </div>
    <h2 class="title">{{ $carrera->nombre }}</h2>
</header>

<div class="content">

    <div class="info" style="padding-bottom:0;">

        @php
            $videoFile = $carrera->multimedia->where('tipo','video')->first();
            $videoUrl  = $carrera->multimedia->where('tipo','video_url')->first();
        @endphp

        @if($videoUrl)
            @php
                $url = $videoUrl->ruta;
                if (str_contains($url, 'youtu.be')) {
                    $videoId = substr(parse_url($url, PHP_URL_PATH), 1);
                    $embedUrl = "https://www.youtube.com/embed/$videoId";
                } elseif (str_contains($url, 'watch?v=')) {
                    $videoId = explode('watch?v=', $url)[1];
                    $videoId = explode('&', $videoId)[0];
                    $embedUrl = "https://www.youtube.com/embed/$videoId";
                } elseif (str_contains($url, '/shorts/')) {
                    $videoId = explode('/shorts/', $url)[1];
                    $videoId = explode('?', $videoId)[0];
                    $embedUrl = "https://www.youtube.com/embed/$videoId";
                } else {
                    $embedUrl = $url;
                }
            @endphp

            <iframe src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
        @endif

        @if($videoFile)
            @php $videoPath = Storage::url($videoFile->ruta); @endphp
            <video controls><source src="{{ $videoPath }}" type="video/mp4"></video>
        @endif

        <div class="tab-buttons-wrap">
            <div class="tab-buttons">
                <button class="active" data-tab="t1">Descripción</button>
                <button data-tab="t2">Objetivo</button>
                <button data-tab="t3">Perfil</button>
                <button data-tab="t4">Plan de Estudio</button>
                <button data-tab="t5">Desarrollo Profesional</button>
                <button data-tab="t6">Competencias</button>
                <button data-tab="t7">Requisitos</button>
            </div>
        </div>

        <div id="t1" class="tab-content active">{{ $carrera->descripcion }}</div>
        <div id="t2" class="tab-content">{{ $carrera->objetivo }}</div>
        <div id="t3" class="tab-content">{{ $carrera->perfil }}</div>
        <div id="t4" class="tab-content">{{ $carrera->plan_estudio }}</div>
        <div id="t5" class="tab-content">{{ $carrera->desarrollo_profesional }}</div>
        <div id="t6" class="tab-content">{{ $carrera->competencias }}</div>
        <div id="t7" class="tab-content">{{ $carrera->requisitos }}</div>

        <script>
        document.querySelectorAll(".tab-buttons button").forEach(btn => {
            btn.addEventListener("click", function() {
                document.querySelectorAll(".tab-buttons button").forEach(b => b.classList.remove("active"));
                document.querySelectorAll(".tab-content").forEach(c => c.classList.remove("active"));
                this.classList.add("active");
                document.getElementById(this.dataset.tab).classList.add("active");
            });
        });
        </script>
    </div>

    <div class="info" style="padding-top:0;">
        @php $imagenes = $carrera->multimedia->where('tipo','imagen')->sortBy('orden'); @endphp

        @if($imagenes->count() > 0)
            <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:1rem;">
                @foreach($imagenes as $img)
                    <img src="{{ asset('storage/'.$img->ruta) }}" style="width:48%; border-radius:12px; object-fit:cover;">
                @endforeach
            </div>
        @endif

        <!-- ✅ BOTONES FINALES CENTRADOS -->
        <div class="final-buttons">
            <a href="{{ route('pre.registro', $carrera->id) }}" class="btn-primary">Pre-registrarse</a><br>
            <a href="{{ route('carreras.index.public') }}" class="btn-secondary">← Regresar</a>
        </div>
    </div>

</div>

</body>
</html>
