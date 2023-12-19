<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\NuevaVentaRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Exception\Exception;


class VentaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:vender');
    }


    public function venta()
    {
        $productos=Producto::all();
        return view('ventas.ventas',compact('productos'));
    }

    
   
    public function vender(NuevaVentaRequest $request)
    {
        
        try {
            $idproducto = $request->input('producto_id');
            $producto = Producto::findOrFail($idproducto);
        
            // Verificar si hay suficientes productos en stock
            $cantidadEnStock = $producto->stock;
            if ($cantidadEnStock <= 0) {
                return redirect()->route('venta')->with('error', 'No hay suficientes productos de este tipo');
            }
        
            // Validar la cantidad de productos a vender
            $cantidadVenta = $request->input('cantidad');
            if ($cantidadVenta > $cantidadEnStock) {
                return redirect()->route('venta')->with('error', 'No hay suficientes productos en el stock');
            }
        
            // Realizar la venta
            $venta = new Venta();
            $totalVenta = $producto->precio * $cantidadVenta;
        
            // Actualizar el stock del producto
            $producto->stock -= $cantidadVenta;
            $producto->save();
        
            // Registrar la venta
            $venta->cantidad = $cantidadVenta;
            $venta->total_venta = $totalVenta;
            $venta->producto_id = $idproducto;
            $venta->save();
        
            // Devolver una respuesta exitosa con los detalles de la venta
            return redirect()->route('venta')->with('success', 'Venta registrada con éxito');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('venta')->with('error', 'Producto no encontrado');
        } catch (\Exception $e) {
            return redirect()->route('venta')->with('error', 'Error al realizar la venta: ' . $e->getMessage());
        }

    }

    
}
