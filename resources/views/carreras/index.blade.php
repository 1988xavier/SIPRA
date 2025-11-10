<!DOCTYPE html> 
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carreras | UPB</title>
@vite(['resources/css/app.css'])


<style>
/* =======================================================
   🎓 ESTILO GENERAL UPB
======================================================= */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;

    background:
        linear-gradient(135deg, rgba(0, 25, 60, 0.7), rgba(0, 87, 184, 0.65)),
        url('{{ asset("images/fondo.jpg") }}') no-repeat center center fixed;

    background-size: cover;
    color: #f1f5ff;
}

/* ENCABEZADO */
header {
    padding: 1rem 1.2rem;
    background: rgba(255, 255, 255, 0.95);
    border-bottom: 2px solid rgba(0,0,0,0.05);
    color: #003366;
    text-align: center;
    font-weight: 700;
    font-size: 1.4rem;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    backdrop-filter: blur(4px);
    position: relative;
    z-index: 5;
}

header img {
    height: 42px;
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
}

/* FLECHA DE REGRESO */
.btn-back {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    background: #003366;
    width: 38px;
    height: 38px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    transition: .25s;
}

.btn-back:hover {
    background: #0057B8;
    transform: translateY(-50%) scale(1.07);
}

.btn-back svg {
    width: 20px;
    height: 20px;
    fill: white;
}

/* =======================================================
   ✅ HERO PRINCIPAL
======================================================= */
.hero {
    position: relative;
    width: 100%;
    height: 75vh;
    max-height: 900px;
    min-height: 480px;

    background: url('{{ asset("images/fondo.jpg") }}') center/cover no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    text-align: center;
    padding: 20px;
}

.hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.55),
        rgba(0,0,0,0.75)
    );
    z-index: 1;
}

.hero-content {
    z-index: 2;
    color: white;
}

.hero-title {
    font-size: 2rem;
    font-weight: 800;
    text-shadow: 0 3px 10px rgba(0,0,0,0.5);
}

.hero-subtitle {
    margin-top: 8px;
    font-size: 1rem;
    font-weight: 400;
    opacity: 0.95;
}

.hero-btn {
    margin-top: 18px;
    display: inline-block;
    padding: .8rem 1.6rem;
    background: #b80000;
    color: #fff;
    border-radius: 50px;
    font-size: .95rem;
    font-weight: 700;
    text-decoration: none;
    transition: .25s;
    box-shadow: 0 4px 14px rgba(0,0,0,0.4);
}

.hero-btn:hover {
    background: #ff1616;
    transform: scale(1.06);
}

/* =======================================================
   ✅ BLOQUE INFORMATIVO — SIN TARJETAS
======================================================= */
.info-box {
    max-width: 960px;
    margin: 40px auto 10px;
    padding: 10px 15px;
    display: grid;
    gap: 18px;
    text-align: center;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}

.info-title {
    font-size: .85rem;
    color: #dbe7ff;
    margin-bottom: 3px;
    font-weight: 500;
}

.info-strong {
    font-size: 1.2rem;
    font-weight: 800;
    color: #ffffff;
    margin: 4px 0;
    text-shadow: 0 3px 8px rgba(0,0,0,0.6);
}

.info-sub {
    font-size: .85rem;
    color: #e1e8ff;
    opacity: .9;
}

/* =======================================================
   ✅ TARJETAS
======================================================= */
.grid {
    max-width: 1000px;
    margin: 55px auto;
    padding: 10px;
    display: grid;
    gap: 1.6rem;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
}

.card {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    height: 260px;
    display: flex;
    align-items: flex-end;

    border: 2px solid rgba(255, 255, 255, 0.55);
    box-shadow: 0 10px 25px rgba(0,0,0,0.35);
    transition: .35s;
}

.card:hover {
    transform: translateY(-7px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.55);
    border-color: rgba(255,255,255,0.85);
}

.card img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.75),
        rgba(0,0,0,0.35),
        transparent 60%
    );
}

.card-body {
    position: relative;
    padding: 1.1rem;
    z-index: 2;
}

