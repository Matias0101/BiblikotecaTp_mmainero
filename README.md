
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Guía de Instalación y Configuración de Laravel Backpack con spatie/laravel-permission

Esta guía describe los pasos detallados para configurar un CRUD de usuarios con **Backpack** y gestionar roles y permisos utilizando **spatie/laravel-permission** en tu proyecto Laravel.

## 1. Instalar **Backpack CRUD**

Instalá **Backpack CRUD** en tu proyecto ejecutando el siguiente comando:

```bash
composer require backpack/crud
```

## 2. Instalar Backpack

Ejecutá el siguiente comando para configurar **Backpack**. Durante este proceso, se te pedirá crear un usuario administrador para acceder al panel de administración:

```bash
php artisan backpack:install
```

## 3. Instalar **Backpack PermissionManager**

Instalá el paquete de **Backpack PermissionManager** para gestionar roles y permisos:

```bash
composer require backpack/permissionmanager
```

## 4. Instalar **spatie/laravel-permission**

Instalá el paquete **spatie/laravel-permission** que permite gestionar roles y permisos en Laravel:

```bash
composer require spatie/laravel-permission
```

## 5. Publicar las migraciones de **spatie/laravel-permission**

Publicá las migraciones que crean las tablas de roles y permisos ejecutando:

```bash
php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider"
```

## 6. Limpiar la caché de la aplicación

Asegurate de que los archivos de caché se limpien para que los cambios surtan efecto:

```bash
php artisan optimize:clear
```

## 7. Limpiar la caché de configuración

Limpia la caché de configuración para asegurarte de que todo esté actualizado:

```bash
php artisan config:clear
```

## 8. Ejecutar las migraciones

Corré las migraciones para que se creen las tablas necesarias para **roles** y **permisos**:

```bash
php artisan migrate
```

## 9. Publicar las migraciones específicas de **spatie/laravel-permission**

Publicá las migraciones relacionadas exclusivamente a **spatie/laravel-permission**:

```bash
php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider" --tag="migrations"
```

## 10. Ejecutar las migraciones nuevamente

Volvé a ejecutar las migraciones para asegurarte de que todo esté actualizado:

```bash
php artisan migrate
```

## 11. Publicar el archivo de configuración de **spatie/laravel-permission**

Para poder personalizar la configuración de permisos, publicá el archivo de configuración:

```bash
php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider" --tag="config"
```

## 12. Publicar las configuraciones y migraciones de **Backpack PermissionManager**

Ejecutá el siguiente comando para publicar los archivos de configuración y migraciones de **Backpack PermissionManager**:

```bash
php artisan vendor:publish --provider="Backpack\\PermissionManager\\PermissionManagerServiceProvider" --tag="config" --tag="migrations"
```

## 13. Modificar el menú lateral de **Backpack**

Para agregar la gestión de **Usuarios**, **Roles** y **Permisos** en el menú lateral, abrí el archivo:

```bash
resources/views/vendor/backpack/base/inc/sidebar_content.blade.php
```

Pegá el siguiente código para agregar las opciones correspondientes:

```blade
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('user') }}">
                <i class="nav-icon la la-user"></i> <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('role') }}">
                <i class="nav-icon la la-id-badge"></i> <span>Roles</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('permission') }}">
                <i class="nav-icon la la-key"></i> <span>Permissions</span>
            </a>
        </li>
    </ul>
</li>
```

## 14. Copiar las rutas de **Backpack PermissionManager**

Para asegurarte de que las rutas de **Backpack PermissionManager** estén disponibles, copiá el archivo:

```bash
vendor/backpack/permissionmanager/src/routes/backpack/permissionmanager.php
```

Y pegalo en:

```bash
routes/backpack/permissionmanager.php
```

## 15. Generar CRUD para el modelo **User**

Ejecutá el siguiente comando para generar el CRUD del modelo **User** en **Backpack**:

```bash
php artisan backpack:crud user
```

Durante el proceso de generación, se te pedirá elegir cómo definir las reglas de validación. Podés presionar **Enter** para usar la opción por defecto (`request`), lo cual es recomendado.

## 16. Acceder al CRUD de usuarios

Una vez que el CRUD esté creado, podés acceder a la gestión de usuarios desde la URL:

```bash
http://localhost:8000/admin/user
```

## 17. Asignar roles y permisos a los usuarios

Para asignar roles y permisos a los usuarios, podés utilizar **spatie/laravel-permission** de la siguiente manera:

1. Abre **Tinker**:

   ```bash
   php artisan tinker
   ```

2. Ejecutá los siguientes comandos en **Tinker**:

   ```php
   use App\Models\User;
   use Spatie\Permission\Models\Role;
   use Spatie\Permission\Models\Permission;

   // Crear un rol
   $role = Role::create(['name' => 'editor']);

   // Crear un permiso
   $permission = Permission::create(['name' => 'publish articles']);

   // Asignar el permiso al rol
   $role->givePermissionTo($permission);

   // Asignar el rol a un usuario
   $user = User::find(1);
   $user->assignRole('editor');
   ```

## 18. Limpiar el caché de permisos (opcional)

Si en algún momento hacés cambios en los roles o permisos y no se reflejan inmediatamente, podés limpiar el caché de permisos:

```bash
php artisan permission:cache-reset
```

---

### Resumen Final

1. Instalaste **Backpack CRUD** y **PermissionManager**.
2. Instalaste y configuraste **spatie/laravel-permission**.
3. Corriste las migraciones necesarias para usuarios, roles y permisos.
4. Personalizaste el menú de **Backpack** para gestionar **Usuarios**, **Roles** y **Permisos**.
5. Creaste el CRUD para **User** en **Backpack**.
6. Probaste y asignaste roles y permisos utilizando **Tinker**.



## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# BiblikotecaTp_mmainero
>>>>>>> 67f597e7ccbdf201dc0bed6ceb96bba902b4eb69
