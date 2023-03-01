@extends('layouts.app')

@section('content')
<section class="auth">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 order-0 auth-background d-none d-md-block">
                    <img src="{{asset('images/login.png')}}" alt="">
                </div>
                <div class="col-md-6 offset-md-6 ">
                    <div class="auth-form">
                        <div class="auth-header mb-5">
                            <h1>{{__('Reset Password')}}</h1>
                        </div>
                        @error('error')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <form class="mt-5" method="POST" action="{{ route('password.email') }}">
                        @csrf
                            <div class="mb-3 form-group">
                                <label for="login_email">{{ __('email') }}</label>
                                <input id="login_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="username" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-default">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>
@endsection
