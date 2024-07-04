@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cuentas Totales</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Total Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->id }}</td>
                    <td>{{ $cuenta->usuario->nombre }}</td>
                    <td>{{ $cuenta->mes }}</td>
                    <td>{{ $cuenta->ano }}</td>
                    <td>{{ $cuenta->total_monto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
