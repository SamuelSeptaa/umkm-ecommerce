<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ asset('coreui') }}/./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('coreui') }}/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('coreui') }}/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('coreui') }}/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('coreui') }}/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('coreui') }}/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('coreui') }}/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('coreui') }}/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('coreui') }}/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('coreui') }}/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('coreui') }}/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('coreui') }}/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('coreui') }}/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('coreui') }}/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('coreui') }}/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('coreui') }}/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="{{ asset('coreui') }}/css/vendors/simplebar.css">
    <link rel="stylesheet" href="{{ asset('coreui/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">

    <!-- Main styles for this application-->
    <link href="{{ asset('ogani') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('coreui') }}/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{ asset('coreui') }}/css/examples.css" rel="stylesheet">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    <link href="{{ asset('coreui') }}/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
    <link href="{{ asset('coreui') }}/vendors/@coreui/icons/css/free.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2e229e0536.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('layout.admin.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('layout.admin.navbar')
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a>
                ©
                2022 creativeLabs.</div>
            <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI
                    Components</a></div>
        </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('ogani/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('coreui') }}/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="{{ asset('coreui') }}/vendors/simplebar/js/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('coreui') }}/vendors/chart.js/js/chart.min.js"></script>
    <script src="{{ asset('coreui') }}/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="{{ asset('coreui') }}/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="{{ asset('coreui') }}/js/main.js"></script>
    <script src="{{ asset('coreui/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('coreui/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<script>
    function showLoading() {
        $(".loader").show();
        $("#preloder").delay(50).fadeIn("fast");
    }

    function hideLoading() {
        $(".loader").fadeOut();
        $("#preloder").delay(50).fadeOut("fast");
    }

    var debounce = function(func, delay) {
        var timeoutId;
        return function() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(func, delay);
        };
    };

    $(window).on('load', function() {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });
</script>
@isset($script)
    @include($script)
@endisset
