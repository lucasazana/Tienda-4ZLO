<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'medida' => 'required|string|max:255',
            'talla' => 'required|string|max:255',
            'estado_ropa' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'estado' => 'required|boolean',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Subir imagen a Cloudinary
        $uploadedFileUrl = null;
        if ($request->hasFile('imagen')) {
            $uploadedFile = $request->file('imagen');
            // Usando Cloudinary SDK
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            $result = $cloudinary->uploadApi()->upload($uploadedFile->getRealPath(), [
                'folder' => 'productos',
            ]);
            $uploadedFileUrl = $result['secure_url'] ?? null;
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'medida' => $request->medida,
            'talla' => $request->talla,
            'estado_ropa' => $request->estado_ropa,
            'precio' => $request->precio,
            'estado' => $request->estado,
            'imagen_url' => $uploadedFileUrl,
        ]);

        return redirect()->route('productos.show', $producto->id)
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
