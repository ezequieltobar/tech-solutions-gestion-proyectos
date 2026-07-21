@extends('layouts.app')

@section('titulo', 'Listado de Proyectos')

@section('contenido')
    <h2>Listado de Proyectos</h2>

    @if (session('mensaje'))
        <div class="alert">{{ session('mensaje') }}</div>
    @endif

    <a href="{{ route('proyectos.create') }}" class="btn btn-primary">+ Agregar Proyecto</a>

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
            @forelse ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto['id'] }}</td>
                    <td>{{ $proyecto['nombre'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($proyecto['fecha_inicio'])->format('d-m-Y') }}</td>
                    <td>{{ $proyecto['estado'] }}</td>
                    <td>{{ $proyecto['responsable'] }}</td>
                    <td>${{ number_format($proyecto['monto'], 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('proyectos.show', $proyecto['id']) }}" class="btn btn-secondary">Ver</a>
                        <a href="{{ route('proyectos.edit', $proyecto['id']) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('proyectos.confirmDelete', $proyecto['id']) }}" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay proyectos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
