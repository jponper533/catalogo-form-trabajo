<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/editycreate.css') }}">
    <script src="{{ asset('js/junta-logotipo.js') }}" defer></script>
    <script src="{{ asset('js/textarea.js') }}" defer></script>
    <script src="{{ asset('js/formularioAjax.js') }}" defer></script>
    <title>Crear Formulario</title>
</head>

<body>
    <header id="contenedor1">
        @include('burguermenu._menu')

        <div id="svgGeneral">
            <junta-logotipo id="logotipoGeneral"></junta-logotipo>
            <span id="texto1General" class="leyenda-general">Junta de Andalucía</span>
            <span id="texto2General" class="leyenda-general">Consejería Salud y Consumo</span>
            <span id="texto3General" class="leyenda-general">Servicio Andaluz de Salud</span>
        </div>
    </header>

    <div id="contenedor3">
        <form id="formularioAjax" action="{{ route('formulario.store') }}" method="POST" class="formulario">
            @csrf


            <h2>Nombre</h2>
            <input type="text" name="nombreForm" placeholder="Nombre del formulario" required value="{{ old('nombreForm') }}">
            @error('nombreForm')
            <div class="error">{{ $message }}</div>
            @enderror


            <input type="file" id="jsonFile" accept=".json,application/json">
            <label for="jsonFile" class="fileButton">Subir JSON</label>
            <span id="fileName">Ningún archivo seleccionado</span>

            <h2>Texto Json</h2>
            <textarea id="datos" name="datos" placeholder='{"color":"rojo","talla":"M"}' required>{{ old('datos') }}</textarea>
            @error('datos')
            <div class="error">
                {{ $message }}
            </div>
            @enderror

            <h2>Visibilidad</h2>
            <label class="checkLabel">
                <input type="checkbox" name="visible">
                <span class="slider"></span>
            </label>

            <p>
                <button type="submit">Crear</button>
            </p>
        </form>
    </div>

</body>

</html>