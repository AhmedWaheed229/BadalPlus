@extends('dashboard.layouts.app')

@section('title', ' - '.__('edit') .' '. __('currency'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('edit')}} {{__('currency')}}</h3>
                </div>

                <form action="{{route('currencies.update', $record->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name_ar">{{__('name_ar')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->name_ar}}" placeholder="{{__('name_ar')}}" id="name_ar" type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar">
                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name_en">{{__('name_en')}} <span class="text-danger">*</span></label>
                                    <input value="{{$record->name_en}}" placeholder="{{__('name_en')}}" id="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en">
                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="percent">{{__('rate')}}</label>
                                    <input placeholder="{{__('rate')}}" id="rate" value="{{$record->rate}}" type="number" step="0.01" class="form-control @error('rate') is-invalid @enderror" name="rate">
                                    @error('rate')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
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
                            <i class="fa fa-pen"></i>
                            {{__('edit')}}
                        </button>
                        <a class="btn btn-sm btn-dark" href="{{route('currencies.index')}}">
                            <i class="fa fa-undo"></i>
                            {{__('cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
