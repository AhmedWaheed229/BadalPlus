@extends('dashboard.layouts.app')

@section('title', ' - '.__('add balance'))

@section('content')

<div class="container">
    <div class="page-content">
        <h4>{{__("Vodafone cash information")}}</h4>
        @foreach ($numbers as $n)
        <label>{{ $n->number }}</label>
        <br>
        @endforeach

        <div class="row">
            <form class="my-3 col-md-6" method="post" action="{{route("recharge_request")}}"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="number">{{__("Number")}}</label>
                    <input value="{{old('number')}}" type="number" name="number" class="form-control" id="number"
                        placeholder="{{__(" Number")}}">
                </div>
                <div class="mb-3">
                    <label for="price">{{__("Amount")}}</label>
                    <input value="{{old('amount')}}" type="number" class="form-control" name="amount" id="price"
                        placeholder="{{__("Amount")}}">
                </div>
                <div class="mb-3 image_upload">
                    <label for="image">{{__("screenshot for the exchange")}}</label>
                    <input type="file" class="d-none" id="image" name="image"
                        accept="image/x-png,image/gif,image/jpeg,image/jpg" />
                    <label for="image" class="image"
                        style="display: block;padding: 25px; background: #F1F1F5;border: 1px dashed rgba(56, 78, 183, 0.3);border-radius: 4px;">
                        <img style="width: 100%; max-height: 250px; object-fit: contain" src="{{asset("images/image_upload.png")}}" alt="">
                    </label>
                </div>
                <div class="mb-3">
                    <button class="btn btn-warning">{{__("Submit")}}</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection

@section("scripts")
<script>
    $('.image_upload input').on('change', function () {
            var img = $(this).get(0).files[0];
            if (img) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('.image_upload .image img').attr('src', reader.result);
                };
                reader.readAsDataURL(img);
            } else {
                $(this).siblings('.image').find('img').attr('src', '{{asset("images/image_upload.png")}}');
            }
        });
</script>
@endsection
