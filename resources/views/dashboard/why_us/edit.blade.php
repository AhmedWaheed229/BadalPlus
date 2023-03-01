@extends('dashboard.layouts.app')

@section('title', ' - '.__('edit') .' '. __('why_us'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('edit')}} {{__('why_us')}}</h3>
                </div>

                <form action="{{route('why_us.update', $record->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="title_ar">{{__('title_ar')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->title_ar}}" placeholder="{{__('title_ar')}}" id="title_ar" type="text" class="form-control @error('title_ar') is-invalid @enderror" name="title_ar">
                                    @error('title_ar')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="title_en">{{__('title_en')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->title_en}}" placeholder="{{__('title_en')}}" id="title_en" type="text" class="form-control @error('title_en') is-invalid @enderror" name="title_en">
                                    @error('title_en')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="description_ar">{{__('description_ar')}} <span class="text-danger">*</span></label>
                                    <textarea placeholder="{{__('description_ar')}}" id="description_ar" class="form-control @error('description_ar') is-invalid @enderror" name="description_ar">{{$record->description_ar}}</textarea>
                                    @error('description_ar')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="description_en">{{__('description_en')}} <span class="text-danger">*</span></label>
                                    <textarea placeholder="{{__('description_en')}}" id="description_en" class="form-control @error('description_en') is-invalid @enderror" name="description_en">{{$record->description_en}}</textarea>
                                    @error('description_en')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="icon">{{__('icon')}}</label>
                                    <input placeholder="{{__('icon')}}" id="icon" type="file" class="form-control @error('icon') is-invalid @enderror" name="icon">
                                    @error('icon')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 mt-3">
                                    <label for="active">
                                        {{__('active')}}
                                    </label>
                                    <input type="checkbox" name="active" id="active" value="1" {{ $record->active ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-warning">
                            <i class="fa fa-pen-alt"></i>
                            {{__('edit')}}
                        </button>
                        <a class="btn btn-sm btn-dark" href="{{route('why_us.index')}}">
                            <i class="fa fa-undo"></i>
                            {{__('cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
