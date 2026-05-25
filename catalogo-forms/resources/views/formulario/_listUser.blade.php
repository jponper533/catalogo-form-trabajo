<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/tarjetas.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/listasForm.css') }}">
    <title>Tus formularios</title>
</head>

<body>

    <div class="container">
        @foreach ($formularios as $f)
        <div class="tarjetas tarjeta-link"
            data-url="{{ route('formulario.formularioJSON', $f) }}">

            <div class="btn-container">
                <div class="favContainer">
                    <form action="{{ route('formulario.activar', $f) }}" method="POST" class="formcheckbox">
                        @csrf
                        <label class="checkLabel">
                            <input type="checkbox" name="activo" onchange="this.form.submit()"
                                {{ in_array($f->id, $favoritosIds) ? 'checked' : '' }}>
                            <i class="fav-icon {{ $f->favoritos->contains('username', session('username')) ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"></i>
                        </label>
                    </form>
                    <span class="nombreForm">{{ $f->nombreForm ?? 'Nombre no encontrado' }}</span>
                </div>
                @if($f->username === session('username'))

                <div class="btn-editDelete">
                    <a href="{{ route('formulario.edit', $f) }}" class="enlaceEditar">
                        <i class="fa-solid fa-pen"></i>
                    </a>


                    <form action="{{ route('formulario.destroy', $f) }}" method="POST" class="delete">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este formulario?')" name="delete">

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </form>
                </div>
                @endif

            </div>

            <div class="contenido-tarjeta">

                <label class="hechoPor">

                    <p class="parrafHechoPor">Hecho por: {{ $f->username ?? 'Nombre no encontrado' }}</p>
                </label>

            </div>

        </div>
        @endforeach
    </div>

</body>

</html>