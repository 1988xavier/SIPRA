<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $carrera->nombre }} | UPB</title>
@vite(['resources/css/app.css'])

<style>
/* === 🎨 ESTILO UPB MODERNO === */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #003366, #0057B8);
    color: #0B2540;
    margin: 0;
    padding: 0;
}

/* === Encabezado === */
header {
    padding: 1rem 1.2rem;
    background: rgba(255, 255, 255, 0.95);
    color: #003366;
    border-bottom: 2px solid rgba(0,0,0,0.05);
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    backdrop-filter: blur(4px);
    position: relative;
}

.header-top {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:.6rem;
}

.title {
    text-align:center;
    font-size:1.2rem;
    font-weight:800;
    margin:0;
    color:#003366;
}

/* ✅ Botón regresar */
.btn-back {
    position: absolute;
    right: 15px;
    top: 15px;
    background: #003366;
    width: 38px;
    height: 38px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: .25s;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

.btn-back:hover {
    background: #0057B8;
    transform: scale(1.07);
}

/* Icono flecha */
.btn-back svg {
    width: 20px;
    height: 20px;
    fill: white;
}

/* === Contenedor principal === */
.content {
    max-width: 950px;
    margin: -0.5px auto 40px;
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: fadeIn .6s ease-in-out;
    position: relative;
    z-index: 2;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}

.info {
    padding: 1.8rem;
}

/* === Multimedia con efecto de resplandor === */
.video-wrapper {
    position: relative;
    width: 110%;
    left: -5%;
    aspect-ratio: 16 / 9;
    margin-top: -15px;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    background: linear-gradient(145deg, #0057B8, #003366);
    padding: 4px;
}

.video-wrapper iframe,
.video-wrapper video {
    width: 100%;
    height: 100%;
    border: none;
    display: block;
    border-radius: 14px;
    box-shadow: 0 0 18px rgba(0,87,184,0.25);
    background: #000;
}

/* === Tabs === */
.tab-buttons-wrap {
    overflow-x: auto;
    white-space: nowrap;
    border-bottom: 2px solid #dce6f9;
    margin: 15px 0;
    padding-bottom: 5px;
    scrollbar-width: thin;
}

.tab-buttons-wrap::-webkit-scrollbar {
    height: 6px;
}

.tab-buttons-wrap::-webkit-scrollbar-thumb {
    background: #b3c8f2;
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
    transition: color .2s;
}

.tab-buttons button:hover {
    color: #0057B8;
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
    font-size: .97rem;
    line-height:1.7;
    white-space: pre-line;
    padding-top: 10px;
    color: #0B2540;
}

.tab-content.active {
    display: block;
    animation: fadeIn .5s ease-in-out;
}

/* === Galería === */
.gallery {
    display:flex;
    gap:12px;
    flex-wrap:wrap;
    margin-bottom:1.5rem;
}

.gallery img {
    width:48%;
    border-radius:14px;
    object-fit:cover;
    transition: transform .25s, box-shadow .25s;
}

.gallery img:hover {
    transform:scale(1.03);
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}

/* === Botones finales === */
.final-buttons {
    text-align:center;
    margin-top: 25px;
    margin-bottom: 35px;
}

.btn-primary {
    display:inline-block;
    padding: .8rem 1.6rem;
    background: #0057B8;
    color:#fff;
    border-radius:10px;
    font-weight:600;
    text-decoration:none;
    margin-bottom:12px;
    transition:.25s ease-in-out;
    box-shadow: 0 5px 10px rgba(0,87,184,0.3);
}

.btn-primary:hover {
    background:#003366;
    transform:scale(1.03);
}

.btn-secondary {
    display:inline-block;
    padding: .65rem 1.1rem;
    background:#666;
    color:white;
    border-radius:8px;
    text-decoration:none;
    font-size:.9rem;
    margin-top:5px;
    transition:.25s;
}

.btn-secondary:hover {
    background:#444;
    transform:scale(1.03);
}

/* ✅ === FOOTER PROFESIONAL UPB === */
footer {
    margin-top: 40px;
    background: #002347;
    color: white;
    padding: 30px 10px;
    text-align: center;
    box-shadow: 0 -4px 15px rgba(0,0,0,0.3);
}

footer .footer-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 5px;
}

footer .footer-subtitle {
    font-size: .9rem;
    opacity: .9;
}

footer .social-footer {
    margin: 12px 0;
}

footer .social-footer img {
    height: 32px;
    margin: 0 10px;
    transition: .25s;
}

footer .social-footer img:hover {
    transform: scale(1.15);
}

footer .copy {
    margin-top: 12px;
    font-size: .8rem;
    opacity: .8;
}


footer .social-footer {
    display: flex;
    justify-content: center;
    align-items: center;
}




</style>
</head>

<body>

<header>
    <div class="header-top">
        <img src="{{ asset('images/logo_upb.png') }}" alt="UPB Logo" style="height:45px;">
    </div>

    <!-- ✅ Flecha de regresar -->
    <a href="{{ route('carreras.index.public') }}" class="btn-back" title="Regresar">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
        </svg>
    </a>

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

            <div class="video-wrapper">
                <iframe src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        @if($videoFile)
            @php $videoPath = Storage::url($videoFile->ruta); @endphp
            <div class="video-wrapper">
                <video controls><source src="{{ $videoPath }}" type="video/mp4"></video>
            </div>
        @endif

        <div class="tab-buttons-wrap">
            <div class="tab-buttons">
                <button class="active" data-tab="t1">Descripción</button>
                <button data-tab="t2">Objetivo</button>
                <button data-tab="t3">Perfil</button>
                <button data-tab="t4">Plan de Estudio</button>
                <button data-tab="t5">Desarrollo Profesional</button>
                <button data-tab="t7">Requisitos</button>
            </div>
        </div>

        <div id="t1" class="tab-content active">{{ $carrera->descripcion }}</div>
        <div id="t2" class="tab-content">{{ $carrera->objetivo }}</div>
        <div id="t3" class="tab-content">{{ $carrera->perfil }}</div>
        <div id="t4" class="tab-content">{{ $carrera->plan_estudio }}</div>
        <div id="t5" class="tab-content">{{ $carrera->desarrollo_profesional }}</div>
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

        <h3 style="
    font-size: 1.1rem;
    font-weight: 700;
    color: #003366;
    margin: 15px 0 10px 0;
    text-align: center;
    letter-spacing: .5px;
">
    Galería de la Carrera
</h3>




            <div class="gallery">
                @foreach($imagenes as $img)
                    <img src="{{ asset('storage/'.$img->ruta) }}">
                @endforeach
            </div>
        @endif



<!-- ✅ TARJETA DE REDES SOCIALES -->
@if($carrera->facebook || $carrera->tiktok)
<div style="
    margin-top:25px;
    margin-bottom:20px;
    padding:20px;
    background:white;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
    text-align:center;
">

    <h3 style="
        font-size:1rem;
        font-weight:700;
        color:#003366;
        margin-bottom:15px;
        text-transform:uppercase;
        letter-spacing:1px;
    ">
        Redes oficiales de la carrera
    </h3>

    <div style="display:flex; justify-content:center; gap:25px;">

        @if($carrera->facebook)
        <a href="{{ $carrera->facebook }}" target="_blank"
            style="display:flex; align-items:center; justify-content:center;
                   width:60px; height:60px;
                   background:#f5f7fa;
                   border-radius:15px;
                   box-shadow:0 4px 12px rgba(0,0,0,0.15);
                   transition:.25s;">
            <img src="{{ asset('images/facebook.png') }}" style="width:30px; height:30px;">
        </a>
        @endif

        @if($carrera->tiktok)
        <a href="{{ $carrera->tiktok }}" target="_blank"
            style="display:flex; align-items:center; justify-content:center;
                   width:60px; height:60px;
                   background:#f5f7fa;
                   border-radius:15px;
                   box-shadow:0 4px 12px rgba(0,0,0,0.15);
                   transition:.25s;">
            <img src="{{ asset('images/tiktok.png') }}" style="width:30px; height:30px;">
        </a>
        @endif

    </div>
</div>
@endif








        <div class="final-buttons">
            <a href="{{ route('pre.registro', $carrera->id) }}" class="btn-primary">Pre-registrarse</a><br>
            
        </div>
    </div>

</div>

<!-- ✅ FOOTER PROFESIONAL UPB -->
<footer>
    <p class="footer-title">Sistema de Promoción y Pre-registro de Aspirantes  SIPRA</p>
    

    <div class="social-footer">
      

        <a href="https://www.upb.edu.mx" target="_blank">
            <img src="{{ asset('images/web.png') }}" alt="Sitio oficial UPB">
        </a>
    </div>

    <p class="copy">© {{ date('Y') }} Universidad Politécnica de Bacalar. Todos los derechos reservados.</p>
</footer>

</body>
</html>
