@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Barang Masuk</h1>
</div>

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Masuk</h6>
        <button class="btn btn-primary btn-icon-split" style="float: right;" id="printButton">
            <span class="icon text-white-50">
                <i class="fas fa-cog"></i>
            </span>
            <span class="text">Cetak Data</span>
        </button>
    </div>
    <div class="card-body" id="printArea">
        <div class="text-center print-title">
            <h1>Laporan Data Masuk</h1>
            <br>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Tgl</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang_masuk as $key => $benda_masuk)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$benda_masuk->no_transaksi}}</td>
                        <td>{{$benda_masuk->nama_barang}}</td>
                        <td>{{$benda_masuk->kategori}}</td>
                        <td>{{$benda_masuk->tanggal_masuk}}</td>
                        <td>{{$benda_masuk->qty}}</td>
                        <td>{{$benda_masuk->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.getElementById('printButton').addEventListener('click', function() {
        const printContents = document.getElementById('printArea').innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    });
</script>

<style>
    .print-title {
        display: none;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #printArea,
        #printArea * {
            visibility: visible;
        }

        #printArea {
            position: absolute;
            left: 0;
            top: 0;
        }

        .print-title {
            display: block;
        }
    }
</style>
@endsection

@section('scripts')
@endsection