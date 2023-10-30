<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
class ProductoController extends Controller
{
    public function index()
    {
    
        $productos = Producto::with('categoria')->where('state', 1)->get();
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
            'stock' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage'), $imageName);
                $images[] = $imageName;
            }
        }

        $producto = new Producto();
        $producto->name = $validatedData['name'];
        $producto->description = $validatedData['description'];
        $producto->stock = $validatedData['stock'];
        $producto->price = $validatedData['price'];
        $producto->product_image = implode(',', $images);
        $producto->state = 1;
        $producto->save();

        return response()->json(['message' => 'Producto creado con éxito'], 201);
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return response()->json($producto);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $producto = Producto::find($id);
        $producto->name = $validatedData['name'];
        $producto->description =  $validatedData['description'];
        $producto->price =  $validatedData['price'];
        $producto->stock = $validatedData['stock'];
        $producto->save();

        return response()->json(['message' => 'Producto actualizado con éxito'], 200);
    }

    public function destroy(string $id)
    {
        //
    }
}
