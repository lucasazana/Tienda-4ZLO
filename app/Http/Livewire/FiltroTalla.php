<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class FiltroTalla extends Component
{
    public $tallas = [];
    public $tallaSeleccionada = '';
    public $categoriaSeleccionada = '';
    public $ordenPrecio = '';
    public $productos = [];
    public $categorias = ['Pantalón', 'Casacas', 'Polos'];

    public function mount()
    {
        $this->tallas = Producto::query()->distinct()->pluck('talla')->toArray();
        $this->actualizarProductos();
    }

    public function updatedTallaSeleccionada()
    {
        $this->actualizarProductos();
    }

    public function updatedCategoriaSeleccionada()
    {
        $this->actualizarProductos();
    }

    public function updatedOrdenPrecio()
    {
        $this->actualizarProductos();
    }

    public function actualizarProductos()
    {
        $query = Producto::query();

        if ($this->tallaSeleccionada) {
            $query->where('talla', $this->tallaSeleccionada);
        }

        if ($this->categoriaSeleccionada) {
            $query->where(function($q) {
                $q->where('nombre', 'like', '%'.$this->categoriaSeleccionada.'%')
                  ->orWhere('descripcion', 'like', '%'.$this->categoriaSeleccionada.'%');
            });
        }

        if ($this->ordenPrecio === 'asc') {
            $query->orderBy('precio', 'asc');
        } elseif ($this->ordenPrecio === 'desc') {
            $query->orderBy('precio', 'desc');
        }

        $this->productos = $query->get();
    }

    public function render()
    {
        return view('livewire.filtro-talla');
    }
}
