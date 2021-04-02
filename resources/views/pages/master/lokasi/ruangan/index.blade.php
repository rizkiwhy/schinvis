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
                            <form action="{{ route('admin.master.lokasi.ruangan.store') }}" method="post"
                                class="form-horizontal" id="form-tambah-ruangan">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Ruangan</label>
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
                                    <label for="exampleInputEmail1">Gedung</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="gedung_id" name="gedung_id"
                                            style="width: 100%;">
                                            <option value="" disabled selected>Pilih Gedung</option>
                                            @foreach ($data['gedung'] as $item)
                                                <option value="{{ $item->id }}">
                                                    Gedung {{ $item->kode }} ({{ $item->nama }})
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Panjang Ruangan</label>
                                        <div class="input-group">
                                            <input type="text" name="panjang_ruangan" class="form-control"
                                                style="text-transform: capitalize" id="panjang_ruangan">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>m</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputPassword1">Lebar Ruangan</label>
                                        <div class="input-group">
                                            <input type="text" name="lebar_ruangan" class="form-control"
                                                style="text-transform: capitalize" id="lebar_ruangan">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>m</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Panjang Koridor Depan</label>
                                        <div class="input-group">
                                            <input type="text" name="panjang_koridor_depan" class="form-control"
                                                style="text-transform: capitalize" id="panjang_koridor_depan">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>m</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputPassword1">Lebar Koridor Depan</label>
                                        <div class="input-group">
                                            <input type="text" name="lebar_koridor_depan" class="form-control"
                                                style="text-transform: capitalize" id="lebar_koridor_depan">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>m</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Panjang Koridor Belakang</label>
                                        <div class="input-group">
                                            <input type="text" name="panjang_koridor_belakang" class="form-control"
                                                style="text-transform: capitalize" id="panjang_koridor_belakang">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>m</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputPassword1">Lebar Koridor Belakang</label>
                                        <div class="input-group">
                                            <input type="text" name="lebar_koridor_belakang" class="form-control"
                                                style="text-transform: capitalize" id="lebar_koridor_belakang">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>m</span>
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
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Gedung</th>
                                        <th class="text-center">Luas Ruangan</th>
                                        <th class="text-center">Koridor Depan</th>
                                        <th class="text-center">Koridor Belakang</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data['ruangan'] as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ $item->gedung->kelompok . '.' . sprintf('%03s', $item->id) }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td> Gedung {{ $item->gedung->kode }}</td>
                                            @php
                                                $arrayLuas = explode('x', $item->luas);
                                                $arrayKorDepan = explode('x', $item->koridor_depan);
                                                $arrayKorBelakang = explode('x', $item->koridor_belakang);
                                            @endphp
                                            <td class="text-right">{{ $arrayLuas[0] * $arrayLuas[1] }} m<sup>2</sup></td>
                                            <td class="text-right">
                                                @if ($item->koridor_depan === '0x0')
                                                    -
                                                @else
                                                    {{ $arrayKorDepan[0] * $arrayKorDepan[1] }}
                                                    m<sup>2</sup>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @if ($item->koridor_belakang === '0x0')
                                                    -
                                                @else
                                                    {{ $arrayKorBelakang[0] * $arrayKorBelakang[1] }}
                                                    m<sup>2</sup>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('admin.master.lokasi.ruangan.edit', ['id' => $item->id]) }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm"
                                                    onclick="deleteRuangan({{ $item }})" data-toggle="modal"
                                                    data-target="#modal-delete-ruangan">
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
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Gedung</th>
                                        <th class="text-center">Luas Ruangan</th>
                                        <th class="text-center">Koridor Depan</th>
                                        <th class="text-center">Koridor Belakang</th>
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
    <div class="modal fade" id="modal-delete-ruangan">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus {{ $data['page'] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.master.lokasi.ruangan.destroy') }}" method="post"
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
        $('#form-tambah-ruangan').validate({
            rules: {
                nama: {
                    required: true,
                },
                gedung_id: {
                    required: true,
                },
                panjang_ruangan: {
                    required: true,
                },
                lebar_ruangan: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Silahkan masukkan nama ruangan",
                },
                gedung_id: {
                    required: "Silahkan pilih gedung",
                },
                panjang_ruangan: {
                    required: "Silahkan masukkan panjang ruangan",
                },
                lebar_ruangan: {
                    required: "Silahkan masukkan lebar ruangan",
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
    
        function deleteRuangan(arr) {
            $('#delete_id').val(arr.id)
            $('#delete_nama').text(arr.nama)
        }
    
    </script>
@endsection
