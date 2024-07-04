@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Entregas</h5>
                    <p class="card-text">{{ $totalEntregas }}</p>
                    <a href="{{ route('dashboard.entregas.create') }}" class="btn btn-primary">Agregar Entrega</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Compras</h5>
                    <p class="card-text">{{ $totalCompras }}</p>
                    <a href="{{ route('dashboard.compras.create') }}" class="btn btn-primary">Agregar Compra</a>
                </div>
            </div>
        </div>
  
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Productos</h5>
                    <p class="card-text">{{ $totalProductos }}</p>
                    <a href="{{ route('dashboard.productos.create') }}" class="btn btn-primary">Agregar Producto</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumen del Mes</h5>
                    <a href="{{ route('dashboard.finDeMes') }}" class="btn btn-primary">Ver Resumen del Mes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
