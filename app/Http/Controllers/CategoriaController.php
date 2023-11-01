<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'category_image' => 'image',
        ]);

        $categoria = new Categoria([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_image' => $request->file('category_image')->store('categorias', 'public'), // Almacena la imagen en la carpeta 'storage/app/public/categorias'
        ]);
        $categoria->save();

        // return response()->json('Categoría creada con éxito');
        return response()->json(['message' => 'Categoria creada con éxito'], 201);
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria);
        // return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
             // Validación para la imagen
        ]);        

        $categoria = Categoria::find($id);
        $categoria->name = $request->input('name');
        $categoria->description = $request->input('description');

        if ($request->hasFile('category_image')) {
            // Eliminar la imagen anterior si existe
            if (Storage::disk('public')->exists($categoria->category_image)) {
                Storage::disk('public')->delete($categoria->category_image);
            }

            // Almacenar la nueva imagen
            $categoria->category_image = $request->file('category_image')->store('categorias', 'public');
        }

        $categoria->save();

        return response()->json(['message' => 'Categoría actualizada con éxito'], 200);
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        // Eliminar la imagen asociada a la categoría
        if (Storage::disk('public')->exists($categoria->category_image)) {
            Storage::disk('public')->delete($categoria->category_image);
        }

        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada con éxito'], 200);
    }
}
