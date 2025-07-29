<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 4ZLO - Catálogo de Ropa Vintage & Streetwear

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?style=flat-square&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38bdf8?style=flat-square&logo=tailwindcss)
![Livewire](https://img.shields.io/badge/Livewire-3.x-blue?style=flat-square&logo=laravel)
![Cloudinary](https://img.shields.io/badge/Cloudinary-Image%20Storage-blue?style=flat-square&logo=cloudinary)

## Descripción

4ZLO es una tienda online de ropa americana vintage y streetwear, desarrollada con Laravel, Tailwind CSS, Livewire y Alpine.js. Permite a los administradores gestionar productos, imágenes y disponibilidad, y a los usuarios explorar, reservar prendas únicas.

## Características principales

- Catálogo de productos totalmente responsivo
- Vista de detalle con galería y lightbox
- Panel de administración para crear, editar y eliminar productos
- Subida de imágenes a Cloudinary
- Eliminación automática de productos no disponibles tras 2 días
- Estilos modernos con Tailwind y animaciones
- Botón de WhatsApp para reservas rápidas

## Tecnologías utilizadas

- Laravel 10+
- Tailwind CSS 3+
- Livewire
- Alpine.js
- Cloudinary (almacenamiento de imágenes)
- MySQL/SQLite

## Instalación

1. Clona el repositorio:

   ```bash
   git clone https://github.com/tuusuario/4zlo.git
   cd 4zlo
   ```

2. Instala dependencias:

   ```bash
   composer install
   npm install && npm run build
   ```

3. Copia y configura tu archivo `.env`:

   ```bash
   cp .env.example .env
   # Edita las variables de base de datos y Cloudinary
   ```

> **Base de datos:**
> - Este proyecto soporta MySQL y SQLite. Puedes usar XAMPP (MySQL) para pruebas locales o una base de datos real en producción.
> - Antes de ejecutar las migraciones, edita tu archivo `.env` con los datos de tu base de datos (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.).
> - Para pruebas rápidas, puedes usar SQLite creando un archivo vacío en `database/database.sqlite` y configurando `DB_CONNECTION=sqlite` en tu `.env`.

4. Genera la clave de la app y ejecuta migraciones:

   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

5. Inicia el servidor:

   ```bash
   php artisan serve
   ```

> **Nota:** Breeze y Livewire ya están instalados y configurados en este proyecto. No es necesario ejecutar `composer require laravel/breeze` ni `composer require livewire/livewire` manualmente. Solo usa `composer install` y `npm install` para tener todo listo.

> Para desarrollo local, usa `npm run dev` para recarga automática de assets. Para producción, usa `npm run build`.

## ¿Cómo trabajar en desarrollo local?

Para que los cambios en tus archivos CSS y JS (Tailwind, Alpine, Livewire, etc.) se reflejen automáticamente mientras desarrollas, sigue este flujo:

1. Abre una terminal y ejecuta:
   ```bash
   npm run dev
   ```
   Esto iniciará el watcher de Vite/Tailwind y recompilará los assets cada vez que guardes un archivo. Así verás los cambios en tiempo real en el navegador.

2. En otra terminal, ejecuta:
   ```bash
   php artisan serve
   ```
   Esto levanta el servidor local de Laravel.

> Si solo ejecutas `npm run build`, los assets se compilan una vez y no se actualizan automáticamente. Usa `npm run dev` siempre que estés trabajando activamente en el proyecto.

## Automatización de limpieza de productos

El sistema elimina automáticamente los productos marcados como "no disponible" después de 2 días. Para que esto funcione en producción, configura el cron de Laravel:

```
* * * * * cd /ruta/a/tu/proyecto && php artisan schedule:run >> /dev/null 2>&1
```

## Despliegue

- Sube el proyecto a tu servidor/hosting
- Configura el entorno `.env` y el cron
- Asegúrate de tener PHP, Composer y Node.js instalados

## ¿Cómo desplegar en producción?

1. Sube el proyecto a tu servidor o hosting.
2. Ejecuta:
   ```bash
   composer install
   npm install
   npm run build
   ```
   Esto compila los assets optimizados y minificados para producción.
3. Configura tu archivo `.env` con los datos de producción (base de datos, Cloudinary, etc.).
4. Ejecuta las migraciones y genera la clave si es necesario:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
5. Configura el cron para el scheduler de Laravel:
   ```
   * * * * * cd /ruta/a/tu/proyecto && php artisan schedule:run >> /dev/null 2>&1
   ```
6. Usa un servidor web real (Apache, Nginx, etc.) apuntando al directorio `public/` de tu proyecto. No uses `php artisan serve` en producción.

> En producción, no es necesario ejecutar `npm run dev`. Solo usa `npm run build` para compilar los assets una vez.

## Stack y enfoque

- Proyecto Laravel sin Breeze, Jetstream ni starter kits: toda la autenticación, panel y lógica fueron hechos a mano para mayor control y personalización.
- Inspiración visual y de UX en ideas de [reactbits.dev](https://reactbits.dev), adaptadas y extendidas para el stack Laravel + Blade + Tailwind.
- Componentes y layouts diseñados a medida, sin plantillas externas.

> **Sobre Breeze y Livewire:**
> Este proyecto incluye Breeze y Livewire como dependencias. Breeze se utilizó únicamente para la autenticación básica (login, registro, etc.), pero toda la interfaz de usuario y la lógica del catálogo y panel de administración fueron desarrolladas a mano, sin usar los componentes Blade ni el frontend por defecto de Breeze. No es necesario instalar Breeze ni Livewire manualmente: ambos ya están incluidos en composer.json y se instalan automáticamente con `composer install`.

## Créditos y agradecimientos


## Licencia

MIT

---

> _Este es mi primer proyecto completo en mi carrera como desarrollador. Aunque es sencillo, representa un gran paso en mi aprendizaje y dedicación. ¡Gracias a quienes me apoyaron y a quienes revisen mi trabajo!_

¡Gracias por visitar este proyecto!
Desarrollado con dedicación por Lucas (xeya).
Si tienes dudas, sugerencias o quieres colaborar, no dudes en abrir un issue o pull request.
¡Tu feedback y participación son siempre bienvenidos!
