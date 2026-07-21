<?php

use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('proyectos.index');
});

// 1. Listar todos los proyectos
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');

// 2. Formulario + registro de un nuevo proyecto
Route::get('/proyectos/crear', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');

// 5. Obtener un proyecto por su id (detalle)
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');

// 4. Formulario + actualización de un proyecto por id
Route::get('/proyectos/{id}/editar', [ProyectoController::class, 'edit'])->name('proyectos.edit');
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');

// 3. Confirmación + eliminación de un proyecto por id
Route::get('/proyectos/{id}/eliminar', [ProyectoController::class, 'confirmDelete'])->name('proyectos.confirmDelete');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
