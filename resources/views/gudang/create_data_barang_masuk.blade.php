@extends('layouts.main2')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Data Barang Masuk</h1>
</div>

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Data Barang Masuk</h6>
        <hr class="sidebar-divider">
        <form id="barangMasukForm" action="{{route('barang_masuk.store')}}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                    <input type="search" class="form-control" id="nama_barang" name="nama_barang" placeholder="Cari Barang" required readonly>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#searchModal">Cari</button>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control" id="harga" name="harga" value="" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="stok" class="col-sm-2 col-form-label">Stok Barang</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" id="stok" name="stok" value="" readonly>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="qty" class="col-sm-2 col-form-label">Qty Masuk</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty Masuk" oninput="handleQtyInput()" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="kategori" name="kategori" value="">
            <div class="form-group row">
                <label for="no_transaksi" class="col-sm-2 col-form-label">No Transaksi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" value="" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tgl Masuk</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="total" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="total" name="total" value="" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{route('barang_masuk.index')}}">
                <button type="button" class="btn btn-warning">Back</button>
            </a>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Pilih Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $key => $benda)
                        <tr id="benda-{{$benda->id}}">
                            <td>{{$key + 1}}</td>
                            <td>{{$benda->nama_barang}}</td>
                            <td>{{$benda->kategori_barang}}</td>
                            <td>{{$benda->stok}}</td>
                            <td>{{$benda->harga}}</td>
                            <td>
                                <button type="button" class="btn btn-primary pilih" onclick="handlePilih(this,<?php echo $benda->id ?>)">Pilih</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    let selectedBendaId = null;

    function calculateTotal() {
        const harga = document.getElementById('harga').value;
        const qty = document.getElementById('qty').value;
        const total = harga * qty;
        document.getElementById('total').value = total;
    }

    function generateRandomTransactionNumber() {
        if (selectedBendaId !== null) {
            const randomNumber = Math.floor(1000000 + Math.random() * 9000000);
            document.getElementById('no_transaksi').value = "NT-" + randomNumber + "-00" + selectedBendaId;
        }
    }

    function handlePilih(button, bendaId) {
        var row = button.closest('tr');
        document.getElementById('nama_barang').value = row.children[1].textContent;
        document.getElementById('kategori').value = row.children[2].textContent; // Update for kategori
        document.getElementById('stok').value = row.children[3].textContent;
        document.getElementById('harga').value = row.children[4].textContent;
        selectedBendaId = bendaId;
        $('#searchModal').modal('hide');
        generateRandomTransactionNumber();
        calculateTotal();
    }


    function handleQtyInput() {
        calculateTotal();
        generateRandomTransactionNumber();
    }
</script>
@endsection
@section('scripts')
<!-- taruh luar jika disini tidak bisa -->
@endsection