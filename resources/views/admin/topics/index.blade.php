@extends('admin.layouts.app')

@section('title', 'Темы заявок')
@section('layout-title', 'Админ')
@section('page-title', 'Темы заявок')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status'))
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>
                        @switch(session('status'))
                            @case('topic-created') Тема добавлена. @break
                            @case('topic-updated') Тема обновлена. @break
                            @case('topic-deleted') Тема удалена. @break
                        @endswitch
                    </span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Темы заявок</h4>

                    <form method="GET" action="{{ route('admin.topics.index') }}" class="mb-1">
                        <div class="row g-1 align-items-end">
                            <div class="col-md-4">
                                <label class="w-100">Поиск
                                    <input type="search" name="search" class="form-control" placeholder="Название"
                                           value="{{ $filters['search'] }}">
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="topicActive">Активность</label>
                                <select id="topicActive" name="is_active" class="form-select">
                                    <option value="">Все</option>
                                    <option value="1" @selected($filters['is_active'] === '1')>Активные</option>
                                    <option value="0" @selected($filters['is_active'] === '0')>Неактивные</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Применить</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.topics.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                            </div>
                        </div>
                    </form>

                    <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('admin.topics.create') }}">+ Новая тема</a>

                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Статус</th>
                                <th>Создана</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($topics as $topic)
                                <tr>
                                    <td>{{ $topic->id }}</td>
                                    <td>{{ $topic->name }}</td>
                                    <td>
                                        @if($topic->is_active)
                                            <span class="badge rounded-pill badge-light-success">Активна</span>
                                        @else
                                            <span class="badge rounded-pill badge-light-secondary">Неактивна</span>
                                        @endif
                                    </td>
                                    <td>{{ $topic->created_at?->format('d.m.Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.topics.edit', $topic) }}" class="btn btn-sm btn-flat-info">Редактировать</a>
                                        <form action="{{ route('admin.topics.destroy', $topic) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-flat-danger" onclick="return confirm('Удалить тему?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Темы не найдены.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $topics->links('vendor.pagination.vuexy-basic') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
