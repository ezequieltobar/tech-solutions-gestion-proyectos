<?php

namespace App\Services;

/**
 * UfService
 *
 * Componente reutilizable que SIMULA el consumo de un servicio externo
 * (por ejemplo, la API de mindicador.cl que entrega el valor real de la UF).
 * Se simula porque el enunciado pide "simule el consumo", sin exigir
 * conexión real a internet.
 *
 * Al ser una clase de servicio independiente (no un método dentro del
 * controlador), puede ser inyectada y reutilizada por CUALQUIER
 * controlador del sistema, no solo por ProyectoController. Eso es lo
 * que la hace "reutilizable".
 */
class UfService
{
    /**
     * Simula la consulta a un servicio externo que entrega el valor
     * de la UF del día. En una implementación real, aquí usaríamos
     * Laravel's Http::get() para llamar a una API externa, por ejemplo:
     *
     *   $respuesta = Http::get('https://mindicador.cl/api/uf');
     *   return $respuesta->json('serie.0.valor');
     *
     * Como el enunciado pide simular el consumo (no conexión real),
     * generamos un valor realista de forma aleatoria dentro de un
     * rango cercano al valor real de la UF.
     */
    public function obtenerValorUf(): array
    {
        $valorSimulado = round(rand(3800000, 3900000) / 100, 2);

        return [
            'fecha' => now()->format('d-m-Y'),
            'valor' => $valorSimulado,
            'fuente' => 'Servicio simulado (mock de mindicador.cl)',
        ];
    }
}
