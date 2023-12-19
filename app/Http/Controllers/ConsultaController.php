<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Exception\Exception;

class ConsultaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:consultar');
    }


    public function consulta()
    {
        try {
            // Obtener los 3 productos con más stock
            $productosStock = Producto::orderBy('stock', 'desc')->take(3)->get();
        
            // Producto más vendido
            $productoMasVendido = DB::table('productos')
                                    ->join('ventas', 'productos.id', '=', 'ventas.producto_id')
                                    ->select('productos.id', 'productos.nombre_producto', DB::raw('SUM(ventas.cantidad) as total_ventas'))
                                    ->groupBy('productos.id', 'productos.nombre_producto')
                                    ->orderByDesc('total_ventas')
                                    ->first();
        
            // Productos con más registros de venta
            $productosVentas = Producto::withCount('ventas')->orderByDesc('ventas_count')->take(3)->get();
        
            return view('productos.consulta', compact('productosStock', 'productosVentas', 'productoMasVendido'));
        } catch (\Exception $e) {
            return view('error')->with('error', $e->getMessage());
        }

    }
}