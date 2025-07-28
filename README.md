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

4ZLO es una tienda online de ropa americana vintage y streetwear, desarrollada con Laravel, Tailwind CSS, Livewire y Alpine.js. Permite a los administradores gestionar productos, imágenes y disponibilidad, y a los usuarios explorar, reservar y comprar prendas únicas.

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

## Automatización de limpieza de productos

El sistema elimina automáticamente los productos marcados como "no disponible" después de 2 días. Para que esto funcione en producción, configura el cron de Laravel:

```
* * * * * cd /ruta/a/tu/proyecto && php artisan schedule:run >> /dev/null 2>&1
```

## Despliegue

- Sube el proyecto a tu servidor/hosting
- Configura el entorno `.env` y el cron
- Asegúrate de tener PHP, Composer y Node.js instalados

## Stack y enfoque

- Proyecto Laravel sin Breeze, Jetstream ni starter kits: toda la autenticación, panel y lógica fueron hechos a mano para mayor control y personalización.
- Inspiración visual y de UX en ideas de [reactbits.dev](https://reactbits.dev), adaptadas y extendidas para el stack Laravel + Blade + Tailwind.
- Componentes y layouts diseñados a medida, sin plantillas externas.

## Créditos y agradecimientos

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Livewire](https://laravel-livewire.com)
- [Alpine.js](https://alpinejs.dev)
- [Cloudinary](https://cloudinary.com)
- Inspiración visual: [reactbits.dev](https://reactbits.dev)

---

MIT

---

¡Gracias por visitar este proyecto! Si tienes dudas, sugerencias o quieres colaborar, abre un issue o pull request.

<!--
Más detalles, capturas de pantalla y documentación pueden agregarse aquí.
-->
