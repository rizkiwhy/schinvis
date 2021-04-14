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
                                <form action="{{ route('admin.transaksi.perbaikan.updatepribadi') }}" method="post"
                                    class="form-horizontal">
                                @elseif(Auth::user()->role_id === 2)
                                    <form action="{{ route('user.transaksi.perbaikan.updatepribadi') }}" method="post"
                                        class="form-horizontal">
                                    @else
                                        <form action="{{ route('management.transaksi.perbaikan.updatepribadi') }}"
                                            method="post" class="form-horizontal">
                            @endif
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $data['inventarisDiperbaiki']->id }}">
                            <input type="hidden" id="inventarisbarang_id" name="inventarisbarang_id" value="{{ $data['inventarisBarang']->id }}">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Masalah</label>
                                    <div class="input-group">
                                        <input type="text" name="masalah" class="form-control"
                                            style="text-transform: capitalize" id="masalah"
                                            value="{{ $data['inventarisDiperbaiki']->masalah }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Kondisi Barang</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="kondisibarang_id" name="kondisibarang_id"
                                            style="width: 100%">
                                            <option value="{{ $data['inventarisBarang']->kondisibarang_id }}" selected>
                                                {{ $data['inventarisBarang']->kondisiBarang->nama }}</option>
                                            @foreach ($data['kondisiBarang']->except($data['inventarisBarang']->kondisibarang_id) as $item)
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
@endsection
