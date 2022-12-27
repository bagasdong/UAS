@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password via Mobile Number') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(!empty($msg))
                    <div class="alert alert-danger" role="alert"> {{ $msg }}</div>
                    @endif
                    <form method="POST" action="{{url('mobile/password/reset')}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number')
                                }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="number" class="form-control @error('number') is-invalid @enderror"
                                        id="mobile" name="mobile" required autocomplete="tel" value="{{old('mobile')}}"
                                        aria-describedby="basic-addon1">
                                </div>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send OTP') }}
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