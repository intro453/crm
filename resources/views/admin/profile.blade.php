@extends('admin.layouts.app')

@section('title', 'Ваш профиль')
@section('page-title', 'Ваш профиль')

@section('content')
@php
    $fullName = trim(collect([$user->last_name, $user->first_name, $user->middle_name])->filter()->implode(' '));
    $fullName = $fullName !== '' ? $fullName : ($user->name ?? 'Администратор');
    $roleMap = [
        'admin' => 'Администратор',
        'manager' => 'Менеджер',
        'lawyer' => 'Юрист',
    ];
@endphp
<div class="row match-height">
    <div class="col-xl-8 col-lg-7 col-md-12">
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success" role="alert">
                Профиль успешно обновлён.
            </div>
        @endif

        <div class="card mb-2">
            <div class="card-header border-bottom">
                <div>
                    <h4 class="card-title mb-25">Основные данные</h4>
                    <span class="text-muted">Редактируйте основные данные вашей учётной записи.</span>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.update') }}" class="row g-1">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="last_name">Фамилия</label>
                            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Введите фамилию" value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="first_name">Имя</label>
                            <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Введите имя" value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="middle_name">Отчество</label>
                            <input type="text" id="middle_name" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Введите отчество" value="{{ old('middle_name', $user->middle_name) }}">
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label class="form-label" for="login">Логин</label>
                            <input type="text" id="login" name="login" class="form-control @error('login') is-invalid @enderror" placeholder="Укажите логин" value="{{ old('login', $user->login) }}">
                            @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label class="form-label" for="email">Электронная почта</label>
                            <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom">
                <div>
                    <h4 class="card-title mb-25">Смена пароля</h4>
                    <span class="text-muted">Задайте новый пароль для входа в систему.</span>
                </div>
            </div>
            <div class="card-body">
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success" role="alert">
                        Пароль успешно обновлён.
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.profile.password') }}" class="row g-1">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="current_password">Текущий пароль</label>
                            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password', 'passwordUpdate') is-invalid @enderror" placeholder="Введите текущий пароль">
                            @error('current_password', 'passwordUpdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="password">Новый пароль</label>
                            <input type="password" id="password" name="password" class="form-control @error('password', 'passwordUpdate') is-invalid @enderror" placeholder="Введите новый пароль">
                            @error('password', 'passwordUpdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="password_confirmation">Повтор пароля</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Повторите новый пароль">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5 col-md-12">
        <div class="card">
            <div class="card-body text-center">
                <div class="avatar avatar-xl bg-light-primary text-primary fw-bolder mb-2 mx-auto">
                    @php($initial = \Illuminate\Support\Str::substr($fullName, 0, 1))
                    <span>{{ \Illuminate\Support\Str::upper($initial ?: 'A') }}</span>
                </div>
                <h4 class="fw-bolder mb-25">{{ $fullName }}</h4>
                <div class="badge badge-light-primary mb-2">{{ $roleMap[$user->role] ?? $user->role }}</div>
                <p class="text-muted mb-2">{{ $user->email }}</p>
                <div class="divider divider-dashed">
                    <div class="divider-text">Информация</div>
                </div>
                <dl class="row mb-0 text-start">
                    <dt class="col-6 text-muted">ID пользователя</dt>
                    <dd class="col-6 text-end text-body">{{ $user->id }}</dd>
                    <dt class="col-6 text-muted">Логин</dt>
                    <dd class="col-6 text-end text-body">{{ $user->login ?? '—' }}</dd>
                    <dt class="col-6 text-muted">Статус</dt>
                    <dd class="col-6 text-end text-body">{{ $user->is_active ? 'Активен' : 'Не активен' }}</dd>
                    <dt class="col-6 text-muted">Дата регистрации</dt>
                    <dd class="col-6 text-end text-body">{{ optional($user->created_at)->format('d.m.Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
