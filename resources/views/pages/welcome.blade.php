@extends($data['layout'])
@section('title', $data['page'] . ' | ' . $data['app'])
@section('content-header')
    {{-- <meta http-equiv="refresh" content="5"> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('main-content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $data['totalInventarisBarang'] }}</h3>

                            <p>Inventaris Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        @if (Auth::user()->role_id === 1)
                            <a href="{{ route('admin.gudang.inventaris.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        @elseif (Auth::user()->role_id === 3)
                            <a href="{{ route('manajemen.gudang.inventaris.index') }}" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $data['totalPengajuanBarang'] }}</h3>

                            <p>Pengajuan Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        @if (Auth::user()->role_id === 1)
                            <a href="{{ route('admin.gudang.pengajuan.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        @elseif (Auth::user()->role_id === 3)
                            <a href="{{ route('manajemen.gudang.pengajuan.index') }}" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $data['totalUser'] }}</h3>

                            <p>User Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        @if (Auth::user()->role_id === 1)
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        @elseif (Auth::user()->role_id === 3)
                            <a href="{{ route('manajemen.user.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $data['totalInventarisRusak'] }}</h3>

                            <p>Inventaris Rusak</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        @if (Auth::user()->role_id === 1)
                            <a href="{{ route('admin.gudang.perbaikan.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        @elseif (Auth::user()->role_id === 3)
                            <a href="{{ route('manajemen.gudang.perbaikan.index') }}" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Inventaris Barang</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                {{-- <div class="col-md-6">
                    <!-- STACKED BAR CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Stacked Bar Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="stackedBarChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div> --}}
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pengajuan Barang</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        var getChartData = function(value) {
            $.ajax({
                type: 'get',
                url: '{!! URL::to('chart/inventaris-barang-doughnut') !!}',
                success: function(data) {
                    var doughnutChartData = {
                        labels: data.label,
                        datasets: [{
                            data: data.dataInventarisBarang,
                            backgroundColor: ['#DC3545', '#FFC107', '#28a745'],
                        }]
                    }
                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    var donutChart = new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: doughnutChartData,
                        options: donutOptions
                    })
                }
            })
            $.ajax({
                type: 'get',
                url: '{!! URL::to('chart/pengajuan-barang-bar') !!}',
                success: function(data) {
                    var areaChartData = {
                        labels: data.label,
                        datasets: [{
                                label: 'Pengajuan Alat Kerja',
                                backgroundColor: 'rgba(220, 53, 69,1)',
                                borderColor: 'rgba(220, 53, 69,1)',
                                pointRadius: false,
                                pointColor: '#DC3545',
                                pointStrokeColor: 'rgba(220, 53, 69,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(220, 53, 69,1)',
                                data: data.dataPengajuanAlatKerja
                            },
                            {
                                label: 'Pengajuan Perminjaman',
                                backgroundColor: 'rgba(255, 193, 7, 1)',
                                borderColor: 'rgba(255, 193, 7, 1)',
                                pointRadius: false,
                                pointColor: 'rgba(255, 193, 7, 1)',
                                pointStrokeColor: '#FFC107',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(255, 193, 7,1)',
                                data: data.dataPengajuanPeminjaman
                            },
                            {
                                label: 'Pengajuan Permintaan',
                                backgroundColor: 'rgba(40,167,69, 1)',
                                borderColor: 'rgba(40,167,69, 1)',
                                pointRadius: false,
                                pointColor: 'rgba(40,167,69, 1)',
                                pointStrokeColor: '#28a745',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(40,167,69,1)',
                                data: data.dataPengajuanPermintaan
                            },
                        ]
                    }
                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    var temp0 = areaChartData.datasets[0]
                    var temp1 = areaChartData.datasets[1]
                    var temp2 = areaChartData.datasets[2]
                    barChartData.datasets[0] = temp2
                    barChartData.datasets[1] = temp1
                    barChartData.datasets[2] = temp0


                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false
                    }

                    var barChart = new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })

                    // //---------------------
                    // //- STACKED BAR CHART -
                    // //---------------------
                    // var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
                    // var stackedBarChartData = $.extend(true, {}, barChartData)

                    // var stackedBarChartOptions = {
                    //     responsive: true,
                    //     maintainAspectRatio: false,
                    //     scales: {
                    //         xAxes: [{
                    //             stacked: true,
                    //         }],
                    //         yAxes: [{
                    //             stacked: true
                    //         }]
                    //     }
                    // }

                    // var stackedBarChart = new Chart(stackedBarChartCanvas, {
                    //     type: 'bar',
                    //     data: stackedBarChartData,
                    //     options: stackedBarChartOptions
                    // })
                }
            })
            setTimeout(function() {
                getChartData(value - 1);
            }, 10000);
        }

        $(document).ready(function() {
            setTimeout(function() {
                getChartData();
            }, 1);
        })

    </script>
@endsection
