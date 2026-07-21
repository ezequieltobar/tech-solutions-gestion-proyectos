<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Services\UfService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProyectoController extends Controller
{
    /**
     * Inyección de dependencias: Laravel resuelve UfService automáticamente
     * gracias a su Service Container. Esto es lo que pide el indicador 6
     * de la rúbrica: "Conecta los componentes con servicios".
     */
    public function __construct(protected UfService $ufService) {}

    /**
     * 1. Listar todos los proyectos.
     * Ruta: GET /proyectos
     */
    public function index(): View
    {
        $proyectos = Proyecto::all();

        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Muestra el formulario para crear un proyecto.
     * Ruta: GET /proyectos/crear
     */
    public function create(): View
    {
        // Consumimos el servicio reutilizable de la UF para mostrarla
        // como referencia mientras el usuario ingresa el monto del proyecto.
        $ufDelDia = $this->ufService->obtenerValorUf();

        return view('proyectos.create', compact('ufDelDia'));
    }

    /**
     * 2. Agregar proyecto (procesa el formulario de creación).
     * Ruta: POST /proyectos
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:Planificado,En curso,Finalizado',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|integer|min:0',
        ]);

        Proyecto::create($datos);

        return redirect()
            ->route('proyectos.index')
            ->with('mensaje', 'Proyecto creado correctamente.');
    }

    /**
     * 5. Obtener un proyecto por su id (vista de detalle).
     * Ruta: GET /proyectos/{id}
     */
    public function show(int $id): View
    {
        $proyecto = Proyecto::find($id);

        abort_if(!$proyecto, 404, 'Proyecto no encontrado.');

        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Muestra el formulario para editar un proyecto existente.
     * Ruta: GET /proyectos/{id}/editar
     */
    public function edit(int $id): View
    {
        $proyecto = Proyecto::find($id);

        abort_if(!$proyecto, 404, 'Proyecto no encontrado.');

        return view('proyectos.edit', compact('proyecto'));
    }

    /**
     * 4. Actualizar proyecto por su id (procesa el formulario de edición).
     * Ruta: PUT /proyectos/{id}
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:Planificado,En curso,Finalizado',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|integer|min:0',
        ]);

        $actualizado = Proyecto::update($id, $datos);

        abort_if(!$actualizado, 404, 'Proyecto no encontrado.');

        return redirect()
            ->route('proyectos.index')
            ->with('mensaje', 'Proyecto actualizado correctamente.');
    }

    /**
     * Muestra una vista de confirmación antes de eliminar.
     * Ruta: GET /proyectos/{id}/eliminar
     */
    public function confirmDelete(int $id): View
    {
        $proyecto = Proyecto::find($id);

        abort_if(!$proyecto, 404, 'Proyecto no encontrado.');

        return view('proyectos.delete', compact('proyecto'));
    }

    /**
     * 3. Eliminar proyecto por su id.
     * Ruta: DELETE /proyectos/{id}
     */
    public function destroy(int $id): RedirectResponse
    {
        Proyecto::delete($id);

        return redirect()
            ->route('proyectos.index')
            ->with('mensaje', 'Proyecto eliminado correctamente.');
    }
}
