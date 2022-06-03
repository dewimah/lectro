@extends('layouts.app')

@section('content')
<div class="container"> <br><br><br><br>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="background-color:#d3d3d3" align="center">
                <!--<div class="card-header">{{ __('Login') }}</div>-->
                <div class="card-header"><h3><b style="color:#1c3b10">BMS's</b> <b>LECTRO</b></h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4">
                           <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>-->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                           <!-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>-->

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!--
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
-->
                        <div class="row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" style="background:#1c3b10" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>
<!--
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
