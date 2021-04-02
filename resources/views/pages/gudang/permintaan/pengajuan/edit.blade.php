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
                            @if (Auth::user()->role_id === 1)
                                <form action="{{ route('admin.gudang.permintaan.pengajuan.updatepermintaan') }}" method="post"
                                    class="form-horizontal" id="form-edit-pengajuan">
                                @else
                                    <form action="{{ route('manajemen.gudang.permintaan.pengajuan.updatepermintaan') }}"
                                        method="post" class="form-horizontal" id="form-edit-pengajuan">
                            @endif
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $data['pengajuanBarang']->id }}">
                            <input type="hidden" id="jenispengajuanbarang_id" name="jenispengajuanbarang_id"
                                value="{{ $data['pengajuanBarang']->jenispengajuanbarang_id }}">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputEmail1">Jumlah Barang</label>
                                    <div class="input-group">
                                        <input type="text" name="jumlahbarang" class="form-control"
                                            style="text-transform: capitalize" id="jumlahbarang"
                                            value="{{ $data['pengajuanBarang']->jumlahbarang }}">
                                    </div>
                                </div>
                                <div class="col-sm-9 form-group">
                                    <label for="exampleInputEmail1">Keterangan</label>
                                    <div class="input-group">
                                        <input type="text" name="keterangan" class="form-control"
                                            style="text-transform: capitalize" id="keterangan"
                                            value="{{ $data['pengajuanBarang']->keterangan }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Jenis Barang</label>
                                    <div class="input-group">
                                        <select type="text" name="subsubkelompokbarang_id" class="form-control select2"
                                            style="width: 100%" id="subsubkelompokbarang_id">
                                            <option value="{{ $data['pengajuanBarang']->subsubkelompokbarang_id }}"
                                                selected>
                                                {{ $data['pengajuanBarang']->subsubKelompokBarang->nama }}
                                            </option>
                                            @foreach ($data['subSubKelompokBarang']->except($data['pengajuanBarang']->subsubkelompokbarang_id) as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label for="exampleInputEmail1">Status Pengajuan</label>
                                    <div class="input-group">
                                        <select type="text" name="statuspengajuan_id" id="statuspengajuan_id"
                                            class="form-control select2" style="width: 100%">
                                            <option value="{{ $data['pengajuanBarang']->statuspengajuan_id }}" selected>
                                                {{ $data['pengajuanBarang']->statusPengajuan->namapengajuan }}
                                            </option>
                                            @foreach ($data['statusPengajuan']->except($data['pengajuanBarang']->statuspengajuan_id) as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputEmail1">Pengguna</label>
                                    <div class="input-group">
                                        <select type="text" name="user_id" class="form-control select2" style="width: 100%"
                                            id="user_id">
                                            <option value="{{ $data['pengajuanBarang']->user_id }}" selected>
                                                {{ $data['pengajuanBarang']->user->nama }}
                                            </option>
                                            @foreach ($data['user']->except($data['pengajuanBarang']->user_id) as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama }}</option>
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
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $('#form-edit-pengajuan').validate({
            rules: {
                subsubkelompokbarang_id: {
                    required: true,
                },
                jumlahbarang: {
                    required: true,
                },
                user_id: {
                    required: true,
                },
                statuspengajuan_id: {
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
                user_id: {
                    required: "Silahkan pilih barang",
                },
                statuspengajuan_id: {
                    required: "Silahkan pilih status pengajuan",
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
    
    </script>
@endsection
