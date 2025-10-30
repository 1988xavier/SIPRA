<!-- resources/views/carreras/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carreras - Universidad Politécnica de Bacalar</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            background: #f4f7fb;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        header {
            background: linear-gradient(90deg, #003366, #0072ce);
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 1.3rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 30px;
            padding: 0.6rem 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 1.2rem;
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 1rem;
        }

        .category-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 1.5rem 1rem 0.5rem;
            color: #003366;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            padding: 0 1rem 2rem;
        }

        .card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .card-body {
            padding: 0.8rem;
            text-align: center;
        }

        .card-body h3 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #222;
            min-height: 40px;
        }

        .btn-ver {
            display: inline-block;
            background: #0072ce;
            color: white;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 8px;
            transition: background 0.3s ease;
        }

        .btn-ver:hover {
            background: #005bb5;
        }
    </style>
</head>
<body>

    <header>
        Carreras
    </header>

    <!-- Barra de búsqueda -->
    <div class="search-box">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#0072ce" style="width: 20px; height: 20px; margin-right: 8px;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M5 11a6 6 0 1112 0 6 6 0 01-12 0z" />
        </svg>
        <input type="text" placeholder="Buscar carrera..." id="buscador">
    </div>

    @php
        use Illuminate\Support\Str;

        $grupos = [
            'Ingenierías' => $carreras->filter(fn($c) => Str::contains(strtolower($c->nombre), 'ingenier')),
            'Licenciaturas' => $carreras->filter(fn($c) => Str::contains(strtolower($c->nombre), 'licenciatur')),
        ];
    @endphp

    @foreach($grupos as $categoria => $lista)
        @if($lista->count())
            <div class="category-title">{{ $categoria }}</div>
            <div class="grid">
                @foreach($lista as $carrera)
                    <div class="card">
                        @php
                            $img = null;

                            if (!empty($carrera->imagenes)) {
                                $imagenes = json_decode($carrera->imagenes, true);

                                // Si es un string tipo "imagen.jpg"
                                if (is_string($imagenes)) {
                                    $img = $imagenes;
                                }
                                // Si es un array simple tipo ["imagen.jpg", "otra.png"]
                                elseif (is_array($imagenes)) {
                                    // Si el primer elemento es otro array u objeto, intenta obtener 'path'
                                    if (isset($imagenes[0]) && is_array($imagenes[0]) && isset($imagenes[0]['path'])) {
                                        $img = $imagenes[0]['path'];
                                    } elseif (isset($imagenes[0]) && is_string($imagenes[0])) {
                                        $img = $imagenes[0];
                                    }
                                }
                                // Si es un objeto tipo {"path": "imagen.jpg"}
                                elseif (is_object($imagenes) && isset($imagenes->path)) {
                                    $img = $imagenes->path;
                                }
                            }
                        @endphp


                        @if($img)
                            <img src="{{ asset('storage/'.$img) }}" alt="{{ $carrera->nombre }}">
                        @else
                            <img src="{{ asset('images/default-career.jpg') }}" alt="Carrera">
                        @endif

                        <div class="card-body">
                            <h3>{{ $carrera->nombre }}</h3>
                            <a href="{{ route('carreras.show.public', $carrera->slug) }}" class="btn-ver">Ver más</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach

    <script>
        // Búsqueda en tiempo real
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
