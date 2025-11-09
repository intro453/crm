<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ route('main') }}">
                    <span class="brand-logo">
                        <i data-feather="layers"></i>
                    </span>
                    <h2 class="brand-text fw-bolder mb-0">{{ $layoutTitle }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate">Заявки</span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate">Клиенты</span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user-check"></i><span class="menu-title text-truncate">Пользователи</span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="tag"></i><span class="menu-title text-truncate">Теги заявок</span></a></li>
            <li class=" nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.profile') }}">
                    <i data-feather="user"></i><span class="menu-title text-truncate">Ваш профиль</span>
                </a>
            </li>
        </ul>
    </div>
</div>
