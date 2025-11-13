@extends('admin.layouts.app')

@section('title', 'Редактирование пользователя')
@section('layout-title', 'Админ')
@section('page-title', 'Редактирование пользователя')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status') === 'user-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>Основные данные пользователя обновлены.</span>
                </div>
            @elseif(session('status') === 'password-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>Пароль пользователя обновлён.</span>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        Пользователь № {{ $user->id }}
                        <span class="fw-bolder">{{ $user->full_name ?: '—' }}</span>
                        <span class="text-muted">({{ $user->login }})</span>
                    </h4>
                    <p class="text-muted mb-2">Регистрация {{ $user->created_at?->format('d.m.Y') }}</p>

                    <div class="pt-1 border-top"></div>

                    <h5 class="fw-bolder mt-2 mb-1">Основные данные</h5>
                    <form class="mt-1" method="post" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="row gy-1">
                            <div class="col-md-6">
                                <label class="form-label" for="role">Роль<span class="text-danger">*</span></label>
                                <select
                                    id="role"
                                    name="role"
                                    class="form-select @error('role') is-invalid @enderror"
                                >
                                    <option value="" disabled {{ old('role', $user->role) ? '' : 'selected' }}>Выберите роль</option>
                                    @foreach($roles as $roleValue => $roleLabel)
                                        <option value="{{ $roleValue }}" @selected(old('role', $user->role) === $roleValue)>
                                            {{ $roleLabel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="is_active">Аккаунт<span class="text-danger">*</span></label>
                                <select
                                    id="is_active"
                                    name="is_active"
                                    class="form-select @error('is_active') is-invalid @enderror"
                                >
                                    @php($activeValue = (string) old('is_active', $user->is_active ? '1' : '0'))
                                    <option value="1" @selected($activeValue === '1')>Активен</option>
                                    <option value="0" @selected($activeValue === '0')>Заблокирован</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="last_name">Фамилия<span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    placeholder="Иванова"
                                >
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="first_name">Имя<span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    value="{{ old('first_name', $user->first_name) }}"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    placeholder="Татьяна"
                                >
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="middle_name">Отчество</label>
                                <input
                                    type="text"
                                    id="middle_name"
                                    name="middle_name"
                                    value="{{ old('middle_name', $user->middle_name) }}"
                                    class="form-control @error('middle_name') is-invalid @enderror"
                                    placeholder="Александровна"
                                >
                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="login">Логин<span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    id="login"
                                    name="login"
                                    value="{{ old('login', $user->login) }}"
                                    class="form-control @error('login') is-invalid @enderror"
                                    placeholder="login"
                                >
                                @error('login')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </form>

                    <div class="pt-2 mt-2 border-top"></div>

                    <h5 class="fw-bolder mt-2 mb-1">Смена пароля</h5>
                    <form class="mt-1" method="post" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="password_form" value="1">

                        <div class="row gy-1">
                            <div class="col-md-6">
                                <label class="form-label" for="new_password">Новый пароль<span class="text-danger">*</span></label>
                                <input
                                    type="password"
                                    id="new_password"
                                    name="password"
                                    class="form-control @error('password', 'passwordUpdate') is-invalid @enderror"
                                    placeholder="Введите новый пароль"
                                >
                                <small class="text-muted">не менее 8 символов</small>
                                @error('password', 'passwordUpdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="new_password_confirmation">Повтор пароля<span class="text-danger">*</span></label>
                                <input
                                    type="password"
                                    id="new_password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Повторите пароль"
                                >
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
