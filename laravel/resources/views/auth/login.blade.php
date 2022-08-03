@extends('layouts.app')

@section('title')
Login
@endsection

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <h1>{{ __('Welcome Laravel API') }}</h1>

                    <p class="text-muted">{{ __('Enter your username and password.') }}</p>

                    @if(session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;padding: 10px 10px 10px 10px;">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>

                            <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ __('Username') }}" value="{{ old('email', null) }}">

                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;padding: 10px 10px 10px 10px;"><i class="fa fa-lock"></i></span>
                            </div>

                            <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ __('Password') }}">

                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-4">
                            <div class="form-check checkbox">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                                <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                    {{ __('Remember me ?') }}
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                @if(Route::has('password.request'))
                                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                        {{ trans('global.forgot_password') }}
                                    </a><br>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
