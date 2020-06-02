<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SGAM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/home')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/list-nursings')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('show-nursings') }}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Listar cuidados</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
    @hasanyrole('admin|tens')
    <!-- Heading -->
    <div class="sidebar-heading">
        Administración
    </div>
    @endhasanyrole
    <!-- Nav Item - Pages Collapse Menu -->
    @role('admin')
    <li class="nav-item {{ (request()->is('admin/users*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('users-list')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span></a>
    </li>
    @endrole
    @hasanyrole('admin|tens')
    <li class="nav-item {{ (request()->is('admin/clients*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('clients-list')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Apoderados</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/residents*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('residents-list')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Residentes</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/nursings*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('nursings-list')}}">
            <i class="fas fa-book-medical"></i>
            <span>Cuidados</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    @endhasanyrole
    <!-- Divider -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
