@extends('admin.layouts.app')

@section('title', 'Ваш профиль')
@section('layout-title', 'Админ')

@push('styles')
    <style>
        .profile-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            padding-top: 32px;
        }

        .profile-card {
            width: 100%;
            max-width: 720px;
            background: #ffffff;
            border-radius: 28px;
            box-shadow: var(--card-shadow);
            padding: 36px 40px;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .profile-card__title {
            font-size: 26px;
            font-weight: 600;
            margin: 0;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .profile-section + .profile-section {
            border-top: 1px solid var(--border-color);
            padding-top: 24px;
        }

        .profile-section__header {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .profile-section__title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .profile-section__subtitle {
            margin: 0;
            font-size: 14px;
            color: var(--muted-color);
        }

        .profile-alert {
            border-radius: 16px;
            padding: 14px 18px;
            font-size: 14px;
            font-weight: 500;
            background-color: rgba(82, 196, 26, 0.1);
            color: #3f8f1b;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-form__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .profile-form__field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .profile-form__label {
            font-size: 14px;
            font-weight: 500;
            color: var(--muted-color);
        }

        .profile-input {
            width: 100%;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            background: #f8f8ff;
            padding: 14px 18px;
            font-size: 15px;
            font-family: 'Montserrat', sans-serif;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            color: var(--text-color);
        }

        .profile-input:focus {
            outline: none;
            border-color: rgba(108, 93, 211, 0.45);
            box-shadow: 0 0 0 3px rgba(108, 93, 211, 0.15);
        }

        .profile-input:disabled {
            background: #f1f1fb;
            color: var(--muted-color);
            cursor: not-allowed;
        }

        .profile-form__error {
            font-size: 13px;
            color: #d93030;
        }

        .profile-input--error {
            border-color: rgba(217, 48, 48, 0.55);
            background: rgba(217, 48, 48, 0.04);
        }

        .profile-actions {
            display: flex;
            justify-content: flex-end;
        }

        .profile-button {
            border: none;
            border-radius: 18px;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
            color: #ffffff;
            background: var(--accent-color);
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .profile-button:hover,
        .profile-button:focus {
            background: var(--accent-color-hover);
        }

        .profile-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            background: #f8f8ff;
            border-radius: 20px;
            padding: 18px 20px;
        }

        .profile-meta__item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .profile-meta__label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted-color);
        }

        .profile-meta__value {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .profile-card {
                padding: 28px 24px;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $roleValue = $user->role ?? 'admin';
        $registeredAt = $user->created_at
            ? $user->created_at->copy()->locale('ru')->isoFormat('DD MMMM YYYY')
            : '—';
    @endphp
    <div class="profile-wrapper">
        <div class="profile-card">
            <h1 class="profile-card__title">Ваш профиль</h1>

            <section class="profile-section">
                <div class="profile-section__header">
                    <h2 class="profile-section__title">Основные данные</h2>
                    <p class="profile-section__subtitle">Измените персональные данные администратора.</p>
                </div>
                @if (session('status') === 'profile-updated')
                    <div class="profile-alert">Данные профиля успешно обновлены.</div>
                @endif
                <form method="POST" action="{{ route('admin.profile.update') }}" class="profile-form">
                    @csrf
                    @method('PUT')
                    <div class="profile-form__grid">
                        <div class="profile-form__field">
                            <label class="profile-form__label" for="last_name">Фамилия</label>
                            <input type="text" id="last_name" name="last_name" class="profile-input @error('last_name') profile-input--error @enderror" placeholder="Введите фамилию" value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')
                                <p class="profile-form__error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="profile-form__field">
                            <label class="profile-form__label" for="first_name">Имя</label>
                            <input type="text" id="first_name" name="first_name" class="profile-input @error('first_name') profile-input--error @enderror" placeholder="Введите имя" value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')
                                <p class="profile-form__error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="profile-form__field">
                            <label class="profile-form__label" for="middle_name">Отчество</label>
                            <input type="text" id="middle_name" name="middle_name" class="profile-input @error('middle_name') profile-input--error @enderror" placeholder="Введите отчество" value="{{ old('middle_name', $user->middle_name) }}">
                            @error('middle_name')
                                <p class="profile-form__error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="profile-form__field">
                            <label class="profile-form__label" for="login">Логин</label>
                            <input type="text" id="login" name="login" class="profile-input @error('login') profile-input--error @enderror" placeholder="Введите логин" value="{{ old('login', $user->login) }}">
                            @error('login')
                                <p class="profile-form__error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-meta">
                        <div class="profile-meta__item">
                            <span class="profile-meta__label">ID</span>
                            <span class="profile-meta__value">{{ $user->id }}</span>
                        </div>
                        <div class="profile-meta__item">
                            <span class="profile-meta__label">Роль</span>
                            <span class="profile-meta__value">{{ $roleValue }}</span>
                        </div>
                        <div class="profile-meta__item">
                            <span class="profile-meta__label">Дата регистрации</span>
                            <span class="profile-meta__value">{{ $registeredAt }}</span>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button type="submit" class="profile-button">Сохранить</button>
                    </div>
                </form>
            </section>

            <section class="profile-section">
                <div class="profile-section__header">
                    <h2 class="profile-section__title">Смена пароля</h2>
                    <p class="profile-section__subtitle">Установите новый пароль для входа.</p>
                </div>
                @if (session('status') === 'password-updated')
                    <div class="profile-alert">Пароль успешно обновлён.</div>
                @endif
                <form method="POST" action="{{ route('admin.profile.password') }}" class="profile-form">
                    @csrf
                    @method('PUT')
                    <div class="profile-form__grid">
                        <div class="profile-form__field">
                            <label class="profile-form__label" for="current_password">Текущий пароль</label>
                            <input type="password" id="current_password" name="current_password" class="profile-input @error('current_password', 'passwordUpdate') profile-input--error @enderror" placeholder="Введите текущий пароль">
                            @error('current_password', 'passwordUpdate')
                                <p class="profile-form__error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="profile-form__field">
                            <label class="profile-form__label" for="password">Новый пароль</label>
                            <input type="password" id="password" name="password" class="profile-input @error('password', 'passwordUpdate') profile-input--error @enderror" placeholder="Введите новый пароль">
                            @error('password', 'passwordUpdate')
                                <p class="profile-form__error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="profile-form__field">
                            <label class="profile-form__label" for="password_confirmation">Повтор пароля</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="profile-input" placeholder="Повторите новый пароль">
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button type="submit" class="profile-button">Сохранить</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
