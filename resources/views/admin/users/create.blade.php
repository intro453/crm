@extends('admin.layouts.app')

@section('title', 'Новый пользователь')
@section('layout-title', 'Админ')
@section('page-title', 'Новый пользователь')

@section('content')
    <div class="row">
        <div class="col-12 col-xl-8 col-lg-9 col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Новый пользователь</h4>

                    <form class="mt-1" method="post" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div class="row gy-1">
                            <div class="col-md-6">
                                <label class="form-label" for="role">Роль<span class="text-danger">*</span></label>
                                <select
                                    id="role"
                                    name="role"
                                    class="form-select @error('role') is-invalid @enderror"
                                >
                                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Выберите роль</option>
                                    @foreach($roles as $roleValue => $roleLabel)
                                        <option value="{{ $roleValue }}" @selected(old('role') === $roleValue)>{{ $roleLabel }}</option>
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
                                    <option value="1" @selected((string) old('is_active', '1') === '1')>Активен</option>
                                    <option value="0" @selected((string) old('is_active', '1') === '0')>Заблокирован</option>
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
                                    value="{{ old('last_name') }}"
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
                                    value="{{ old('first_name') }}"
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
                                    value="{{ old('middle_name') }}"
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
                                    value="{{ old('login') }}"
                                    class="form-control @error('login') is-invalid @enderror"
                                    placeholder="login"
                                >
                                @error('login')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="password">Пароль<span class="text-danger">*</span></label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Введите пароль"
                                >
                                <small class="text-muted">не менее 8 символов</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="password_confirmation">Повтор пароля<span class="text-danger">*</span></label>
                                <input
                                    type="password"
                                    id="password_confirmation"
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
