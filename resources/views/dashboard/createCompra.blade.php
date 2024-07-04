@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Crear Compra</h1>
            <form action="{{ route('dashboard.compras.store') }}" method="POST" id="crearCompraForm">
                @csrf
                


                  <!-- Campo de usuario visible (solo lectura) con estilo Bootstrap -->
    <div class="form-group">
        <label for="usuario">Usuario</label>
        <input type="text" class="form-control" value="{{ $usuario->nombre }}" readonly>
    </div>

    <!-- Campo oculto para enviar el ID del usuario -->
    <input type="hidden" name="usuario_id" value="{{ $usuario->id }}"> 


                <div class="form-group">
                    <label for="producto_id">Producto</label>
                    <select name="producto_id" class="form-control" required>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="compra_fecha">Fecha de Compra</label>
                    <input type="date" name="compra_fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear Compra</button>
                <a href="{{ route('dashboard.compras') }}" class="btn btn-success">Ver Compras</a>
            </form>

            <!-- Mensaje de compra exitosa oculto por defecto -->
            <div class="alert alert-success mt-3 d-none" id="mensajeCompraExitosa" role="alert">
                Compra creada exitosamente.
            </div>
        </div>
    </div>
</div>

<script>
    // Esperar a que el documento esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Capturar el formulario y el mensaje de compra exitosa
        const form = document.getElementById('crearCompraForm');
        const mensajeCompraExitosa = document.getElementById('mensajeCompraExitosa');

        // Escuchar el evento submit del formulario
        form.addEventListener('submit', function(event) {
            // Prevenir el envío del formulario por defecto
            event.preventDefault();

            // Mostrar el mensaje de compra exitosa
            mensajeCompraExitosa.classList.remove('d-none');

            // Después de 2 segundos, ocultar el mensaje de compra exitosa
            setTimeout(function() {
                mensajeCompraExitosa.classList.add('d-none');
                // Envía el formulario después de mostrar el mensaje
                form.submit();
            }, 2000); // 2000 milisegundos = 2 segundos
        });
    });
</script>

@endsection
