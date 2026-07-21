<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('titulo', 'Gestión de Proyectos'); ?> - Tech Solutions</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #16213e;
            color: #ffffff;
            padding: 1rem 2rem;
        }

        header h1 {
            margin: 0;
            font-size: 1.4rem;
        }

        main {
            max-width: 960px;
            margin: 2rem auto;
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            text-align: left;
            padding: 0.6rem;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #eef1f5;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #16213e;
            color: #fff;
        }

        .btn-danger {
            background-color: #c0392b;
            color: #fff;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: #fff;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.3rem;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
        }

        .alert {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 0.8rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .uf-box {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            padding: 0.8rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tech Solutions &mdash; Sistema de Gestión de Proyectos</h1>
    </header>
    <main>
        <?php echo $__env->yieldContent('contenido'); ?>
    </main>
</body>

</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>