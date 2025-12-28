<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_TITLE') }} @yield('title', 'SIREGA')</title>
    <link rel="shortcut icon" href="{{ asset(env('APP_FAVICON_PATH')) }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.25.4/dist/css/uikit.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.3.5/r-3.0.7/datatables.min.css" rel="stylesheet"
        integrity="sha384-7BuMUZVY1n5/MC0a4MwlfSWYITJAWwNfOI3Pn3G37vlXjjKMqKowKM15z2TY/7Nt" crossorigin="anonymous">

    @stack('css')
    <style>
        .img-fixed {
            /* lebar konsisten */
            width: 200px;
            /* tinggi konsisten */
            height: 200px;
            /* isi kotak tanpa lonjong */
            object-fit: cover;
            /* Kalau kamu ingin seluruh gambar terlihat utuh (tidak ada bagian terpotong) */
            /* object-fit: contain;  */
            /* fokus di tengah */
            object-position: center;
            /* opsional, isi ruang kosong */
            /* background-color: #f0f0f0; */
        }

        /* Pastikan lightbox selalu di atas navbar & sidebar */
        .uk-lightbox,
        .uk-lightbox-overlay {
            z-index: 99999 !important;
        }
    </style>
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
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.25.4/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.25.4/dist/js/uikit-icons.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

    <script src="https://cdn.datatables.net/v/bs4/dt-2.3.5/r-3.0.7/datatables.min.js"
        integrity="sha384-xNl4KzWHw1EHKaRnrmS9oDxGXAqYaJgo7L5Pl8yXfLXP6eJD5IN1poOMFK4UcBeV" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('.defaultDataTable').DataTable({
                columnDefs: [{
                    targets: [0, -1],
                    className: 'text-center'
                }]
            });
            $('#usersTable').DataTable();

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    @stack('js')
</body>

</html>
