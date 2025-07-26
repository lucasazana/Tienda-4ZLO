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
        $productos = Producto::where(function($q) {
            $q->where('estado', 1)
              ->orWhere(function($q2) {
                  $q2->where('estado', 0)
                      ->where(function($q3) {
                          $q3->whereNull('no_disponible_desde')
                              ->orWhere('no_disponible_desde', '>', now()->subDay());
                      });
              });
        })->get();
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

        // Subir imagen a Cloudinary y obtener versión webp
        $uploadedFileUrl = null;
        if ($request->hasFile('imagen')) {
            $uploadedFile = $request->file('imagen');
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            $result = $cloudinary->uploadApi()->upload($uploadedFile->getRealPath(), [
                'folder' => 'productos',
                'resource_type' => 'image',
            ]);
            // Obtener la URL en webp usando transformación de Cloudinary
            if (isset($result['public_id'])) {
                $publicId = $result['public_id'];
                $uploadedFileUrl = $cloudinary->image($publicId . '.webp')->toUrl();
            } else {
                $uploadedFileUrl = $result['secure_url'] ?? null;
            }
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

        // Si la petición es AJAX, devolver JSON
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Producto creado correctamente.']);
        }
        // Si no es AJAX, comportamiento tradicional
        return redirect()->route('admin.productos.panel')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.detalle', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'medida' => 'required|string|max:255',
            'talla' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'estado_ropa' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->only([
            'nombre', 'descripcion', 'medida', 'talla', 'categoria', 'estado_ropa', 'precio', 'estado'
        ]);

        // Si se sube una nueva imagen, procesarla y subir a Cloudinary
        if ($request->hasFile('imagen')) {
            $uploadedFile = $request->file('imagen');
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            $result = $cloudinary->uploadApi()->upload($uploadedFile->getRealPath(), [
                'folder' => 'productos',
                'resource_type' => 'image',
            ]);
            // Obtener la URL en webp usando transformación de Cloudinary
            if (isset($result['public_id'])) {
                $publicId = $result['public_id'];
                $data['imagen_url'] = $cloudinary->image($publicId . '.webp')->toUrl();
            } else {
                $data['imagen_url'] = $result['secure_url'] ?? null;
            }
        }

        // Guardar o limpiar la fecha de no disponible
        if ($request->estado == 0 && !$producto->no_disponible_desde) {
            $data['no_disponible_desde'] = now();
        } elseif ($request->estado == 1) {
            $data['no_disponible_desde'] = null;
        }

        $producto->update($data);

        return redirect()->route('admin.productos.panel')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
