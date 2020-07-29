@extends('layouts.app')

@section('content')
<div class="container vh-100 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7 col-sm-12 col-xs-12 ">
            <div class="card card--login card--shadow card-body d-flex justify-content-center">
                <div class="card__content">
                    <h1 class="title2 pb-4">{{ __('Login') }}</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                                <label for="email" class="col-md-12 col-form-label text-left pl-0">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input--shadow " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            

                            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                                <label for="password" class="col-md-12 col-form-label text-left pl-0">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror input--shadow" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-center form-group--padding">
                            <div class="row">
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0 pt-3">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary btn-lg pl-5 pr-5">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        @if (Route::has('password.request'))
                        <div class="password-forget-container password-forget-container--padding d-flex justify-content-center col-12">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
