@extends($data['layout'])
@section('title', $data['page'] . ' | ' . $data['app'])
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $data['page'] }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ $data['page'] }}</a></li>
                        <li class="breadcrumb-item active">{{ $data['subpage'] }}</li>
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
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['subpage'] . ' ' . $data['page'] }}</h3>

                            <div class="card-tools">
                                <button onclick="goBack()" type="button" class="btn btn-tool">
                                    <i class="fas fa-chevron-circle-left"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.gudang.inventaris.update') }}" method="post" class="form-horizontal"
                                id="form-edit-subsubkelompokbarang">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ $data['inventaris']->id }}">
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="exampleInputEmail1">No. Inventaris</label>
                                        <div class="input-group">
                                            <input type="text" name="kodesubsubkelompokbarang"
                                                class="form-control col-sm-4 text-center" style="text-transform: capitalize"
                                                id="kodesubsubkelompokbarang"
                                                value="{{ $data['inventaris']->subsubkelompokbarang_id }}" disabled>
                                            <input type="text" name="noregister" class="form-control col-sm-8"
                                                style="text-transform: capitalize" id="noregister"
                                                value="{{ sprintf('%03s', $data['inventaris']->noregister) }}" disabled>
                                            <input type="hidden" name="noregisterhidden" id="noregisterhidden"
                                                value="{{ $data['inventaris']->noregister }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-tags"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="exampleInputEmail1">Nama Barang</label>
                                        <div class="input-group">
                                            <select class="form-control select2" onchange="subSubKelompokBarang()"
                                                id="subsubkelompokbarang_id" name="subsubkelompokbarang_id"
                                                style="width: 100%;">
                                                <option value="{{ $data['inventaris']->subsubkelompokbarang_id }}"
                                                    selected>{{ $data['inventaris']->subSubKelompokBarang->nama }}
                                                </option>
                                                @foreach ($data['subSubKelompokBarang']->except($data['inventaris']->subsubkelompokbarang_id) as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="exampleInputEmail1">Merek/Model</label>
                                        <div class="input-group">
                                            <input type="text" name="merekmodel" class="form-control"
                                                style="text-transform: capitalize" id="merekmodel"
                                                value="{{ $data['inventaris']->merekmodel }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-signature"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="exampleInputEmail1">No. Seri</label>
                                        <div class="input-group">
                                            <input type="text" name="noseri" class="form-control"
                                                style="text-transform: capitalize" id="noseri"
                                                value="{{ $data['inventaris']->noseri }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span><b>SN</b></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="exampleInputEmail1">Ukuran</label>
                                        <div class="input-group">
                                            <input type="text" name="ukuran" class="form-control col-sm-8"
                                                style="text-transform: capitalize" id="ukuran"
                                                value="{{ $data['inventaris']->ukuran }}">
                                            <select class="form-control select2" id="ukuranbarang_id" name="ukuranbarang_id"
                                                style="width: 33.33%">
                                                <option value="{{ $data['inventaris']->ukuranbarang_id }}" selected>
                                                    {{ $data['inventaris']->ukuranBarang->nama }}</option>
                                                @foreach ($data['ukuranBarang']->except($data['inventaris']->ukuranbarang_id) as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="exampleInputEmail1">Bahan</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="bahanbarang_id" name="bahanbarang_id"
                                                style="width: 100%">
                                                <option value="{{ $data['inventaris']->bahanbarang_id }}" selected>
                                                    {{ $data['inventaris']->bahanBarang->nama }}</option>
                                                @foreach ($data['bahanBarang']->except($data['inventaris']->bahanbarang_id) as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Tahun Pembuatan</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="tahunpembuatan" name="tahunpembuatan"
                                                style="width: 100%">
                                                <option value="{{ $data['inventaris']->tahunpembuatan }}" selected>
                                                    {{ $data['inventaris']->tahunpembuatan }}</option>
                                                @foreach (range(date('Y'), 1950) as $tahun)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">Tanggal Pembelian</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" name="tanggalpembelian"
                                                class="form-control datetimepicker-input" id="tanggalpembelian"
                                                data-target="#reservationdate"
                                                value="{{ $data['inventaris']->tanggalpembelian }}" />
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-sm-3 form-group">
                                        <label for="exampleInputEmail1">Tahun Pembuatan</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="tahunpembuatan" name="tahunpembuatan"
                                                style="width: 100%">
                                                <option value="{{ $data['inventaris']->tahunpembuatan }}" selected>
                                                    {{ $data['inventaris']->tahunpembuatan }}</option>
                                                @foreach (range(date('Y'), 1950) as $tahun)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 form-group ">
                                        <label for="exampleInputEmail1">Tanggal Pembelian</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" name="tanggalpembelian"
                                                class="form-control datetimepicker-input" id="tanggalpembelian"
                                                data-target="#reservationdate"
                                                value="{{ $data['inventaris']->tanggalpembelian }}" />
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label for="exampleInputEmail1">Kondisi Barang</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="kondisibarang_id"
                                                name="kondisibarang_id" style="width: 100%">
                                                <option value="{{ $data['inventaris']->kondisibarang_id }}" selected>
                                                    {{ $data['inventaris']->kondisiBarang->nama }}</option>
                                                @foreach ($data['kondisiBarang']->except($data['inventaris']->kondisibarang_id) as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label for="exampleInputEmail1">Status Barang</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="statusbarang_id" name="statusbarang_id"
                                                style="width: 100%">
                                                <option value="{{ $data['inventaris']->statusbarang_id }}" selected>
                                                    {{ $data['inventaris']->statusBarang->nama }}</option>
                                                @foreach ($data['statusBarang']->except($data['inventaris']->statusbarang_id) as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{-- Footer --}}
                            <div class="form-group row">
                                <div class="col-sm-2 offset-sm-10">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
