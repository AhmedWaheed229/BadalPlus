@extends('dashboard.layouts.app')

@section('title', ' - '.__('create') .' '. __('user'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('create')}} {{__('user')}}</h3>
                </div>

                <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="first_name">{{__('first_name')}} <span
                                            class="text-danger">*</span></label>
                                    <input value="{{old('first_name')}}" placeholder="{{__('first_name')}}"
                                           id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="last_name">{{__('last_name')}} <span
                                            class="text-danger">*</span></label>
                                    <input value="{{old('last_name')}}" placeholder="{{__('last_name')}}" id="last_name"
                                           type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email">{{__('email')}} <span class="text-danger">*</span></label>
                                    <input value="{{old('email')}}" placeholder="{{__('email')}}" id="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone">{{__('phone')}} <span class="text-danger">*</span></label>
                                    <input value="{{old('phone')}}" placeholder="{{__('phone')}}" id="phone"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password">{{__('password')}} <span class="text-danger">*</span></label>
                                    <input type="password" value="{{old('password')}}" placeholder="{{__('password')}}"
                                           id="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password_confirmation">{{__('password_confirmation')}} <span
                                            class="text-danger">*</span></label>
                                    <input type="password" value="{{old('password_confirmation')}}"
                                           placeholder="{{__('password_confirmation')}}" id="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="image">{{__('image')}}</label>
                                    <input placeholder="{{__('image')}}" id="image" type="file"
                                           class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="location">{{__('location')}}</label>
                                    <input value="{{old('location')}}" placeholder="{{__('location')}}" id="location"
                                           class="form-control @error('location') is-invalid @enderror" name="location">
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="balance">{{__('balance')}}</label>
                                    <input type="number" step="0.01" value="{{old('balance')}}"
                                           placeholder="{{__('balance')}}" id="balance"
                                           class="form-control @error('balance') is-invalid @enderror" name="balance">
                                    @error('balance')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="currency">{{__('currency')}}</label>
                                    <select id="currency" class="form-control @error('currency_id') is-invalid @enderror"
                                            name="currency_id">
                                        <option value="">{{__("choose")}} {{__('currency')}}</option>
                                        @foreach($currencies as $c)
                                            <option @if($c->id == old('currency_id')) selected
                                                    @endif value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('currency_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="facebook">{{__('facebook')}}</label>
                                    <input value="{{old('facebook')}}" placeholder="{{__('facebook')}}" id="facebook"
                                           class="form-control @error('facebook') is-invalid @enderror" name="facebook">
                                    @error('facebook')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="twitter">{{__('twitter')}}</label>
                                    <input value="{{old('twitter')}}" placeholder="{{__('twitter')}}" id="twitter"
                                           class="form-control @error('twitter') is-invalid @enderror" name="twitter">
                                    @error('twitter')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 mt-3">
                                    <label for="active">
                                        {{__('active')}}
                                    </label>
                                    <input type="checkbox" name="active" id="active"
                                           value="1" {{ old('active') ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 mt-3">
                                    <label for="admin">
                                        {{__('admin')}}
                                    </label>
                                    <input type="checkbox" name="admin" id="admin"
                                           value="1" {{ old('admin') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-warning">
                            <i class="fa fa-plus"></i>
                            {{__('create')}}
                        </button>
                        <a class="btn btn-sm btn-dark" href="{{route('users.index')}}">
                            <i class="fa fa-undo"></i>
                            {{__('cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
