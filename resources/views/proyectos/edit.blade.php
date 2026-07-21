@extends('layouts.app')

@section('titulo', 'Editar Proyecto')

@section('contenido')
    <h2>Editar Proyecto #{{ $proyecto['id'] }}</h2>

    @if ($errors->any())
        <div class="alert" style="background-color:#fee2e2;border-color:#dc2626;color:#7f1d1d;">
            <ul style="margin:0;padding-left:1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('proyectos.update', $proyecto['id']) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del Proyecto</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $proyecto['nombre']) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio"
                value="{{ old('fecha_inicio', $proyecto['fecha_inicio']) }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="Planificado" @selected(old('estado', $proyecto['estado']) === 'Planificado')>Planificado</option>
                <option value="En curso" @selected(old('estado', $proyecto['estado']) === 'En curso')>En curso</option>
                <option value="Finalizado" @selected(old('estado', $proyecto['estado']) === 'Finalizado')>Finalizado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="responsable">Responsable</label>
            <input type="text" id="responsable" name="responsable"
                value="{{ old('responsable', $proyecto['responsable']) }}" required>
        </div>

        <div class="form-group">
            <label for="monto_visual">Monto ($)</label>
            <input type="text" id="monto_visual" inputmode="numeric"
                value="{{ number_format(old('monto', $proyecto['monto']), 0, ',', '.') }}">
            <input type="hidden" id="monto" name="monto" value="{{ old('monto', $proyecto['monto']) }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
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
@endsection
