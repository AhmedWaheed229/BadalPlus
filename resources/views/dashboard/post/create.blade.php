@extends('dashboard.layouts.app')

@section('title', ' - '.__('create') .' '. __('post'))

@section('style')
    <style>
        .form-check-input {
            position: relative;
            margin: 0 !important;
            width: 25px;
            height: 25px;
        }
        .image_upload .image {
            display: block;
            padding: 5px;
            background: #F1F1F5;
            border: 1px dashed rgba(56, 78, 183, 0.3);
            border-radius: 4px;
        }
        .image_upload .image img {
            display: block;
            margin: 0 auto;
            height: 100%;
            max-height: 250px;
            max-width: 100%;
            width: 100%;
            object-fit: contain;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bg-white posts-header p-md-3 p-2 rounded mb-3">
                <div class="row align-items-center">
                    <div class="col-md-4 col-6">
                        <img src="{{asset("images/service.png")}}" alt="" class="w-100" style="object-fit: contain">
                    </div>
                    <div class="col-md-4 col-6">
                        <h1 class="mb-3">{{__("do you want to sell a")}} <span
                                class="text-warning">{{__("service")}}</span>{{__("?")}}</h1>
                        <p>{{__("fill in the required data to get what you need")}}</p>
                    </div>
                </div>
            </div>
            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                <h4>{{__("required data")}}</h4>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title">{{__('title')}} {{__("post")}} <span class="text-danger">*</span></label>
                            <input value="{{old('title')}}" placeholder="{{__('title')}} {{__("post")}}" id="title" type="text"
                                   class="form-control @error('title') is-invalid @enderror" name="title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>{{__("categories")}} <span class="text-danger">*</span></label>
                            <div class="row">
                                @foreach($main_categories as $category)
                                <div class="col-md-3 col-6">
                                    <div class="form-check mb-3 p-2 text-center alert alert-light">
                                        <label for="category-{{$category->id}}" class="d-block" style="cursor: pointer">{{$category->name}}</label>
                                        <input type="radio" name="main_category" id="category-{{$category->id}}"
                                               @if ($category->id == old('main_category')) checked @endif value="{{$category->id}}" class="form-check-input">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('main_category')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>{{__("sub categories")}} <span class="text-danger">*</span></label>
                            <div class="row" id="sub_categories">
                            </div>
                            @error('sub_category')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="price">{{__("price")}} <span class="text-danger">*</span></label>
                                    <input value="{{old('price')}}" placeholder="{{__('price')}}" id="price" type="number" step="0.01"
                                           class="form-control @error('price') is-invalid @enderror" name="price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="currency">{{__("currency")}} <span class="text-danger">*</span></label>
                                    <select id="currency" name="currency_id" class="form-control @error('currency_id') is-invalid @enderror">
                                        <option value="">{{__('choose')}} {{__("currency")}}</option>
                                        @foreach($currencies as $currency)
                                            <option @if(old('currency_id') == $currency->id || auth()->user()->currency_id == $currency->id) selected @endif value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('currency_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 image_upload">
                            <label for="image">{{__("image")}}</label>
                            <input type="file" class="d-none" name="image" id="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" />
                            <label for="image" class="image" id="img">
                                <img src="{{asset("images/image_upload.png")}}" alt="">
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="description">{{__("description")}}</label>
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{__("description")}}" rows="5"></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-plus"></i>
                                {{__('create')}}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("input[name='main_category']").change(function () {
            subCategories($(this).val());
        });

        $(window).ready(function () {
            subCategories("{{old('main_category') ?? 1}}");
        });

        function subCategories(value) {
            $("#sub_categories").html('<div class="spinner-grow text-center text-warning"><span class="sr-only">Loading...</span></div>');
            $.ajax({
                url: "{{route("sub_categories")}}",
                type: "Get",
                async: true,
                data: {_token: "{{csrf_token()}}", category_id: value},
                success: function (data) {
                    var html = "";
                    if (data.length > 0){
                        data.forEach(function(category){
                            html +='<div class="col-md-3 col-6"><div class="form-check mb-3 p-2 text-center alert alert-light">'+
                            '<label for="subcategory-'+category.id+'" class="d-block" style="cursor: pointer">'+category.name+'</label>'+
                            '<input type="radio" name="sub_category" id="subcategory-'+category.id+'" ' +
                                'value="'+category.id+'" class="form-check-input"> </div> </div>';
                        });
                    }
                    $("#sub_categories").html(html);
                }
            });
        }

        $('.image_upload input').on('change', function () {
            var img = $(this).get(0).files[0];
            if (img){
                var reader = new FileReader();
                reader.onload = function (){
                    $('.image_upload .image img').attr('src', reader.result);
                };
                reader.readAsDataURL(img);
            }else {
                $(this).siblings('.image').find('img').attr('src', 'images/image_upload.png');
            }
        });
        /*
        function readfiles(files) {
            for (var i = 0; i < files.length; i++) {
                let name = files[i].name,
                    size = files[i].size,
                    type = files[i].type;
                console.log(name,size,type);
                reader = new FileReader();
                reader.onload = function(event) {
                    $('.image_upload #img img').attr('src', event.target.result);
                }
                reader.readAsDataURL(files[i]);
            }
        }
        var holder = document.getElementById('img');
        holder.ondragover = function () {  return false; };
        holder.ondragend = function () { return false; };
        holder.ondrop = function (e) {
            e.preventDefault();
            readfiles(e.dataTransfer.files);
        }
        */
    </script>
@endsection
