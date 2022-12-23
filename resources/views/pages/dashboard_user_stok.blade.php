@extends('layouts.dashboard_user')
@section('title', 'Stok Persediaan')
@section('content')
<div class="row">
    <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Update Stok Persediaan</h6>
            </div>
            <div class="card-body p-3 mt-3">
                <form method="POST" action="{{url('/user/stok/1')}}">
                    @csrf
                    @method('PUT')
                    @foreach ($stok as $item)
                    <div class="form-group">
                        <label for="{{$item['id']}}">{{$item['nama_barang']}}</label>
                        <div class="input-group">
                            <input type="number" id="{{$item['id']}}" class="form-control"
                                aria-describedby="basic-addon{{$item['id']}}" name="{{$item['nama_barang']}}">
                            <span class="input-group-text"
                                id="basic-addon{{$item['nama_barang']}}">{{$item['satuan']}}</span>
                        </div>
                    </div>
                    @endforeach
                    <button type="submit" class="btn bg-gradient-warning  px-4">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize mb-0">Last Update</h6>
                <p class="text-sm mb-0">
                    <span class="font-weight-bold text-warning">{{$last}}</span>
                </p>
            </div>
            <div class="card-body p-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Nama Barang
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Stok
                                Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stok as $item)
                        <tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{$item['nama_barang']}}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{$item['stok']}}</p>
                                <p class="text-xs text-secondary mb-0">{{$item['satuan']}}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection