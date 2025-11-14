@extends('admin.layouts.app')

@section('title', 'Заявки')
@section('layout-title', 'Админ')
@section('page-title', 'Заявки')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status'))
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>
                        @switch(session('status'))
                            @case('application-created') Заявка создана. @break
                            @case('application-updated') Заявка обновлена. @break
                            @case('application-deleted') Заявка удалена. @break
                        @endswitch
                    </span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Заявки</h4>

                    <form method="GET" action="{{ route('admin.applications.index') }}" class="mb-1">
                        <div class="row g-1 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label" for="applicationStatus">Статус</label>
                                <select id="applicationStatus" name="status" class="form-select">
                                    <option value="">Все</option>
                                    @foreach($statusOptions as $value => $label)
                                        <option value="{{ $value }}" @selected($filters['status'] === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="applicationType">Тип</label>
                                <select id="applicationType" name="type" class="form-select">
                                    <option value="">Все</option>
                                    @foreach($typeOptions as $value => $label)
                                        <option value="{{ $value }}" @selected($filters['type'] === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="applicationManager">Менеджер</label>
                                <select id="applicationManager" name="manager_id" class="form-select">
                                    <option value="">Все</option>
                                    @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}" @selected($filters['manager_id'] == $manager->id)>{{ $manager->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="applicationLawyer">Юрист</label>
                                <select id="applicationLawyer" name="lawyer_id" class="form-select">
                                    <option value="">Все</option>
                                    @foreach($lawyers as $lawyer)
                                        <option value="{{ $lawyer->id }}" @selected($filters['lawyer_id'] == $lawyer->id)>{{ $lawyer->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="applicationTopic">Тема</label>
                                <select id="applicationTopic" name="topic_id" class="form-select">
                                    <option value="">Все</option>
                                    @foreach($topics as $topic)
                                        <option value="{{ $topic->id }}" @selected($filters['topic_id'] == $topic->id)>{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="applicationClient">Клиент</label>
                                <input type="search" id="applicationClient" name="client" class="form-control" placeholder="Имя, телефон или email"
                                       value="{{ $filters['client'] }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="applicationDateFrom">Дата начала с</label>
                                <input type="date" id="applicationDateFrom" name="date_from" class="form-control" value="{{ $filters['date_from'] }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="applicationDateTo">Дата начала по</label>
                                <input type="date" id="applicationDateTo" name="date_to" class="form-control" value="{{ $filters['date_to'] }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Применить</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                            </div>
                        </div>
                    </form>

                    <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('admin.applications.create') }}">+ Новая заявка</a>

                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Клиент</th>
                                <th>Тема</th>
                                <th>Статус</th>
                                <th>Тип</th>
                                <th>Менеджер</th>
                                <th>Юрист</th>
                                <th>Период</th>
                                <th>Стоимость</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($applications as $application)
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $application->client->name }}</div>
                                        <small class="text-muted">{{ $application->client->phone }} {{ $application->client->email }}</small>
                                    </td>
                                    <td>{{ $application->topic?->name ?? '—' }}</td>
                                    <td>
                                        @php($statusLabel = $statusOptions[$application->status] ?? $application->status)
                                        <span class="badge rounded-pill {{ match($application->status) {
                                            \App\Models\Application::STATUS_NEW => 'badge-light-secondary',
                                            \App\Models\Application::STATUS_UNDER_REVIEW => 'badge-light-info',
                        \App\Models\Application::STATUS_IN_PROGRESS => 'badge-light-primary',
                                            \App\Models\Application::STATUS_COMPLETED => 'badge-light-success',
                                            default => 'badge-light-secondary'
                                        } }}">{{ $statusLabel }}</span>
                                    </td>
                                    <td>{{ $typeOptions[$application->type] ?? $application->type }}</td>
                                    <td>{{ $application->manager?->full_name ?? '—' }}</td>
                                    <td>{{ $application->lawyer?->full_name ?? '—' }}</td>
                                    <td>
                                        @if($application->scheduled_start_at)
                                            {{ $application->scheduled_start_at->format('d.m.Y H:i') }}<br>
                                            <small class="text-muted">до {{ $application->scheduled_end_at?->format('d.m.Y H:i') }}</small>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>{{ number_format($application->cost, 2, ',', ' ') }} ₽</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.applications.edit', $application) }}" class="btn btn-sm btn-flat-info">Редактировать</a>
                                        <form action="{{ route('admin.applications.destroy', $application) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-flat-danger" onclick="return confirm('Удалить заявку?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Заявки не найдены.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $applications->links('vendor.pagination.vuexy-basic') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
