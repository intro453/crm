@extends('admin.layouts.app')

@section('title', 'Редактирование заявки')
@section('layout-title', 'Админ')
@section('page-title', 'Редактирование заявки')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('status') === 'application-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>Заявка обновлена.</span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Редактирование заявки</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.applications.update', $application) }}" method="POST" class="mt-1">
                        @csrf
                        @method('PUT')
                        @include('admin.applications._form', ['application' => $application])
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('admin.applications.partials.form-script')
@endpush
