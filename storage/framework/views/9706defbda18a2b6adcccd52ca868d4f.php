

<?php $__env->startSection('titulo', 'Editar Proyecto'); ?>

<?php $__env->startSection('contenido'); ?>
    <h2>Editar Proyecto #<?php echo e($proyecto['id']); ?></h2>

    <?php if($errors->any()): ?>
        <div class="alert" style="background-color:#fee2e2;border-color:#dc2626;color:#7f1d1d;">
            <ul style="margin:0;padding-left:1.2rem;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('proyectos.update', $proyecto['id'])); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="nombre">Nombre del Proyecto</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre', $proyecto['nombre'])); ?>" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio"
                value="<?php echo e(old('fecha_inicio', $proyecto['fecha_inicio'])); ?>" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="Planificado" <?php if(old('estado', $proyecto['estado']) === 'Planificado'): echo 'selected'; endif; ?>>Planificado</option>
                <option value="En curso" <?php if(old('estado', $proyecto['estado']) === 'En curso'): echo 'selected'; endif; ?>>En curso</option>
                <option value="Finalizado" <?php if(old('estado', $proyecto['estado']) === 'Finalizado'): echo 'selected'; endif; ?>>Finalizado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="responsable">Responsable</label>
            <input type="text" id="responsable" name="responsable"
                value="<?php echo e(old('responsable', $proyecto['responsable'])); ?>" required>
        </div>

        <div class="form-group">
            <label for="monto_visual">Monto ($)</label>
            <input type="text" id="monto_visual" inputmode="numeric"
                value="<?php echo e(number_format(old('monto', $proyecto['monto']), 0, ',', '.')); ?>">
            <input type="hidden" id="monto" name="monto" value="<?php echo e(old('monto', $proyecto['monto'])); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
        <a href="<?php echo e(route('proyectos.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>

    <script>
        const montoVisual = document.getElementById('monto_visual');
        const montoReal = document.getElementById('monto');

        function formatearMonto(valor) {
            const soloDigitos = valor.replace(/\D/g, '');
            montoReal.value = soloDigitos;
            montoVisual.value = soloDigitos ?
                soloDigitos.replace(/\B(?=(\d{3})+(?!\d))/g, '.') :
                '';
        }

        montoVisual.addEventListener('input', () => formatearMonto(montoVisual.value));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/proyectos/edit.blade.php ENDPATH**/ ?>