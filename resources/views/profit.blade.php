<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <a href="/home"><title>Daraz</title></a>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/home" class="nav-link">Home</a>
            </li>
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="#" class="nav-link">Contact</a>--}}
{{--            </li>--}}
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/home" class="brand-link">
            <img src="/img/webcloud1.png" alt="" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Daraz</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/img/webcloud1.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">WebCloudSoft</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <nav class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @foreach($data2 as $value2)
                        <li class="nav-item has-treeview menu-close">
                            <a href="#" class="nav-link active">

                                <p>{{$value2 -> account_name}}

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
{{--                                <li class="nav-item">--}}
{{--                                    <a href="/home" class="nav-link">--}}
{{--                                        <p>Products</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                                <li class="nav-item">
                                    <a href="/account/{{$value2->account_email}}/all" class="nav-link ">

                                        <p>Orders</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a href="/home" class="nav-link">--}}
                                {{--                                        <p>Products</p>--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                                <li class="nav-item">
                                    <a href="/profit/{{$value2->account_email}}" class="nav-link ">

                                        <p>Profit Calculator</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
            @endforeach
            {{--            <li class="nav-item has-treeview menu-open">--}}
            {{--                <a href="#" class="nav-link active">--}}

            {{--                    <p>--}}
            {{--                        Oscar Accessories--}}
            {{--                        <i class="right fas fa-angle-left"></i>--}}
            {{--                    </p>--}}
            {{--                </a>--}}
            {{--                <ul class="nav nav-treeview">--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a href="./index.html" class="nav-link">--}}
            {{--                            <p>Products</p>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a href="./index2.html" class="nav-link active">--}}

            {{--                            <p>Orders</p>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}

        </div>
        </nav>
        <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Women Delights</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
{{--            <div class="row">--}}
{{--                <div class="col-12 col-sm-6 col-md-3">--}}
{{--                    <div class="info-box">--}}
{{--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">CPU Traffic</span>--}}
{{--                            <span class="info-box-number">--}}
{{--                  10--}}
{{--                  <small>%</small>--}}
{{--                </span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--                <div class="col-12 col-sm-6 col-md-3">--}}
{{--                    <div class="info-box mb-3">--}}
{{--                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Likes</span>--}}
{{--                            <span class="info-box-number">41,410</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}

{{--                <!-- fix for small devices only -->--}}
{{--                <div class="clearfix hidden-md-up"></div>--}}

{{--                <div class="col-12 col-sm-6 col-md-3">--}}
{{--                    <div class="info-box mb-3">--}}
{{--                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Sales</span>--}}
{{--                            <span class="info-box-number">760</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--                <div class="col-12 col-sm-6 col-md-3">--}}
{{--                    <div class="info-box mb-3">--}}
{{--                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">New Members</span>--}}
{{--                            <span class="info-box-number">2,000</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--            </div>--}}
            <!-- /.row -->

        {{--        <div class="row">--}}
        {{--          <div class="col-md-12">--}}
        {{--            <div class="card">--}}
        {{--              <div class="card-header">--}}
        {{--                <h5 class="card-title">Monthly Recap Report</h5>--}}

        {{--                <div class="card-tools">--}}
        {{--                  <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
        {{--                    <i class="fas fa-minus"></i>--}}
        {{--                  </button>--}}
        {{--                  <div class="btn-group">--}}
        {{--                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">--}}
        {{--                      <i class="fas fa-wrench"></i>--}}
        {{--                    </button>--}}
        {{--                    <div class="dropdown-menu dropdown-menu-right" role="menu">--}}
        {{--                      <a href="#" class="dropdown-item">Action</a>--}}
        {{--                      <a href="#" class="dropdown-item">Another action</a>--}}
        {{--                      <a href="#" class="dropdown-item">Something else here</a>--}}
        {{--                      <a class="dropdown-divider"></a>--}}
        {{--                      <a href="#" class="dropdown-item">Separated link</a>--}}
        {{--                    </div>--}}
        {{--                  </div>--}}
        {{--                  <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
        {{--                    <i class="fas fa-times"></i>--}}
        {{--                  </button>--}}
        {{--                </div>--}}
        {{--              </div>--}}
        {{--              <!-- /.card-header -->--}}
        {{--              <div class="card-body">--}}
        {{--                <div class="row">--}}
        {{--                  <div class="col-md-8">--}}
        {{--                    <p class="text-center">--}}
        {{--                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>--}}
        {{--                    </p>--}}

        {{--                    <div class="chart">--}}
        {{--                      <!-- Sales Chart Canvas -->--}}
        {{--                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>--}}
        {{--                    </div>--}}
        {{--                    <!-- /.chart-responsive -->--}}
        {{--                  </div>--}}
        {{--                  <!-- /.col -->--}}
        {{--                  <div class="col-md-4">--}}
        {{--                    <p class="text-center">--}}
        {{--                      <strong>Goal Completion</strong>--}}
        {{--                    </p>--}}

        {{--                    <div class="progress-group">--}}
        {{--                      Add Products to Cart--}}
        {{--                      <span class="float-right"><b>160</b>/200</span>--}}
        {{--                      <div class="progress progress-sm">--}}
        {{--                        <div class="progress-bar bg-primary" style="width: 80%"></div>--}}
        {{--                      </div>--}}
        {{--                    </div>--}}
        {{--                    <!-- /.progress-group -->--}}

        {{--                    <div class="progress-group">--}}
        {{--                      Complete Purchase--}}
        {{--                      <span class="float-right"><b>310</b>/400</span>--}}
        {{--                      <div class="progress progress-sm">--}}
        {{--                        <div class="progress-bar bg-danger" style="width: 75%"></div>--}}
        {{--                      </div>--}}
        {{--                    </div>--}}

        {{--                    <!-- /.progress-group -->--}}
        {{--                    <div class="progress-group">--}}
        {{--                      <span class="progress-text">Visit Premium Page</span>--}}
        {{--                      <span class="float-right"><b>480</b>/800</span>--}}
        {{--                      <div class="progress progress-sm">--}}
        {{--                        <div class="progress-bar bg-success" style="width: 60%"></div>--}}
        {{--                      </div>--}}
        {{--                    </div>--}}

        {{--                    <!-- /.progress-group -->--}}
        {{--                    <div class="progress-group">--}}
        {{--                      Send Inquiries--}}
        {{--                      <span class="float-right"><b>250</b>/500</span>--}}
        {{--                      <div class="progress progress-sm">--}}
        {{--                        <div class="progress-bar bg-warning" style="width: 50%"></div>--}}
        {{--                      </div>--}}
        {{--                    </div>--}}
        {{--                    <!-- /.progress-group -->--}}
        {{--                  </div>--}}
        {{--                  <!-- /.col -->--}}
        {{--                </div>--}}
        {{--                <!-- /.row -->--}}
        {{--              </div>--}}
        {{--              <!-- ./card-body -->--}}
        {{--              <div class="card-footer">--}}
        {{--                <div class="row">--}}
        {{--                  <div class="col-sm-3 col-6">--}}
        {{--                    <div class="description-block border-right">--}}
        {{--                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>--}}
        {{--                      <h5 class="description-header">$35,210.43</h5>--}}
        {{--                      <span class="description-text">TOTAL REVENUE</span>--}}
        {{--                    </div>--}}
        {{--                    <!-- /.description-block -->--}}
        {{--                  </div>--}}
        {{--                  <!-- /.col -->--}}
        {{--                  <div class="col-sm-3 col-6">--}}
        {{--                    <div class="description-block border-right">--}}
        {{--                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>--}}
        {{--                      <h5 class="description-header">$10,390.90</h5>--}}
        {{--                      <span class="description-text">TOTAL COST</span>--}}
        {{--                    </div>--}}
        {{--                    <!-- /.description-block -->--}}
        {{--                  </div>--}}
        {{--                  <!-- /.col -->--}}
        {{--                  <div class="col-sm-3 col-6">--}}
        {{--                    <div class="description-block border-right">--}}
        {{--                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>--}}
        {{--                      <h5 class="description-header">$24,813.53</h5>--}}
        {{--                      <span class="description-text">TOTAL PROFIT</span>--}}
        {{--                    </div>--}}
        {{--                    <!-- /.description-block -->--}}
        {{--                  </div>--}}
        {{--                  <!-- /.col -->--}}
        {{--                  <div class="col-sm-3 col-6">--}}
        {{--                    <div class="description-block">--}}
        {{--                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>--}}
        {{--                      <h5 class="description-header">1200</h5>--}}
        {{--                      <span class="description-text">GOAL COMPLETIONS</span>--}}
        {{--                    </div>--}}
        {{--                    <!-- /.description-block -->--}}
        {{--                  </div>--}}
        {{--                </div>--}}
        {{--                <!-- /.row -->--}}
        {{--              </div>--}}
        {{--              <!-- /.card-footer -->--}}
        {{--            </div>--}}
        {{--            <!-- /.card -->--}}
        {{--          </div>--}}
        {{--          <!-- /.col -->--}}
        {{--        </div>--}}
        <!-- /.row -->





            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">



                    <div class="card">
                        <div class="card-header border-transparent">

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <nav class="mt-3">
                                <nav class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                    <!-- Add icons to the links using the .nav-icon class
                                         with font-awesome or any other icon font library -->


                                    <li>

                                            <form name="dateform" action="/profit/{{$arzam}}">
                                                {{ csrf_field() }}
                                                <div class="">
                                                    <div class="">
                                                        <div class="col-md-3">
                                                            <input name="date" type="date" class="form-control inline" placeholder="From Date">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                    </li>




                        </div>

                    </div>
                </div>

            </div>

            <div class="row">
                <!-- Left col -->



                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 <a href="">WebCloudSoft Pvt. Limited</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.0.1
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/plugins/raphael/raphael.min.js"></script>
<script src="/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="/dist/js/pages/dashboard2.js"></script>
</body>
</html>
