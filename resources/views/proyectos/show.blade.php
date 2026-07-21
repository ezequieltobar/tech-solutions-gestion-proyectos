@extends('layouts.app')

@section('titulo', 'Detalle del Proyecto')

@section('contenido')
    <h2>Detalle del Proyecto #{{ $proyecto['id'] }}</h2>

    <table>
        <tr>
            <th style="width:200px;">Nombre</th>
            <td>{{ $proyecto['nombre'] }}</td>
        </tr>
        <tr>
            <th>Fecha de Inicio</th>
            <td>{{ \Carbon\Carbon::parse($proyecto['fecha_inicio'])->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>{{ $proyecto['estado'] }}</td>
        </tr>
        <tr>
            <th>Responsable</th>
            <td>{{ $proyecto['responsable'] }}</td>
        </tr>
        <tr>
            <th>Monto</th>
            <td>${{ number_format($proyecto['monto'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <br>
    <a href="{{ route('proyectos.edit', $proyecto['id']) }}" class="btn btn-primary">Editar</a>
    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver al listado</a>
@endsection
