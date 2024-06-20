@extends('layouts.main2')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang Masuk</h1>
</div>

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
        <a href="{{route('barang_masuk.create')}}">
            <button class="btn btn-primary btn-icon-split" data-toggle="modal" style="float: right;">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </button>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang_masuk as $key => $benda_masuk)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$benda_masuk->no_transaksi}}</td>
                        <td>{{$benda_masuk->nama_barang}}</td>
                        <td>{{$benda_masuk->kategori}}</td>
                        <td>{{$benda_masuk->qty}}</td>
                        <td>{{$benda_masuk->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

</script>
@endsection