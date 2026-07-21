

<?php $__env->startSection('titulo', 'Listado de Proyectos'); ?>

<?php $__env->startSection('contenido'); ?>
    <h2>Listado de Proyectos</h2>

    <?php if(session('mensaje')): ?>
        <div class="alert"><?php echo e(session('mensaje')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('proyectos.create')); ?>" class="btn btn-primary">+ Agregar Proyecto</a>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($proyecto['id']); ?></td>
                    <td><?php echo e($proyecto['nombre']); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($proyecto['fecha_inicio'])->format('d-m-Y')); ?></td>
                    <td><?php echo e($proyecto['estado']); ?></td>
                    <td><?php echo e($proyecto['responsable']); ?></td>
                    <td>$<?php echo e(number_format($proyecto['monto'], 0, ',', '.')); ?></td>
                    <td>
                        <a href="<?php echo e(route('proyectos.show', $proyecto['id'])); ?>" class="btn btn-secondary">Ver</a>
                        <a href="<?php echo e(route('proyectos.edit', $proyecto['id'])); ?>" class="btn btn-primary">Editar</a>
                        <a href="<?php echo e(route('proyectos.confirmDelete', $proyecto['id'])); ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7">No hay proyectos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/proyectos/index.blade.php ENDPATH**/ ?>