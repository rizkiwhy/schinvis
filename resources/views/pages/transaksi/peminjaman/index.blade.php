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
                <div class="col-sm-6 offset-sm-6">
                    @if (Auth::user()->role_id === 1)
                        <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                            href="{{ route('admin.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi') }}">
                        @elseif (Auth::user()->role_id === 2)
                            <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                                href="{{ route('user.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi') }}">
                            @else
                                <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                                    href="{{ route('management.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi') }}">
                    @endif
                    <i class="fas fa-bell mr-2"></i>Pengajuan
                    </a>
                </div>
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
                                        <th class="text-center">Kode Inventaris</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Pengguna</th>
                                        <th class="text-center">Mulai Peminjaman</th>
                                        <th class="text-center">Status Peminjaman</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Ruangan</th>
                                        <th class="text-center">Selesai Peminjaman</th>
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
                                            <td>{{ $item->inventarisbarang_id }}</td>
                                            <td>{{ $item->inventarisBarang->subsubkelompokbarang->nama }}</td>
                                            <td>{{ $item->user->nama }}</td>
                                            <td>{{ $item->mulaidigunakan }}</td>
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
                                                @if ($item->jenispenggunaanbarang_id === 2 && $item->selesaidigunakan === null)
                                                    <a class="btn btn-primary btn-sm"
                                                        onclick="endPeminjamanBarang({{ $item }})"
                                                        data-toggle="modal" data-target="#modal-end-peminjamanbarang">
                                                        <i class="fas fa-check"></i></a>
                                                @endif
                                            </td>
                                            <td>{{ $item->ruangan->nama }}</td>
                                            <td>{{ $item->selesaidigunakan }}</td>
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
                                        <th class="text-center">Kode Inventaris</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Pengguna</th>
                                        <th class="text-center">Mulai Peminjaman</th>
                                        <th class="text-center">Status Peminjaman</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Ruangan</th>
                                        <th class="text-center">Selesai Peminjaman</th>
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
    <!-- /.content -->
    <div class="modal fade" id="modal-end-peminjamanbarang">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Selesai {{ $data['page'] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (Auth::user()->role_id === 1)
                        <form action="{{ route('admin.transaksi.peminjaman.endpribadi') }}" method="post"
                            class="form-horizontal">
                        @elseif (Auth::user()->role_id === 2)
                            <form action="{{ route('user.transaksi.peminjaman.endpribadi') }}" method="post"
                                class="form-horizontal">
                            @elseif (Auth::user()->role_id === 3)
                                <form action="{{ route('management.transaksi.peminjaman.endpribadi') }}" method="post"
                                    class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" name="end_id" id="end_id" value="" />
                    Apakah inventaris <span name="end_name" id="end_name"></span> sudah selesai dipinjam?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
<script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    function endPeminjamanBarang(arr) {
        $('#end_id').val(arr.id)
        $('#end_name').text(arr.id)
    }

</script>
