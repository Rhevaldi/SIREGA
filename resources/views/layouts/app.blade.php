<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SIREGA')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">

    
    @stack('css')
</head>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    
    @auth
        @include('layouts.navbar')
    @endauth

    
    @auth
        @include('layouts.sidebar')
    @endauth

    
    <div class="content-wrapper">

    
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="mb-2">@yield('page-title')</h1>
            </div>
        </section>

        
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>

    </div>

    
    @auth
        @include('layouts.footer')
    @endauth

</div>


<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

@stack('js')
</body>
</html>
