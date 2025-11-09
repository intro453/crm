@extends('layouts.auth')

@section('title', __('Confirm Password') . ' - ' . config('app.name'))

@section('auth-title')
    {{ __('Confirm Password') }} 🔐
@endsection

@section('auth-subtitle')
    {{ __('Please confirm your password before continuing.') }}
@endsection

@section('auth-content')
    <form class="mt-2" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="mb-1">
            <label class="form-label" for="confirm-password">{{ __('Password') }}</label>
            <div class="input-group input-group-merge form-password-toggle">
                <input
                    class="form-control form-control-merge @error('password') is-invalid @enderror"
                    id="confirm-password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary w-100">{{ __('Confirm Password') }}</button>
    </form>
@endsection

@section('auth-extra')
    @if (Route::has('password.request'))
        <p class="text-center mb-0">
            <a href="{{ route('password.request') }}"><span>{{ __('Forgot Your Password?') }}</span></a>
        </p>
    @endif
@endsection

@push('page-script')
    <script src="{{ asset('vuexy/app-assets/js/scripts/pages/auth-login.js') }}"></script>
@endpush
