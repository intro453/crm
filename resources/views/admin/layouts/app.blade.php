<!DOCTYPE html>
<html lang="ru" class="loading" data-textdirection="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Админ | CRM')</title>
    <link rel="apple-touch-icon" href="{{ asset('vuexy/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('vuexy/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/assets/css/style.css') }}">

    @stack('styles')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
@include('admin.layouts.partials.navbar')
@include('admin.layouts.partials.sidebar')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row align-items-center mb-2">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-1">
                    <div>
                        <h2 class="content-header-title float-start mb-0">@yield('page-title', 'Панель администратора')</h2>
                        @hasSection('breadcrumbs')
                            <div class="breadcrumb-wrapper">
                                @yield('breadcrumbs')
                            </div>
                        @endif
                    </div>
                    <div class="text-md-end text-muted small">
                        @php($now = \Illuminate\Support\Carbon::now()->locale('ru'))
                        {{ \Illuminate\Support\Str::ucfirst($now->isoFormat('dddd, D MMMM YYYY г.')) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('vuexy/app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('vuexy/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('vuexy/app-assets/js/core/app.js') }}"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        document.querySelectorAll('[data-menu-toggle]').forEach(function (button) {
            button.addEventListener('click', function () {
                document.body.classList.toggle('menu-open');
                document.querySelector('.main-menu')?.classList.toggle('open');
            });
        });
    });
</script>
@stack('scripts')
</body>
</html>
