@extends('layouts.auth')

@section('title', __('Login') . ' - ' . config('app.name'))

@section('auth-title')
    {{ __('Welcome to :app!', ['app' => config('app.name')]) }} 👋
@endsection

@section('auth-subtitle')
    {{ __('Please sign in to continue') }}
@endsection

@section('auth-content')
    <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-1">
            <label class="form-label" for="login">{{ __('Login') }}</label>
            <input
                class="form-control @error('login') is-invalid @enderror"
                id="login"
                type="text"
                name="login"
                value="{{ old('login') }}"
                placeholder="{{ __('Enter your login') }}"
                aria-describedby="login"
                autofocus
                tabindex="1"
                autocomplete="username"
            />
            @error('login')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"><small>{{ __('Forgot Password?') }}</small></a>
                @endif
            </div>
            <div class="input-group input-group-merge form-password-toggle">
                <input
                    class="form-control form-control-merge @error('password') is-invalid @enderror"
                    id="login-password"
                    type="password"
                    name="password"
                    placeholder="············"
                    aria-describedby="login-password"
                    tabindex="2"
                    autocomplete="current-password"
                />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <div class="form-check">
                <input class="form-check-input" id="remember-me" type="checkbox" name="remember" tabindex="3" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember-me">{{ __('Remember Me') }}</label>
            </div>
        </div>
        <button class="btn btn-primary w-100" tabindex="4">{{ __('Login') }}</button>
    </form>
@endsection

@section('auth-extra')
    @if (Route::has('register'))
        <p class="text-center mb-0">
            <span>{{ __('New on our platform?') }}</span>
            <a href="{{ route('register') }}"><span>&nbsp;{{ __('Create an account') }}</span></a>
        </p>
    @endif
@endsection

@push('page-script')
    <script src="{{ asset('vuexy/app-assets/js/scripts/pages/auth-login.js') }}"></script>
@endpush
