<!-- resources/views/carreras/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carreras</title>
</head>
<body>
    <h1>Lista de Carreras</h1>

    <ul>
        @foreach($carreras as $carrera)
            <li>
                <a href="{{ route('carreras.show.public', $carrera->slug) }}">
                    {{ $carrera->nombre }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
