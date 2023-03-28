<!DOCTYPE html>
<html lang="en">

{{-- <head>
    <meta charset="utf-8">
    <title>Administration | PLANNING N'ZRAMA FESTIVAL</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico"><!-- jvectormap -->
    <link href="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}"
        rel="stylesheet"><!-- App css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('admin/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/metisMenu.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
     <!-- Responsive datatable examples -->
     <link href="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.css') }}"
     rel="stylesheet" type="text/css"><!-- App css -->

     <!-- summernote -->
     <link rel="stylesheet" href="{{ asset('admin/summernote/summernote.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/summernote/summernote-bs4.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/summernote/summernote-lite.css') }}">

</head> --}}

<head>
    <meta charset="utf-8">
    <title>Administration | Planning N'zrama Festival</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}">
    <link href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/plugins/datatables/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/summernote/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/summernote/summernote-lite.css') }}">

    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css"><!-- App css -->
    <!-- App css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('admin/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/metisMenu.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="dark-sidenav">
    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <!-- LOGO -->
        @include('partials-admin.left-sidenav')
    </div><!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- Navbar -->
            @include('partials-admin.topbar')
            <!-- end navbar-->
        </div><!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <!-- container contenu -->
            
             <!--footer-->
            @include('partials-admin.footer')
            <!--end footer-->
            
            @yield('content')
        </div><!-- end page content -->
    </div><!-- end page-wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/waves.js') }}"></script>
    <script src="{{ asset('admin/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/moment.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/jszip.min.js') }}"></script>
    <script src="../plugins/datatables/pdfmake.min.js"></script>
    <script src="{{ asset('admin/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/pages/jquery.datatable.init.js') }}"></script>

    <!-- summernote js -->

    <script src="{{ asset('admin/summernote/summernote.js') }}"></script>
    <script src="{{ asset('admin/summernote/summernote-bs4.js') }}"></script>


    <!-- App js -->
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-chart/jquery.canvaswrapper.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-chart/jquery.colorhelpers.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-chart/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin//plugins/flot-chart/jquery.flot.saturated.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-chart/jquery.flot.browser.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-chart/jquery.flot.drawSeries.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-chart/jquery.flot.uiConstants.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-chart/jquery.flot-dataType.js') }}"></script>
    <script src="{{ asset('admin/assets/pages/jquery.crm_dashboard.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <script>
        $('#summernote,.summernote').summernote({
            height: 100
        });
    </script>

</body>
</html>