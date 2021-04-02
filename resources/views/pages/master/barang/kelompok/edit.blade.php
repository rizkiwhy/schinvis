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
                            <form action="{{ route('admin.master.barang.kelompok.update') }}" method="post"
                                class="form-horizontal" id="form-edit-kelompokbarang">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ $data['kelompokBarang']->id }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="exampleInputEmail1">Kode</label>
                                        <div class="input-group">
                                            <input type="text" name="kodebidangbarang"
                                                class="form-control col-sm-2 text-center" style="text-transform: capitalize"
                                                id="kodebidangbarang"
                                                value="{{ $data['kelompokBarang']->bidangbarang_id }}" disabled>
                                            <input type="text" name="kode" class="form-control col-sm-10"
                                                style="text-transform: capitalize" id="kode"
                                                value="{{ substr($data['kelompokBarang']->id, -2) }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-tags"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <div class="input-group form-group">
                                            <div class="input-group">
                                                <input type="text" name="nama" class="form-control"
                                                    style="text-transform: capitalize" id="nama"
                                                    value="{{ $data['kelompokBarang']->nama }}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-tags"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="exampleInputPassword1">Bidang Barang</label>
                                        <div class="input-group form-group">
                                            <select class="form-control select2" onchange="bidangBarang()"
                                                id="bidangbarang_id" name="bidangbarang_id" style="width: 100%;">
                                                <option value="{{ $data['kelompokBarang']->bidangbarang_id }}" selected>
                                                    {{ $data['kelompokBarang']->bidangBarang->nama }}</option>
                                                @foreach ($data['bidangBarang']->except($data['kelompokBarang']->bidangbarang_id) as $item)
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
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $('#form-edit-kelompokbarang').validate({
            rules: {
                nama: {
                    required: true,
                },
                bidangbarang_id: {
                    required: "Silahkan pilih bidang barang",
                },
            },
            messages: {
                nama: {
                    required: "Silahkan masukkan nama kelompok barang",
                },
                bidangbarang_id: {
                    required: "Silahkan pilih bidang barang",
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
    
        function bidangBarang() {
            var bidangBarangId = document.getElementById("bidangbarang_id").value;
            $('#kodebidangbarang').val(bidangBarangId);
        }
    
    </script>
@endsection
