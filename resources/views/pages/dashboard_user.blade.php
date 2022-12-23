@extends('layouts.dashboard_user')
@section('title','Presensi')
@section('content')
<div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card h-100">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Today</p>
                            <h2 class="font-weight-bolder mb-0 text-primary text-nowrap">
                                {{$today->englishDayOfWeek}}
                            </h2>
                            <p class="mb-0">
                                <span class="text-sm font-weight-bolder">{{$today->englishMonth}} {{$today->day}}
                                    @if($today->englishDayOfWeek==1)
                                    st
                                    @elseif($today->englishDayOfWeek==2)
                                    nd
                                    @elseif($today->englishDayOfWeek==3)
                                    rd
                                    @else
                                    th
                                    @endif, {{$today->year}} {{$today->format('H:i:s')}}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="far fa-calendar text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card h-100">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Attendance</p>
                            <h1 class="font-weight-bolder mb-0 text-success">
                                {{$kerja}}
                            </h1>
                            <p class="mb-0">
                                <span class="text-sm font-weight-bolder">days</span>
                                since December 1st
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="far fa-thumbs-up text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card h-100">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Absence</p>
                            <h1 class="text-danger font-weight-bolder mb-0">
                                {{$bolos}}
                            </h1>
                            <p class="mb-0">
                                <span class="text-sm font-weight-bolder">days</span>
                                since December 1st
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="far fa-thumbs-down text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($now == null)
<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Huh, you haven't filled in today's attendance !</h6>
            </div>
            <div class="card-body p-3 mt-3">
                <button class="btn btn-outline-warning btn-rounded mb-3" onclick="getLocation()"><i
                        class="fas fa-map-marker-alt me-2 "></i>
                    Get Location</button>
                <span class="ms-3" id="locationInfo"></span>
                <form method="POST" action="{{route('presensi.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-xl-4 mb-3">
                        <img id="imgPreview" style="max-width: 180px" src="" alt="">
                        <input type="file" onchange="readURL(this);" class="form-control" id="customFile" name="file"
                            required>
                    </div>
                    <input type="text" id="latitude" name="latitude" value="" hidden>
                    <input type="text" id="longitude" name="longitude" value="" hidden>
                    <button class="btn bg-gradient-primary shadow-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">hooray, You have filled attendance today !</h6>
            </div>
            <div class="card-body p-3 mt-3">
                <div class="col-md-4">
                    <img class="w-100" src="https://cdn-icons-png.flaticon.com/512/7503/7503982.png" alt="greatwork">
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
<script>
    var x = document.getElementById("locationInfo");
    
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    
    function showPosition(position) {
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;
    x.innerHTML = "Lokasi sudah didapatkan, silahkan upload bukti dan submit."
    }
</script>
<script>
    function readURL(input) {
        var MaxSizeInBytes = 1048576;
        if( input.files && input.files.length == 1 && input.files[0].size > MaxSizeInBytes )
            {
                alert("The file size must be no more than " + parseInt(MaxSizeInBytes/1024/1024) + "MB");
                return false;
            }else{
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
            alert(approvedHTML);
        }
    
</script>
@endsection