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
                                <form action="{{ route('admin.alat-kerja.pengajuan.storepribadi') }}" method="post"
                                    class="form-horizontal" id="form-tambah-pengajuan-alatkerja">
                                @elseif(Auth::user()->role_id === 2)
                                    <form action="{{ route('user.alat-kerja.pengajuan.storepribadi') }}" method="post"
                                        class="form-horizontal" id="form-tambah-pengajuan-alatkerja">
                                    @else
                                        <form action="{{ route('management.alat-kerja.pengajuan.storepribadi') }}"
                                            method="post" class="form-horizontal" id="form-tambah-pengajuan-alatkerja">
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah Barang</label>
                                <div class="input-group">
                                    <input type="text" name="jumlahbarang" class="form-control"
                                        style="text-transform: capitalize" id="jumlahbarang">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Barang</label>
                                <div class="input-group">
                                    <select class="form-control select2" id="subsubkelompokbarang_id"
                                        name="subsubkelompokbarang_id" style="width: 100%">
                                        <option value="" disabled selected>Pilih Jenis Barang</option>
                                        @foreach ($data['subSubKelompokBarang'] as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <div class="input-group">
                                    <input type="text" name="keterangan" class="form-control"
                                        style="text-transform: capitalize" id="keterangan">
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">No. Pengajuan</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Jenis Barang</th>
                                        <th class="text-center">Jumlah Barang</th>
                                        <th class="text-center">Status Pengajuan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data['pengajuanBarang'] as $item)
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>{{ $item->id }}
                                            </td>
                                            <td>{{ $item->user->nama }}</td>
                                            <td>{{ $item->subSubKelompokBarang->nama }}</td>
                                            <td class="text-right">{{ $item->jumlahbarang }}</td>
                                            <td>
                                                @if ($item->statuspengajuan_id === 1)
                                                    <span class="badge badge-danger">
                                                    @else
                                                        <span class="badge badge-success">
                                                @endif
                                                {{ $item->statusPengajuan->namapengajuan }}
                                                </span>
                                            </td>
                                            </td>
                                            <td>{{ ucwords($item->keterangan) }}</td>
                                            <td class="text-center align-top">
                                                @if ($item->statuspengajuan_id === 1)
                                                    @if (Auth::user()->role_id === 1)
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('admin.alat-kerja.pengajuan.editpribadi', ['id' => $item->id]) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @elseif (Auth::user()->role_id === 2)
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('user.alat-kerja.pengajuan.editpribadi', ['id' => $item->id]) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @else
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('management.alat-kerja.pengajuan.editpribadi', ['id' => $item->id]) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endif
                                                    <a class="btn btn-danger btn-sm"
                                                        onclick="deletePengajuanBarang({{ $item }})"
                                                        data-toggle="modal" data-target="#modal-delete-pengajuanbarang">
                                                        <i class="fas fa-trash"></i></a>
                                                @endif
                                            </td>
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
                                        <th class="text-center">User</th>
                                        <th class="text-center">Jenis Barang</th>
                                        <th class="text-center">Jumlah Barang</th>
                                        <th class="text-center">Status Pengajuan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Aksi</th>
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
    <div class="modal fade" id="modal-delete-pengajuanbarang">
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
                        <form action="{{ route('admin.alat-kerja.pengajuan.destroypribadi') }}" method="post"
                            class="form-horizontal">
                        @elseif(Auth::user()->role_id === 2)
                            <form action="{{ route('user.alat-kerja.pengajuan.destroypribadi') }}" method="post"
                                class="form-horizontal">
                            @else
                                <form action="{{ route('management.alat-kerja.pengajuan.destroypribadi') }}" method="post"
                                    class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" name="delete_id" id="delete_id" value="" />
                    Apakah anda yakin akan menghapus Pengajuan <span name="delete_nama" id="delete_nama"></span>?
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
        $('#form-tambah-pengajuan-alatkerja').validate({
            rules: {
                subsubkelompokbarang_id: {
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
                jumlahbarang: {
                    required: "Silahkan masukkan jumlah barang",
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

        function deletePengajuanBarang(arr) {
            $('#delete_id').val(arr.id)
            $('#delete_nama').text(arr.id)
        }

        $(function() {
            $('.select2').select2()
        })

    </script>
@endsection
