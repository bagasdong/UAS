@extends('layouts.dashboard_user')
@section('title', 'Keuangan')
@section('content')
<div class="row">
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize mb-0">Pendapatan</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{route('keuangan.store')}}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="pendapatan" class="form-control-label">Jumlah Pendapatan</label>
                        <input class="form-control" type="number" id="pendapatan" name="pendapatan" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ket_pendapatan" class="form-control-label">Keterangan</label>
                        <input class="form-control" type="text" id="ket_pendapatan" name="ket_pendapatan" required>
                    </div>
                    <div class="col-mb-3">
                        <input type="submit" class="btn btn-outline-warning" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize mb-0">Pegeluarann</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{route('keuangan.store')}}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="pengeluaran" class="form-control-label">Jumlah Pengeluaran</label>
                        <input class="form-control" type="number" id="pengeluaran" name="pengeluaran" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ket_pengeluaran" class="form-control-label">Keterangan</label>
                        <input class="form-control" type="text" id="ket_pengeluaran" name="ket_pengeluaran" required>
                    </div>
                    <div class="col-mb-3">
                        <input type="submit" class="btn btn-outline-warning" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="row mt-2">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100 px-3 shadow">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Pendapatan</h6>
                </div>
                <div class="card-body p-3 mt-3">
                    <table id="myTable" class="table display table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Created at</th>
                                <th>Created by</th>
                                <th>Keterangan</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendapatan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item['created_at']}}</td>
                                <td>{{$item['firstname']}}</td>
                                <td>{{$item['keterangan']}}</td>
                                <td>{{$item['jumlah']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="row mt-2">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100 px-3 shadow">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Pengeluaran</h6>
                </div>
                <div class="card-body p-3 mt-3">
                    <table id="myTable2" class="table display table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Created at</th>
                                <th>Created by</th>
                                <th>Keterangan</th>
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $item)
                            <tr>
                                <td></td>
                                <td>{{$item['created_at']}}</td>
                                <td>{{$item['firstname']}}</td>
                                <td>{{$item['keterangan']}}</td>
                                <td>{{$item['jumlah']}}</td>
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
@section('script')
<script>
    var t = $('#myTable').DataTable({
        responsive: true,
        columnDefs: [{
            searchable: false,
            orderable: false,
            targets: 0,
        }, ],
        order: [
            [1, 'desc']
        ],
    });
    var t2 = $('#myTable2').DataTable({
        responsive: true,
        columnDefs: [{
            searchable: false,
            orderable: false,
            targets: 0,
        }, ],
        order: [
            [1, 'desc']
        ],
    });

    t.on('order.dt search.dt', function() {
        let i = 1;

        t.cells(null, 0, {
            search: 'applied',
            order: 'applied'
        }).every(function(cell) {
            this.data(i++);
        });
    }).draw();
    t2.on('order.dt search.dt', function() {
        let i = 1;

        t.cells(null, 0, {
            search: 'applied',
            order: 'applied'
        }).every(function(cell) {
            this.data(i++);
        });
    }).draw();
</script>
@endsection