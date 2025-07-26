<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'medida',
        'talla',
        'categoria',
        'estado_ropa',
        'precio',
        'estado',
        'imagen_url',
    ];
}
