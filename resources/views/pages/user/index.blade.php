@extends($data['layout'])
@section('title', $data['page'] . ' | ' . $data['app'])
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $data['page'] }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ $data['page'] }}</a></li>
                        <li class="breadcrumb-item active">{{ $data['subpage'] }}</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-sm mr-2 float-sm-right" data-toggle="modal"
                        data-target="#modal-add-user" data-backdrop="static">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
            </div>

            <div class="modal fade" id="modal-add-user">
                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah {{ $data['page'] }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.user.store') }}" method="post" class="form-horizontal"
                                id="form-tambah-user">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 form-group">
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
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control" id="email">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Password</label>
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
                                    <div class="col-sm-6 form-group">
                                        <label for="exampleInputEmail1">Password
                                            Confirmation</label>
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
                                <div class="row">
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputPassword1">Status</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="aktif" name="aktif"
                                                style="width: 100%;">
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="1">
                                                    Aktif
                                                </option>
                                                <option value="0">
                                                    Tidak Aktif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="exampleInputPassword1">Role</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="role_id" name="role_id"
                                                style="width: 100%;">
                                                <option value="" disabled selected>Pilih Role</option>
                                                @foreach ($data['role'] as $item)
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
                                        <label for="exampleInputEmail1">NIP/NIS</label>
                                        <div class="input-group">
                                            <input type="text" name="noinduk" class="form-control" id="noinduk">
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
                                                id="tanggallahir" data-target="#reservationdate" />
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
                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                @foreach ($data['jenisKelamin'] as $item)
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
                                                <option value="" disabled selected>Pilih Title</option>
                                                @foreach ($data['title'] as $item)
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
                                                <option value="" disabled selected>Pilih Agama</option>
                                                @foreach ($data['agama'] as $item)
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
                                            <input type="text" name="notelepon" class="form-control" id="notelepon">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone"></span>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('main-content')
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
                                        <th class="text-center">NIP/NIS</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Agama</th>
                                        <th class="text-center">No. Telepon</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data['user'] as $item)
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->personal->noinduk }}</td>
                                            <td>{{ $item->personal->title->nama }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role->nama }}</td>
                                            <td>
                                                @if ($item->aktif === 1)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Tidak Aktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('admin.user.edit', ['id' => $item->id]) }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" onclick="deleteUser({{ $item }})"
                                                    data-toggle="modal" data-target="#modal-delete-user" href="#">
                                                    <i class="fas fa-trash"></i></a>
                                            </td>
                                            <td>{{ $item->personal->jeniskelamin->nama }}</td>
                                            <td>{{ $item->personal->tanggallahir }}</td>
                                            <td>{{ $item->personal->agama->nama }}</td>
                                            <td>{{ $item->personal->notelepon }}</td>
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
                                        <th class="text-center">NIP/NIS</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Agama</th>
                                        <th class="text-center">No. Telepon</th>
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
    <div class="modal fade" id="modal-delete-user">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus {{ $data['page'] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.destroy') }}" method="post" class="form-horizontal quickForm">
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
        </div>
    </div>
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $('#form-tambah-user').validate({
            rules: {
                nama: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                aktif: {
                    required: true,
                },
                role_id: {
                    required: true,
                },
                noinduk: {
                    required: true,
                    number: true,
                    maxlength: 18,
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
                password: {
                    required: "Silahkan masukkan password",
                    minlength: "Password harus terdiri dari minimal 6 karakter"
                },
                password_confirmation: {
                    required: "Silakan masukkan konfirmasi password",
                    minlength: "Password harus terdiri dari minimal 6 karakter",
                    equalTo: "Konfirmasi password tidak cocok"
                },
                aktif: {
                    required: "Silahkan pilih status",
                },
                role_id: {
                    required: "Silahkan pilih role",
                },
                noinduk: {
                    required: "Silahkan masukkan NIP/NIS",
                    number: "Silahkan masukkan NIP/NIS yang valid",
                    maxlength: "Password harus terdiri dari maksimal 18 karakter"
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
    
        function deleteUser(arr) {
            $('#delete_id').val(arr.id)
            $('#delete_nama').text(arr.nama)
        }
    
    </script>
@endsection
