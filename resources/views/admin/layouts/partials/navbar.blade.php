@php
    $user = auth()->user();
    $fullName = trim(collect([$user->last_name ?? null, $user->first_name ?? null, $user->middle_name ?? null])->filter()->implode(' '));
    if ($fullName === '') {
        $fullName = $user->name ?? 'Администратор';
    }
    $roleLabel = $user->role ?? 'admin';
    $currentDate = \Illuminate\Support\Carbon::now()->locale('ru')->isoFormat('dddd, DD MMMM YYYY');
@endphp
<header class="admin-header">
    <div>
        <div class="admin-header__title">{{ $layoutTitle }}</div>
        <div class="admin-header__meta">
            <span>{{ $currentDate }}</span>
            @if(!empty($breadcrumbsContent))
                {!! $breadcrumbsContent !!}
            @else
                <a href="#">Главная</a>
            @endif
        </div>
    </div>
    <div class="admin-header__user">
        <div class="admin-header__user-name">{{ $fullName }}</div>
        <div class="admin-header__user-role">{{ $roleLabel }}</div>
    </div>
</header>
