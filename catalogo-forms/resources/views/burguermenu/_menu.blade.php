<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuburguer.css') }}">
    <script src="{{ asset('js/menuhamburguesa.js') }}" defer></script>
    <title>Menú lateral</title>
</head>

<body>

    <nav class="navbar">

        <div class="nav_toggle" id="nav_toggle">
            <hr>
            <hr>
            <hr>
        </div>

    </nav>

    <div class="nav_items" id="nav_items">

        <div id="svgHamburguesa">
            <junta-logotipo id="logotipoHamburguesa"></junta-logotipo>

            <div id="bloqueLeyenda">

                <div id="bloqueTexto1" class="contenedor-texto">
                    <span id="texto1Hamburguesa" class="leyenda-hamburguesa">Junta</span>
                    <span id="texto2Hamburguesa" class="leyenda-hamburguesa">de Andalucía</span>
                </div>

                <hr id="separador" class="leyenda-hamburguesa">

                <div id="bloqueTexto2" class="contenedor-texto">
                    <span id="texto3Hamburguesa" class="leyenda-hamburguesa">Consejería de Sanidad</span>
                    <span id="texto4Hamburguesa" class="leyenda-hamburguesa">Presidencia y Emergencias</span>
                </div>

            </div>

        </div>

        <a href="{{ route('dashboard') }}" class="enlace-nav">Inicio</a>
        <a href="{{ route('formulario.index') }}" class="enlace-nav">Formularios</a>
        <a href="{{ route('formulario.seeUserForms') }}" class="enlace-nav">Tus formularios</a>
        <a href="{{ route('formulario.create') }}" class="enlace-nav">Crear formulario</a>

        <form action="{{ route('logout') }}" method="POST" class="logout">
            @csrf
            <button type="submit" id="cierraSesion">Cerrar sesión</button>
        </form>

    </div>

</body>

</html>