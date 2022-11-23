<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Title Page-->
    <title>Ticket Vendor Pro</title>

    <!-- Icons font CSS-->
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>


    <!-- Main CSS-->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" media="all">

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
</head>

<body>

    @include('sweetalert::alert')

    @yield('content')

    <!-- Jquery JS-->
    {{-- <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script> --}}
    <!-- Vendor JS-->
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datepicker/daterangepicker.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('assets/js/global.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>





</body>

</html>
<!-- end document-->
