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
                            <h1>{{ __('register') }}</h1>
                            <p>{{__('enter your valid data to get into your account')}}</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="first_name">{{__('first name')}}</label>
                                        <input value="{{old('first_name')}}" name="first_name" id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" autocomplete="first name" autofocus>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="last_name">{{__('last name')}}</label>
                                        <input value="{{old('last_name')}}" name="last_name" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" autocomplete="last name">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="auth_email">{{__('email')}}</label>
                                <input value="{{old('email')}}" id="auth_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"  autocomplete="username">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">{{__('phone')}}</label>
                                <input value="{{old('phone')}}" id="phone" name="phone" type="number" class="form-control @error('phone') is-invalid @enderror"  autocomplete="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="auth_password">{{__('password')}}</label>
                                <input value="{{old('password')}}" id="auth_password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password-confirm">{{__('confirm password')}}</label>
                                <input value="{{old('password_confirmation')}}" id="password-confirm" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                            </div>

                            <div class="submit-btn">
                                <button type="submit" class="btn btn-default">{{__('register')}}</button>
                            </div>
                        </form>
                        <div class="sign_up">
                            {{__('have an account?')}}
                            <a href="{{route('login')}}">{{__('login')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
