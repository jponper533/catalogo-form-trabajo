<!DOCTYPE html>
<html>

<head>
    <title>Resultados de búsqueda</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/boton.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/resultado.css')); ?>">
</head>

<body>

    <?php if($filas->isEmpty()): ?>
    <span>Sin resultados</span>
    <?php else: ?>

    <table>
        <thead>
            <tr>
                <th colspan="<?php echo e(count($columnas) - 1); ?>" id="descarga"><a href="<?php echo e(route('export.resultados', ['busqueda' => $nombre])); ?>">
                        Descargar Excel
                    </a></th>
            </tr>
            <tr>
                <th colspan="<?php echo e(count($columnas) - 1); ?>" id="cabecera">
                    Resultados de búsqueda para: <?php echo e($nombre); ?>

                </th>
            </tr>
            <tr>
                <?php $__currentLoopData = $columnas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$loop->first): ?>
                <th>
                    <?php echo e(ucfirst(str_replace('.', ' ', $col))); ?>

                </th>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $filas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php $__currentLoopData = $columnas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$loop->first): ?>
                <td>
                    <?php echo e($fila[$col]); ?>

                </td>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>

</html><?php /**PATH /var/www/html/resources/views/busqueda/resultado.blade.php ENDPATH**/ ?>