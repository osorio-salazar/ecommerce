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
            'description' => 'required|string',
            'category_image' => 'required|image',
        ]);


        $categoria = new Categoria([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_image' => $request->file('category_image')->storeAs('categorias', $request->input('name') . '.' . $request->file('category_image')->getClientOriginalExtension(), 'public'),
        ]);
        $categoria->save();

        // return response()->json('Categoría creada con éxito');
        return response()->json(['message' => 'Categoria creada con éxito'], 201);
    }

    public function show($id)
    {
        // $categoria = Categoria::find($id);
        // return view('categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria);
        // return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $categoria = Categoria::find($id);

        if ($request->hasFile('category_image')) {

            Storage::disk('public')->delete($categoria->category_image);

            $imageName = $validatedData['name'] . '.' . $request->file('category_image')->getClientOriginalExtension();
            $request->file('category_image')->storeAs('categorias', $imageName, 'public');

            $categoria->category_image = 'categorias/' . $imageName;
        }


        $categoria->name = $validatedData['name'];
        $categoria->description = $validatedData['description'];


        $categoria->save();;

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
