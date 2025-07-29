<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Producto;
use Carbon\Carbon;

// elimina productos que han estado no disponibles por más de 48 horas
class EliminarProductosNoDisponibles extends Command
{
    protected $signature = 'productos:eliminar-no-disponibles';
    protected $description = 'Elimina productos marcados como no disponibles hace más de 48 horas';

    public function handle()
    {
        $productos = Producto::where('estado', 0)
            ->whereNotNull('no_disponible_desde')
            ->where('no_disponible_desde', '<', Carbon::now()->subDays(2))
            ->get();

        $total = 0;
        foreach ($productos as $producto) {

            // eliminar las imagenes asociadas
            if (method_exists($producto, 'imagenes')) {
                $producto->imagenes()->delete();
            }
            $producto->delete();
            $total++;
        }
        $this->info("Productos eliminados: $total");
    }
}
