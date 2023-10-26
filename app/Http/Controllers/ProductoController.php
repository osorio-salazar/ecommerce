<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use GuzzleHttp\Psr7\Message;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function create()
    {
        return view('producto.create');
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

       



        $producto = new Producto();
        $producto->name = $validatedData['name'];
        $producto->description = $validatedData['description'];
        $producto->price = $validatedData ['price'];
        $producto->save();

        return response()->json(['message' => 'Producto creado con éxito'], 201);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
