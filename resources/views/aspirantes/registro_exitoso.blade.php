<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>¡Registro exitoso!</title>
@vite(['resources/css/app.css'])

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #003366, #0057B8);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 15px;
    color: #0B2540;
}

.card {
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    text-align: center;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    animation: fadeIn .5s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

h2 {
    color: #003366;
    font-weight: 800;
    margin-bottom: 8px;
}

p {
    color: #444;
    margin-bottom: 20px;
    font-size: 15px;
}

button {
    background: #0057B8;
    color: white;
    padding: 14px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    width: 100%;
    transition: .2s ease-in-out;
}

button:hover {
    background: #003366;
    transform: scale(1.03);
}
</style>
</head>

<body>

<div class="card">
    <h2>✅ ¡Registro exitoso!</h2>
    <p>Gracias por tu interés en formar parte de la Universidad Politécnica de Bacalar.</p>
    <p>Pronto un asesor se pondrá en contacto contigo.</p>

    <a href="{{ route('carreras.index.public') }}">
        <button>Continuar</button>
    </a>
</div>

</body>
</html>
