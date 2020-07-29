@extends('layouts.app')

@section('content')
<div class="container vh-100">
    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-12 col-xs-12 ">
            <div class="card card--login card--shadow card-body d-flex justify-content-center">
                <div class="card__content">
                    <h1 class="title2 pb-4">{{ __('Register') }}</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                                <label for="name" class="col-md-12 col-form-label text-left pl-0">{{ __('Username') }}</label>
                           
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror input--shadow " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                                <label for="email" class="col-md-12 col-form-label text-left pl-0">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input--shadow " name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror input--shadow " name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                                <label for="password-confirm" class="col-md-12 col-form-label text-left pl-0">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control input--shadow" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 pt-3">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary btn-lg pl-5 pr-5">
                                    {{ __('Register') }}
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
