@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos Totales</h1>
    <div class="row mb-3 align-items-center">
        <div class="col-md-6 mb-2 mb-md-0">
            <a href="{{ route('dashboard.productos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nuevo Producto
            </a>
       
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio Compra</th>
                    <th scope="col">Precio Venta</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->precio }}$</td>
                        <td>{{ $producto->venta }}$</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
