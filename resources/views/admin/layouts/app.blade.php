<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ env('APP_NAME') }} </title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/admin') }}/assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin') }}/assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin') }}/assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet"
        type="text/css">
    <script src="{{ asset('assets/admin') }}/assets/demo/pages/animations_css3.js"></script>
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/admin') }}/assets/demo/demo_configurator.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- /core JS files -->

    {{-- for data tables --}}
    <script src="{{ asset('assets/admin') }}/assets/demo/pages/datatables_extension_responsive.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/vendor/tables/datatables/datatables.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/vendor/tables/datatables/extensions/responsive.min.js"></script>
    {{-- ////// --}}

    {{-- bootsrap toggle cdn --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

    <!-- Theme JS files -->
    <script src="{{ asset('assets/admin') }}/assets/js/app.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/d3.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/d3_tooltip.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/pages/dashboard.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/streamgraph.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/sparklines.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/lines.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/areas.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/donuts.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/bars.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/progress.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/heatmaps.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/pies.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/charts/pages/dashboard/bullets.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/vendor/media/glightbox.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/pages/gallery.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/vendor/forms/selects/select2.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/pages/form_select2.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/vendor/forms/selects/select2.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/demo/pages/form_select2.js"></script>


    {{-- extra add --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script src="{{ asset('assets/admin') }}/global_assets/js/plugins/pickers/datepicker.min.js"></script> --}}


    {{-- ///// --}}
    <!-- /theme JS files -->

    <style>
        .custom-select {
            display: inline-block;
            height: calc(1.5715em + 1rem + 2px);
            padding: .5rem 2.5rem .5rem 1rem;
            font-size: .875rem;
            font-weight: 700;
            line-height: 1.5715;
            color: #333;
            vertical-align: middle;
            border: 1px solid #ccc;
            border-radius: .25rem;
            box-shadow: none;

        }

        .nav-sidebar .nav-link.active {
            background: rgb(1, 51, 150);
            background: linear-gradient(90deg, rgba(1, 51, 150, 1) 0%, rgba(23, 77, 167, 1) 50%, rgba(99, 166, 225, 1) 100%);
        }

        .table {
            font-family: 'Lora', serif;
            font-size: 15px;
            /* font-weight: normal; */
        }
    </style>

    @yield('js')
</head>

<body>
    @include('admin.layouts.header')
    @include('admin.layouts.menu')
    <div class="content-wrapper">
        <div class="content-inner">
            @yield('body')
        </div>
        @include('admin.layouts.footer')
    </div>

</body>

</html>
