@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Cuenta Total</h1>
    <form action="{{ route('dashboard.cuentas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" class="form-control" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="mes">Mes</label>
            <input type="text" name="mes" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ano">Año</label>
            <input type="number" name="ano" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total_monto">Total Monto</label>
            <input type="number" step="0.01" name="total_monto" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Cuenta Total</button>
    </form>
</div>
@endsection