.card-body h3 {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0 0 .5rem;
    text-shadow: 0 2px 6px rgba(0,0,0,0.55);
}

.btn-ver {
    display: inline-block;
    padding: .5rem 1.1rem;
    font-size: .85rem;
    font-weight: 600;
    border-radius: 10px;
    color: #fff;

    background: rgba(0, 87, 184, 0.75);
    border: 1px solid rgba(255,255,255,0.4);

    text-decoration: none;
    transition: .25s;
}

.btn-ver:hover {
    background: rgba(0, 87, 184, 1);
    transform: scale(1.06);
}

/* =======================================================
   ✅ FOOTER
======================================================= */
footer {
    margin-top: 45px;
    background: #002347;
    color: white;
    padding: 35px 10px;
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

footer .social-footer img {
    height: 32px;
    margin: 0 12px;
    transition: .25s;
}

footer .social-footer img:hover {
    transform: scale(1.15);
}

footer .copy {
    margin-top: 15px;
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
    <img src="{{ asset('images/logo_upb.png') }}" alt="UPB Logo">

    <a href="{{ route('aspirantes.bienvenida') }}" class="btn-back" title="Regresar">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
        </svg>
    </a>

    Carreras
</header>


<!-- ✅ HERO PRINCIPAL -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Ingenierías y Licenciaturas UPB</h1>
        <p class="hero-subtitle">Formando profesionales con visión, liderazgo e innovación.</p>

        <a href="#lista-carreras" class="hero-btn">Ver carreras →</a>
    </div>
</section>

<!-- ✅ LÓGICA DEL AÑO -->
@php
    $anio = date('n') >= 9 ? date('Y') + 1 : date('Y');
@endphp

<!-- ✅ BLOQUE INFORMATIVO -->
<section class="info-box">

    <div class="info-item">
        <p class="info-title">Próximo ciclo escolar</p>
        <p class="info-strong">Septiembre {{ $anio }}</p>
        <p class="info-sub">Nuevo ingreso</p>
    </div>

    <div class="info-item">
        <p class="info-title">Duración de estudios</p>
        <p class="info-strong">Desde 3 años 4 meses</p>
        <p class="info-sub">Planes cuatrimestrales</p>
    </div>

    <div class="info-item">
        <p class="info-title">Titulación</p>
        <p class="info-strong">Titulación directa</p>
        <p class="info-sub">Sin tesis tradicional</p>
    </div>

    <div class="info-item">
        <p class="info-title">Becas disponibles</p>
        <p class="info-strong">Institucionales</p>
        <p class="info-strong">Gubernamentales</p>
    </div>

</section>



<!-- ✅ IMPORTACIÓN CORRECTA DE CARBON -->
@php
    use Carbon\Carbon;

    // Evitar errores si no se enviaron los datos desde el controlador público
    $inicio = $inicio ?? Carbon::now()->startOfMonth();
    $fin = $fin ?? Carbon::now()->endOfMonth();
    $mes = $mes ?? Carbon::now()->month;
    $eventos = $eventos ?? collect(); 
    $proximos = $proximos ?? collect(); 
@endphp





<!-- NAVEGACIÓN DE MESES -->
@php
    $prev = $inicio->copy()->subMonth();
    $next = $inicio->copy()->addMonth();
@endphp






<!-- ✅ CALENDARIO ACADÉMICO — CORREGIDO -->
<section style="
    max-width:1000px; 
    margin:40px auto; 
    padding:25px; 
    background:rgba(0,0,0,0.35); 
    border-radius:18px; 
    backdrop-filter:blur(6px);
">

    <h2 style="font-size:1.6rem; font-weight:800; text-align:center; margin-bottom:25px;">
        Calendario Académico
    </h2>

    @php
    $prev = $inicio->copy()->subMonth();
    $next = $inicio->copy()->addMonth();
@endphp

<div style="
    display:flex;
    justify-content:center;
    align-items:center;
    gap:25px;
    margin:-10px 0 25px;
">

    <!-- Mes anterior -->
    <a href="{{ url('/carreras?mes=' . $prev->month . '&anio=' . $prev->year) }}"
       style="color:white; font-size:1.7rem; font-weight:bold; text-decoration:none;">
        ⬅
    </a>

    <!-- Nombre del mes -->
    <span style="font-size:1.4rem; font-weight:800;">
        {{ ucfirst($inicio->translatedFormat('F Y')) }}
    </span>

    <!-- Mes siguiente -->
    <a href="{{ url('/carreras?mes=' . $next->month . '&anio=' . $next->year) }}"
       style="color:white; font-size:1.7rem; font-weight:bold; text-decoration:none;">
        ➡
    </a>
</div>


    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; color:white;">
            <thead>
                <tr style="background:rgba(255,255,255,0.15);">
                    @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'] as $dia)
                        <th style="
                            padding:10px; 
                            font-weight:700; 
                            border:1px solid rgba(255,255,255,0.15);
                        ">
                            {{ $dia }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
            @php
                $startOfWeek = $inicio->copy()->startOfWeek(Carbon::MONDAY);
                $endOfWeek = $fin->copy()->endOfWeek(Carbon::SUNDAY);
            @endphp

            @for($date = $startOfWeek; $date <= $endOfWeek; $date->addWeek())
                <tr>
                    @for($d = 0; $d < 7; $d++)
                        @php
                            $current = $date->copy()->addDays($d);
                            $eventoDelDia = $eventos->where('fecha',$current->toDateString());
                        @endphp

                        <td style="
                            border:1px solid rgba(255,255,255,0.08);
                            padding:8px;
                            height:95px;
                            vertical-align:top;
                            {{ $current->month != $mes ? 'opacity:0.4;' : '' }}
                        ">
                            <div style="font-size:0.9rem; font-weight:700;">
                                {{ $current->day }}
                            </div>

                            @foreach($eventoDelDia as $ev)
                                <div style="
                                    margin-top:6px;
                                    background:rgba(0,255,145,0.25);
                                    padding:3px 5px;
                                    font-size:0.78rem;
                                    border-radius:6px;
                                    color:#00ff9a;
                                    border:1px solid rgba(0,255,145,0.4);
                                ">
                                    {{ $ev->titulo }}
                                </div>
                            @endforeach
                        </td>
                    @endfor
                </tr>
            @endfor
            </tbody>
        </table>
    </div>


    <!-- ✅ Próximos Eventos -->
    <h3 style="font-size:1.3rem; font-weight:700; text-align:center; margin:30px 0 15px;">
        Próximos eventos
    </h3>

    <div style="display:grid; gap:12px;">
        @forelse($proximos as $p)
            <div style="
                background:rgba(255,255,255,0.12); 
                padding:12px; 
                border-radius:10px;
            ">
                <div style="font-weight:700;">
                    {{ \Carbon\Carbon::parse($p->fecha)->format('d M') }}
                </div>
                <div style="opacity:0.9; font-size:0.9rem;">
                    {{ $p->titulo }}
                </div>
            </div>
        @empty
            <p style="opacity:0.8; text-align:center;">No hay eventos próximos.</p>
        @endforelse
    </div>

</section>



<!-- ✅ GRID DE CARRERAS -->
<div id="lista-carreras" class="grid">

@foreach($carreras as $carrera)
    <div class="card">

        @php
            $multimedia = $carrera->multimedia->where('tipo','imagen')->sortBy('orden')->first();
            $imgPath = $multimedia ? $multimedia->ruta : null;
            $url = ($imgPath && Storage::disk('public')->exists($imgPath))
                ? asset('storage/' . $imgPath)
                : asset('images/default-career.jpg');
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


<!-- ✅ FOOTER -->
<footer>
    <p class="footer-title">Sistema de Promoción y Pre-registro de Aspirantes — SIPRA</p>
    <p class="footer-subtitle">Universidad Politécnica de Bacalar</p>

    <div class="social-footer">
       

        <a href="https://www.upb.edu.mx" target="_blank">
            <img src="{{ asset('images/web.png') }}" alt="Sitio oficial UPB">
        </a>
    </div>

    <p class="copy">© {{ date('Y') }} Universidad Politécnica de Bacalar. Todos los derechos reservados.</p>
</footer>

</body>
</html>
