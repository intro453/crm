@extends('admin.layouts.app')

@section('title', 'Новый отчет')
@section('layout-title', 'Админ')
@section('page-title', 'Новый отчет')

@section('content')
    <div class="row">
        <div class="col-12">
            @php($report = $report ?? new \App\Models\Report())
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Новый отчет</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.reports.store') }}" method="POST" class="mt-1">
                        @csrf
                        @include('admin.reports._form', ['report' => $report])
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
