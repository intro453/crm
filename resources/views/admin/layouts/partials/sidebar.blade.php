<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ route('admin.profile') }}">
                    <span class="brand-logo">
                        <img src="{{ asset('vuexy/app-assets/images/logo/logo.svg') }}" alt="Logo" height="24">
                    </span>
                    <h2 class="brand-text">CRM</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">Главная</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate">Заявки</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">Клиенты</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="pie-chart"></i>
                    <span class="menu-title text-truncate">Отчеты</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="book"></i>
                    <span class="menu-title text-truncate">Теги заявок</span>
                </a>
            </li>
            <li class="navigation-header">
                <span>Профиль</span>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.profile') }}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate">Ваш профиль</span>
                </a>
            </li>
        </ul>
    </div>
</div>
