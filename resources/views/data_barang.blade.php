@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
</div>

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
        <button class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addCategoryModal" style="float: right;">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori Barang</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $key => $benda)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $benda->kategori_barang}}</td>
                        <td>{{ $benda->nama_barang }}</td>
                        <td>{{ $benda->stok }}</td>
                        <td>Rp{{ $benda->harga }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $benda->id }}" data-name="{{ $benda->kategori_barang }}">Edit</button>
                            <form action="{{ route('barang.destroy', $benda->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah barang</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addbendaForm" action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kategori_barang">Kategori</label>
                        <select class="form-control" id="kategori_barang" name="kategori_barang" required>
                            <option value="" disabled selected>Pilih Kategori Barang</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok" oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, this.maxLength);" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, this.maxLength);" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit benda</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($barang as $key => $benda)
                <form id="addbendaForm" action="{{ route('barang.update' ,$benda->id) }}" method="POST">
                    @endforeach
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kategori_barang">Kategori</label>
                        <select class="form-control" id="kategori_barang" name="kategori_barang" required>
                            <option value="" disabled selected>Pilih Kategori Barang</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok" oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, this.maxLength);" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, this.maxLength);" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#editCategoryModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var modal = $(this);
        modal.find('.modal-body #editCategoryName').val(name);
        modal.find('form').attr('action', '/categories/' + id);
    });
</script>
@endsection