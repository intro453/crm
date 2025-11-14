@extends('admin.layouts.app')

@section('title', 'Новый суд')
@section('layout-title', 'Админ')
@section('page-title', 'Новый суд')

@section('content')
    <div class="row">
        <div class="col-12">
            @php($court = $court ?? new \App\Models\Court())
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Новый суд</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.courts.store') }}" method="POST" class="mt-1">
                        @csrf
                        @include('admin.courts._form', ['court' => $court])
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.courts.index') }}" class="btn btn-outline-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
