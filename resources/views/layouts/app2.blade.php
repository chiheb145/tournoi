<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type " content="text/html; charset=utf-8"/>
    <title> Tournoi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/success_error_icon.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet"
          href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link href="{{asset('css/SourceSansPro.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{asset("DataTables/css/select.dataTables.min.css")}}" rel="stylesheet"/>
    <link href="{{asset("DataTables/css/buttons.dataTables.min.css")}}" rel="stylesheet"/>
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            *cursor: hand;
            color: #333 !important;
            border: 1px solid transparent;
            border-radius: 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            cursor: default;
            color: #666 !important;
            border: 1px solid transparent;
            background: transparent;
            box-shadow: none;
        }

        .alert a {
            color: #fff;
            text-decoration: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            *cursor: hand;
            color: #333 !important;
            border: 1px solid transparent;
            border-radius: 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            outline: none;
            background-color: #2b2b2b;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
            background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
            box-shadow: inset 0 0 3px #111;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            border: 1px solid #111;
            background-color: #585858;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));
            background: -webkit-linear-gradient(top, #585858 0%, #111 100%);
            background: -moz-linear-gradient(top, #585858 0%, #111 100%);
            background: -ms-linear-gradient(top, #585858 0%, #111 100%);
            background: -o-linear-gradient(top, #585858 0%, #111 100%);
            background: linear-gradient(to bottom, #585858 0%, #111 100%);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(161, 160, 195, 0.29);
        }

        .table-striped tbody tr {
            background-color: rgba(76, 109, 107, 0.19);
        }

        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 5px solid #ffffff;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #08fc98;
            border-top: 2px solid #0de8d9;
            background-color: #05e8f1;
            color: white;
        }

        .h4, h4 {
            font-size: 1.3rem;
        }

        .btn-info {
            color: #fff;
            background-color: #05c976;
            border-color: #09ba6b;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .075);
        }

        .btn-info:hover {
            color: #fff;
            background-color: #7c3dd2;
            border-color: #6629b9;
        }

        .brand-link {
            padding: .8125rem .5rem;
            font-size: 2.25rem;
            display: block;
            line-height: 2.5;
            white-space: nowrap;
        }

        .my_alert {
            position: fixed;
            top: 100px;
            width: 100%;


        }
    </style>
    <link href="{{asset('emoji/emojionearea.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/main.css')}}" rel="stylesheet"/>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <!-- Navigation -->
    <nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">

        <a class="navbar-link navbar_color " data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>

        <!-- links toggle -->
        <a class="navbar-toggler ml-auto navbar_color" data-toggle="collapse" data-target="#links"
           aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" title="Resource">
            <i class="fas fa-bars"></i>
        </a>

    </nav>


    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->


        <!-- Sidebar -->
        <div class="sidebar" style="padding-top: 50px">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-football-ball"></i>
                            <p>
                                Gestion des Tournois
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">


                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des matches</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des équipes</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>liste des joueurs </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>liste des entraineurs </p>
                                </a>
                            </li>


                        </ul>

                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-group"></i>
                            <p>
                                Tournois
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Liste des tournois</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content">
            @yield('content')
        </section>

    </div>



</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    window.deleteButtonTrans = '{{ trans("quickadmin.qa_delete_selected") }}';
    window.copyButtonTrans = '{{ trans("quickadmin.qa_copy") }}';
    window.csvButtonTrans = '{{ trans("quickadmin.qa_csv") }}';
    window.excelButtonTrans = '{{ trans("quickadmin.qa_excel") }}';
    window.pdfButtonTrans = '{{ trans("quickadmin.qa_pdf") }}';
    window.printButtonTrans = '{{ trans("quickadmin.qa_print") }}';
    window.colvisButtonTrans = '{{ trans("quickadmin.qa_colvis") }}';
</script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('adminlte/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('adminlte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>




<style>
    .swal-icon--custom > img {
        max-height: 250px;
        border-radius: 50%;
    }
</style>
{{--}}<script src="/assets/SpiderWebtr/isAuth/isAuth.js"></script>{{--}}

{{--}}endpopup{{--}}


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('emoji/emojionearea.min.js')}}"></script>

<script>
    window.laravel_echo_port = '6001';
    console.log('port laravel echo', window.laravel_echo_port);
</script>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
@yield('javascript')
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>
