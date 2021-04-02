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
                            <form action="{{ route('admin.master.lokasi.ruangan.update') }}" method="post"
                                class="form-horizontal" id="form-edit-ruangan">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ $data['ruangan']->id }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Ruangan</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            style="text-transform: capitalize" value="{{ $data['ruangan']->nama }}">
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
                                            <option value="{{ $data['ruangan']->gedung->id }}" selected>
                                                Gedung {{ $data['ruangan']->gedung->kode }}
                                                ({{ $data['ruangan']->gedung->nama }})</option>
                                            @foreach ($data['gedung']->except($data['ruangan']->gedung->id) as $item)
                                                <option value="{{ $item->id }}">
                                                    Gedung {{ $item->kode }} ({{ $item->nama }})
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    @php
                                        $arrayLuas = explode('x', $data['ruangan']->luas);
                                        $arrayKorDepan = explode('x', $data['ruangan']->koridor_depan);
                                        $arrayKorBelakang = explode('x', $data['ruangan']->koridor_belakang);
                                    @endphp
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Panjang Ruangan</label>
                                        <div class="input-group">
                                            <input type="text" name="panjang_ruangan" class="form-control"
                                                id="panjang_ruangan" value="{{ $arrayLuas[0] }}">
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
                                            <input type="text" name="lebar_ruangan" class="form-control" id="lebar_ruangan"
                                                value="{{ $arrayLuas[1] }}">
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
                                                id="panjang_koridor_depan" value="{{ $arrayKorDepan[0] }}">
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
                                                id="lebar_koridor_depan" value="{{ $arrayKorDepan[1] }}">
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
                                                id="panjang_koridor_belakang" value="{{ $arrayKorBelakang[0] }}">
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
                                                id="lebar_koridor_belakang" value="{{ $arrayKorBelakang[1] }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>m</span>
                                                </div>
                                            </div>
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
        $('#form-edit-ruangan').validate({
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
    
    </script>
@endsection
