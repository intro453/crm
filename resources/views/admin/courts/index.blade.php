@extends('admin.layouts.app')

@section('title', 'Суды')
@section('layout-title', 'Админ')
@section('page-title', 'Суды')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status'))
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>
                        @switch(session('status'))
                            @case('court-created') Суд добавлен. @break
                            @case('court-updated') Суд обновлён. @break
                            @case('court-deleted') Суд удалён. @break
                        @endswitch
                    </span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Список судов</h4>

                    <form method="GET" action="{{ route('admin.courts.index') }}" class="mb-1">
                        <div class="row g-1 align-items-end">
                            <div class="col-md-6">
                                <label class="w-100">Поиск
                                    <input type="search" name="search" class="form-control" placeholder="Название, регион или адрес"
                                           value="{{ $search }}">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.courts.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                            </div>
                        </div>
                    </form>

                    <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('admin.courts.create') }}">+ Новый суд</a>

                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Регион</th>
                                <th>Адрес</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($courts as $court)
                                <tr>
                                    <td>{{ $court->id }}</td>
                                    <td>{{ $court->name }}</td>
                                    <td>{{ $court->region }}</td>
                                    <td>{{ $court->address }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.courts.edit', $court) }}" class="btn btn-sm btn-flat-info">Редактировать</a>
                                        <form action="{{ route('admin.courts.destroy', $court) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-flat-danger" onclick="return confirm('Удалить суд?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Суды не найдены.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $courts->links('vendor.pagination.vuexy-basic') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
