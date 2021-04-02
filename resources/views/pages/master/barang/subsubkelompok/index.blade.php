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
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah {{ $data['page'] }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.master.barang.subsubkelompok.store') }}" method="post"
                                class="form-horizontal" id="form-tambah-subsubkelompokbarang">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode</label>
                                    <div class="input-group">
                                        <input type="text" name="kodesubkelompokbarang"
                                            class="form-control col-sm-3 text-center" style="text-transform: capitalize"
                                            id="kodesubkelompokbarang" disabled>
                                        <input type="text" name="kode" class="form-control col-sm-9"
                                            style="text-transform: capitalize" id="kode">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-tags"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control"
                                            style="text-transform: capitalize" id="nama">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-signature"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Kelompok Barang</label>
                                    <div class="input-group">
                                        <select class="form-control select2" onchange="subKelompokBarang()"
                                            id="subkelompokbarang_id" name="subkelompokbarang_id" style="width: 100%;">
                                            <option value="" disabled selected>Pilih Sub Kelompok Barang</option>
                                            @foreach ($data['subKelompokBarang'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
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
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Sub Kelompok Barang</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data['subSubKelompokBarang'] as $item)
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td class="text-center">{{ $item->id }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                {{ $item->subKelompokBarang->nama }}
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('admin.master.barang.subsubkelompok.edit', ['id' => $item->id]) }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm"
                                                    onclick="deleteSubSubKelompokBarang({{ $item }})"
                                                    data-toggle="modal" data-target="#modal-delete-subsubkelompokbarang">
                                                    <i class="fas fa-trash"></i></a>

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
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Sub Kelompok Barang</th>
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
    <div class="modal fade" id="modal-delete-subsubkelompokbarang">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus {{ $data['page'] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.master.barang.subsubkelompok.destroy') }}" method="post"
                        class="form-horizontal">
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
        $('#form-tambah-subsubkelompokbarang').validate({
            rules: {
                nama: {
                    required: true,
                },
                subkelompokbarang_id: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Silahkan masukkan nama sub sub kelompok barang",
                },
                subkelompokbarang_id: {
                    required: "Silahkan pilih sub kelompok barang",
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
    
        function subKelompokBarang() {
            var subKelompokBarangId = document.getElementById("subkelompokbarang_id").value;
            $('#kodesubkelompokbarang').val(subKelompokBarangId);
        }
    
        function deleteSubSubKelompokBarang(arr) {
            $('#delete_id').val(arr.id)
            $('#delete_nama').text(arr.nama)
        }
    
    </script>
@endsection
