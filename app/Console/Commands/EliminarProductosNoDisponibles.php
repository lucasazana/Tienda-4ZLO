<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Producto;
use Carbon\Carbon;

class EliminarProductosNoDisponibles extends Command
{
    protected $signature = 'productos:eliminar-no-disponibles';
    protected $description = 'Elimina productos marcados como no disponibles hace más de 24 horas';

    public function handle()
    {
        $productos = Producto::where('estado', 0)
            ->whereNotNull('no_disponible_desde')
            ->where('no_disponible_desde', '<', Carbon::now()->subDays(2))
            ->get();

        $total = 0;
        foreach ($productos as $producto) {
            // Eliminar imágenes asociadas
            if (method_exists($producto, 'imagenes')) {
                $producto->imagenes()->delete();
            }
            $producto->delete();
            $total++;
        }
        $this->info("Productos eliminados: $total");
    }
}
