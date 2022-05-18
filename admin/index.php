<!DOCTYPE html>
<html lang="en">
<?php
include_once "../app/connect.php";
include_once "../admin/function.php";

include_once "./includes/head.php";

$current = date('Y-m-d');
$todayTotalRevenue = getBillsTotalByDate($conn, $current . " 00:00:00", $current . " 23:59:59");
$todayTotalProduct = getProductTotalByDate($conn, $current . " 00:00:00", $current . " 23:59:59");

$bestSellingMonth = getProductBestSelling($conn, date('m'));
?>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->

        <?php include_once "./includes/navbar.php" ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once "./includes/sidebar.php" ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>$<?= $todayTotalRevenue ?></h3>

                                    <p>Today's revenue</p>
                                </div>
                                <div class="icon">
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $todayTotalProduct ?></h3>

                                    <p>Product sold</p>
                                </div>
                                <div class="icon">
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <a href="/admin/product/show.php?id=<?= $bestSellingMonth['product_id'] ?>">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3><?= mb_strimwidth($bestSellingMonth['product_name'], 0, 12, '...') ?></h3>

                                        <p>This month best-selling(<?= $bestSellingMonth['tong'] ?>)</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- ./col -->

                        <!-- ./col -->
                    </div>
                    <div class="row">

                        <!-- /.col-md-6 -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Revenue</h3>
                                        <!-- <a href="javascript:void(0);">View Report</a> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">

                                        <!-- <p class="ml-auto d-flex flex-column text-right">
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> 33.1%
                                            </span>
                                            <span class="text-muted">Since last month</span>
                                        </p> -->
                                    </div>
                                    <!-- /.d-flex -->

                                    <div class="position-relative mb-4">
                                        <canvas id="sales-chart" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> This year
                                        </span>

                                        <span>
                                            <i class="fas fa-square text-gray"></i> Last year
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->


                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Number of product sold</h3>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="position-relative mb-4">
                                        <canvas id="visitors-chart" height="200" width="487" style="display: block; width: 487px; height: 200px;" class="chartjs-render-monitor"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> This Year
                                        </span>

                                        <span>
                                            <i class="fas fa-square text-danger"></i> Last Year
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
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
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0-rc
            </div>
        </footer>
    </div>

    <?php include_once "./includes/foot.php" ?>



    <script>
        $.ajax({
            type: "get",
            url: '/admin/dashboard.php',
            data: {
                "get": 1
            },
            success: function(response) {




                // let result = JSON.parse(response);
                let str = (response.slice(1, -1));
                let result = str.split(',');
                let current = result.splice(0, 12);
                let last = result;


                // result.forEach(function(e){
                //     currentRevenue.push(e);
                // })

                //    let a = JSON.parse(response);
                //    console.log(a)
                $(function() {
                    var ticksStyle = {
                        fontColor: '#495057',
                        fontStyle: 'bold'
                    }

                    var mode = 'index'
                    var intersect = true

                    var $salesChart = $('#sales-chart')
                    // eslint-disable-next-line no-unused-vars
                    var salesChart = new Chart($salesChart, {
                        type: 'bar',
                        data: {
                            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                            datasets: [{
                                    backgroundColor: '#007bff',
                                    borderColor: '#007bff',
                                    data: current
                                },
                                {
                                    backgroundColor: '#ced4da',
                                    borderColor: '#ced4da',
                                    data: last
                                }
                            ]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    // display: false,
                                    gridLines: {
                                        display: true,
                                        lineWidth: '4px',
                                        color: 'rgba(0, 0, 0, .2)',
                                        zeroLineColor: 'transparent'
                                    },
                                    ticks: $.extend({
                                        beginAtZero: true,

                                        // Include a dollar sign in the ticks
                                        callback: function(value) {
                                            if (value >= 1000) {
                                                value /= 1000
                                                value += 'k'
                                            }

                                            return '$' + value
                                        }
                                    }, ticksStyle)
                                }],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: ticksStyle
                                }]
                            }
                        }
                    })
                })
            }
        });


        $.ajax({
            type: "get",
            url: '/admin/dashboard.php',
            data: {
                "number": 1
            },
            success: function(response) {

                let str = (response.slice(1, -1));
                let result = str.split(',');
                let current = result.splice(0, 12);
                let last = result;


                $(function() {
                    'use strict'

                    var ticksStyle = {
                        fontColor: '#495057',
                        fontStyle: 'bold'
                    }
                    var mode = 'index'
                    var intersect = true
                    var $visitorsChart = $('#visitors-chart')
                    // eslint-disable-next-line no-unused-vars
                    var visitorsChart = new Chart($visitorsChart, {
                        data: {
                            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                            datasets: [{
                                    type: 'line',
                                    data: current,
                                    backgroundColor: 'transparent',
                                    borderColor: '#007bff',
                                    pointBorderColor: '#007bff',
                                    pointBackgroundColor: '#007bff',
                                    fill: false,
                                    // pointHoverBackgroundColor: '#007bff',
                                    // pointHoverBorderColor    : '#007bff'
                                },
                                {
                                    type: 'line',
                                    data: last,
                                    backgroundColor: 'transparent',
                                    // borderColor: '#ced4da',
                                    borderColor: 'red',

                                    pointBorderColor: '#ced4da',
                                    pointBackgroundColor: '#ced4da',
                                    fill: false
                                    // pointHoverBackgroundColor: '#ced4da',
                                    // pointHoverBorderColor    : '#ced4da'
                                }
                            ]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    // display: false,
                                    gridLines: {
                                        display: true,
                                        lineWidth: '4px',
                                        color: 'rgba(0, 0, 0, .2)',
                                        zeroLineColor: 'transparent'
                                    },
                                    ticks: $.extend({
                                        beginAtZero: true,
                                        suggestedMax: 200
                                    }, ticksStyle)
                                }],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: ticksStyle
                                }]
                            }
                        }
                    })
                })
            }

        });
    </script>
</body>

</html>