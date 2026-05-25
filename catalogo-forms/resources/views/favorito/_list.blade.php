<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/listasForm.css') }}">
    <title>Inicio: Lista de favoritos</title>
</head>

<body>

    <div class="container">

        @foreach ($fav as $f)

        <div class="tarjetas tarjeta-link"
            data-url="{{ route('formulario.formularioJSON', $f->formulario) }}">
            <div class="btn-container">
                <div class="favContainer">
                    <form action="{{ route('favorito.toggle', $f) }}" method="POST" class="formcheckbox">
                        @csrf
                        <label class="checkLabel">
                            <input type="checkbox" name="activo" checked>
                            <i class="fav-icon fa-solid fa-star"></i>
                        </label>
                    </form>
                    <span class="nombreForm">{{ $f->formulario->nombreForm ?? 'Nombre no encontrado' }}</span>
                </div>

            </div>

            <div class="contenido-tarjeta">

                <label class="hechoPor">

                    <p class="parrafHechoPor">Hecho por: {{ $f->formulario->username ?? 'Nombre no encontrado' }}</p>
                </label>

            </div>

        </div>

        @endforeach

    </div>


    <!-- Cargar script externo -->
    <script src="{{ asset('js/tarjetasFav.js') }}"></script>

</body>

</html>