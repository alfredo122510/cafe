@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('dashboard.productos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio de Compra</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="venta">Precio de Venta</label>
            <input type="number" step="0.01" name="venta" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Producto</button>
        <a href="{{ route('dashboard.productos') }}" class="btn btn-success">Ver Productos</a>
    </form>
</div>
@endsection
