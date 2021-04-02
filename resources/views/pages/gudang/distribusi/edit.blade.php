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
                                <form action="{{ route('admin.gudang.distribusi.update') }}" method="post"
                                    class="form-horizontal" id="form-edit-subsubkelompokbarang">
                                @else
                                    <form action="{{ route('manajemen.gudang.distribusi.update') }}" method="post"
                                        class="form-horizontal" id="form-edit-subsubkelompokbarang">
                            @endif
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $data['inventarisDigunakan']->id }}">
                            <input type="hidden" id="inventarisbarang_id" name="inventarisbarang_id"
                                value="{{ $data['inventarisDigunakan']->inventarisbarang_id }}">
                            <div class="row">
                                <div class="col-sm-6 form-group" id="input-ruangan_id">
                                    <label for="exampleInputEmail1">Ruangan</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="ruangan_id" name="ruangan_id"
                                            style="width: 100%">
                                            <option value="{{ $data['inventarisDigunakan']->ruangan_id }}" selected>
                                                {{ $data['inventarisDigunakan']->ruangan->nama }}</option>
                                            @foreach ($data['ruangan']->except($data['inventarisDigunakan']->ruangan_id) as $item)
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
                                            <option value="{{ $data['inventarisDigunakan']->user_id }}" selected>
                                                {{ $data['inventarisDigunakan']->user->nama }}</option>
                                            @foreach ($data['user']->except($data['inventarisDigunakan']->user_id) as $item)
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
        $('#form-edit-distribusi').validate({
            rules: {
                ruangan_id: {
                    required: true,
                },
                user_id: {
                    required: true
                }
            },
            messages: {
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
    
    </script>
@endsection
