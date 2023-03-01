@extends('dashboard.layouts.app')

@section('title', ' - '. __('settings'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('settings')}}</h3>
                </div>

                <form action="{{route('settings.update', $record->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name_ar">{{__('name_ar')}} <span class="text-danger">*</span></label>
                            <input value="{{$record->name_ar}}" placeholder="{{__('name_ar')}}" id="name_ar"
                                   type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                   name="name_ar">
                            @error('name_ar')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name_en">{{__('name_en')}} <span class="text-danger">*</span></label>
                            <input value="{{$record->name_en}}" placeholder="{{__('name_en')}}" id="name_en"
                                   type="text" class="form-control @error('name_en') is-invalid @enderror"
                                   name="name_en">
                            @error('name_en')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">{{__('email')}} <span class="text-danger">*</span></label>
                            <input value="{{$record->email}}" placeholder="{{__('email')}}" id="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone">{{__('phone')}} <span class="text-danger">*</span></label>
                            <input value="{{$record->phone}}" placeholder="{{__('phone')}}" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror" name="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address_ar">{{__('address_ar')}}</label>
                            <input type="text" value="{{$record->address_ar}}" placeholder="{{__('address_ar')}}"
                                   id="address_ar" class="form-control @error('address_ar') is-invalid @enderror"
                                   name="address_ar">
                            @error('address_ar')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address_en">{{__('address_en')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" value="{{$record->address_en}}"
                                   placeholder="{{__('address_en')}}" id="address_en"
                                   class="form-control @error('address_en') is-invalid @enderror"
                                   name="address_en">
                            @error('address_en')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content_ar">{{__('content_ar')}}</label>
                            <input value="{{$record->content_ar}}" placeholder="{{__('content_ar')}}" id="content_ar"
                                   class="form-control @error('content_ar') is-invalid @enderror" name="content_ar">
                            @error('content_ar')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_en">{{__('content_en')}}</label>
                            <input value="{{$record->content_en}}"
                                   placeholder="{{__('content_en')}}" id="content_en"
                                   class="form-control @error('content_en') is-invalid @enderror" name="content_en">
                            @error('content_en')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="logo_ar">{{__('logo_ar')}}</label>
                                        <input placeholder="{{__('logo_ar')}}" id="logo_ar" type="file"
                                               class="form-control @error('logo_ar') is-invalid @enderror"
                                               name="logo_ar">
                                        @error('logo_ar')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <img src="{{$record->logo_ar_url}}"  style="max-height: 70px" alt="{{__('logo_ar')}}"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="logo_en">{{__('logo_en')}}</label>
                                        <input placeholder="{{__('logo_en')}}" id="logo_en" type="file"
                                               class="form-control @error('logo_en') is-invalid @enderror"
                                               name="logo_en">
                                        @error('logo_en')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <img src="{{$record->logo_en_url}}" style="max-height: 70px" alt="{{__('logo_en')}}"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="icon">{{__('icon')}}</label>
                                        <input placeholder="{{__('icon')}}" id="icon" type="file"
                                               class="form-control @error('icon') is-invalid @enderror"
                                               name="icon">
                                        @error('icon')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <img src="{{$record->icon_url}}"  style="max-height: 70px" alt="{{__('icon')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-warning">
                            <i class="fa fa-plus"></i>
                            {{__('edit')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
