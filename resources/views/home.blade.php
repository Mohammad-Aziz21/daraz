@include('header')

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->

                <div class="col-md-12">
                    <!-- MAP & BOX PANE -->


                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">All Orders Combined</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Procurement</th>
                                        <th>Date</th>
                                        <th>Status</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data2 as $value2)
                                    <tr>
                                        <td><a href="pages/examples/invoice.html"></a>{{$value2 -> account_email}}</td>
                                        <td>{{$value2 -> OrderId}}</td>
                                        <td><span class="">{{$value2 -> CustomerFirstName}}</span></td>
                                        <td><span class="">{{$value2 -> Name}}</span></td>
                                        <td><span class="">{{$value2 -> Price}}</span></td>
                                        <td><span class="">{{$value2 -> OrderProcurement}}</span></td>
                                        <td><span class="badge badge-success">{{$value2 -> CreatedAt}}</span></td>
                                        <td><span class="badge badge-success">{{$value2 -> Statuses}}</span></td>

                                    </tr>
                                    @endforeach
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>--}}
{{--                                        <td>Samsung Smart TV</td>--}}
{{--                                        <td><span class="badge badge-warning">Pending</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
{{--                                        <td>iPhone 6 Plus</td>--}}
{{--                                        <td><span class="badge badge-danger">Delivered</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
{{--                                        <td>Samsung Smart TV</td>--}}
{{--                                        <td><span class="badge badge-info">Processing</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>--}}
{{--                                        <td>Samsung Smart TV</td>--}}
{{--                                        <td><span class="badge badge-warning">Pending</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
{{--                                        <td>iPhone 6 Plus</td>--}}
{{--                                        <td><span class="badge badge-danger">Delivered</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>--}}
{{--                                        <td>Call of Duty IV</td>--}}
{{--                                        <td><span class="badge badge-success">Shipped</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


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
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
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
