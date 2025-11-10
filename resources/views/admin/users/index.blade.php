@extends('admin.layouts.app')

@section('title', 'Пользователи')
@section('layout-title', 'Админ')
@section('page-title', 'Ваш профиль')

@section('content')
    <div class="row">
        <div class="col-12 col-xl-8 col-lg-9 col-md-10 mx-auto">
            @if(session('status') === 'profile-updated')
                <div class="alert alert-success d-flex align-items-center mb-1" role="alert">
                    <i data-feather="check-circle" class="me-50"></i>
                    <span>Профиль успешно обновлён.</span>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Пользователи</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
