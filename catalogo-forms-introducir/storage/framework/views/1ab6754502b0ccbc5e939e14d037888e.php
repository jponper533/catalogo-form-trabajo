<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/formulario.css')); ?>">
    <script src="<?php echo e(asset('js/junta-logotipo.js')); ?>" defer></script>
    <title>Insertar datos</title>
</head>

<body>

    <div id="svgInsercion">
        <junta-logotipo id="logotipoInsercion"></junta-logotipo>
        <span id="texto1Insercion" class="leyenda-insercion">Junta de Andalucía</span>
        <span id="texto2Insercion" class="leyenda-insercion">Consejería Salud y Consumo</span>
        <span id="texto3Insercion" class="leyenda-insercion">Servicio Andaluz de Salud</span>
    </div>

    <form id="form1" method="POST" action="<?php echo e(route('datos.buscar')); ?>">
        <?php echo csrf_field(); ?>

        <fieldset id="fieldset1">
            <legend id="legend1" class="leyenda">BUSCAR POR NOMBRE:</legend>
            <input type="search" id="campoTexto" class="busqueda" name="busqueda" placeholder="Ingrese el nombre del formulario..." />

            <button type="submit">Buscar</button>
        </fieldset>

    </form>

    <form method="POST" id="form2" action="<?php echo e(route('datos.store')); ?>">
        <?php echo csrf_field(); ?>
        <fieldset id="fieldset2">
            <legend id="legend2" class="leyenda">INSERTAR DATOS:</legend>
            <textarea id="data" name="data" rows="10" cols="50" placeholder="Introduzca su texto {clave:'valor'} aquí."></textarea>
            <button type="submit">Enviar</button>
        </fieldset>

    </form>

</body>

</html><?php /**PATH /var/www/html/resources/views/main/index.blade.php ENDPATH**/ ?>