@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Mobile Number') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if ($message=="notAllowRequest")
                    <div class="alert alert-info" role="alert">
                        OTP code has been sent to your number, please enter the OTP in the field below. Wait 5 minutes
                        after requesting the otp code to request it again.
                    </div>
                    @endif
                    @if ($message=="allowRequest")
                    <div class="alert alert-info" role="alert">
                        OTP code has been sent to your number, please enter the OTP in the field below.
                        <form action="{{url('mobile/verify')}}" method="POST">
                            @csrf
                            <input type="number" value="{{$mobile}}" hidden name="mobile">
                            <input type="text" value="true" hidden name="resend">
                            <button type="submit" class="btn btn-white text-primary text-font-weight p-0"
                                style="text-decoration: underline">Resend
                                OTP</button>
                        </form>
                    </div>
                    @endif
                    <form method="POST" action="{{url('mobile/OTP-check')}}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="otp" class="col-md-3 col-form-label"></label>
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <input id="otp" placeholder="OTP" type="number" maxlength="6" class="form-control"
                                        name="otp" required>
                                </div>
                                <input type="number" value="{{$mobile}}" hidden name="mobile">

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection