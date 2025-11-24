@extends('admin.layouts.app')

@section('title', 'Отчеты')
@section('layout-title', 'Админ')
@section('page-title', 'Отчеты')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status'))
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>
                        @switch(session('status'))
                            @case('report-created') Отчет добавлен. @break
                            @case('report-updated') Отчет обновлён. @break
                            @case('report-deleted') Отчет удалён. @break
                        @endswitch
                    </span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Отчеты</h4>

                    <form method="GET" action="{{ route('admin.reports.index') }}" class="mb-1">
                        <div class="row g-1 align-items-end">
                            <div class="col-md-6">
                                <label class="w-100">Поиск
                                    <input type="search" name="search" class="form-control" placeholder="Название отчета"
                                           value="{{ $search }}">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                            </div>
                        </div>
                    </form>

                    <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('admin.reports.create') }}">+ Новый отчет</a>

                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Период</th>
                                <th>Всего заявок</th>
                                <th>Завершено</th>
                                <th>Выручка</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reports as $report)
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->title }}</td>
                                    <td>{{ $report->period_start->format('d.m.Y') }} - {{ $report->period_end->format('d.m.Y') }}</td>
                                    <td>{{ $report->total_applications }}</td>
                                    <td>{{ $report->completed_applications }}</td>
                                    <td>{{ number_format($report->total_revenue, 2, ',', ' ') }} ₽</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.reports.edit', $report) }}" class="btn btn-sm btn-flat-info">Редактировать</a>
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-flat-danger" onclick="return confirm('Удалить отчет?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Отчеты не найдены.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $reports->links('vendor.pagination.vuexy-basic') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
