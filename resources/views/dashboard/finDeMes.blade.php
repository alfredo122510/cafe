@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resumen del Mes</h1>

    <!-- Formulario de selección de mes y año -->
    <form method="GET" action="{{ route('dashboard.finDeMes') }}">
        <div class="row">
            <div class="col-md-4">
                <label for="mes">Seleccionar Mes:</label>
                <select name="mes" id="mes" class="form-control">
                    <!-- Opciones para los meses -->
                    @php
                        $meses = [
                            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                        ];
                    @endphp
                    @foreach ($meses as $numero => $nombre)
                        <option value="{{ $numero }}" {{ $numero == $mes ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="ano">Seleccionar Año:</label>
                <select name="ano" id="ano" class="form-control">
                    <!-- Opciones para los años -->
                    @for ($year = date('Y'); $year >= 2010; $year--)
                        <option value="{{ $year }}" {{ $year == $ano ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <br>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <br>

    <!-- Resultados del resumen del mes -->
    <p>Mes: {{ $mes }}/{{ $ano }}</p>
    <p>Total de Compras: ${{ number_format($totalCompras, 2) }}</p>
    <p>Total de Entregas: ${{ number_format($totalEntregas, 2) }}</p>
    <p>Ganancia: ${{ number_format($ganancia, 2) }}</p>
</div>
@endsection
