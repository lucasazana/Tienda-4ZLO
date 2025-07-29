<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class FiltroTalla extends Component
{
    public $tallas = [];
    public $tallaSeleccionada = '';
    public $productos = [];

    public function mount()
    {
        $this->tallas = Producto::query()->distinct()->pluck('talla')->toArray();
        $this->productos = Producto::all();
    }

    public function updatedTallaSeleccionada($value)
    {
        if ($value) {
            $this->productos = Producto::where('talla', $value)->get();
        } else {
            $this->productos = Producto::all();
        }
    }

    public function render()
    {
        return view('livewire.filtro-talla');
    }
}
