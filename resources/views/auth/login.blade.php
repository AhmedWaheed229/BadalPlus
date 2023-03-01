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
                        <div class="auth-header">
                            <h1>{{__('login')}}</h1>
                            <p>{{__('enter your valid data to get into your account')}}</p>
                        </div>
                        @error('error')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <form method="POST" action="{{ route('login') }}">
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

                            <div class="mb-3 form-group">
                                <label for="login_password">{{__('password')}}</label>
                                <input id="login_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('remember me') }}
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="submit" class="btn btn-default">
                                    {{ __('login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <div class="forget_password">
                                        <a href="{{ route('password.request') }}">
                                            {{ __('forgot your password?') }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </form>

                        <div class="sign_up">
                            {{__('don’t have an account?')}}
                            <a href="{{route('register')}}">{{__('register')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
