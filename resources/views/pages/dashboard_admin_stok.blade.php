@extends('layouts.dashboard_admin')
@section('title', 'Stok')
@section('content')
<div class="row">
    <div class="row mt-2">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100 px-3">
                <div class="card-header pb-0 pt-3 bg-transparent">
                </div>
                <div class="card-body p-3 mt-3">
                    <table id="myTable" class="table display table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Last Updated</th>
                                <th class="text-center"><a class="btn bg-gradient-primary px-5 mb-0"
                                        href="{{url('admin/stok/create')}}">Add</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stok as $item)
                            <tr>
                                <td></td>
                                <td>{{$item['nama_barang']}}</td>
                                <td>{{$item['stok']}}</td>
                                <td>{{$item['satuan']}}</td>
                                <td>{{$item['updated_at']}}</td>
                                <td class="text-center d-flex">
                                    <form class="mx-0" action="{{url('admin/stok')}}/{{$item['id']}}/edit">
                                        <button class="btn btn-link" type="submit">
                                            <i class="far fa-edit fa-lg text-success"></i>
                                        </button>
                                    </form>
                                    <form class="mx-0" action="{{url('admin/stok')}}/{{$item['id']}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link" type="submit">
                                            <i class="fa fa-trash fa-lg text-danger mx-2"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection