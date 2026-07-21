@extends('layouts.app')

@section('titulo', 'Eliminar Proyecto')

@section('contenido')
    <h2>Eliminar Proyecto</h2>

    <div class="alert" style="background-color:#fee2e2;border-color:#dc2626;color:#7f1d1d;">
        ¿Estás seguro de que deseas eliminar el proyecto
        <strong>"{{ $proyecto['nombre'] }}"</strong> (Id: {{ $proyecto['id'] }})?
        Esta acción no se puede deshacer.
    </div>

    <table>
        <tr>
            <th style="width:200px;">Responsable</th>
            <td>{{ $proyecto['responsable'] }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>{{ $proyecto['estado'] }}</td>
        </tr>
        <tr>
            <th>Monto</th>
            <td>${{ number_format($proyecto['monto'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <br>
    <form method="POST" action="{{ route('proyectos.destroy', $proyecto['id']) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
    </form>
    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
@endsection
