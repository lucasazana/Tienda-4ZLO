
<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// aqui puedes poner comandos personalizados para la consola de artisan
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
