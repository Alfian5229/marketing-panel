<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('CRM MITRA') }} | {{$title}}</title>
        <!-- Favicon -->
        <link href="{{ asset('assets') }}/img/brand/eklankumax.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <!-- Icons -->
        <link rel="stylesheet" href="{{asset('assets')}}/vendor/nucleo/css/nucleo.css" type="text/css">
        <link rel="stylesheet" href="{{asset('assets')}}/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <!-- Page plugins -->
        <link rel="stylesheet" href="{{asset('assets')}}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('assets')}}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('assets')}}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('assets')}}/vendor/sweetalert2/dist/sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    

        {{-- Loading JS--}}
        <link rel="stylesheet" href="{{asset('assets')}}/jquery-loading/src/loading.css">

        <!-- Argon CSS -->
        <link rel="stylesheet" href="{{asset('assets')}}/css/argon.css?v=1.1.0" type="text/css">
    </head>
    <body class="{{ $class ?? '' }}" id="body">
        <form id="logout-form" action="/logout" method="GET" style="display: none;">
            @csrf
        </form>
        @include('layouts.navbars.sidebar')

        <div class="main-content" id="panel">
            @yield('content')
        </div>

        {{-- @auth()
            <form id="logout-form" action="/logout" method="GET" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="main-content" id="panel">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>
        @guest()
            @include('layouts.footers.guest')
        @endguest --}}

        <!-- Argon Scripts -->


        <!-- Core -->
        <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('assets') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
        <script src="{{ asset('assets') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="{{ asset('assets') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script src="{{ asset('assets') }}/js/dropzone.js"></script>


        <!-- Optional JS -->
        <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.extension.js"></script>
        <!-- Optional JS -->
        <script src="{{asset('assets')}}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('assets')}}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{asset('assets')}}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{asset('assets')}}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="{{asset('assets')}}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{asset('assets')}}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="{{asset('assets')}}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{asset('assets')}}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

        <!-- Optional JS -->
        {{-- <script src="{{asset('assets')}}/vendor/select2/dist/js/select2.min.js"></script> --}}
        <script src="{{asset('assets')}}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="{{asset('assets')}}/vendor/nouislider/distribute/nouislider.min.js"></script>
        <script src="{{asset('assets')}}/vendor/quill/dist/quill.min.js"></script>
        <script src="{{asset('assets')}}/vendor/dropzone/dist/min/dropzone.min.js"></script>
        <script src="{{asset('assets')}}/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>


        <!-- Argon JS -->
        <script src="{{ asset('assets') }}/js/argon.js?v=1.1.0"></script>

        {{-- Loading --}}
        <script src="{{asset('assets')}}/jquery-loading/dist/jquery.loading.min.js"></script>
        <script src="{{asset('assets')}}/jquery-loading/dist/jquery.loading.js"></script>

        <!-- Notify -->
        <script src="{{asset('assets')}}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="{{asset('assets')}}/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>

        @stack('js')

        <script>
            // SweetAlert2
            $('.hapus').on('click', function (e) {
                e.preventDefault();
                const href = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#5e72e4',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        document.location.href = href;
                    }
                })
            });
        </script>



    </body>
</html>
