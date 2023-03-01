@extends('dashboard.layouts.app')

@section('title', ' - '.__('create') .' '. __('categories'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('create')}} {{__('categories')}}</h3>
                </div>

                <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name_ar">{{__('name_ar')}} <span class="text-danger">*</span></label>
                                    <input value="{{old('name_ar')}}" placeholder="{{__('name_ar')}}" id="name_ar" type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar">
                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name_en">{{__('name_en')}} <span class="text-danger">*</span></label>
                                    <input value="{{old('name_en')}}" placeholder="{{__('name_en')}}" id="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en">
                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="parent_id">{{__('category')}} <span class="text-danger">*</span> </label>
                                    <select id="parent_id" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id">
                                        <option value="0">{{__('main category')}}</option>
                                        @foreach($categories as $category)
                                            <option @if(old('parent_id') == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4" id="image_input">
                                <div class="mb-3">
                                    <label for="image">{{__('image')}}</label>
                                    <input placeholder="{{__('image')}}" id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4" id="percent_input">
                                <div class="mb-3">
                                    <label for="percent">{{__('percent')}}</label>
                                    <input placeholder="{{__('percent')}}" id="percent" value="{{old("percent")}}" type="number" step="0.01" class="form-control @error('percent') is-invalid @enderror" name="percent">
                                    @error('percent')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-3 mt-3">
                                    <label for="active">
                                        {{__('active')}}
                                    </label>
                                    <input type="checkbox" name="active" id="active" value="1" {{ old('active') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-warning">
                            <i class="fa fa-plus"></i>
                            {{__('create')}}
                        </button>
                        <a class="btn btn-sm btn-dark" href="{{route('categories.index')}}">
                            <i class="fa fa-undo"></i>
                            {{__('cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#parent_id").change(function(){
            var value = $(this).val();
            parentChange(value);
        });

        $(window).ready(function(){
            parentChange("{{old('parent_id') ?? 0}}");
        });

        function parentChange(value){
            if (value == 0){
                $("#percent_input").css('display','none');
                $("#image_input").css('display','block');
            }else {
                $("#percent_input").css('display','block');
                $("#image_input").css('display','none');
            }
        }
    </script>
@endsection
