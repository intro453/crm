@php
    $user = auth()->user();
    $fullName = trim(collect([$user->last_name ?? null, $user->first_name ?? null, $user->middle_name ?? null])->filter()->implode(' '));
    if ($fullName === '') {
        $fullName = $user->name ?? 'Администратор';
    }
    $roleLabel = $user->role ?? 'admin';
    $currentDate = \Illuminate\Support\Carbon::now()->locale('ru')->isoFormat('dddd, DD MMMM YYYY');
@endphp
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
            <span class="fw-bolder text-body">{{ \Illuminate\Support\Str::ucfirst($currentDate) }}</span>
            <a class="ms-md-2 mt-25 mt-md-0 text-primary" href="{{ route('main') }}">Главная</a>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown-user">
                <a class="nav-link dropdown-user-link" href="#">
                    <div class="user-nav d-flex flex-column text-end me-1">
                        <span class="user-name fw-bolder">{{ $fullName }}</span>
                        <span class="user-status text-capitalize">{{ $roleLabel }}</span>
                    </div>
                    {{--logout--}}
                </a>
            </li>
        </ul>
    </div>
</nav>
