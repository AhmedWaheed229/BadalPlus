@extends('dashboard.layouts.app')
@include('Chatify::layouts.headLinks')
@section('content')
    <div class="row">
        <div class="col-md-4 post-info d-none">
            <div class="d-flex align-items-center p-1 rounded bg-white w-100 mb-3 post-data" style="overflow: hidden; @if(app()->getlocale() == 'ar') border-right: @else border-left: @endif 2px solid #FC5B00;">
                <img src="" alt="" style="max-height: 65px; object-fit: cover; max-width: 50%;" class="rounded">
                <h4 class="m-0 h5 px-2"></h4>
            </div>
        </div>

        <div class="col-md-4 post-info d-none">
            <div class="align-items-center p-2 rounded bg-white w-100 mb-3 post-price"
            style="overflow: hidden; @if(app()->getlocale() == 'ar') border-right: @else border-left: @endif 2px solid #FBD540;">
                <p class="mb-1">{{ __("price") }}</p>
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="m-0 main_price"></h4>
                    <h4 class="m-0 convert_price"></h4>
                </div>
            </div>
        </div>

        <div class="col-md-4 post-info d-none">
            <div class="p-2 rounded bg-white w-100 mb-3"
            style="@if(app()->getlocale() == 'ar') border-right: @else border-left: @endif 2px solid #FBD540;">
                <div class="start-escrow">
                    <button type="button" class="btn btn-warning">  {{ __("escrow") }}</button>
                </div>
                <div class="escrow align-items-center rounded bg-white w-100 mb-3 post-price d-flex">
                    <span class="price"></span>
                    <button type="button" class="btn btn-warning">{{ __("hold") }}</button>
                </div>
                <div class="hold align-items-center rounded bg-white justify-content-between w-100 mb-3 post-price d-flex">
                    <span class="price"></span>
                    <button type="button" class="btn btn-warning">{{ __("release") }}</button>
                </div>
                <div class="release align-items-center rounded bg-white w-100 mb-3 post-price d-flex">
                    <span class="price"></span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="messenger" style="height: calc(100vh - 50px); position:relative;">
                {{-- ----------------------Users/Groups lists side---------------------- --}}
                <div class="messenger-listView">
                    {{-- Header and search bar --}}
                    <div class="m-header">
                        <nav class="text-center">
                            <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">{{__("messages")}}</span> </a>
                            {{-- header buttons --}}
                            <nav class="m-header-right">
                                {{--                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>--}}
                                <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                            </nav>
                        </nav>
                        {{-- Search input --}}
{{--                        <input type="text" class="messenger-search" placeholder="Search"/>--}}
                    </div>
                    {{-- tabs and lists --}}
                    <div class="m-body contacts-container">
                        {{-- Lists [Users/Group] --}}
                        {{-- ---------------- [ User Tab ] ---------------- --}}
                        <div class="@if($type == 'user') show @endif messenger-tab users-tab app-scroll"
                             data-view="users">
                            {{-- Favorites --}}
                            <div class="favorites-section d-none" >
                                <p class="messenger-title">{{__("favorites")}}</p>
                                <div class="messenger-favorites app-scroll-thin"></div>
                            </div>

                            {{-- Saved Messages --}}
                            {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}

                            {{-- Contact --}}
                            <div class="listOfContacts"
                                 style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

                        </div>

                        {{-- ---------------- [ Group Tab ] ---------------- --}}
                        <div class="@if($type == 'group') show @endif messenger-tab groups-tab app-scroll"
                             data-view="groups">
                            {{-- items --}}
                            <p style="text-align: center;color:grey;margin-top:30px">
                                <a target="_blank" style="color:{{$messengerColor}};"
                                   href="https://chatify.munafio.com/notes#groups-feature">Click here</a> for more info!
                            </p>
                        </div>

                        {{-- ---------------- [ Search Tab ] ----------------
                        <div class="messenger-tab search-tab app-scroll" data-view="search">
                            {{-- items
                            <p class="messenger-title">Search</p>
                            <div class="search-records">
                                <p class="message-hint center-el"><span>Type to search..</span></p>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>

                {{-- ----------------------Messaging side---------------------- --}}
                <div class="messenger-messagingView">
                    {{-- header title [conversation name] amd buttons --}}
                    <div class="m-header m-header-messaging">
                        <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                            {{-- header back button, avatar and user name --}}
                            <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                                <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                                <div class="avatar av-s header-avatar"
                                     style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                                </div>
                                <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                            </div>
                            {{-- header buttons --}}
                            <nav class="m-header-right">
                                {{--  <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                                <a href="/"><i class="fas fa-home"></i></a>  --}}
                                {{--                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>--}}
                            </nav>
                        </nav>
                    </div>
                    {{-- Internet connection --}}
                    <div class="internet-connection">
                        <span class="ic-connected">Connected</span>
                        <span class="ic-connecting">Connecting...</span>
                        <span class="ic-noInternet">No internet access</span>
                    </div>
                    {{-- Messaging area --}}
                    <div class="m-body messages-container app-scroll">
                        <div class="messages" style="direction: ltr">
                            <p class="message-hint center-el"><span>
                                {{ __("Please select a chat to start messaging") }}
                            </span></p>
                        </div>
                        {{-- Typing indicator --}}
                        <div class="typing-indicator">
                            <div class="message-card typing">
                                <p>
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                                </p>
                            </div>
                        </div>
                        {{-- Send Message Form --}}
                        @include('Chatify::layouts.sendForm')
                    </div>
                </div>
                {{-- ---------------------- Info side ---------------------- --}}
                <div class="messenger-infoView app-scroll" style="display:none;">
                    {{-- nav actions --}}
                    <nav>
                        <a href="#"><i class="fas fa-times"></i></a>
                    </nav>
                    {!! view('Chatify::layouts.info')->render() !!}
                </div>
            </div>
        </div>
    </div>
@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
@endsection
