<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Exception\Exception;
use App\Http\Requests\ActualizarUsuarioRequest;
use App\Http\Requests\NuevoUsuarioRequest;


class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:administrar')->except('registrar');
    }


    public function index()
    {
        $usuarios= User::all();

        return view('usuarios.index', compact('usuarios'));
    }

    

    public function registrar(NuevoUsuarioRequest $request)
    {
        try {
            $usuario = new User($request->validated());
            $usuario->save();

            $consultaRole = Role::find(3);
            $usuario->assignRole($consultaRole);

            return redirect()->route('login')->with('success', 'Registrado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al registrar usuario: ' . $e->getMessage());
        }
    }

   
    public function show(string $id)
    {
        //
    }

    

    public function edit(string $id)
    {
        try {
            $usuario = User::findOrFail($id);
            $roles = Role::all();
            return view('usuarios.edit', compact('usuario','roles'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }

    


    public function update(ActualizarUsuarioRequest $request, string $id)
    {
        try {
            // Encontrar el usuario
            $usuario = User::findOrFail($id);
    
            // Actualizar los datos del usuario
            $usuario->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
    
            // Obtener el nuevo rol desde el formulario
            $nuevoRol = $request->input('rol');
    
            // Sincronizar el nuevo rol al usuario
            $usuario->syncRoles([$nuevoRol]);
    
            // Redirigir de vuelta con un mensaje de éxito
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Usuario no encontrado ' . $e->getMessage())->withInput();
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Error inesperado al actualizar el usuario.')->withInput();
        }
    }

    


    public function destroy(string $id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
        
            return redirect()->route('usuarios.index')->with('success', 'Producto eliminado correctamente');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('usuarios.index')->with('error', 'Producto no encontrado.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')->with('error', 'Error al eliminar el producto.');
        }
    }
}
