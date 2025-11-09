@extends('layouts.auth')

@section('title', __('Verify Email') . ' - ' . config('app.name'))

@section('auth-title')
    {{ __('Verify Your Email Address') }} 📧
@endsection

@section('auth-subtitle')
    {{ __('Before proceeding, please check your email for a verification link.') }}
@endsection

@section('auth-content')
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <p class="mb-2">{{ __('If you did not receive the email, you can request another below.') }}</p>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary w-100">{{ __('Resend Verification Email') }}</button>
    </form>
@endsection

@section('auth-extra')
    <p class="text-center mb-0">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span>{{ __('Log out') }}</span>
        </a>
    </p>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endsection

@push('page-script')
    <script src="{{ asset('vuexy/app-assets/js/scripts/pages/auth-two-steps.js') }}"></script>
@endpush
