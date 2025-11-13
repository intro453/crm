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

                    <div class="row">
                        <div class="col-md-4 user_search">
                            <label class="w-100">Search:
                                <input type="search" class="form-control" placeholder="">
                            </label>
                        </div>
                        <div class="col-md-2 user_role"><label class="form-label" for="UserRole">Role</label><select
                                id="UserRole" class="form-select text-capitalize mb-md-0 mb-2">
                                <option value=""> Select Role</option>
                                <option value="Admin" class="text-capitalize">Admin</option>
                                <option value="Author" class="text-capitalize">Author</option>
                                <option value="Editor" class="text-capitalize">Editor</option>
                                <option value="Maintainer" class="text-capitalize">Maintainer</option>
                                <option value="Subscriber" class="text-capitalize">Subscriber</option>
                            </select></div>
                        <div class="col-md-2 user_plan"><label class="form-label" for="UserPlan">Plan</label><select
                                id="UserPlan" class="form-select text-capitalize mb-md-0 mb-2">
                                <option value=""> Select Plan</option>
                                <option value="Basic" class="text-capitalize">Basic</option>
                                <option value="Company" class="text-capitalize">Company</option>
                                <option value="Enterprise" class="text-capitalize">Enterprise</option>
                                <option value="Team" class="text-capitalize">Team</option>
                            </select></div>
                        <div class="col-md-2 user_status"><label class="form-label"
                                                                 for="FilterTransaction">Status</label><select
                                id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx">
                                <option value=""> Select Status</option>
                                <option value="Pending" class="text-capitalize">Pending</option>
                                <option value="Active" class="text-capitalize">Active</option>
                                <option value="Inactive" class="text-capitalize">Inactive</option>
                            </select></div>
                        <div class="col-md-2 user_buttons">
                            <div class="mt-2"><i style="width:32px;height:32px;" data-feather='search'></i> <i
                                    class="ms-1" style="width:37px;height:37px;" data-feather='delete'></i></div>
                        </div>
                    </div>

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
                            @foreach($users as $user)
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
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
