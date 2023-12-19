<?php

namespace App\Http\Controllers;


use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\NuevoProductoRequest;
use App\Http\Requests\ActualizarProductoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Exception\Exception;


class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:administrar');
    }

    
    public function index()
    {
        $productos=Producto::all();

        return view('productos.index', compact('productos'));
    }

  
    public function store(NuevoProductoRequest  $request)
    {
        try {
            $producto = new Producto($request->validated());
            $producto->save();

            return redirect()->route('productos.index')->with('success', 'Producto agregado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al agregar el producto: ' . $e->getMessage());
        }
    }

    
    public function edit(string $id)
    {
        try {
            $producto = Producto::findOrFail($id);

            return view('productos.edit', compact('producto'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }
    }

    
    public function update(ActualizarProductoRequest $request, string $id)
    {
        try {
            $producto = Producto::findOrFail($id);
        
            $producto->update($request->validated());
        
            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
        }
    }

   
    public function destroy(string $id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();
        
            return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Error al eliminar el producto.');
        }

        
    }
}
