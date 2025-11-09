<div class="admin-sidebar">
    <div>
        <div class="sidebar-title">{{ $layoutTitle }}</div>
        <div class="sidebar-subtitle">{{ config('app.name', 'CRM') }}</div>
    </div>
    <nav>
        <ul class="sidebar-nav">
            <li><a href="#">Заявки</a></li>
            <li><a href="#">Клиенты</a></li>
            <li><a href="#">Пользователи</a></li>
            <li><a href="#">Теги заявок</a></li>
            <li class="sidebar-section-title">Профиль</li>
            <li class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}"><a href="{{ route('admin.profile') }}">Ваш профиль</a></li>
        </ul>
    </nav>
</div>
