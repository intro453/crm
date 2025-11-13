<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Админ | CRM')</title>
    <link rel="apple-touch-icon" href="{{ asset('vuexy/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('vuexy/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/vendors/css/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy/assets/css/style.css') }}">
    @stack('styles')
</head>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
@php
    $layoutTitle = trim($__env->yieldContent('layout-title', config('app.name', 'CRM')));
    $pageTitle = trim($__env->yieldContent('page-title', ''));
    $breadcrumbsContent = trim($__env->yieldContent('breadcrumbs', ''));
@endphp
@include('admin.layouts.partials.navbar', [
    'layoutTitle' => $layoutTitle,
    'pageTitle' => $pageTitle !== '' ? $pageTitle : $layoutTitle,
    'breadcrumbsContent' => $breadcrumbsContent,
])
@include('admin.layouts.partials.sidebar', [
    'layoutTitle' => $layoutTitle,
])
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('vuexy/app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('vuexy/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('vuexy/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('vuexy/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('vuexy/app-assets/js/core/app.js') }}"></script>
<script>
    window.addEventListener('load', function () {
        if (window.feather) {
            window.feather.replace({ width: 14, height: 14 });
        }
    });
</script>
@stack('scripts')
</body>
</html>
