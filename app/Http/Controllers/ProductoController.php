<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductoController extends Controller
{
    // LEER (listar)
    public function index()
    {
        return Inertia::render('Productos/Index', [
            'productos' => Producto::latest()->get(),
        ]);
    }

    // CREAR (mostrar formulario)
    public function create()
    {
        return Inertia::render('Productos/Form', ['producto' => null]);
    }

    // CREAR (guardar)
    public function store(Request $request)
    {
        Producto::create($this->validar($request));
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // ACTUALIZAR (mostrar formulario)
    public function edit(Producto $producto)
    {
        return Inertia::render('Productos/Form', ['producto' => $producto]);
    }

    // ACTUALIZAR (guardar)
    public function update(Request $request, Producto $producto)
    {
        $producto->update($this->validar($request));
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // ELIMINAR
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);
    }
}