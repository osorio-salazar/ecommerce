<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index()
    {

        $productos = Producto::with('categoria')->where('state', 1)->get();
        return response()->json($productos);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('producto.create', compact('categorias'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            $i = 1;
            foreach ($request->file('images') as $image) {
                $imageName = $validatedData['name'] . $i . '.webp';
                $destinationPath = public_path('storage/productos');

       
                $src = imagecreatefromstring(file_get_contents($image));

              
                if (!imageistruecolor($src)) {
                    $trueColorImage = imagecreatetruecolor(imagesx($src), imagesy($src));
                    imagecopy($trueColorImage, $src, 0, 0, 0, 0, imagesx($src), imagesy($src));
                    imagedestroy($src);
                    $src = $trueColorImage;
                }

              
                $created = imagewebp($src, $destinationPath . '/' . $imageName, 80);

                if ($created) {
                    $images[] = $imageName;
                }

                imagedestroy($src);

                $i++;
            }
        }

        $producto = new Producto();
        $producto->name = $validatedData['name'];
        $producto->description = $validatedData['description'];
        $producto->stock = $validatedData['stock'];
        $producto->price = $validatedData['price'];
        $producto->category_id = $validatedData['category_id'];
        $producto->product_image = implode(',', $images);
        $producto->state = 1;
        $producto->save();

        return response()->json(['message' => 'Producto creado con éxito'], 201);
    }


    public function show(string $id)
    {
        $producto = Producto::find($id);

        return response()->json($producto, 200);
    }

    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return response()->json($producto);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'new_images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validación para las nuevas imágenes
            'existing_images.*' => 'string',
        ]);


        $images = [];


        if ($request->hasFile('new_images')) {
            $i = 1;
            foreach ($request->file('new_images') as $image) {
                $imageName = $validatedData['name'] . $i . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/productos'), $imageName);
                $images[] = $imageName;
                $i++;
            }
        }

        $existingImages = $request->input('existing_images', []);
        $images = array_merge($images, $existingImages);

        if ($producto = Producto::find($id)) {
            $producto->name = $validatedData['name'];
            $producto->price =  $validatedData['price'];
            $producto->stock = $validatedData['stock'];
            $producto->description =  $validatedData['description'];
            $producto->product_image = implode(',', $images);
            $producto->category_id = $validatedData['category_id'];
            $producto->save();
            return response()->json(['message' => 'Producto actualizado con éxito'], 200);
        }
    }
    public function destroy(string $id)
    {
        $producto = Producto::find($id);


        $images = explode(',', $producto->product_image);
        foreach ($images as $image) {
            $imagePath = public_path('storage/productos/' . $image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }


        $producto->state = 0;
        $producto->update();

        return response()->json(['message' => 'Eliminado con exito'], 200);
    }
}
