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
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-keseluruhan-tab" data-toggle="pill"
                                        href="#custom-tabs-one-keseluruhan" role="tab"
                                        aria-controls="custom-tabs-one-keseluruhan" aria-selected="false">Keseluruhan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-pribadi-tab" data-toggle="pill"
                                        href="#custom-tabs-one-pribadi" role="tab" aria-controls="custom-tabs-one-pribadi"
                                        aria-selected="false">Pribadi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-keseluruhan" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-keseluruhan-tab">
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
                                                    <a href="{{ route('admin.gudang.inventaris.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.gudang.inventaris.index') }}"
                                                        class="small-box-footer">More info
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
                                                    <a href="{{ route('admin.gudang.pengajuan.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.gudang.pengajuan.index') }}"
                                                        class="small-box-footer">More info
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
                                                    <a href="{{ route('admin.user.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.user.index') }}"
                                                        class="small-box-footer">More info <i
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
                                                    <a href="{{ route('admin.gudang.perbaikan.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.gudang.perbaikan.index') }}"
                                                        class="small-box-footer">More info
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
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="inventarisBarangDonutChart"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- BAR CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Pengajuan Barang</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="pengajuanBarangBarChart"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- PIE CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">User Terdaftar</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="userPieChart"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- DONUT CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Inventaris Diperbaiki</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="inventarisDiperbaikiDonutChart"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- BAR CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Inventaris Barang</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="inventarisBarangBarChart"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- BAR CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Inventaris Diperbaiki</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="inventarisDiperbaikiStackedBarChart"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- DONUT CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Pengajuan Alat Kerja</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="pengajuanBarangDonutChart1"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- DONUT CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Pengajuan Peminjaman</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="pengajuanBarangDonutChart2"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- DONUT CHART -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Pengajuan Permintaan</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="pengajuanBarangDonutChart3"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-pribadi" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-pribadi-tab">
                                    <!-- Small boxes (Stat box) -->
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3>{{ $data['totalInventarisDigunakanPribadi'] }}</h3>

                                                    <p>Inventaris Digunakan</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-bag"></i>
                                                </div>
                                                @if (Auth::user()->role_id === 1)
                                                    <a href="{{ route('admin.inventaris.digunakan.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.inventaris.digunakan.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3>{{ $data['totalPengajuanBarangPribadi'] }}</h3>

                                                    <p>Pengajuan Barang</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-stats-bars"></i>
                                                </div>
                                                @if (Auth::user()->role_id === 1)
                                                    <a href="{{ route('admin.pengajuan.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.pengajuan.index') }}"
                                                        class="small-box-footer">More info
                                                        <i class="fas fa-arrow-circle-right"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3>{{ $data['totalBarangHabisPakaiPribadi'] }}</h3>

                                                    <p>Barang Habis Pakai</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-person-add"></i>
                                                </div>
                                                @if (Auth::user()->role_id === 1)
                                                    <a href="{{ route('admin.inventaris.baranghabispakai.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 2)
                                                    <a href="{{ route('user.inventaris.baranghabispakai.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.inventaris.baranghabispakai.index') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-danger">
                                                <div class="inner">
                                                    <h3>{{ $data['totalInventarisRusakPribadi'] }}</h3>

                                                    <p>Inventaris Rusak</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-pie-graph"></i>
                                                </div>
                                                @if (Auth::user()->role_id === 1)
                                                    <a href="{{ route('admin.transaksi.perbaikan.indexpribadi') }}"
                                                        class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 2)
                                                    <a href="{{ route('user.transaksi.perbaikan.indexpribadi') }}"
                                                        class="small-box-footer">More info
                                                        <i class="fas fa-arrow-circle-right"></i></a>
                                                @elseif (Auth::user()->role_id === 3)
                                                    <a href="{{ route('management.transaksi.perbaikan.indexpribadi') }}"
                                                        class="small-box-footer">More info
                                                        <i class="fas fa-arrow-circle-right"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/chart.js/Chart.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script> --}}
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
                    var donutChartCanvas = $('#inventarisBarangDonutChart').get(0).getContext('2d')
                    var delayed;
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !
                                    delayed) {
                                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
                        plugins: {
                            labels: [{
                                render: 'label',
                                position: 'outside',
                                render: function(args) {
                                    return `${args.label} (${args.percentage}%)`
                                }
                            }, ]
                        }
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
                                label: 'Alat Kerja',
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
                                label: 'Perminjaman',
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
                                label: 'Permintaan',
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
                    var barChartCanvas = $('#pengajuanBarangBarChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    var temp0 = areaChartData.datasets[0]
                    var temp1 = areaChartData.datasets[1]
                    var temp2 = areaChartData.datasets[2]
                    barChartData.datasets[0] = temp2
                    barChartData.datasets[1] = temp1
                    barChartData.datasets[2] = temp0
                    var delayed;

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false,
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !
                                    delayed) {
                                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
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
            $.ajax({
                type: 'get',
                url: '{!! URL::to('chart/user-pie') !!}',
                success: function(data) {
                    var userPieChartData = {
                        labels: data.label,
                        datasets: [{
                            data: data.dataUser,
                            backgroundColor: ['#DC3545', '#FFC107', '#28a745'],
                        }]
                    }
                    //-------------
                    //- PIE CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var pieChartCanvas = $('#userPieChart').get(0).getContext('2d')
                    var pieData = userPieChartData;
                    var pieOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !
                                    delayed) {
                                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    var pieChart = new Chart(pieChartCanvas, {
                        type: 'pie',
                        data: pieData,
                        options: pieOptions
                    })
                }
            })
            $.ajax({
                type: 'get',
                url: '{!! URL::to('chart/inventaris-diperbaiki-doughnut') !!}',
                success: function(data) {
                    var doughnutChartData = {
                        labels: data.label,
                        datasets: [{
                            data: data.dataInventarisDiperbaiki,
                            backgroundColor: ['#DC3545', '#FFC107', '#28a745'],
                        }]
                    }
                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas = $('#inventarisDiperbaikiDonutChart').get(0).getContext('2d')
                    var delayed;
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !
                                    delayed) {
                                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
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
                url: '{!! URL::to('chart/inventaris-barang-bar') !!}',
                success: function(data) {
                    var areaChartData = {
                        labels: data.label,
                        datasets: [{
                            label: 'Jumlah',
                            backgroundColor: 'rgba(220, 53, 69,1)',
                            borderColor: 'rgba(220, 53, 69,1)',
                            pointRadius: false,
                            pointColor: '#DC3545',
                            pointStrokeColor: 'rgba(220, 53, 69,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220, 53, 69,1)',
                            data: data.dataInventarisBarang
                        }, ]
                    }
                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChartCanvas = $('#inventarisBarangBarChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    var temp = areaChartData.datasets
                    barChartData.datasets = temp
                    var delayed;

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false,
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !
                                    delayed) {
                                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
                    }

                    var barChart = new Chart(barChartCanvas, {
                        type: 'horizontalBar',
                        data: barChartData,
                        options: barChartOptions,
                    })
                }
            })
            $.ajax({
                type: 'get',
                url: '{!! URL::to('chart/inventaris-diperbaiki-bar') !!}',
                success: function(data) {
                    var areaChartData = {
                        labels: data.label,
                        datasets: [{
                                label: 'Dalam Antrian',
                                backgroundColor: 'rgba(220, 53, 69,1)',
                                borderColor: 'rgba(220, 53, 69,1)',
                                pointRadius: false,
                                pointColor: '#DC3545',
                                pointStrokeColor: 'rgba(220, 53, 69,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(220, 53, 69,1)',
                                data: data.dataInventarisDiperbaikiDalamAntrian
                            },
                            {
                                label: 'Sedang Diperbaiki',
                                backgroundColor: 'rgba(255, 193, 7, 1)',
                                borderColor: 'rgba(255, 193, 7, 1)',
                                pointRadius: false,
                                pointColor: 'rgba(255, 193, 7, 1)',
                                pointStrokeColor: '#FFC107',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(255, 193, 7,1)',
                                data: data.dataInventarisDiperbaikiSedangDiperbaiki
                            },
                            {
                                label: 'Selesai',
                                backgroundColor: 'rgba(40,167,69, 1)',
                                borderColor: 'rgba(40,167,69, 1)',
                                pointRadius: false,
                                pointColor: 'rgba(40,167,69, 1)',
                                pointStrokeColor: '#28a745',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(40,167,69,1)',
                                data: data.dataInventarisDiperbaikiSelesaiDiperbaiki
                            },
                        ]
                    }
                    // //-------------
                    // //- BAR CHART -
                    // //-------------
                    // var barChartCanvas = $('#pengajuanBarangBarChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    // var temp0 = areaChartData.datasets[0]
                    // var temp1 = areaChartData.datasets[1]
                    // var temp2 = areaChartData.datasets[2]
                    // barChartData.datasets[0] = temp2
                    // barChartData.datasets[1] = temp1
                    // barChartData.datasets[2] = temp0
                    // var delayed;

                    // var barChartOptions = {
                    //     responsive: true,
                    //     maintainAspectRatio: false,
                    //     datasetFill: false,
                    //     animation: {
                    //         onComplete: () => {
                    //             delayed = true;
                    //         },
                    //         delay: (context) => {
                    //             let delay = 0;
                    //             if (context.type === 'data' && context.mode === 'default' && !
                    //                 delayed) {
                    //                 delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    //             }
                    //             return delay;
                    //         },
                    //     },
                    // }

                    // var barChart = new Chart(barChartCanvas, {
                    //     type: 'bar',
                    //     data: barChartData,
                    //     options: barChartOptions
                    // })

                    //---------------------
                    //- STACKED BAR CHART -
                    //---------------------
                    var stackedBarChartCanvas = $('#inventarisDiperbaikiStackedBarChart').get(0).getContext(
                        '2d')
                    var stackedBarChartData = $.extend(true, {}, barChartData)

                    var stackedBarChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                stacked: true,
                            }],
                            yAxes: [{
                                stacked: true
                            }]
                        }
                    }

                    var stackedBarChart = new Chart(stackedBarChartCanvas, {
                        type: 'bar',
                        data: stackedBarChartData,
                        options: stackedBarChartOptions
                    })
                }
            })
            $.ajax({
                type: 'get',
                url: '{!! URL::to('chart/pengajuan-barang-doughnut') !!}',
                success: function(data) {
                    var doughnutChartData1 = {
                        labels: data.label1,
                        datasets: [{
                            data: data.dataPengajuanAlatKerja,
                            backgroundColor: ['#DC3545', '#FFC107', '#28a745'],
                        }]
                    }
                    var doughnutChartData2 = {
                        labels: data.label2,
                        datasets: [{
                            data: data.dataPengajuanPeminjaman,
                            backgroundColor: ['#DC3545', '#FFC107', '#28a745'],
                        }]
                    }
                    var doughnutChartData3 = {
                        labels: data.label3,
                        datasets: [{
                            data: data.dataPengajuanPermintaan,
                            backgroundColor: ['#DC3545', '#FFC107', '#28a745'],
                        }]
                    }
                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas1 = $('#pengajuanBarangDonutChart1').get(0).getContext('2d')
                    var donutChartCanvas2 = $('#pengajuanBarangDonutChart2').get(0).getContext('2d')
                    var donutChartCanvas3 = $('#pengajuanBarangDonutChart3').get(0).getContext('2d')
                    var delayed;
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !
                                    delayed) {
                                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    var donutChart1 = new Chart(donutChartCanvas1, {
                        type: 'doughnut',
                        data: doughnutChartData1,
                        options: donutOptions
                    })
                    var donutChart2 = new Chart(donutChartCanvas2, {
                        type: 'doughnut',
                        data: doughnutChartData2,
                        options: donutOptions
                    })
                    var donutChart3 = new Chart(donutChartCanvas3, {
                        type: 'doughnut',
                        data: doughnutChartData3,
                        options: donutOptions
                    })
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
