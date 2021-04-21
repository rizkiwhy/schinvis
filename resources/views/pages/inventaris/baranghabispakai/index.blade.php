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
                    @if (Auth::user()->role_id === 1)
                        <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                            href="{{ route('admin.alat-kerja.pengajuan.indexpribadi') }}">
                        @elseif(Auth::user()->role_id === 2)
                            <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                                href="{{ route('user.alat-kerja.pengajuan.indexpribadi') }}">
                            @else
                                <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                                    href="{{ route('management.alat-kerja.pengajuan.indexpribadi') }}">
                    @endif
                    <i class="fas fa-bell mr-2"></i>Pengajuan
                    </a>
                </div>
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
                                            <th class="text-center">No. Pengajuan</th>
                                            <th class="text-center">Jenis Penggunaan</th>
                                            <th class="text-center">Kode Inventaris</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Ruangan</th>
                                            <th class="text-center">Pengguna</th>
                                            <th class="text-center">Mulai Digunakan</th>
                                            <th class="text-center">Status Penggunaan</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Selesai Digunakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data['inventarisDigunakan'] as $item)
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td>
                                                    @if (empty($item->nopengajuan))
                                                        -
                                                    @else
                                                        {{ $item->nopengajuan }}
                                                    @endif
                                                </td>
                                                <td>{{ $item->jenisPenggunaanBarang->nama }}</td>
                                                <td>{{ $item->inventarisbarang_id }}</td>
                                                <td>{{ $item->inventarisBarang->subsubkelompokbarang->nama }}</td>
                                                <td>{{ $item->ruangan->nama }}</td>
                                                <td>{{ $item->user->nama }}</td>
                                                <td class="text-center">{{ $item->mulaidigunakan }}</td>
                                                <td>
                                                    @if (empty($item->selesaidigunakan))
                                                        <span class="badge badge-warning">
                                                            Sedang digunakan
                                                        @else
                                                            <span class="badge badge-success">
                                                                Sudah dikembalikan
                                                    @endif
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if (empty($item->selesaidigunakan))
                                                        <a class="btn btn-primary btn-sm"
                                                            onclick="endDistribusiBarang({{ $item }})"
                                                            data-toggle="modal" data-target="#modal-end-distribusibarang">
                                                            <i class="fas fa-check"></i></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->selesaidigunakan }}
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
                                            <th class="text-center">No. Pengajuan</th>
                                            <th class="text-center">Jenis Penggunaan</th>
                                            <th class="text-center">Kode Inventaris</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Ruangan</th>
                                            <th class="text-center">Pengguna</th>
                                            <th class="text-center">Mulai Digunakan</th>
                                            <th class="text-center">Status Penggunaan</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Selesai Digunakan</th>
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
        <div class="modal fade" id="modal-end-distribusibarang">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Selesai Digunakan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (Auth::user()->role_id === 1)
                            <form action="{{ route('admin.inventaris.digunakan.end') }}" method="post"
                                class="form-horizontal">
                            @elseif(Auth::user()->role_id === 2)
                                <form action="{{ route('user.inventaris.digunakan.end') }}" method="post"
                                    class="form-horizontal">
                                @elseif(Auth::user()->role_id === 3)
                                    <form action="{{ route('management.inventaris.digunakan.end') }}" method="post"
                                        class="form-horizontal">
                        @endif
                        @csrf
                        <input type="hidden" name="end_id" id="end_id" value="" />
                        <input type="hidden" name="end_inventarisbarang_id" id="end_inventarisbarang_id" value="" />
                        Apakah inventaris <span name="end_name" id="end_name"></span> sudah selesai digunakan?
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
        <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script>
            function endDistribusiBarang(arr) {
                $('#end_id').val(arr.id)
                $('#end_inventarisbarang_id').val(arr.inventarisbarang_id)
                $('#end_name').text(arr.id)
            }

        </script>
    @endsection
