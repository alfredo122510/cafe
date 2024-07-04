<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\entregas;
use App\Models\compras;
use App\Models\cuentastotales;
use App\Models\productos;
use App\Models\usuarios;
use Carbon\Carbon;


class DashboardController extends Controller
{
    
    public function index()
    {
        $usuarioId = session('usuario_id'); 
        
        $totalEntregas = entregas::where('usuario_id', $usuarioId)
        ->count();
        $totalCompras = compras::where('usuario_id', $usuarioId)
        ->count();
        $totalCuentas = cuentastotales::sum('total_monto');
        $totalProductos = productos::count();

        return view('dashboard.index', compact('totalEntregas', 'totalCompras', 'totalCuentas', 'totalProductos'));
    }

   /* public function entregas()
    {
        $usuarioId = session('usuario_id');
        $entregas = entregas::where('usuario_id', $usuarioId)
        ->with('usuario', 'producto')->get();
        return view('dashboard.entregas', compact('entregas'));
    }*/

    public function entregas(Request $request)
    {
        $usuarioId = session('usuario_id'); // Obtener el ID del usuario desde la sesión
    
        // Verificar si el usuario está autenticado
        if (!$usuarioId) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
        }
    
        // Obtener el mes y el año seleccionados por el usuario
        $mes = $request->input('mes', date('m'));
        $ano = $request->input('ano', date('Y'));
    
        // Obtener todas las entregas del usuario para el mes y el año seleccionados
        $entregas = entregas::where('usuario_id', $usuarioId)
            ->whereMonth('entrega_fecha', $mes)
            ->whereYear('entrega_fecha', $ano)
            ->with('producto')
            ->get();
    
        // Agrupar entregas por producto y calcular totales
        $entregasAgrupadas = $entregas->groupBy('producto_id')->map(function ($entregas, $productoId) use ($usuarioId, $mes, $ano) {
            $cantidadTotal = $entregas->sum('cantidad');
            $totalEntregado = $entregas->sum(function ($entrega) {
                return $entrega->cantidad * $entrega->producto->venta;
            });
    
            // Calcular la cantidad comprada
            $cantidadComprada = compras::where('usuario_id', $usuarioId)
                ->where('producto_id', $productoId)
                ->whereMonth('compra_fecha', $mes)
                ->whereYear('compra_fecha', $ano)
                ->sum('cantidad');
    
            // Calcular la cantidad entregada
            $cantidadEntregada = $entregas->sum('cantidad');
    
            // Calcular la cantidad disponible
            $cantidadDisponible = $cantidadComprada - $cantidadEntregada;
    
            return [
                'producto' => $entregas->first()->producto,
                'cantidad_total' => $cantidadTotal,
                'precio_venta' => $entregas->first()->producto->venta,
                'total_entregado' => $totalEntregado,
                'cantidad_disponible' => $cantidadDisponible,
            ];
        });
    
        return view('dashboard.entregas', compact('entregas', 'entregasAgrupadas', 'mes', 'ano'));
    }
    
    






public function compras(Request $request)
{
    $usuarioId = session('usuario_id'); // Obtener el ID del usuario desde la sesión

    // Verificar si el usuario está autenticado
    if (!$usuarioId) {
        return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
    }

    // Obtener el mes y el año seleccionados por el usuario
    $mes = $request->input('mes', date('m'));
    $ano = $request->input('ano', date('Y'));

    // Obtener todas las compras del usuario para el mes y el año seleccionados
    $compras = compras::where('usuario_id', $usuarioId)
        ->whereMonth('compra_fecha', $mes)
        ->whereYear('compra_fecha', $ano)
        ->with('usuario', 'producto')
        ->get();
    
    // Agrupar compras por producto y calcular totales y disponibilidad
    $comprasAgrupadas = $compras->groupBy('producto_id')->map(function ($compras, $productoId) use ($usuarioId) {
        $cantidadTotal = $compras->sum('cantidad');
        $totalCompras = $compras->sum(function ($compra) {
            return $compra->cantidad * $compra->producto->precio;
        });

        // Calcular la cantidad entregada y disponible
        $cantidadComprada = compras::where('usuario_id', $usuarioId)
            ->where('producto_id', $productoId)
            ->sum('cantidad');
        $cantidadEntregada = entregas::where('usuario_id', $usuarioId)
            ->where('producto_id', $productoId)
            ->sum('cantidad');
        $cantidadDisponible = $cantidadComprada - $cantidadEntregada;

        return [
            'producto' => $compras->first()->producto,
            'cantidad_total' => $cantidadTotal,
            'precio' => $compras->first()->producto->precio,
            'total_compras' => $totalCompras,
            'cantidad_entregada' => $cantidadEntregada,
            'cantidad_disponible' => $cantidadDisponible,
        ];
    });

    return view('dashboard.compras', compact('compras', 'comprasAgrupadas', 'mes', 'ano'));
}







    
    public function cuentas()
    {
        $cuentas = cuentastotales::with('usuario')->get();
        return view('dashboard.cuentas', compact('cuentas'));
    }


    public function productos()
    {
        $productos = productos::all();
        return view('dashboard.productos', compact('productos'));
    }

    
    // Métodos de creación
