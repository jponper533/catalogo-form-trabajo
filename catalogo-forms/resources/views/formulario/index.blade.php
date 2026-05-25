<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/listasForm.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.0/css/all.css">
    <script src="{{ asset('js/junta-logotipo.js') }}" defer></script>
    <title>Lista Formularios</title>
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

    <div id="contenedor2">
        <h2>Lista de formularios</h2>
        <div class="boton">
            <a href="{{ route('formulario.create') }}" class="enlaceCreate">Crear formulario</a>
        </div>

        <div id="contenendor3">
            @include('formulario._list')
        </div>

</body>

</html>