{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')


<!--<x-backpack::menu-item title="Users" icon="la la-users" :link="backpack_url('user')" />
 <x-backpack::menu-item title="Countries" icon="la la-globe" :link="backpack_url('country')" />
<x-backpack::menu-item title="Funtions" icon="la la-cogs" :link="backpack_url('funtion')" />
<x-backpack::menu-item title="Themes" icon="la la-paint-brush" :link="backpack_url('theme')" />
<x-backpack::menu-item title="Series" icon="la la-film" :link="backpack_url('serie')" /> -->

<!-- 
 -->
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
        <li>
            <x-backpack::menu-item title="países" icon="la la-globe" :link="backpack_url('country')" />
        </li>
        <li>
            <x-backpack::menu-item title="Funciones" icon="la la-cogs" :link="backpack_url('position')" />
        </li>
        <li>
            <!-- <x-backpack::menu-item title="Themes" icon="la la-paint-brush" :link="backpack_url('theme')" /> -->
            <x-backpack::menu-item title="Temas" icon="la la-paint-brush" :link="backpack_url('subject')" />
        </li>
        <li>
            <x-backpack::menu-item title="Series" icon="la la-film" :link="backpack_url('serie')" />
        </li>
        <li>
            <x-backpack::menu-item title="Autores" icon="la la-pen-alt" :link="backpack_url('author')" />
        </li>
        <li>
            <x-backpack::menu-item title="Editoriales" icon="la la-building" :link="backpack_url('publisher')" />
        </li>

        <li>
            <x-backpack::menu-item title="Libros" icon="la la-book" :link="backpack_url('book')" />
        </li>
        <!-- <li><x-backpack::menu-item title="Miembros" icon="la la-users" :link="backpack_url('member')" /></li> -->

        <li><x-backpack::menu-item title="Prestamos de Libros" icon="la la-book" :link="backpack_url('book-loans')" /></li>

        <!-- <li><x-backpack::menu-item title="Loan configurations" icon="la la-cogs" :link="backpack_url('loan-configuration')" /></li> -->
        <!-- <li><x-backpack::menu-item title="Series" icon="la la-list" :link="backpack_url('serie')" /></li> -->
         
        <li><x-backpack::menu-item title="Ediciones" icon="la la-calendar" :link="backpack_url('edition')" /></li>

        <li>
        <x-backpack::menu-item title="Translation Manager" icon="la la-language" :link="backpack_url('translation-manager')" />

        </li>
    </ul>
</li>


<x-backpack::menu-dropdown title="Administración" icon="la la-shield">
    <x-backpack::menu-dropdown-item title="Usuarios" icon="la la-user" :link="backpack_url('user')" />
    <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" />
    <x-backpack::menu-dropdown-item title="Permisos" icon="la la-key" :link="backpack_url('permission')" />
</x-backpack::menu-dropdown>



<!-- tablas intermedias -->
<!-- <x-backpack::menu-item title="Book subjects" icon="la la-question" :link="backpack_url('book-subject')" />
<x-backpack::menu-item title="Book publishers" icon="la la-question" :link="backpack_url('book-publisher')" /> -->
<!--  <x-backpack::menu-item title="Book authors" icon="la la-user_edit" :link="backpack_url('book-author')" /> -->




<!-- <x-backpack::menu-item title="Book series" icon="la la-question" :link="backpack_url('book-serie')" /> -->

<!-- <x-backpack::menu-item title="Book editions" icon="la la-question" :link="backpack_url('book-edition')" /> -->
<x-backpack::menu-item title="Translation Manager" icon="la la-language" :link='backpack_url('translation-manager')" />
<x-backpack::menu-item title="Add-ons" icon="la la-plug" :link="backpack_url('addons')" />
<x-backpack::menu-item title="Páginas" icon="la la-file" :link="backpack_url('page')" />

