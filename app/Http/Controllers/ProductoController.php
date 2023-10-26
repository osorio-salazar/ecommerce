<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

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
            'images_product' => 'required', 
        ]);

        $name = $request['images_product']->getClientOriginalName();
        $location = "img_products";
        $imagePath = $request['images_product']->move($location, $name);

        $producto = new Producto();
        $producto->name = $request->input('name');
        $producto->description = $request->input('description');
        $producto->price = $request->input('price');
        $producto->images_product = $imagePath;
        $producto->save();

        return redirect()->route('productList')->with('success', 'Producto creado exitosamente');
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
