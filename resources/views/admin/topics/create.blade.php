@extends('admin.layouts.app')

@section('title', 'Новая тема')
@section('layout-title', 'Админ')
@section('page-title', 'Новая тема')

@section('content')
    <div class="row">
        <div class="col-12">
            @php($topic = $topic ?? new \App\Models\RequestTopic())
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Новая тема</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.topics.store') }}" method="POST" class="mt-1">
                        @csrf
                        @include('admin.topics._form', ['topic' => $topic])
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.topics.index') }}" class="btn btn-outline-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
