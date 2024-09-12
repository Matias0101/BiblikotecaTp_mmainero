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
            <x-backpack::menu-item title="Users" icon="la la-users" :link="backpack_url('user')" />
        </li>
        <li>
            <x-backpack::menu-item title="Countries" icon="la la-globe" :link="backpack_url('country')" />
        </li>
        <li>
            <x-backpack::menu-item title="Positions" icon="la la-cogs" :link="backpack_url('position')" />
        </li>
        <li>
            <!-- <x-backpack::menu-item title="Themes" icon="la la-paint-brush" :link="backpack_url('theme')" /> -->
            <x-backpack::menu-item title="Subjects" icon="la la-paint-brush" :link="backpack_url('subject')" />
        </li>
        <li>
            <x-backpack::menu-item title="Series" icon="la la-film" :link="backpack_url('serie')" />
        </li>
        <li>
            <x-backpack::menu-item title="Authors" icon="la la-pen-alt" :link="backpack_url('author')" />
        </li>
        <li>
            <x-backpack::menu-item title="Publishers" icon="la la-building" :link="backpack_url('publisher')" />
        </li>

        <li>
            <x-backpack::menu-item title="Books" icon="la la-book" :link="backpack_url('book')" />
        </li>
        <li><x-backpack::menu-item title="Members" icon="la la-users" :link="backpack_url('member')" /></li>
        <li><x-backpack::menu-item title="Book loans" icon="la la-book" :link="backpack_url('book-loans')" /></li>
        <li><x-backpack::menu-item title="Loan configurations" icon="la la-cogs" :link="backpack_url('loan-configuration')" /></li>
        <li><x-backpack::menu-item title="Series" icon="la la-list" :link="backpack_url('serie')" /></li>
        <li><x-backpack::menu-item title="Editions" icon="la la-calendar" :link="backpack_url('edition')" /></li>
    </ul>
</li>





<!-- tablas intermedias -->
<!-- <x-backpack::menu-item title="Book subjects" icon="la la-question" :link="backpack_url('book-subject')" />
<x-backpack::menu-item title="Book publishers" icon="la la-question" :link="backpack_url('book-publisher')" /> -->
<!--  <x-backpack::menu-item title="Book authors" icon="la la-user_edit" :link="backpack_url('book-author')" /> -->




<!-- <x-backpack::menu-item title="Book series" icon="la la-question" :link="backpack_url('book-serie')" /> -->

<!-- <x-backpack::menu-item title="Book editions" icon="la la-question" :link="backpack_url('book-edition')" /> -->