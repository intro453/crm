@extends('admin.layouts.app')

@section('title', 'Клиенты')
@section('layout-title', 'Админ')
@section('page-title', 'Клиенты')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status'))
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>
                        @switch(session('status'))
                            @case('client-created') Клиент добавлен. @break
                            @case('client-deleted') Клиент удалён. @break
                        @endswitch
                    </span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Клиенты</h4>

                    <form method="GET" action="{{ route('admin.clients.index') }}">
                        <div class="row g-1 align-items-end">
                            <div class="col-md-6">
                                <label class="w-100">Поиск
                                    <input type="search" name="search" class="form-control"
                                           placeholder="Имя, телефон или email"
                                           value="{{ $search }}">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                            </div>
                        </div>
                    </form>

                    <a class="btn btn-primary waves-effect waves-float waves-light mt-2" href="{{ route('admin.clients.create') }}">+ Новый клиент</a>

                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Email</th>
                                <th>Создан</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->first_name }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->created_at?->format('d.m.Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-flat-info">Редактировать</a>
                                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-flat-danger" onclick="return confirm('Удалить клиента?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Клиенты не найдены.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $clients->links('vendor.pagination.vuexy-basic') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
