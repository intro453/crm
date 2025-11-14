@extends('admin.layouts.app')

@section('title', 'Новая заявка')
@section('layout-title', 'Админ')
@section('page-title', 'Новая заявка')

@section('content')
    <div class="row">
        <div class="col-12">
            @php($application = $application ?? new \App\Models\Application())
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Новая заявка</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.applications.store') }}" method="POST" class="mt-1">
                        @csrf
                        @include('admin.applications._form', ['application' => $application])
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary">Отмена</a>
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
