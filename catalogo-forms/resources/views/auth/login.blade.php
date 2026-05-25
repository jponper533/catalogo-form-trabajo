<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="{{ asset('js/junta-logotipo.js') }}" defer></script>
    <title>Inicio de sesión</title>
</head>

<body>

    <div id="svgLogin">
        <junta-logotipo id="logotipoLogin"></junta-logotipo>
        <span id="texto1Login" class="leyenda-login">Junta de Andalucía</span>
        <span id="texto2Login" class="leyenda-login">Consejería Salud y Consumo</span>
        <span id="texto3Login" class="leyenda-login">Servicio Andaluz de Salud</span>
    </div>

    <section>
        <h1>Iniciar sesión</h1>
        <form method='POST' action="{{ route('login') }}">
            @csrf
            <input type='text' name='username' placeholder='usuario'>
            <input type='password' name='password' placeholder='contraseña'>
            <button type='submit'>Acceder</button>
        </form>

        @if ($errors->any())
        <div id="mensaje_error">
            {{ $errors->first() }}
        </div>
        @endif
    </section>

</body>

</html>