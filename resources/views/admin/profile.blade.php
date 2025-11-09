@extends('admin.layouts.app')

@section('title', 'Ваш профиль')
@section('layout-title', 'Админ')
@section('page-title', 'Ваш профиль')

@section('content')
    @php
        $roleValue = $user->role ?? 'admin';
        $registeredAt = $user->created_at
            ? $user->created_at->copy()->locale('ru')->isoFormat('DD MMMM YYYY')
            : '—';
    @endphp
    <div class="row">
        <div class="col-12 col-xl-8 col-lg-9 col-md-10 mx-auto">
            @if(session('status') === 'profile-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>Профиль успешно обновлён.</span>
                </div>
            @endif
            @if(session('status') === 'password-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="lock" class="me-50"></i>
                    <span>Пароль успешно изменён.</span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Ваш профиль</h4>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-1">
                        <div>
                            <h5 class="fw-bolder mb-25">Основные данные</h5>
                        </div>
                    </div>

                    <form class="validate-form mt-1" method="post" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('put')
                        <div class="row gy-1">
                            <div class="col-md-6">
                                <label class="form-label" for="last_name">Фамилия</label>
                                <input
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    placeholder="Иванова"
                                >
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="first_name">Имя</label>
                                <input
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name', $user->first_name) }}"
                                    placeholder="Татьяна"
                                >
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="middle_name">Отчество</label>
                                <input
                                    type="text"
                                    id="middle_name"
                                    name="middle_name"
                                    class="form-control @error('middle_name') is-invalid @enderror"
                                    value="{{ old('middle_name', $user->middle_name) }}"
                                    placeholder="Александровна"
                                >
                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="login">Логин</label>
                                <input
                                    type="text"
                                    id="login"
                                    name="login"
                                    class="form-control"
                                    value="{{ old('login', $user->login) }}"
                                    placeholder="admin"
                                    disabled
                                >
                                @error('login')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-2">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-1">
                        <div>
                            <h5 class="fw-bolder mb-25">Смена пароля</h5>
                            <p class="text-muted mb-0">Укажите текущий и новый пароль для аккаунта.</p>
                        </div>
                    </div>

                    <form class="validate-form mt-1" method="post" action="{{ route('admin.profile.password') }}">
                        @csrf
                        @method('put')
                        <div class="row gy-1">
                            <div class="col-md-6">
                                <label class="form-label" for="current_password">Текущий пароль</label>
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-control @error('current_password', 'passwordUpdate') is-invalid @enderror"
                                    placeholder="Введите текущий пароль"
                                >
                                @error('current_password', 'passwordUpdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="password">Новый пароль</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password', 'passwordUpdate') is-invalid @enderror"
                                    placeholder="Введите новый пароль"
                                >
                                @error('password', 'passwordUpdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="password_confirmation">Повтор пароля</label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Повторите новый пароль"
                                >
                            </div>
                            <div class="col-12 d-flex justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </form>

                    <div class="row gy-2 mt-2 pt-1 border-top">
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex align-items-center border rounded p-1">
                                <span class="avatar bg-light-primary me-75">
                                    <div class="avatar-content"><i data-feather="shield" class="text-primary"></i></div>
                                </span>
                                <div>
                                    <p class="fw-bolder mb-0 text-body">Роль</p>
                                    <small class="text-muted text-capitalize">{{ $roleValue }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex align-items-center border rounded p-1">
                                <span class="avatar bg-light-success me-75">
                                    <div class="avatar-content"><i data-feather="hash" class="text-success"></i></div>
                                </span>
                                <div>
                                    <p class="fw-bolder mb-0 text-body">ID</p>
                                    <small class="text-muted">{{ $user->id }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex align-items-center border rounded p-1">
                                <span class="avatar bg-light-warning me-75">
                                    <div class="avatar-content"><i data-feather="calendar" class="text-warning"></i></div>
                                </span>
                                <div>
                                    <p class="fw-bolder mb-0 text-body">Дата регистрации</p>
                                    <small class="text-muted">{{ $registeredAt }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
