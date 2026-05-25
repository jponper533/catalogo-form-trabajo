<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/editycreate.css') }}">
    <script src="{{ asset('js/junta-logotipo.js') }}" defer></script>
    <title>Editar Formulario</title>
</head>

<body>

    <div id="svgGeneral">
        <junta-logotipo id="logotipoGeneral"></junta-logotipo>
        <span id="texto1General" class="leyenda-general">Junta de Andalucía</span>
        <span id="texto2General" class="leyenda-general">Consejería Salud y Consumo</span>
        <span id="texto3General" class="leyenda-general">Servicio Andaluz de Salud</span>
    </div>

    @include('burguermenu._menu')

    <form id="formularioAjax" action="{{ route('formulario.update', $formulario->id) }}" method="POST" class="formulario">
        @csrf
        @method('PUT')


        <h2>Nombre del formulario</h2>
        <input type="text" name="nombreForm" value="{{ old('nombreForm', $formulario->nombreForm) }}">
        @error('nombreForm')
        <div class="error">{{ $message }}</div>
        @enderror

        <input type="file" id="jsonFile" accept=".json,application/json">
        <label for="jsonFile" class="fileButton">Subir JSON</label>
        <span id="fileName">Ningún archivo seleccionado</span>


        <h2>Datos del formulario</h2>
        <textarea id="jsonDatos" name="datos">{{ old('datos', $formulario->datos) }}</textarea>
        @error('datos')
        <div class="error">{{ $message }}</div>
        @enderror

        <h2>Visibilidad</h2>
        <label class="checkLabel">
            <input type="hidden" name="visible" value="0">
            <input type="checkbox" name="visible" value=1 {{ old('visible', $formulario->visible) ? 'checked' : '' }}>
            <span class="slider"></span>
        </label>

        <div class="botones">
            <button type="submit">Actualizar</button>
            </p>
        </div>
    </form>

    <script src="{{ asset('js/jsonTextarea.js') }}?v=1"></script>
    <script src="{{ asset('js/formularioAjax.js') }}"></script>
</body>

</html>