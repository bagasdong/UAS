@extends('layouts.dashboard_user')
@section('content')
<div class="row mb-5">
    <h1 class="d-flex justify-content-between"><a href="/user" class="me-3"><span class="iconify"
                data-icon="akar-icons:arrow-back-thick"></span></a>Presensi</h1>
</div>
<div class="row mb-3 justify-content-around">
    <div
        class="col-md-11 p-3 mi-bg-primary d-flex flex-column justify-content-center align-items-center shadow-sm rounded">
        @if ($last != null)
        <h2 class="text-white">Horee!!</h2>
        <p class="text-white">
            Kamu sudah mengisi presensi hari ini.
        </p>
        @else
        <h2 class="text-white">Haduhh!!</h2>
        <p class="text-white">
            Kamu belum mengisi presensi hari ini.
        </p>
        @endif
    </div>
</div>
<div class="row mb-3 justify-content-around">
    <div
        class="col-md-5 p-3 mi-bg-primary d-flex flex-column justify-content-center align-items-center shadow-sm rounded">
        <label for="totalCabang">Hari Kamu Bekerja</label>
        <div id="totalCabang">{{$kerja}}</div>
    </div>
    <div
        class="col-md-5 p-3 mi-bg-primary d-flex flex-column justify-content-center align-items-center shadow-sm rounded">
        <label for="totalKaryawan">Hari Kamu Bolos</label>
        <div id="totalKaryawan">{{$bolos}}</div>
    </div>
</div>
@if ($last == null)
<div class="row mb-3">
    <div class="col-md-12 mt-5 d-flex justify-content-around">
        <!-- Button trigger modal -->
        <button type="button" class="btn mi-btn-secondary" data-bs-toggle="modal" data-bs-target="#inputModal">
            Presensi di sini!
        </button>
        <!-- Modal -->
        <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/user/presensi" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="inputModalLabel">
                                Upload Bukti Presensi
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="my-3">
                                <input type="file" class="form-control" accept="image/*" name="file" />
                            </div>
                        </div>
                        <input type="text" id="latitude" name="latitude" value="" hidden>
                        <input type="text" id="longitude" name="longitude" value="" hidden>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection