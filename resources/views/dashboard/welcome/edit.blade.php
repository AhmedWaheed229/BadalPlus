@extends('dashboard.layouts.app')

@section('title', ' - '.__('edit') .' '. __('welcome'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('edit')}} {{__('welcome')}}</h3>
                </div>

                <form action="{{route('welcomes.update', $record->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="content_ar">{{__('content_ar')}} <span class="text-danger">*</span></label>
                                    <textarea placeholder="{{__('content_ar')}}" id="content_ar" type="text" class="form-control @error('content_ar') is-invalid @enderror" name="content_ar">{{$record->content_ar}}</textarea>
                                    @error('content_ar')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="content_en">{{__('content_en')}} <span class="text-danger">*</span></label>
                                    <textarea placeholder="{{__('content_en')}}" id="content_en" type="text" class="form-control @error('content_en') is-invalid @enderror" name="content_en">{{$record->content_en}}</textarea>
                                    @error('content_en')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="type">{{__('type')}} <span class="text-danger">*</span> </label>
                                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                                        <option value="">{{__('choose type')}}</option>
                                        <option @if($record->type == 'title') selected @endif value="title">{{__('title')}}</option>
                                        <option @if($record->type == 'list') selected @endif value="list">{{__('list')}}</option>
                                    </select>
                                    @error('type')
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
                        <a class="btn btn-sm btn-dark" href="{{route('welcomes.index')}}">
                            <i class="fa fa-undo"></i>
                            {{__('cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
