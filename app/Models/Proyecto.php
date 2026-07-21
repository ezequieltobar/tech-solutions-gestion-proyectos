<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

/**
 * Modelo Proyecto
 *
 * Sigue usando datos ESTÁTICOS (no hay conexión a MySQL/Eloquent), tal
 * como pide el caso de estudio. La diferencia frente a la primera versión
 * es que ahora el "estado actual" de los proyectos se guarda en la SESIÓN
 * del navegador (Session), no en una simple variable estática de PHP.
 *
 * Por qué el cambio: PHP-FPM crea un proceso nuevo por cada petición HTTP,
 * así que cualquier variable estática se reinicia en cada request. La
 * sesión, en cambio, persiste entre peticiones del mismo navegador (vía
 * una cookie), lo que nos permite ver reflejados los cambios de crear/
 * editar/eliminar sin necesitar una base de datos real.
 */
class Proyecto
{
    protected const CLAVE_SESION = 'proyectos';

    /**
     * Datos estáticos "semilla": el punto de partida cada vez que se
     * inicia una sesión nueva (por ejemplo, un navegador distinto).
     */
    protected static array $proyectosIniciales = [
        [
            'id' => 1,
            'nombre' => 'Migración a la nube',
            'fecha_inicio' => '2026-03-01',
            'estado' => 'En curso',
            'responsable' => 'Camila Rojas',
            'monto' => 4500000,
        ],
        [
            'id' => 2,
            'nombre' => 'Portal de clientes',
            'fecha_inicio' => '2026-04-15',
            'estado' => 'Planificado',
            'responsable' => 'Matías Fuentes',
            'monto' => 3200000,
        ],
        [
            'id' => 3,
            'nombre' => 'Automatización de reportes',
            'fecha_inicio' => '2026-01-20',
            'estado' => 'Finalizado',
            'responsable' => 'Javiera Soto',
            'monto' => 1800000,
        ],
    ];

    /**
     * Devuelve el dataset actual: si es la primera vez que el navegador
     * visita la app, siembra la sesión con los datos iniciales; si ya
     * existía, devuelve lo que haya en sesión (incluyendo cambios previos).
     */
    protected static function dataset(): array
    {
        if (!Session::has(self::CLAVE_SESION)) {
            Session::put(self::CLAVE_SESION, self::$proyectosIniciales);
        }

        return Session::get(self::CLAVE_SESION);
    }

    /**
     * Guarda el dataset completo de vuelta en la sesión.
     */
    protected static function guardar(array $proyectos): void
    {
        Session::put(self::CLAVE_SESION, $proyectos);
    }

    public static function all(): array
    {
        return self::dataset();
    }

    public static function find(int $id): ?array
    {
        foreach (self::dataset() as $proyecto) {
            if ($proyecto['id'] === $id) {
                return $proyecto;
            }
        }

        return null;
    }

    public static function create(array $datos): array
    {
        $proyectos = self::dataset();

        $nuevoId = count($proyectos) > 0
            ? max(array_column($proyectos, 'id')) + 1
            : 1;

        $nuevoProyecto = array_merge(['id' => $nuevoId], $datos);

        $proyectos[] = $nuevoProyecto;

        self::guardar($proyectos);

        return $nuevoProyecto;
    }

    public static function update(int $id, array $datos): ?array
    {
        $proyectos = self::dataset();

        foreach ($proyectos as $indice => $proyecto) {
            if ($proyecto['id'] === $id) {
                $proyectos[$indice] = array_merge($proyecto, $datos, ['id' => $id]);
                self::guardar($proyectos);

                return $proyectos[$indice];
            }
        }

        return null;
    }

    public static function delete(int $id): bool
    {
        $proyectos = self::dataset();

        foreach ($proyectos as $indice => $proyecto) {
            if ($proyecto['id'] === $id) {
                unset($proyectos[$indice]);
                self::guardar(array_values($proyectos));

                return true;
            }
        }

        return false;
    }
}
