@extends('layouts.dashboard_admin')
@section('title', 'Presensi')
@section('content')
<div class="row">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100 px-3 overflow-hidden">
                <div class="card-header pb-0 pt-3 bg-transparent">
                </div>
                <div class="card-body p-3 mt-3">
                    <table id="myTable" class="table display table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Presensi</th>
                                <th>Waktu Presensi</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $item)
                            <tr>
                                <td>no</td>
                                <td>{{$item['firstname']}} {{$item['lastname']}}</td>
                                <td>{{$item['tgl_presensi']}}</td>
                                <td>{{$item['waktu_presensi']}}</td>
                                <td><a class="badge bg-gradient-warning"
                                        href="https://www.google.com/maps/place/{{$item['latitude']}},{{$item['longitude']}}">Klik</a>
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