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
                                <form action="{{ route('admin.gudang.perbaikan.update') }}" method="post"
                                    class="form-horizontal">
                                @else
                                    <form action="{{ route('manajemen.gudang.perbaikan.update') }}" method="post"
                                        class="form-horizontal">
                            @endif
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $data['inventarisDiperbaiki']->id }}">
                            <input type="hidden" id="inventarisbarang_id" name="inventarisbarang_id"
                                value="{{ $data['inventarisDiperbaiki']->inventarisbarang_id }}">
                            <input type="hidden" id="jenispengajuanbarang_id" name="jenispengajuanbarang_id"
                                value="{{ $data['inventarisDiperbaiki']->jenispengajuanbarang_id }}">

                            <div class="row">

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputEmail1">Status Perbaikan</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="statuspengajuan_id"
                                            name="statuspengajuan_id" style="width: 100%;">
                                            <option value="{{ $data['inventarisDiperbaiki']->statuspengajuan_id }}"
                                                selected>
                                                {{ $data['inventarisDiperbaiki']->statusPengajuan->namaperbaikan }}
                                            </option>
                                            @foreach ($data['statusPengajuan']->except($data['inventarisDiperbaiki']->statuspengajuan_id) as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputEmail1">Estimasi Perbaikan</label>
                                    <div class="input-group">
                                        <input type="text" name="estimasiperbaikan" class="form-control"
                                            style="text-transform: capitalize" id="estimasiperbaikan"
                                            value="{{ $data['inventarisDiperbaiki']->estimasiperbaikan }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group ">
                                    <label for="exampleInputEmail1">Mulai Perbaikan</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="date" name="mulaiperbaikan" class="form-control datetimepicker-input"
                                            id="mulaiperbaikan" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group ">
                                    <label for="exampleInputEmail1">Selesai Perbaikan</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="date" name="selesaiperbaikan" class="form-control datetimepicker-input"
                                            id="selesaiperbaikan" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputEmail1">Masalah</label>
                                    <div class="input-group">
                                        <input type="text" name="masalah" class="form-control"
                                            style="text-transform: capitalize" id="masalah"
                                            value="{{ $data['inventarisDiperbaiki']->masalah }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fa fa-tools"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputEmail1">Solusi</label>
                                    <div class="input-group">
                                        <input type="text" name="solusi" class="form-control"
                                            style="text-transform: capitalize" id="solusi"
                                            value="{{ $data['inventarisDiperbaiki']->solusi }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fa fa-tools"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputEmail1">Pengguna</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="user_id" name="user_id"
                                            style="width: 100%;">
                                            <option value="{{ $data['inventarisDiperbaiki']->user_id }}" selected>
                                                {{ $data['inventarisDiperbaiki']->user->nama }}
                                            </option>
                                            @foreach ($data['user']->except($data['inventarisDiperbaiki']->user_id) as $item)
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
        $('#form-edit-perbaikan').validate({
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
    
    </script>
@endsection
