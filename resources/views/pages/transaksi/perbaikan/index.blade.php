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
                                <form action="{{ route('admin.transaksi.perbaikan.storepribadi') }}" method="post"
                                    class="form-horizontal" id="form-tambah-perbaikan">
                                @elseif(Auth::user()->role_id === 2)
                                    <form action="{{ route('user.transaksi.perbaikan.storepribadi') }}" method="post"
                                        class="form-horizontal" id="form-tambah-perbaikan">
                                    @else
                                        <form action="{{ route('management.transaksi.perbaikan.storepribadi') }}"
                                            method="post" class="form-horizontal" id="form-tambah-perbaikan">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Inventaris Barang</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="inventarisbarang_id"
                                            name="inventarisbarang_id" style="width: 100%">
                                            <option value="" disabled selected>Pilih Inventaris Barang</option>
                                            @foreach ($data['inventarisTidakDiperbaiki'] as $item)
                                                <option value="{{ $item->inventarisbarang_id }}">
                                                    {{ $item->inventarisbarang_id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Kondisi Barang</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="kondisibarang_id" name="kondisibarang_id"
                                            style="width: 100%">
                                            <option value="" disabled selected>Pilih Kondisi Barang</option>
                                            @foreach ($data['kondisiBarang'] as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Masalah</label>
                                <div class="input-group">
                                    <input type="text" name="masalah" class="form-control"
                                        style="text-transform: capitalize" id="masalah">
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
                                        <th class="text-center">No. Perbaikan</th>
                                        <th class="text-center">Kode Inventaris</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Status Perbaikan</th>
                                        <th class="text-center">Mulai Perbaikan</th>
                                        <th class="text-center">Selesai Perbaikan</th>
                                        <th class="text-center">Pengguna</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Estimasi Perbaikan</th>
                                        <th class="text-center">Kondisi Barang</th>
                                        <th class="text-center">Masalah</th>
                                        <th class="text-center">Solusi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data['inventarisDiperbaiki'] as $item)
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>{{ $item->id }}
                                            <td>{{ $item->inventarisbarang_id }}</td>
                                            <td>{{ $item->inventarisBarang->subsubkelompokbarang->nama }}</td>
                                            <td>
                                                @if ($item->statuspengajuan_id === 1)
                                                    <span class="badge badge-danger">
                                                    @elseif($item->statuspengajuan_id === 2)
                                                        <span class="badge badge-warning">
                                                        @else
                                                            <span class="badge badge-success">
                                                @endif
                                                {{ $item->statuspengajuan->namaperbaikan }}
                                                </span>
                                            </td>
                                            <td>{{ $item->mulaiperbaikan }}</td>
                                            <td>{{ $item->selesaiperbaikan }}</td>
                                            <td>{{ $item->user->nama }}</td>
                                            <td class="text-center">
                                                @if (Auth::user()->role_id === 1)
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('admin.transaksi.perbaikan.editpribadi', ['id' => $item->id]) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                @elseif(Auth::user()->role_id === 2)
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('user.transaksi.perbaikan.editpribadi', ['id' => $item->id]) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                @else
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('management.transaksi.perbaikan.editpribadi', ['id' => $item->id]) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                @endif
                                                <a class="btn btn-danger btn-sm"
                                                    onclick="deletePerbaikanBarangPribadi({{ $item }})"
                                                    data-toggle="modal" data-target="#modal-delete-perbaikanbarang">
                                                    <i class="fas fa-trash"></i></a>
                                            </td>
                                            <td>{{ $item->estimasiperbaikan }}</td>
                                            <td>
                                                @if ($item->inventarisBarang->kondisibarang_id === 1)
                                                    <span class="badge badge-success">
                                                    @elseif($item->inventarisBarang->kondisibarang_id === 2)
                                                        <span class="badge badge-warning">
                                                        @elseif($item->inventarisBarang->kondisibarang_id === 3)
                                                            <span class="badge badge-danger">
                                                @endif
                                                {{ $item->inventarisBarang->kondisiBarang->nama }}
                                                </span>
                                            </td>
                                            <td>{{ $item->masalah }}</td>
                                            <td>{{ $item->solusi }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">No. Perbaikan</th>
                                        <th class="text-center">Kode Inventaris</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Status Perbaikan</th>
                                        <th class="text-center">Mulai Perbaikan</th>
                                        <th class="text-center">Selesai Perbaikan</th>
                                        <th class="text-center">Pengguna</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Estimasi Perbaikan</th>
                                        <th class="text-center">Kondisi Barang</th>
                                        <th class="text-center">Masalah</th>
                                        <th class="text-center">Solusi</th>
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
    <div class="modal fade" id="modal-delete-perbaikanbarang">
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
                        <form action="{{ route('admin.transaksi.perbaikan.destroypribadi') }}" method="post"
                            class="form-horizontal">
                        @elseif(Auth::user()->role_id === 2)
                            <form action="{{ route('user.transaksi.perbaikan.destroypribadi') }}" method="post"
                                class="form-horizontal">
                            @else
                                <form action="{{ route('management.transaksi.perbaikan.destroypribadi') }}" method="post"
                                    class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" name="delete_id" id="delete_id" value="" />
                    Apakah anda yakin akan menghapus perbaikan <span name="delete_nama" id="delete_nama"></span>?
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
    <div class="modal fade" id="modal-start-perbaikanbarang">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mulai {{ $data['page'] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (Auth::user()->role_id === 1)
                        <form action="{{ route('admin.gudang.perbaikan.start') }}" method="post" class="form-horizontal">
                        @else
                            <form action="{{ route('management.gudang.perbaikan.start') }}" method="post"
                                class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" name="start_id" id="start_id" value="" />
                    Apakah anda yakin akan memulai perbaikan <span name="start_name" id="start_name"></span>?
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Estimasi Perbaikan</label>
                        <div class="input-group">
                            <input type="text" name="estimasiperbaikan" class="form-control"
                                style="text-transform: capitalize" id="estimasiperbaikan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Mulai</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-end-perbaikanbarang">
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
                        <form action="{{ route('admin.gudang.perbaikan.end') }}" method="post" class="form-horizontal"
                            id="form-">
                        @else
                            <form action="{{ route('management.gudang.perbaikan.end') }}" method="post"
                                class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" name="end_id" id="end_id" value="" />
                    Apakah perbaikan <span name="end_name" id="end_name"></span> sudah selesai?
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Solusi</label>
                        <div class="input-group">
                            <input type="text" name="solusi" class="form-control" style="text-transform: capitalize"
                                id="solusi">
                        </div>
                    </div>
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
        $('#form-tambah-perbaikan').validate({
            rules: {
                inventarisbarang_id: {
                    required: true,
                },
                kondisibarang_id: {
                    required: true,
                },
                masalah: {
                    required: true,
                },
            },
            messages: {
                inventarisbarang_id: {
                    required: "Silahkan pilih inventaris barang",
                },
                kondisibarang_id: {
                    required: "Silahkan pilih kondisi barang",
                },
                masalah: {
                    required: "Silahkan masukkan masalah barang",
                },
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

        function deletePerbaikanBarangPribadi(arr) {
            $('#delete_id').val(arr.id)
            $('#delete_nama').text(arr.id)
        }

    </script>
@endsection
