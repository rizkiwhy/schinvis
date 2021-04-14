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
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-sm mr-2 float-sm-right" data-toggle="modal"
                        data-target="#modal-add-title" data-backdrop="static">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
            </div>

            <div class="modal fade" id="modal-add-title">
                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah {{ $data['page'] }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (Auth::user()->role_id === 1)
                                <form action="{{ route('admin.gudang.inventaris.store') }}" method="post"
                                    class="form-horizontal" id="form-tambah-inventaris">
                                @else
                                    <form action="{{ route('management.gudang.inventaris.store') }}" method="post"
                                        class="form-horizontal" id="form-tambah-inventaris">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">No. Inventaris</label>
                                    <div class="input-group">
                                        <input type="text" name="kodesubsubkelompokbarang"
                                            class="form-control col-sm-4 text-center" style="text-transform: capitalize"
                                            id="kodesubsubkelompokbarang" disabled>
                                        <input type="text" name="noregister" class="form-control col-sm-8"
                                            style="text-transform: capitalize" id="noregister" disabled>
                                        <input type="hidden" name="noregisterhidden" id="noregisterhidden">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-tags"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <div class="input-group">
                                        <select class="form-control select2" onchange="subSubKelompokBarang()"
                                            id="subsubkelompokbarang_id" name="subsubkelompokbarang_id"
                                            style="width: 100%;">
                                            <option value="" disabled selected>Pilih Barang</option>
                                            @foreach ($data['subSubKelompokBarang'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Merek/Model</label>
                                    <div class="input-group">
                                        <input type="text" name="merekmodel" class="form-control"
                                            style="text-transform: capitalize" id="merekmodel">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-signature"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">No. Seri</label>
                                    <div class="input-group">
                                        <input type="text" name="noseri" class="form-control"
                                            style="text-transform: capitalize" id="noseri">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-barcode"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Ukuran</label>
                                    <div class="input-group">
                                        <input type="text" name="ukuran" class="form-control col-sm-6"
                                            style="text-transform: capitalize" id="ukuran">
                                        <select class="form-control select2" id="ukuranbarang_id" name="ukuranbarang_id"
                                            style="width: 50%">
                                            <option value="" disabled selected>Pilih Satuan Ukuran</option>
                                            @foreach ($data['ukuranBarang'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Bahan</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="bahanbarang_id" name="bahanbarang_id"
                                            style="width: 100%">
                                            <option value="" disabled selected>Pilih Bahan</option>
                                            @foreach ($data['bahanBarang'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Tahun Pembuatan</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="tahunpembuatan" name="tahunpembuatan"
                                            style="width: 100%">
                                            <option value="" disabled selected>Pilih Tahun Pembuatan</option>
                                            @foreach (range(date('Y'), 1950) as $tahun)
                                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group ">
                                    <label for="exampleInputEmail1">Tanggal Pembelian</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" name="tanggalpembelian" class="form-control datetimepicker-input"
                                            id="tanggalpembelian" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputEmail1">Kondisi Barang</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="kondisibarang_id" name="kondisibarang_id"
                                            style="width: 100%">
                                            <option value="" disabled selected>Pilih Kondisi Barang</option>
                                            @foreach ($data['kondisiBarang'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputEmail1">Status Barang</label>
                                    <div class="input-group">
                                        <input type="hidden" name="statusbarang_id" id="statusbarang_id"
                                            value="{{ $data['statusBarang']->id }}">
                                        <input type="text" name="statusbarang" class="form-control"
                                            style="text-transform: capitalize" id="statusbarang"
                                            value="{{ $data['statusBarang']->nama }}" disabled>
                                        {{-- <select class="form-control select2" id="statusbarang_id" name="statusbarang_id"
                                                style="width: 100%">
                                                <option value="" disabled selected>Pilih Status Barang</option>
                                                @foreach ($data['statusBarang'] as $item)
                                                    <option disabled selected value="{{ $data['statusBarang']->id }}">{{ $data['statusBarang']->nama }}</option>
                                                @endforeach
                                            </select> --}}
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputEmail1">Jumlah Barang</label>
                                    <div class="input-group">
                                        <input type="text" name="jumlahbarang" class="form-control"
                                            style="text-transform: capitalize" id="jumlahbarang">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-boxes"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
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
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Data {{ $data['page'] }}</h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">No. Inventaris</th>
                                        <th class="text-center">Merek/Model</th>
                                        <th class="text-center">Ukuran</th>
                                        <th class="text-center">Kondisi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Tanggal Pembelian</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Bahan</th>
                                        <th class="text-center">No. Seri</th>
                                        <th class="text-center">Tahun Pembuatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data['inventaris'] as $item)
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>{{ $item->subSubKelompokBarang->nama }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->merekmodel }}</td>
                                            <td>{{ $item->ukuran . ' ' . $item->ukuranBarang->nama }}</td>
                                            <td>
                                                @if ($item->kondisibarang_id === 1)
                                                    <span class="badge badge-success">
                                                    @elseif($item->kondisibarang_id === 2)
                                                        <span class="badge badge-warning">
                                                        @else
                                                            <span class="badge badge-danger">
                                                @endif
                                                {{ $item->kondisiBarang->nama }}
                                                </span>
                                            </td>
                                            <td>{{ $item->statusBarang->nama }}</td>
                                            <td>{{ $item->tanggalpembelian }}</td>
                                            <td class="text-center">
                                                @if (Auth::user()->role_id === 1)
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('admin.gudang.inventaris.edit', ['id' => $item->id]) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                @else
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('management.gudang.inventaris.edit', ['id' => $item->id]) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                @endif
                                                <a class="btn btn-danger btn-sm"
                                                    onclick="deleteInventarisBarang({{ $item }})"
                                                    data-toggle="modal" data-target="#modal-delete-inventarisbarang">
                                                    <i class="fas fa-trash"></i></a>
                                            </td>
                                            <td>{{ $item->bahanBarang->nama }}</td>
                                            <td>{{ $item->noseri }}</td>
                                            <td>{{ $item->tahunpembuatan }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">No. Inventaris</th>
                                        <th class="text-center">Merek/Model</th>
                                        <th class="text-center">Ukuran</th>
                                        <th class="text-center">Kondisi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Tanggal Pembelian</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Bahan</th>
                                        <th class="text-center">No. Seri</th>
                                        <th class="text-center">Tahun Pembuatan</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-delete-inventarisbarang">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus {{ $data['page'] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (Auth::user()->role_id === 1)
                        <form action="{{ route('admin.gudang.inventaris.destroy') }}" method="post"
                            class="form-horizontal">
                        @else
                            <form action="{{ route('management.gudang.inventaris.destroy') }}" method="post"
                                class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" name="delete_id" id="delete_id" value="" />
                    Apakah anda yakin akan menghapus <span name="delete_nama" id="delete_nama"></span>?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $('#form-tambah-inventaris').validate({
            rules: {
                subsubkelompokbarang_id: {
                    required: true,
                },
                merekmodel: {
                    required: true,
                },
                ukuran: {
                    required: true,
                },
                bahanbarang_id: {
                    required: true,
                },
                tahunpembuatan: {
                    required: true,
                },
                tanggalpembelian: {
                    required: true,
                },
                kondisibarang_id: {
                    required: true,
                },
                statusbarang_id: {
                    required: true,
                },
                jumlahbarang: {
                    required: true,
                },
            },
            messages: {
                subsubkelompokbarang_id: {
                    required: "Silahkan pilih barang",
                },
                merekmodel: {
                    required: "Silahkan masukkan merek/model",
                },
                ukuran: {
                    required: "Silahkan masukkan ukuran barang",
                },
                bahanbarang_id: {
                    required: "Silahkan masukkan bahan barang",
                },
                tahunpembuatan: {
                    required: "Silahkan masukkan tahun pembuatan",
                },
                tanggalpembelian: {
                    required: "Silahkan masukkan tanggal pembelian",
                },
                kondisibarang_id: {
                    required: "Silahkan masukkan kondisi barang",
                },
                statusbarang_id: {
                    required: "Silahkan masukkan status barang",
                },
                jumlahbarang: {
                    required: "Silahkan masukkan jumlah barang",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        function subSubKelompokBarang() {
            var subSubKelompokBarangId = document.getElementById("subsubkelompokbarang_id").value;
            $('#kodesubsubkelompokbarang').val(subSubKelompokBarangId);

            $.ajax({
                type: 'get',
                url: '{!! URL::to('check/no-register-inventaris') !!}',
                data: {
                    'subsubkelompokbarang_id': subSubKelompokBarangId
                },
                success: function(data) {
                    const newNoRegister = data;
                    $('#noregister').val(newNoRegister);
                    $('#noregisterhidden').val(newNoRegister);
                },
                error: function() {}
            });
        }

        function deleteInventarisBarang(arr) {
            $('#delete_id').val(arr.id)
            $('#delete_nama').text(arr.id)
        }

    </script>
@endsection
