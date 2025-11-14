@extends('admin.layouts.app')

@section('title', 'Редактирование отчета')
@section('layout-title', 'Админ')
@section('page-title', 'Редактирование отчета')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status') === 'report-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>Отчет обновлён.</span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Редактирование отчета</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.reports.update', $report) }}" method="POST" class="mt-1">
                        @csrf
                        @method('PUT')
                        @include('admin.reports._form', ['report' => $report])
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
