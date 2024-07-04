@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Crear Entrega</h1>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('dashboard.entregas.store') }}" method="POST" id="formEntrega">
                @csrf

    <!-- Campo de usuario visible (solo lectura) con estilo Bootstrap -->
    <div class="form-group">
        <label for="usuario">Usuario</label>
        <input type="text" class="form-control" value="{{ $usuario->nombre }}" readonly>
    </div>

    <!-- Campo oculto para enviar el ID del usuario -->
    <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                

                <!-- Resto del formulario con estilos Bootstrap -->
                <div class="form-group">
                    <label for="producto_id">Producto</label>
                    <select name="producto_id" class="form-control" required id="producto_id">
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            <h1>jjj</h1>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="entrega_fecha">Fecha de Entrega</label>
                    <input type="date" name="entrega_fecha" class="form-control" value="{{ date('Y-m-d') }}"  required>
                </div>

                <button type="submit" class="btn btn-primary">Crear Entrega</button>
                <a href="{{ route('dashboard.entregas') }}" class="btn btn-success">Ver Entregas</a>
            </form>
           
            
        </div>


@endsection
