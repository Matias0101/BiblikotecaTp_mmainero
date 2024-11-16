{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
<!-- @includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item') -->


<!-- Parametricas Dropdown -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="parametricasDropdown" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="la la-cogs nav-icon"></i> Parametricas
    </a>
    <ul class="dropdown-menu" aria-labelledby="parametricasDropdown">
        <li>
            <x-backpack::menu-item title="Usuarios" icon="la la-users" :link="backpack_url('user')" />
        </li>
        <li><x-backpack::menu-item title="países" icon="la la-globe" :link="backpack_url('country')" /></li>
        <li><x-backpack::menu-item title="Funciones" icon="la la-cogs" :link="backpack_url('position')" /></li>
        <li><x-backpack::menu-item title="Temas" icon="la la-paint-brush" :link="backpack_url('subject')" /></li>
        <li><x-backpack::menu-item title="Series" icon="la la-film" :link="backpack_url('serie')" /></li>
        <li><x-backpack::menu-item title="Autores" icon="la la-pen-alt" :link="backpack_url('author')" /></li>
        <li><x-backpack::menu-item title="Editoriales" icon="la la-building" :link="backpack_url('publisher')" /></li>

        <li><x-backpack::menu-item title="Libros" icon="la la-book" :link="backpack_url('book')" /></li>
    
        <li><x-backpack::menu-item title="Prestamos de Libros" icon="la la-book" :link="backpack_url('book-loans')" /></li>
         
        <li><x-backpack::menu-item title="Ediciones" icon="la la-calendar" :link="backpack_url('edition')" /></li>
        <!-- <li><x-backpack::menu-item title="Translation Manager" icon="la la-language" :link="backpack_url('translation-manager')" /></li> -->
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon la la-users"></i> Authentication
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> Users</a></li>
        <li><a class="dropdown-item" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> Roles</a></li>
        <li><a class="dropdown-item" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> Permissions</a></li>
    </ul>
</li>


<!-- Users, Roles, Permissions -->
<!-- <li class="nav-item nav-dropdown">
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
</li> -->


<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />