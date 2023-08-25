<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: auto">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"
    />
    @vite([
        'resources/css/app.css'
    ])
    <meta name="_token" content="{{ csrf_token() }}" />
</head>
<body class="sidebar-mini" style="height: auto">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        @include('admin.partials.aside')

        <div class="content-wrapper">
            @yield('content_header')
            <section class="content">
                <div class="container-fluid">
                    @include('admin.partials.messages')
                </div>
                @yield('content')
            </section>
            </div>
        </div>
    @vite([
        'resources/js/app.js',
        'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
        'node_modules/admin-lte/dist/js/adminlte.min.js',
        'node_modules/jquery-maskmoney/dist/jquery.maskMoney.min.js',
        'resources/js/scripts.js',
    ])
    @yield('scripts')
</body>
</html>
