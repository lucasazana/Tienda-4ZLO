<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class FiltroProductos extends Component
{
    use WithPagination;

    public $tallas = [];
    public $categorias = [];
    public $precio_orden = '';
    public $perPage = 12;
    public $buscar = '';

    protected $updatesQueryString = ['tallas', 'categorias', 'precio_orden', 'buscar'];

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Producto::query()
            ->where(function($q) {
                $q->where('estado', 1)
                    ->orWhere(function($q2) {
                        $q2->where('estado', 0)
                            ->where(function($q3) {
                                $q3->whereNull('no_disponible_desde')
                                    ->orWhere('no_disponible_desde', '>', now()->subDay());
                            });
                    });
            });

        if (!empty($this->buscar)) {
            $query->where(function($q) {
                $q->where('nombre', 'like', '%' . $this->buscar . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->buscar . '%');
            });
        }

        if (!empty($this->tallas)) {
            $query->whereIn('talla', $this->tallas);
        }
        if (!empty($this->categorias)) {
            $query->whereIn('categoria', $this->categorias);
        }
        if ($this->precio_orden === 'asc') {
            $query->orderBy('precio', 'asc');
        } elseif ($this->precio_orden === 'desc') {
            $query->orderBy('precio', 'desc');
        } else {
            $query->inRandomOrder();
        }

        $productos = $query->paginate($this->perPage);

        // Opciones únicas para filtros
        $tallasDisponibles = Producto::select('talla')->distinct()->pluck('talla');
        $categoriasDisponibles = Producto::select('categoria')->distinct()->pluck('categoria');

        return view('livewire.filtro-productos', [
            'productos' => $productos,
            'tallasDisponibles' => $tallasDisponibles,
            'categoriasDisponibles' => $categoriasDisponibles,
        ]);
    }
}
