@extends('layouts.auth')

@section('title', __('Reset Password') . ' - ' . config('app.name'))

@section('auth-title')
    {{ __('Reset Password') }} 🔁
@endsection

@section('auth-subtitle')
    {{ __('Enter your new password below.') }}
@endsection

@section('auth-content')
    <form class="mt-2" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-1">
            <label class="form-label" for="reset-email">{{ __('Email Address') }}</label>
            <input
                class="form-control @error('email') is-invalid @enderror"
                id="reset-email"
                type="email"
                name="email"
                value="{{ $email ?? old('email') }}"
                placeholder="{{ __('john@example.com') }}"
                aria-describedby="reset-email"
                required
                autofocus
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label class="form-label" for="reset-password">{{ __('Password') }}</label>
            <div class="input-group input-group-merge form-password-toggle">
                <input
                    class="form-control form-control-merge @error('password') is-invalid @enderror"
                    id="reset-password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label class="form-label" for="reset-password-confirm">{{ __('Confirm Password') }}</label>
            <div class="input-group input-group-merge form-password-toggle">
                <input
                    class="form-control form-control-merge @error('password_confirmation') is-invalid @enderror"
                    id="reset-password-confirm"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary w-100">{{ __('Reset Password') }}</button>
    </form>
@endsection

@section('auth-extra')
    <p class="text-center mb-0">
        <a href="{{ route('login') }}"><span>{{ __('Back to login') }}</span></a>
    </p>
@endsection

@push('page-script')
    <script src="{{ asset('vuexy/app-assets/js/scripts/pages/auth-reset-password.js') }}"></script>
@endpush
