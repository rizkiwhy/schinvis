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
                                {{-- <a href="{{ route('admin.user.index') }}" type="button" class="btn btn-tool">
                                    <i class="fas fa-chevron-circle-left"></i>
                                </a> --}}
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
                            <form action="{{ route('admin.user.update') }}" method="post" class="form-horizontal"
                                id="form-edit-user">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ $data['user']->id }}">
                                <div class="row">
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">Name</label>
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input type="text" name="nama" class="form-control"
                                                    style="text-transform: capitalize" id="nama"
                                                    value="{{ $data['user']->nama }}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-signature"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">Email</label>
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" id="email"
                                                    value="{{ $data['user']->email }}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">Password</label>
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control" id="password"
                                                    value="">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">Password
                                            Confirmation</label>
                                        <div class="input-group ">
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    id="password_confirmation" value="">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputPassword1">Status</label>
                                        <div class="input-group ">
                                            <div class="input-group">
                                                <select class="form-control select2" id="aktif" name="aktif">
                                                    @if ($data['user']->aktif === 1)
                                                        <option value="{{ $data['user']->aktif }}" selected>
                                                            Aktif
                                                        </option>
                                                        <option value="0">
                                                            Tidak Aktif
                                                        </option>
                                                    @else
                                                        <option value="{{ $data['user']->aktif }}" selected>
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
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputPassword1">Role</label>
                                        <div class="input-group">
                                            <div class="input-group">
                                                <select class="form-control select2" id="role_id" name="role_id">
                                                    <option value="{{ $data['user']->role_id }}" selected>
                                                        {{ $data['user']->role->nama }}
                                                    </option>
                                                    @foreach ($data['role']->except([$data['user']->role_id]) as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">NIP/NIS</label>
                                        <div class="input-group">
                                            <input type="text" name="noinduk" class="form-control" id="noinduk"
                                                value="{{ $data['user']->personal->noinduk }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-id-card"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" name="tanggallahir" class="form-control datetimepicker-input"
                                                id="tanggallahir" data-target="#reservationdate"
                                                value="{{ $data['user']->personal->tanggallahir }}" />
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="jeniskelamin_id" name="jeniskelamin_id"
                                                style="width: 100%;">
                                                <option value="{{ $data['user']->personal->jeniskelamin_id }}" selected>
                                                    {{ $data['user']->personal->jeniskelamin->nama }}
                                                </option>
                                                @foreach ($data['jenisKelamin']->except($data['user']->personal->jeniskelamin_id) as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputPassword1">Title</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="title_id" name="title_id"
                                                style="width: 100%;">
                                                <option value="{{ $data['user']->personal->title_id }}" selected>
                                                    {{ $data['user']->personal->title->nama }}
                                                </option>
                                                @foreach ($data['title']->except($data['user']->personal->title_id) as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputPassword1">Agama</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="agama_id" name="agama_id"
                                                style="width: 100%;">
                                                <option value="{{ $data['user']->personal->agama_id }}" selected>
                                                    {{ $data['user']->personal->agama->nama }}
                                                </option>
                                                @foreach ($data['agama']->except($data['user']->personal->agama_id) as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputEmail1">No. Telepon</label>
                                        <div class="input-group">
                                            <input type="text" name="notelepon" class="form-control" id="notelepon"
                                                value="{{ $data['user']->personal->notelepon }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone"></span>
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
        $('#form-edit-user').validate({
            rules: {
                nama: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                aktif: {
                    required: true,
                },
                role_id: {
                    required: true,
                },
                noinduk: {
                    required: true
                },
                tanggallahir: {
                    required: true
                },
                jeniskelamin_id: {
                    required: true
                },
                title_id: {
                    required: true
                },
                agama_id: {
                    required: true
                },
                notelepon: {
                    required: true,
                }
            },
            messages: {
                nama: {
                    required: "Silahkan masukkan nama",
                },
                email: {
                    required: "Silahkan masukkan alamat email",
                    email: "Silahkan masukkan alamat email yang valid"
                },
                aktif: {
                    required: "Silahkan pilih status",
                },
                role_id: {
                    required: "Silahkan pilih role",
                },
                noinduk: {
                    required: "Silahkan masukkan NIP/NIS",
                },
                tanggallahir: {
                    required: "Silahkan pilih tanggal lahir",
                },
                jeniskelamin_id: {
                    required: "Silahkan pilih jenis kelamin",
                },
                title_id: {
                    required: "Silahkan pilih title",
                },
                agama_id: {
                    required: "Silahkan pilih agama",
                },
                notelepon: {
                    required: "Silahkan masukkan no. telepon",
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
