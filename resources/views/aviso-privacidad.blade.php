<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aviso de Privacidad | UPB</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f7fb;
    padding: 30px;
    color: #003366;
}

.container {
    max-width: 800px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #003366;
}

p {
    line-height: 1.7;
    margin-bottom: 15px;
}
</style>
</head>
<body>

<div class="container">
    <h1>Aviso de Privacidad</h1>

    <p>
        La Universidad Politécnica de Bacalar (UPB) informa que los datos personales
        recabados mediante el formulario de pre–registro serán utilizados con fines
        exclusivamente académicos y administrativos, para dar seguimiento al proceso
        de admisión del aspirante.
    </p>

    <p>
        Los datos proporcionados serán tratados bajo estrictas medidas de seguridad,
        garantizando su confidencialidad, integridad y protección conforme a la Ley
        General de Protección de Datos Personales en Posesión de Sujetos Obligados.
    </p>

    <p>
        El aspirante podrá solicitar en cualquier momento la actualización,
        corrección o cancelación de su información, mediante los canales oficiales
        de la institución.
    </p>

    <p>
        Para mayor información consulte el portal oficial:
        <a href="https://www.upb.edu.mx" target="_blank">www.upb.edu.mx</a>
    </p>
</div>



<div style="text-align:center; margin-top:25px;">
    <a href="{{ url()->previous() }}" 
       style="
           display:inline-block;
           background:#0057B8;
           color:white;
           padding:12px 20px;
           border-radius:10px;
           text-decoration:none;
           font-weight:600;
           transition:0.2s;
       ">
       Cerrar y regresar
    </a>
</div>


</body>
</html>
