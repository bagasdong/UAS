@extends('layouts.dashboard_admin')
@section('title', 'Edit Item')
@section('content')
<div class="row mt-4">
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100 px-3">
            <div class="card-header pb-0 pt-3 bg-transparent">
            </div>
            <div class="card-body p-3 mt-3">
                <form action="{{url('admin/stok/')}}/{{$item['id']}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama_barang" class="form-control-label">Nama Barang</label>
                        <input class="form-control" type="text" id="nama_barang" name="nama_barang"
                            value="{{$item['nama_barang']}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="stok" class="form-control-label">Stok</label>
                        <input class="form-control" type="number" id="stok" name="stok" value="{{$item['stok']}}"
                            required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="satuan" class="form-control-label">Satuan</label>
                        <input class="form-control" type="text" id="satuan" name="satuan" value="{{$item['satuan']}}"
                            required>
                    </div>
                    <div class="col-mb-3">
                        <input type="submit" class="btn bg-gradient-warning px-5" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection