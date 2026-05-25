<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/listasForm.css') }}">
</head>
    <body>

<div class="container">
    @foreach ($formulario as $f)
    <div class="tarjetas tarjeta-link"
        data-url="{{ route('formulario.formularioJSON', $f) }}">

        <div class="btn-container">
            <div class="favContainer">
                <form action="{{ route('formulario.activar', $f) }}" method="POST" class="formcheckbox">
                    @csrf
                    <label class="checkLabel">
                        <input type="checkbox" name="activo"
                            {{ $f->favoritos->contains('username', session('username')) ? 'checked' : '' }}>

                        <i class="fav-icon {{ $f->favoritos->contains('username', session('username')) ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"></i>
                    </label>
                </form>
                <span class="nombreForm">{{ $f->nombreForm ?? 'Nombre no encontrado' }}</span>
            </div>
        </div>

        <div class="contenido-tarjeta">

            <label class="hechoPor">

                <p class="parrafHechoPor">Hecho por: {{ $f->username ?? 'Nombre no encontrado' }}</p>
            </label>

        </div>

    </div>
    @endforeach
</div>

<script src="{{ asset('js/tarjetas.js') }}"></script>

</body>
</html>