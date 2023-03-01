@extends('dashboard.layouts.app')

@section('title', ' - ' .  $record->title)

@section('content')
    <div class="container">
        <div class="page-content">
            <div class="row">
                <div class="col-md-7 order-1 order-md-0">
                    <h4>{{__("Start transfer")}}</h4>
                    <p class="text-muted">{{__("info about the post")}}</p>
                    <div class="product bg-white p-3 rounded-2">
                        <div class="d-flex justify-content-between">
                            <div class="w-25"><p class="text-muted">{{__("title")}}</p></div>
                            <div class="w-75">
                                <p>{!!$record->title!!}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="w-25"><p class="text-muted">{{__("Description")}}</p></div>
                            <div class="w-75">
                                <p>{!!$record->description!!}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="w-25"><p class="text-muted">{{__("category")}}</p></div>
                            <div class="w-75"><p>{{optional(optional($record->category)->category)->name}}
                                    - {{optional($record->category)->name}}</p></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="w-25"><p class="text-muted">{{__("price")}}</p></div>
                            <div class="w-75"><h6 class="text-primary fw-bolder">{{$record->price}} {{$record->currency->name ?? ""}}</h6></div>
                        </div>
                    </div>

                    <p class="text-muted mt-2">{{__("info about the owner")}}</p>

                    <div class="badge bg-white w-100 mb-3 p-3" style="text-align: start!important;">
                        <img src="{{$record->user->image_url}}" height="150" class="mb-2 rounded-2" alt="">
                        <h6>{{$record->user->name}}</h6>
                        <p><span class="text-muted me-1">{{__("location")}}: </span> {{$record->user->location}}</p>
                        <p><span class="text-muted me-1">{{__("Times of transfers")}}: </span>
                            {{$record->user->soldPosts()->count() + $record->user->boughtPosts()->count()}}
                        </p>
{{--                        <div class="d-flex">--}}
{{--                            <div--}}
{{--                                class="alert me-2 alert-light border p-2 d-flex justify-content-between align-items-center">--}}
{{--                                <img src="images/like.png" height="20" alt="" class="me-2">--}}
{{--                                <div class="badge bg-light">3</div>--}}
{{--                            </div>--}}
{{--                            <div--}}
{{--                                class="alert me-2 alert-light border p-2 d-flex justify-content-between align-items-center">--}}
{{--                                <img src="images/dislike.png" height="20" alt="" class="me-2">--}}
{{--                                <div class="badge bg-light">6</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <a href="{{route(config('chatify.routes.prefix')).'/'.$record->user->id.'/'.$record->id}}" class="btn btn-warning d-block w-100">
                            <img src="{{asset('images/chat.png')}}" height="20" class="me-2" alt="">
                            {{__("chat")}}
                        </a>
                    </div>
                </div>

                <div class="col-md-5 mt-md-5 pt-md-4 order-0 order-md-1">
                    <img src="{{$record->image_url}}" class="w-100" alt="" style="object-fit: cover">
                </div>
            </div>

        </div>
    </div>
@endsection
