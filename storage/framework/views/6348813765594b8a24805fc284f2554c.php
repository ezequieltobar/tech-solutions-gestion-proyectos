

<?php $__env->startSection('titulo', 'Agregar Proyecto'); ?>

<?php $__env->startSection('contenido'); ?>
    <h2>Agregar Proyecto</h2>

    <div class="uf-box">
        <strong>Valor UF del día (servicio simulado):</strong>
        $<?php echo e(number_format($ufDelDia['valor'], 2, ',', '.')); ?>

        &mdash; <?php echo e($ufDelDia['fecha']); ?>

        <br>
        <small><?php echo e($ufDelDia['fuente']); ?></small>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert" style="background-color:#fee2e2;border-color:#dc2626;color:#7f1d1d;">
            <ul style="margin:0;padding-left:1.2rem;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('proyectos.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="nombre">Nombre del Proyecto</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo e(old('fecha_inicio')); ?>" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="">Selecciona un estado</option>
                <option value="Planificado" <?php if(old('estado') === 'Planificado'): echo 'selected'; endif; ?>>Planificado</option>
                <option value="En curso" <?php if(old('estado') === 'En curso'): echo 'selected'; endif; ?>>En curso</option>
                <option value="Finalizado" <?php if(old('estado') === 'Finalizado'): echo 'selected'; endif; ?>>Finalizado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="responsable">Responsable</label>
            <input type="text" id="responsable" name="responsable" value="<?php echo e(old('responsable')); ?>" required>
        </div>

        <div class="form-group">
            <label for="monto_visual">Monto ($)</label>
            <input type="text" id="monto_visual" inputmode="numeric" placeholder="Ej: 4.500.000"
                value="<?php echo e(old('monto') ? number_format(old('monto'), 0, ',', '.') : ''); ?>">
            <input type="hidden" id="monto" name="monto" value="<?php echo e(old('monto')); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/proyectos/create.blade.php ENDPATH**/ ?>