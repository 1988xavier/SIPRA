<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pre-registro | {{ $carrera->nombre }}</title>
@vite(['resources/css/app.css'])

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #003366, #0057B8);
    color: #0B2540;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 15px;
}

.card {
    width: 100%;
    max-width: 600px;
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    animation: fadeIn .5s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

h2, h3 {
    color: #003366;
    font-weight: 800;
    margin-bottom: 10px;
}

label {
    font-weight: 600;
    margin-top: 10px;
    display: block;
}

input {
    width: 100%;
    border: 1px solid #C5D4E8;
    padding: 10px 14px;
    border-radius: 10px;
    margin-top: 4px;
    background: #F8FAFF;
}

input:focus {
    border: 2px solid #0057B8;
    outline: none;
    background: #fff;
    box-shadow: 0px 0px 6px rgba(0,87,184,0.3);
}

button {
    background: #0057B8;
    color: white;
    padding: 13px;
    border-radius: 10px;
    width: 100%;
    margin-top: 20px;
    font-size: 17px;
    font-weight: bold;
    transition: .2s ease-in-out;
}

button:hover {
    background: #003366;
    transform: scale(1.02);
}

.info-box {
    background: #E9F3FF;
    padding: 12px;
    border-left: 4px solid #0057B8;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 14px;
    color: #003366;
}

.footer-text {
    font-size: 12px;
    text-align: center;
    margin-top: 15px;
    color: #666;
}

.alert-success {
    background: #DFF6DD;
    border-left: 6px solid #2E7D32;
    padding: 15px;
    border-radius: 8px;
    color: #2E7D32;
    margin-bottom: 18px;
    font-family: 'Poppins', sans-serif;
}
</style>

</head>
<body>

<div class="card">

    {{-- ✅ MENSAJE DE ÉXITO --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

<!-- ✅ Botón regresar estilo UPB -->
<a href="{{ url()->previous() }}" 
   style="
       position:absolute;
       right:20px;
       top:20px;
       background:#003366;
       width:38px;
       height:38px;
       border-radius:8px;
       display:flex;
       align-items:center;
       justify-content:center;
       text-decoration:none;
       box-shadow:0 3px 8px rgba(0,0,0,0.25);
       transition:.25s;
   ">
    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width="20" height="20" fill="#fff">
        <path d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
    </svg>
</a>



    {{-- INFO --}}
    <h2>Prerregistro</h2>
    <div class="info-box">
        Estás a punto de iniciar tu proceso de prerregistro para la carrera:
        <strong>{{ $carrera->nombre }}</strong>
    </div>

    <form action="{{ route('pre.registro.guardar') }}" method="POST">
        @csrf
        <input type="hidden" name="carrera_principal_id" value="{{ $carrera->id }}">

        <label>Nombre(s)</label>
        <input type="text" name="nombre" placeholder="Ej. Juan Carlos" required>

        <label>Apellido paterno</label>
        <input type="text" name="apellido_paterno" placeholder="Ej. Pérez" required>

        <label>Apellido materno</label>
        <input type="text" name="apellido_materno" placeholder="Ej. Gómez">

        <label>Número de teléfono</label>
        <input type="tel" name="telefono" placeholder="Ej. 983 123 4567" required>

        <label>Correo electrónico</label>
        <input type="email" name="email" placeholder="Ej. alumno@gmail.com" required>

        <label>Escuela de procedencia</label>
        <input type="text" name="escuela_procedencia" placeholder="Ej. CBTIS 214, Bachilleres..." required>

        <p class="footer-text">
            Al continuar aceptas nuestro <a href="#" style="color:#0057B8;"><a href="{{ route('aviso.privacidad') }}" style="color:#0057B8;" target="_blank">
    Aviso de privacidad
</a>
</a>.
        </p>

        <button type="submit">Enviar pre-registro</button>
    </form>

</div>

</body>
</html>
