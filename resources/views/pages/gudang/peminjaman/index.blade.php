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
                <div class="col-sm-6 offset-sm-6">
                    @if (Auth::user()->role_id === 1)
                        <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                            href="{{ route('admin.gudang.peminjaman.pengajuan.index') }}">
                        @else
                            <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                                href="{{ route('manajemen.gudang.peminjaman.pengajuan.index') }}">
                    @endif
                    <i class="fas fa-bell mr-2"></i>Pengajuan
                    </a>
                    <button class="btn btn-primary btn-sm mr-2 float-sm-right" data-toggle="modal"
                        data-target="#modal-add-title" data-backdrop="static">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
            </div>

            <div class="modal fade" id="modal-add-title">
                <div class="modal-dialog modal-dialog-centered modal-md">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah {{ $data['page'] }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (Auth::user()->role_id === 1)
                                <form action="{{ route('admin.gudang.peminjaman.store') }}" method="post"
                                    class="form-horizontal" id="form-tambah-peminjaman">
                                @else
                                    <form action="{{ route('manajemen.gudang.peminjaman.store') }}" method="post"
                                        class="form-horizontal" id="form-tambah-peminjaman">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">No. Pengajuan Barang</label>
                                    <div class="input-group">
                                        <select type="text" name="pengajuanbarang_id" class="form-control select2"
                                            onchange="peminjamanBarang()" style="width: 100%" id="pengajuanbarang_id">
                                            <option value="" disabled selected>Pilih No. Peminjaman</option>
                                            @foreach ($data['pengajuanBarang'] as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->id }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Jumlah Barang</label>
                                    <div class="input-group" id="input-jumlahbarang">
                                        <input type="text" name="jumlahbarang" class="form-control"
                                            style="text-transform: capitalize" id="jumlahbarang">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Barang</label>
                                <div class="input-group" id="input-subsubkelompokbarang_id">
                                    <select class="form-control select2" id="subsubkelompokbarang_id"
                                        name="subsubkelompokbarang_id" style="width: 100%">
                                        <option value="" disabled selected>Pilih Jenis Barang</option>
                                        @foreach ($data['inventarisTersedia'] as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama }} | {{ $item->jumlah }} Unit</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group" id="input-ruangan_id">
                                    <label for="exampleInputEmail1">Ruangan</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="ruangan_id" name="ruangan_id"
                                            style="width: 100%">
                                            <option value="" disabled selected>Pilih Ruangan</option>
                                            @foreach ($data['ruangan'] as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Pengguna</label>
                                    <div class="input-group" id="input-user_id">
                                        <select class="form-control select2" id="user_id" name="user_id"
                                            style="width: 100%">
                                            <option value="" disabled selected>Pilih Pengguna</option>
                                            @foreach ($data['user'] as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
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
                                        <th class="text-center">No. Pengajuan</th>
                                        <th class="text-center">Kode Inventaris</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Ruangan</th>
                                        <th class="text-center">Pengguna</th>
                                        <th class="text-center">Mulai Peminjaman</th>
                                        <th class="text-center">Status Peminjaman</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Selesai Peminjaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data['inventarisDigunakan'] as $item)
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>
                                                @if (empty($item->nopengajuan))
                                                    -
                                                @else
                                                    {{ $item->nopengajuan }}
                                                @endif
                                            </td>
                                            <td>{{ $item->inventarisbarang_id }}</td>
                                            <td>{{ $item->inventarisBarang->subsubkelompokbarang->nama }}</td>
                                            <td>{{ $item->ruangan->nama }}</td>
                                            <td>{{ $item->user->nama }}</td>
                                            <td>{{ $item->mulaidigunakan }}</td>
                                            <td>
                                                @if (empty($item->selesaidigunakan))
                                                    <span class="badge badge-warning">
                                                        Sedang digunakan
                                                    @else
                                                        <span class="badge badge-success">
                                                            Sudah dikembalikan
                                                @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if (empty($item->selesaidigunakan))
                                                    @if (Auth::user()->role_id === 1)
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('admin.gudang.peminjaman.edit', ['id' => $item->id]) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @elseif (Auth::user()->role_id === 3)
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('manajemen.gudang.peminjaman.edit', ['id' => $item->id]) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endif
                                                    <a class="btn btn-danger btn-sm"
                                                        onclick="deletePeminjamanBarang({{ $item }})"
                                                        data-toggle="modal" data-target="#modal-delete-peminjamanbarang">
                                                        <i class="fas fa-trash"></i></a>
                                                    <a class="btn btn-primary btn-sm"
                                                        onclick="endPeminjamanBarang({{ $item }})"
                                                        data-toggle="modal" data-target="#modal-end-peminjamanbarang">
                                                        <i class="fas fa-check"></i></a>
                                                @endif
                                            </td>
                                            <td>{{ $item->selesaidigunakan }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">No. Pengajuan</th>
                                        <th class="text-center">Kode Inventaris</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Ruangan</th>
                                        <th class="text-center">Pengguna</th>
                                        <th class="text-center">Mulai Peminjaman</th>
                                        <th class="text-center">Status Peminjaman</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Selesai Peminjaman</th>
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
    <!-- /.content -->
    <div class="modal fade" id="modal-end-peminjamanbarang">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Selesai {{ $data['page'] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (Auth::user()->role_id === 1)
                        <form action="{{ route('admin.gudang.peminjaman.end') }}" method="post" class="form-horizontal">
                        @else
                            <form action="{{ route('manajemen.gudang.peminjaman.end') }}" method="post"
                                class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" name="end_id" id="end_id" value="" />
                    Apakah inventaris <span name="end_name" id="end_name"></span> sudah selesai dipinjam?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
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
        $('#form-tambah-peminjaman').validate({
            rules: {
                subsubkelompokbarang_id: {
                    required: true,
                },
                jumlahbarang: {
                    required: true,
                },
                ruangan_id: {
                    required: true
                },
                user_id: {
                    required: true
                }
            },
            messages: {
                subsubkelompokbarang_id: {
                    required: "Silahkan pilih barang",
                },
                jumlahbarang: {
                    required: "Silahkan masukkan jumlah barang",
                },
                ruangan_id: {
                    required: "Silahkan pilih ruangan",
                },
                user_id: {
                    required: "Silahkan pilih pengguna"
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

        function endPeminjamanBarang(arr) {
            $('#end_id').val(arr.id)
            $('#end_name').text(arr.id)
        }

        function peminjamanBarang() {
            var pengajuanBarangId = document.getElementById("pengajuanbarang_id").value;
            var userId = '';
            var subSubKelompokBarangId = '';
            var html1 = " ";
            var html2 = " ";
            var html3 = " ";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('check/peminjaman-barang') !!}',
                data: {
                    'id': pengajuanBarangId
                },
                success: function(dataPengajuanBarang) {
                    userId = dataPengajuanBarang.user_id;
                    subSubKelompokBarangId = dataPengajuanBarang.subsubkelompokbarang_id;

                    $('#input-jumlahbarang').empty();
                    html1 +=
                        '<input type="hidden" name="jumlahbarang" class="form-control" style="text-transform: capitalize" id="jumlahbarang" value="' +
                        dataPengajuanBarang.jumlahbarang + '">';
                    html1 +=
                        '<input type="text" name="jumlahbarangtext" class="form-control" style="text-transform: capitalize" id="jumlahbarangtext" value="' +
                        dataPengajuanBarang.jumlahbarang + '" disabled>';
                    $('#input-jumlahbarang').append(html1);

                    $.ajax({
                        type: 'get',
                        url: '{!! URL::to('check/user') !!}',
                        data: {
                            'id': userId
                        },
                        success: function(dataUser) {
                            $('#input-user_id').empty();
                            html2 +=
                                '<input type="hidden" name="user_id" class="form-control" style="text-transform: capitalize" id="user_id" value="' +
                                dataUser.id + '">';
                            html2 +=
                                '<input type="text" name="username" class="form-control" style="text-transform: capitalize" id="username" value="' +
                                dataUser.nama + '" disabled>';
                            $('#input-user_id').append(html2);
                        },
                        error: function() {}
                    });

                    $.ajax({
                        type: 'get',
                        url: '{!! URL::to('check/jenis-barang') !!}',
                        data: {
                            'id': subSubKelompokBarangId
                        },
                        success: function(dataJenisBarang) {
                            $('#input-subsubkelompokbarang_id').empty();
                            html3 +=
                                '<input type="hidden" name="subsubkelompokbarang_id" class="form-control" style="text-transform: capitalize" id="subsubkelompokbarang_id" value="' +
                                dataJenisBarang.id + '">';
                            html3 +=
                                '<input type="text" name="subsubkelompokbarangname" class="form-control" style="text-transform: capitalize" id="subsubkelompokbarangname" value="' +
                                dataJenisBarang.nama + '" disabled>';
                            $('#input-subsubkelompokbarang_id').append(html3);
                        },
                        error: function() {}
                    });
                },
                error: function() {}
            });

        }

        function deletePeminjamanBarang(arr) {
            $('#delete_id').val(arr.id)
            $('#delete_inventarisbarang_id').val(arr.inventarisbarang_id)
            $('#delete_nama').text(arr.inventarisbarang_id)
        }

    </script>
@endsection
