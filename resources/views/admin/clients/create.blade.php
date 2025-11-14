@extends('admin.layouts.app')

@section('title', 'Новый клиент')
@section('layout-title', 'Админ')
@section('page-title', 'Новый клиент')

@section('content')
    <div class="row">
        <div class="col-12">
            @php($client = $client ?? new \App\Models\Client())
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Новый клиент</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.clients.store') }}" method="POST" class="mt-1">
                        @csrf
                        @include('admin.clients._form', ['client' => $client])
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
