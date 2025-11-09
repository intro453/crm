<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Админ | CRM')</title>
    <link rel="apple-touch-icon" href="{{ asset('vuexy/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('vuexy/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background-color: #f6f7fb;
            --sidebar-width: 248px;
            --text-color: #1f1f38;
            --muted-color: #8f90a6;
            --border-color: #e6e8f5;
            --accent-color: #6c5dd3;
            --accent-color-hover: #5949c4;
            --card-shadow: 0 20px 45px rgba(76, 90, 204, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: var(--background-color);
            color: var(--text-color);
        }

        a {
            color: inherit;
        }

        a:hover,
        a:focus {
            color: var(--accent-color);
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
            background: var(--background-color);
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border-color);
            padding: 32px 28px;
            display: flex;
            flex-direction: column;
            gap: 36px;
        }

        .sidebar-title {
            font-size: 24px;
            font-weight: 700;
            line-height: 1.2;
            color: var(--text-color);
        }

        .sidebar-subtitle {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-color);
            margin-top: 6px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-nav li a {
            display: block;
            padding: 12px 16px;
            border-radius: 16px;
            font-size: 15px;
            font-weight: 500;
            color: #5e5f75;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .sidebar-nav li a:hover,
        .sidebar-nav li a:focus {
            background-color: rgba(108, 93, 211, 0.12);
            color: var(--accent-color);
        }

        .sidebar-nav li.active a {
            background-color: rgba(108, 93, 211, 0.18);
            color: var(--accent-color);
            font-weight: 600;
        }

        .sidebar-section-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted-color);
            margin-top: 24px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            padding: 28px 40px 16px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .admin-header__title {
            font-size: 28px;
            font-weight: 600;
            line-height: 1.2;
            margin-bottom: 12px;
        }

        .admin-header__meta {
            font-size: 14px;
            color: var(--muted-color);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .admin-header__meta a {
            text-decoration: none;
            color: var(--accent-color);
            font-weight: 500;
        }

        .admin-header__user {
            text-align: right;
        }

        .admin-header__user-name {
            font-size: 16px;
            font-weight: 600;
        }

        .admin-header__user-role {
            font-size: 14px;
            color: var(--muted-color);
            margin-top: 4px;
        }

        .admin-content {
            flex: 1;
            padding: 0 40px 48px;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 1024px) {
            .admin-shell {
                flex-direction: column;
            }

            .admin-sidebar {
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 16px;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }

            .sidebar-nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .sidebar-section-title {
                width: 100%;
            }

            .admin-main {
                width: 100%;
            }

            .admin-header {
                padding: 24px;
            }

            .admin-content {
                padding: 0 24px 32px;
            }
        }

        @media (max-width: 640px) {
            .admin-header {
                flex-direction: column;
                gap: 16px;
            }

            .admin-header__user {
                text-align: left;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
@php
    $layoutTitle = trim($__env->yieldContent('layout-title')) ?: 'Админ';
    $breadcrumbsContent = trim($__env->yieldContent('breadcrumbs'));
@endphp
<div class="admin-shell">
    @include('admin.layouts.partials.sidebar', ['layoutTitle' => $layoutTitle])
    <div class="admin-main">
        @include('admin.layouts.partials.navbar', [
            'layoutTitle' => $layoutTitle,
            'breadcrumbsContent' => $breadcrumbsContent,
        ])
        <main class="admin-content">
            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
