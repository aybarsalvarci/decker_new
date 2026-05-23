<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('back/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('back/dist/css/adminlte.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('back/plugins/toastr/toastr.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* pagination styles start */
        .pagination-modern .page-item {
            margin: 0 3px;
        }

        .pagination-modern .page-link {
            border: none;
            border-radius: 50% !important;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .pagination-modern .page-link:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #007bff;
        }

        .pagination-modern .page-item.active .page-link {
            background: #007bff;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
            transform: scale(1.1);
        }

        .pagination-modern .page-item.disabled .page-link {
            background-color: #f8f9fa;
            color: #d6d8db;
            cursor: not-allowed;
            box-shadow: none;
        }

        /*pagination styles end*/

        /* Alt menüleri içeri kaydır ve hiyerarşi çizgisi ekle */
        .nav-sidebar .nav-treeview {
            padding-left: 20px; /* İçeri kaydırma miktarını artırdık */
            background: rgba(255, 255, 255, 0.02); /* Çok hafif bir arka plan rengi farkı */
            border-left: 1px solid #4f5962; /* Sol tarafa dikey hiyerarşi çizgisi */
            margin-left: 10px; /* Çizginin ana menüden uzaklığı */
        }

        /* Alt menüdeki her bir linkin stili */
        .nav-sidebar .nav-treeview .nav-item .nav-link {
            font-size: 0.9rem !important; /* Yazı boyutunu bir tık küçült */
            color: #c2c7d0;
        }

        .nav-sidebar .nav-treeview .nav-item .nav-link .nav-icon {
            font-size: 0.75rem !important;
            width: 1.2rem;
            margin-right: 5px;
        }

        .nav-sidebar .nav-treeview .nav-item .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border-radius: 4px;
        }

        .nav-item.menu-open > .nav-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 5px;
        }
    </style>

    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include("admin.layouts.navbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("admin.layouts.sidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('breadcrumb-title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb-links')
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @yield('content')
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@include("admin.layouts.footer")