/*    public function createEntrega()
    {
       
        $usuarios = usuarios::all();
        $productos = productos::all();
        return view('dashboard.createEntrega', compact('usuarios', 'productos'));
    }*/



    public function createCompra(Request $request)
    {

        $usuarioId = session('usuario_id'); // Obtener el ID del usuario desde la sesión
        $usuario = usuarios::find($usuarioId); // Obtener el usuario que ha iniciado sesión
    

        $usuarios = Usuarios::all();
        $productos = Productos::all();
        $entregas = entregas::all();
        $mes = $request->input('mes');
        $ano = $request->input('ano');
    
        // Lógica para obtener las compras filtradas por mes y año
        $compras = Compras::query();
    
        if ($mes) {
            $compras->whereMonth('compra_fecha', $mes);
        }
    
        if ($ano) {
            $compras->whereYear('compra_fecha', $ano);
        }
    
        $compras = $compras->get();
    
        return view('dashboard.createCompra', compact('usuario', 'productos', 'compras', 'mes', 'ano'));
    }


    public function createProducto()
    {
        return view('dashboard.createProducto');
    }

    public function createCuenta()
    {
        $usuarios = usuarios::all();
        return view('dashboard.createCuenta', compact('usuarios'));
    }

    // Métodos de almacenamiento
    public function storeEntrega(Request $request)
    {
        $usuarioId = $request->input('usuario_id');
        $productoId = $request->input('producto_id');
        $cantidadEntrega = $request->input('cantidad');
    

        // Calcular la cantidad total de productos comprados y entregados
        $cantidadComprada = compras::where('usuario_id', $usuarioId)
            ->where('producto_id', $productoId)
            ->sum('cantidad');
    
        $cantidadEntregada = entregas::where('usuario_id', $usuarioId)
            ->where('producto_id', $productoId)
            ->sum('cantidad');
    
        $cantidadDisponible = $cantidadComprada - $cantidadEntregada;
    
        // Validar que la cantidad de entrega no exceda la cantidad disponible
        if ($cantidadEntrega > $cantidadDisponible) {
            return redirect()->back()->with('error', 'Cantidad de entrega excede la cantidad disponible.');
        }
    
        // Obtener la fecha y hora actual en la zona horaria de Ecuador
        $entregaFecha = Carbon::now('America/Guayaquil');
    
        // Crear la entrega con los datos del formulario y la fecha y hora actualizada
        entregas::create([
            'usuario_id' => $usuarioId,
            'producto_id' => $productoId,
            'cantidad' => $cantidadEntrega,
            'entrega_fecha' => $entregaFecha,
        ]);
    
        return redirect()->route('dashboard.entregas')->with('success', 'Entrega creada exitosamente.');
    }




    public function createEntrega()
{
    $usuario = usuarios::find(session('usuario_id')); // Obtener el usuario que ha iniciado sesión

    $productos = productos::all();
    $entregas = entregas::all();
    
    return view('dashboard.createEntrega', compact('usuario', 'productos', 'entregas'));
}

  

    

public function storeCompra(Request $request)
{
    // Valida los datos recibidos del formulario
    $validatedData = $request->validate([
        'usuario_id' => 'required|exists:usuarios,id',
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer',
        'compra_fecha' => 'required|date'
    ]);

    // Combinar la fecha de compra proporcionada con la hora actual en la zona horaria de Ecuador
    $compraFecha = Carbon::parse($validatedData['compra_fecha'], 'America/Guayaquil')->setTimeFromTimeString(now('America/Guayaquil')->toTimeString());

    // Crear la compra con la fecha y hora actualizada
    compras::create([
        'usuario_id' => $validatedData['usuario_id'],
        'producto_id' => $validatedData['producto_id'],
        'cantidad' => $validatedData['cantidad'],
        'compra_fecha' => $compraFecha,
    ]);

    return redirect()->route('dashboard.compras')->with('success', 'Compra creada exitosamente.');
}


    public function storeProducto(Request $request)
    {
        productos::create($request->all());
        return redirect()->route('dashboard.productos')->with('success', 'Producto creado exitosamente.');
    }

    public function storeCuenta(Request $request)
    {
        cuentastotales::create($request->all());
        return redirect()->route('dashboard.cuentas')->with('success', 'Cuenta total creada exitosamente.');
    }






public function calcularFinDeMes(Request $request)
{
    $usuarioId = session('usuario_id'); // Obtenemos el ID del usuario desde la sesión
    if (!$usuarioId) {
        return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
    }

    // Obtener el mes y el año seleccionados por el usuario, o usar el mes y año actuales por defecto
    $mes = $request->input('mes', Carbon::now()->format('m'));
    $ano = $request->input('ano', Carbon::now()->format('Y'));

    // Obtener todas las compras del usuario para el mes y el año seleccionados
    $compras = compras::where('usuario_id', $usuarioId)
        ->whereMonth('compra_fecha', $mes)
        ->whereYear('compra_fecha', $ano)
        ->with('producto')
        ->get();

    // Calcular el total de compras para el mes y año seleccionados
    $totalCompras = $compras->sum(function ($compra) {
        return $compra->cantidad * $compra->producto->precio;
    });

    // Obtener todas las entregas del usuario para el mes y el año seleccionados
    $entregas = entregas::where('usuario_id', $usuarioId)
        ->whereMonth('entrega_fecha', $mes)
        ->whereYear('entrega_fecha', $ano)
        ->with('producto')
        ->get();

    // Calcular el total de entregas para el mes y año seleccionados
    $totalEntregas = $entregas->sum(function ($entrega) {
        return $entrega->cantidad * $entrega->producto->venta;
    });

    // Calcular la ganancia (total entregas - total compras)
    $ganancia = $totalEntregas - $totalCompras;

    // Retornar la vista con los datos
    return view('dashboard.finDeMes', compact('totalCompras', 'totalEntregas', 'ganancia', 'mes', 'ano'));
}



}