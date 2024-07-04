@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Compras</h1>

    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('dashboard.compras.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nueva Compra
            </a>
        </div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('dashboard.compras') }}">
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

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad Comprada</th>
            
                    <th scope="col">Precio Compra</th>
                    <th scope="col">Total Compras ($)</th>
                    <th scope="col">Fecha de Compra</th>

              
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $compra)
                    <tr>
                      
                        <td>{{ $compra->producto->nombre }}</td>
                        <td>{{ $compra->cantidad }}</td>

          

                        <td>{{ $compra->producto->precio }} $</td>
                        <td>{{ $compra->cantidad * $compra->producto->precio }} $</td>
                        <td>{{ $compra->compra_fecha }}</td>
                   
                       
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>


    <!-- Resumen de Compras por Producto -->
    <h2>
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#resumenCompras" aria-expanded="false" aria-controls="resumenCompras">
            Resumen de Compras por Producto
        </button>
    </h2>

    <div class="collapse" id="resumenCompras">
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad Total Comprada</th>
                        <th scope="col">Cantidad Entregada</th>
                        <th scope="col">Cantidad Disponible</th>
                        <th scope="col">Precio Compra</th>
                        <th scope="col">Total Compras ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalCompras = 0;
                    @endphp
                    @foreach($comprasAgrupadas as $compraAgrupada)
                        <tr>
                            <td>{{ $compraAgrupada['producto']->nombre }}</td>
                            <td>{{ $compraAgrupada['cantidad_total'] }}</td>
                            <td>{{ $compraAgrupada['cantidad_entregada'] }}</td>
                            <td>{{ $compraAgrupada['cantidad_disponible'] }}</td>
                            <td>{{ $compraAgrupada['precio'] }} $</td>
                            <td>{{ $compraAgrupada['total_compras'] }} $</td>
                        </tr>
                        @php
                            $totalCompras += $compraAgrupada['total_compras'];
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right"><strong>Total:</strong></td>
                        <td><strong>{{ $totalCompras }} $</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection
