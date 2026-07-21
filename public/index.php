<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Autoload de Composer: aquí se cargan Laravel y todas las dependencias
require __DIR__.'/../vendor/autoload.php';

// Arranca la aplicación (bootstrap/app.php) y despacha la petición HTTP actual
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
