<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    // controlador para manejar todo lo de productos (mostrar, crear, editar, eliminar)

    // muestra la lista de productos en la pagina principal
    public function index()
    {
        $productos = Producto::where(function($q) {
            $q->where('estado', 1)
                ->orWhere(function($q2) {
                    $q2->where('estado', 0)
                        ->where(function($q3) {
                            $q3->whereNull('no_disponible_desde')
                                ->orWhere('no_disponible_desde', '>', now()->subDays(2));
                        });
                });
        })
        ->inRandomOrder()
        ->paginate(12);
        return view('productos.index', compact('productos'));
    }


    // muestra el formulario para crear un nuevo producto (aqui deberia ir la vista de creacion)
    public function create()
    {
        return view('dashboard');
    }


    // guarda un nuevo producto en la base de datos
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'medida' => 'required|string|max:255',
            'talla' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'estado_ropa' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'estado' => 'required|boolean',
            'imagenes' => 'required',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'medida' => $request->medida,
            'talla' => $request->talla,
            'categoria' => $request->categoria,
            'estado_ropa' => $request->estado_ropa,
            'precio' => $request->precio,
            'estado' => $request->estado,
        ]);

        $imagenesUrls = [];
        if ($request->hasFile('imagenes')) {
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            foreach ($request->file('imagenes') as $i => $uploadedFile) {
                $result = $cloudinary->uploadApi()->upload($uploadedFile->getRealPath(), [
                    'folder' => 'productos',
                    'resource_type' => 'image',
                ]);
                if (isset($result['public_id'])) {
                    $publicId = $result['public_id'];
                    $url = $cloudinary->image($publicId . '.webp')->toUrl();
                } else {
                    $url = $result['secure_url'] ?? null;
                }
                $imagenesUrls[] = $url;
                $producto->imagenes()->create([
                    'url' => $url,
                    'orden' => $i,
                ]);
            }

            // guardar la primera imagen como principal en el campo imagen_url
            if (count($imagenesUrls) > 0) {
                $producto->imagen_url = $imagenesUrls[0];
                $producto->save();
            }
        }

        // ji la petición es ajax devuelve json
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Producto creado correctamente.']);
        }

        // si no es ajax cinserva su comportamiento tradicional
        return redirect()->route('admin.productos.panel')
            ->with('success', 'Producto creado correctamente.');
    }

    // muestra cards aleatorias de productos al interactuar con los detalles de un producto
    public function show(Producto $producto)
    {
        $randomProductos = Producto::where('id', '!=', $producto->id)
            ->where('estado', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return view('productos.detalle', compact('producto', 'randomProductos'));
    }

    // muestra el formulario para editar un producto
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    // actualiza un producto existente
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

        // si se sube una nueva imagen procesarla y subir a cloudinary
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

            // obtiener la url de la imagen subida y lo convertir a webp con cloudinary
            if (isset($result['public_id'])) {
                $publicId = $result['public_id'];
                $data['imagen_url'] = $cloudinary->image($publicId . '.webp')->toUrl();
            } else {
                $data['imagen_url'] = $result['secure_url'] ?? null;
            }
        }

        // actualizar el estado del producto
        if ($request->estado == 0 && !$producto->no_disponible_desde) {
            $data['no_disponible_desde'] = now();
        } elseif ($request->estado == 1) {
            $data['no_disponible_desde'] = null;
        }

        $producto->update($data);

        return redirect()->route('admin.productos.panel')->with('success', 'Producto actualizado correctamente.');
    }

    // elimina un producto existente
    public function destroy(Producto $producto)
    {
        // eliminar imágenes asociadas
        if (method_exists($producto, 'imagenes')) {
            $producto->imagenes()->delete();
        }
        // eliminar el producto
        $producto->delete();
        return redirect()->route('admin.productos.panel')->with('success', 'Producto eliminado correctamente.');
    }
}
