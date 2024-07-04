@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Entregas</h1>

    <!-- Botón para crear nueva entrega -->
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('dashboard.entregas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nueva Entrega
            </a>
        </div>

        <!-- Formulario de selección de mes y año -->
        <div class="col-md-6">
            <form method="GET" action="{{ route('dashboard.entregas') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="mes">Seleccionar Mes:</label>
                        <select name="mes" id="mes" class="form-control">
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
        </div>
    </div>

    <!-- Tabla de entregas -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Venta</th>
                    <th>Valor ($)</th>
                    <th>Fecha de Entrega</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entregas as $entrega)
                    <tr>
                        <td>{{ $entrega->producto->nombre }}</td>
                        <td>{{ $entrega->cantidad }}</td>
                        <td>{{ $entrega->producto->venta }} $</td>
                        <td>{{ $entrega->cantidad * $entrega->producto->venta }} $</td>
                        <td>{{ $entrega->entrega_fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Resumen de Entregas por Producto -->
    <h2>
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#resumenEntregas" aria-expanded="false" aria-controls="resumenEntregas">
            Resumen de Entregas por Producto
        </button>
    </h2>

    <div class="collapse" id="resumenEntregas">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Total Entregada</th>
                        <th>Cantidad Disponible</th>
                        <th>Precio Venta</th>
                        <th>Total Entregado ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalEntregado = 0;
                    @endphp
                    @foreach($entregasAgrupadas as $resumen)
                        <tr>
                            <td>{{ $resumen['producto']->nombre }}</td>
                            <td>{{ $resumen['cantidad_total'] }}</td>
                            <td>{{ $resumen['cantidad_disponible'] }}</td>
                            <td>{{ $resumen['precio_venta'] }} $</td>
                            <td>{{ $resumen['total_entregado'] }} $</td>
                        </tr>
                        @php
                            $totalEntregado += $resumen['total_entregado'];
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                        <td><strong>{{ $totalEntregado }} $</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
