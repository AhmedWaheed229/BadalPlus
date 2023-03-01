@extends('dashboard.layouts.app')

@section('title', ' - ' .  __('edit profile'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('edit')}} {{__('profile')}}</h3>
                </div>

                <form action="{{route('update_user_profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="first_name">{{__('first_name')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->first_name}}" placeholder="{{__('first_name')}}" id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="last_name">{{__('last_name')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->last_name}}" placeholder="{{__('last_name')}}" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email">{{__('email')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->email}}" placeholder="{{__('email')}}" id="email" class="form-control @error('email') is-invalid @enderror" name="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone">{{__('phone')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->phone}}" placeholder="{{__('phone')}}" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password">{{__('password')}}</label>
                                    <input type="password" value="{{old('password')}}" placeholder="{{__('password')}}" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password_confirmation">{{__('password_confirmation')}}</label>
                                    <input type="password" value="{{old('password_confirmation')}}" placeholder="{{__('password_confirmation')}}" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="image">{{__('image')}}</label>
                                    <input placeholder="{{__('image')}}" id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="location">{{__('location')}}</label>
                                    <input value="{{$record->location}}" placeholder="{{__('location')}}" id="location" class="form-control @error('location') is-invalid @enderror" name="location">
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="facebook">{{__('facebook')}}</label>
                                    <input value="{{$record->facebook}}" placeholder="{{__('facebook')}}" id="facebook" class="form-control @error('facebook') is-invalid @enderror" name="facebook">
                                    @error('facebook')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="twitter">{{__('twitter')}}</label>
                                    <input value="{{$record->twitter}}" placeholder="{{__('twitter')}}" id="twitter" class="form-control @error('twitter') is-invalid @enderror" name="twitter">
                                    @error('twitter')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-alt"></i>
                            {{__('edit')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
