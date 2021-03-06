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
                            <form action="{{ route('admin.master.title.update') }}" method="post" class="form-horizontal"
                                id="form-edit-title">
                                @csrf
                                @foreach ($data['title'] as $item)

                                    <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="exampleInputEmail1">Name</label>
                                            <div class="input-group form-group">
                                                <div class="input-group">
                                                    <input type="text" name="nama" class="form-control"
                                                        style="text-transform: capitalize" id="nama"
                                                        value="{{ $item->nama }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-signature"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="exampleInputPassword1">Status</label>
                                            <div class="input-group form-group">
                                                <div class="input-group">
                                                    <select class="form-control select2" id="aktif" name="aktif">
                                                        @if ($item->aktif === 1)
                                                            <option value="{{ $item->aktif }}" selected>
                                                                Aktif
                                                            </option>
                                                            <option value="0">
                                                                Tidak Aktif
                                                            </option>
                                                        @else
                                                            <option value="{{ $item->active }}" selected>
                                                                Tidak Aktif
                                                            </option>
                                                            <option value="1">
                                                                Aktif
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
        $('#form-edit-title').validate({
            rules: {
                nama: {
                    required: true,
                },
                aktif: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Silahkan masukkan nama title",
                },
                aktif: {
                    required: "Silahkan pilih status",
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
