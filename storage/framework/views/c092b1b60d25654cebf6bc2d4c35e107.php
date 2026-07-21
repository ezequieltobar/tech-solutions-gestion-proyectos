

<?php $__env->startSection('titulo', 'Detalle del Proyecto'); ?>

<?php $__env->startSection('contenido'); ?>
    <h2>Detalle del Proyecto #<?php echo e($proyecto['id']); ?></h2>

    <table>
        <tr>
            <th style="width:200px;">Nombre</th>
            <td><?php echo e($proyecto['nombre']); ?></td>
        </tr>
        <tr>
            <th>Fecha de Inicio</th>
            <td><?php echo e(\Carbon\Carbon::parse($proyecto['fecha_inicio'])->format('d-m-Y')); ?></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td><?php echo e($proyecto['estado']); ?></td>
        </tr>
        <tr>
            <th>Responsable</th>
            <td><?php echo e($proyecto['responsable']); ?></td>
        </tr>
        <tr>
            <th>Monto</th>
            <td>$<?php echo e(number_format($proyecto['monto'], 0, ',', '.')); ?></td>
        </tr>
    </table>

    <br>
    <a href="<?php echo e(route('proyectos.edit', $proyecto['id'])); ?>" class="btn btn-primary">Editar</a>
    <a href="<?php echo e(route('proyectos.index')); ?>" class="btn btn-secondary">Volver al listado</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/proyectos/show.blade.php ENDPATH**/ ?>