@extends('layouts.auth')

@section('title', __('Forgot Password') . ' - ' . config('app.name'))

@section('auth-title')
    {{ __('Forgot Password?') }} 🔒
@endsection

@section('auth-subtitle')
    {{ __('Enter your email and we will send you a link to reset your password.') }}
@endsection

@section('auth-content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form class="mt-2" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-1">
            <label class="form-label" for="forgot-password-email">{{ __('Email Address') }}</label>
            <input
                class="form-control @error('email') is-invalid @enderror"
                id="forgot-password-email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="{{ __('john@example.com') }}"
                aria-describedby="forgot-password-email"
                autofocus
                required
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary w-100">{{ __('Send Password Reset Link') }}</button>
    </form>
@endsection

@section('auth-extra')
    <p class="text-center mb-0">
        <a href="{{ route('login') }}"><span>{{ __('Back to login') }}</span></a>
    </p>
@endsection

@push('page-script')
    <script src="{{ asset('vuexy/app-assets/js/scripts/pages/auth-forgot-password.js') }}"></script>
@endpush
