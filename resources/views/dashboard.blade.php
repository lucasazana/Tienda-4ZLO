@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto py-12">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500 text-black rounded shadow text-center font-bold border border-green-400">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="text-2xl font-bold mb-8 text-green-400">Agregar nuevo producto</h2>
    <div id="success-message" class="mb-6 p-4 bg-green-500 text-black rounded shadow text-center font-bold border border-green-400 hidden"></div>
    <div id="error-message" class="mb-6 p-4 bg-red-500 text-black rounded shadow text-center font-bold border border-red-400 hidden"></div>
    <form id="producto-form" action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-black/90 p-8 rounded-xl border border-green-900 shadow-lg">
        @csrf

        <div>
            <label for="nombre" class="block text-green-300 font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="descripcion" class="block text-green-300 font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required></textarea>
        </div>

        <div>
            <label for="medida" class="block text-green-300 font-semibold mb-1">Medidas</label>
            <input type="text" name="medida" id="medida" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="talla" class="block text-green-300 font-semibold mb-1">Talla</label>
            <select name="talla" id="talla" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="">Selecciona una talla</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="UNICA">ÚNICA</option>
            </select>
        </div>

        <div>
            <label for="categoria" class="block text-green-300 font-semibold mb-1">Categoría</label>
            <select name="categoria" id="categoria" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="">Selecciona una categoría</option>
                <option value="Pantalón">Pantalón</option>
                <option value="Casacas">Casacas</option>
                <option value="Polos">Polos</option>
            </select>
        </div>

        <div>
            <label for="estado_ropa" class="block text-green-300 font-semibold mb-1">Estado de la prenda</label>
            <input type="text" name="estado_ropa" id="estado_ropa" placeholder="Ej: 9/10" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="precio" class="block text-green-300 font-semibold mb-1">Precio (S/)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="estado" class="block text-green-300 font-semibold mb-1">Estado</label>
            <select name="estado" id="estado" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="1">Disponible</option>
                <option value="0">No disponible</option>
            </select>
        </div>

        <div>
            <label for="imagenes" class="block text-green-300 font-semibold mb-1">Imágenes</label>
            <input type="file" name="imagenes[]" id="imagenes" accept="image/*" class="w-full text-green-200" multiple required>
            <small class="text-green-500">Puedes seleccionar varias imagenes. La primera sera la principal.</small>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-6 rounded transition-all duration-200 uppercase tracking-widest border border-green-400">Publicar producto</button>
        </div>
    </form>

    // script para enviar el formulario por ajax y mostrar mensaje de éxito
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('producto-form');
        const successDiv = document.getElementById('success-message');
        const errorDiv = document.getElementById('error-message');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            errorDiv.classList.add('hidden');
            errorDiv.textContent = '';
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (response.status === 422 && data.errors) {
                    let errorList = Object.values(data.errors).flat().join('\n');
                    errorDiv.textContent = errorList;
                    errorDiv.classList.remove('hidden');
                } else if (data.success) {
                    form.reset();
                    successDiv.textContent = data.message;
                    successDiv.classList.remove('hidden');
                    setTimeout(() => {
                        successDiv.classList.add('hidden');
                    }, 4000);
                }
            })
            .catch(() => {
                errorDiv.textContent = 'Ocurrió un error al guardar el producto.';
                errorDiv.classList.remove('hidden');
            });
        });
    });
    </script>
</div>
@endsection
