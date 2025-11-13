@extends('admin.layouts.app')

@section('title', 'Пользователи')
@section('layout-title', 'Админ')
@section('page-title', 'Ваш профиль')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status') === 'profile-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>Профиль успешно обновлён.</span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Пользователи</h4>

                    <form method="GET" action="{{ route('admin.users.index') }}">
                        <div class="row g-1 align-items-end">
                            <div class="col-md-4 user_search">
                                <label class="w-100">Поиск
                                    <input type="search" name="search" class="form-control" placeholder="ФИО или логин"
                                           value="{{ $filters['values']['search'] ?? '' }}">
                                </label>
                            </div>
                            <div class="col-md-2 user_role">
                                <label class="form-label" for="UserRole">Роль</label>
                                <select id="UserRole" name="role" class="form-select text-capitalize mb-md-0 mb-2">
                                    <option value="">Все</option>
                                    @foreach($filters['options']['roles'] as $value => $label)
                                        <option value="{{ $value }}" @selected(($filters['values']['role'] ?? null) === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 user_sort">
                                <label class="form-label" for="UserSort">Сортировка</label>
                                <select id="UserSort" name="sort" class="form-select text-capitalize mb-md-0 mb-2">
                                    @foreach($filters['options']['sort'] as $value => $option)
                                        <option value="{{ $value }}" @selected(($filters['values']['sort'] ?? null) === $value)>
                                            {{ $option['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 user_status">
                                <label class="form-label" for="FilterTransaction">Статус</label>
                                <select id="FilterTransaction" name="status" class="form-select text-capitalize mb-md-0 mb-2">
                                    <option value="">Все</option>
                                    @foreach($filters['options']['status'] as $value => $label)
                                        <option value="{{ $value }}" @selected(($filters['values']['status'] ?? null) === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 user_buttons">
                                <div class="d-flex gap-1 mt-2">
                                    <button type="submit" class="btn btn-icon btn-outline-primary" title="Применить фильтры">
                                        <i data-feather="search"></i>
                                    </button>
                                    <a href="{{ route('admin.users.index', ['reset' => 1]) }}" class="btn btn-icon btn-outline-secondary"
                                       title="Сбросить фильтры">
                                        <i data-feather="x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a class="btn btn-primary waves-effect waves-float waves-light mt-2" href="{{ route('admin.users.create') }}">+ Новый пользователь</a>

                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Аккаунт</th>
                                <th>Логин</th>
                                <th>ФИО</th>
                                <th>Роль</th>
                                <th>Регистрация</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @include('admin.users.is_active')
                                    </td>
                                    <td>{{ $user->login }}</td>
                                    <td>{{ $user->full_name}}</td>
                                    <td>{{ $user->role_label}}</td>
                                    <td>{{ $user->created_at->format('d.m.Y')}}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', [$user->id]) }}" class="btn btn-flat-info">Редактировать</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Пользователи не найдены.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
