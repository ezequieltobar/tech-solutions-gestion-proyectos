

<?php $__env->startSection('titulo', 'Eliminar Proyecto'); ?>

<?php $__env->startSection('contenido'); ?>
    <h2>Eliminar Proyecto</h2>

    <div class="alert" style="background-color:#fee2e2;border-color:#dc2626;color:#7f1d1d;">
        ¿Estás seguro de que deseas eliminar el proyecto
        <strong>"<?php echo e($proyecto['nombre']); ?>"</strong> (Id: <?php echo e($proyecto['id']); ?>)?
        Esta acción no se puede deshacer.
    </div>

    <table>
        <tr>
            <th style="width:200px;">Responsable</th>
            <td><?php echo e($proyecto['responsable']); ?></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td><?php echo e($proyecto['estado']); ?></td>
        </tr>
        <tr>
            <th>Monto</th>
            <td>$<?php echo e(number_format($proyecto['monto'], 0, ',', '.')); ?></td>
        </tr>
    </table>

    <br>
    <form method="POST" action="<?php echo e(route('proyectos.destroy', $proyecto['id'])); ?>" style="display:inline;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
    </form>
    <a href="<?php echo e(route('proyectos.index')); ?>" class="btn btn-secondary">Cancelar</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/proyectos/delete.blade.php ENDPATH**/ ?>