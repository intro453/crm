<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-1">
            <button class="btn btn-flat-secondary d-lg-none me-1" type="button" data-menu-toggle="true">
                <i data-feather="menu"></i>
            </button>
            <div>
                <div class="fw-bolder text-body">Админ</div>
                <small class="text-muted">{{ config('app.name', 'CRM') }}</small>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="text-end me-1 d-none d-sm-block">
                <div class="fw-bold text-body">{{ auth()->user()->name ?: 'Администратор' }}</div>
                <small class="text-muted">ID: {{ auth()->id() }}</small>
            </div>
            <div class="avatar bg-light-primary text-primary fw-bold">
                @php($initial = \Illuminate\Support\Str::substr(auth()->user()->name ?? '', 0, 1))
                <span>{{ \Illuminate\Support\Str::upper($initial ?: 'A') }}</span>
            </div>
        </div>
    </div>
</nav>
