@extends('dashboard.layouts.app')

@section('title', ' - ' .  __('profile'))

@section('content')
    <!-- start profile header-->
    <div class="profile-header">
        <div class="row justify-content-between">
            <div class="col-md-3 col-6">
                <div class="alert alert-default-warning rounded p-2 px-3">
                    <img src="{{$record->image_url}}" alt=""
                         style="display: block; margin: 0 auto 10px; height: 100px; width: auto; max-width: 100%; object-fit: contain; border-radius: 50%">
                    <h6 class="text-center" style="white-space: nowrap; overflow: hidden;"> {{ $record->name }}</h6>
                    {{--                        <span class="text-success">Online</span>--}}
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="alert alert-light">
                    {{__('location')}}:
                    <span class="text-warning">{{$record->location}}</span>
                </div>
                {{--                <div class="alert alert-light">--}}
                {{--                    {{__('blocked by')}}: <span class="yellow">3</span> {{__('person')}}--}}
                {{--                </div>--}}
                {{--                <div class="alert alert-light">--}}
                {{--                    {{__('blocked by')}}: <span class="yellow">3</span> {{__('person')}}--}}
                {{--                </div>--}}
            </div>
            <div class="col-md-4 col-6">
                {{--                <div class="alert alert-light">--}}
                {{--                    {{__('language')}}:--}}
                {{--                    <span class="yellow">English & Arabic</span>--}}
                {{--                </div>--}}
                {{--                <div class="alert alert-light">--}}
                {{--                    {{__('times of transferring')}}:--}}
                {{--                    <span class="yellow">10</span>--}}
                {{--                </div>--}}
                <div class="alert alert-light">
                    {{__('joined at')}}:
                    {{\Carbon\Carbon::parse($record->created_at)->fromNow()}}
                </div>
            </div>
            <div class="col-md-3 col-6">
                {{--                <div class="alert alert-default-success d-flex justify-content-between">--}}
                {{--                    <div>--}}
                {{--                        {{__("great feedback")}} (<span class="text-success">+1111</span>)--}}
                {{--                    </div>--}}
                {{--                    <div>--}}
                {{--                        <img src="{{asset('images/like.png')}}" height="20" alt="">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="alert alert-default-danger d-flex justify-content-between">--}}
                {{--                    <div>--}}
                {{--                        {{__("bad feedback")}} (<span class="text-danger">+1</span>)--}}
                {{--                    </div>--}}
                {{--                    <div>--}}
                {{--                        <img src="{{asset("images/dislike.png")}}" height="20" alt="">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- end profile header  -->

    <!--  start browse  -->
    <div class="py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="m-0 p-0">{{__('posts')}}</h4>

            <form id="sort_form" class="form-inline border border-warning py-1 px-2 justify-content-between">
                <label for="sort_by">{{__('sort by')}}</label>
                <select class="form-control border-0 bg-transparent" name="sort_by" id="sort_by">
                    <option @if(request('sort_by') == 'asc') selected
                            @endif value="asc">{{__('newest')}} {{__('posts')}}</option>
                    <option @if(request('sort_by') == 'desc') selected
                            @endif value="desc">{{__('oldest')}} {{__('posts')}}</option>
                </select>
            </form>
        </div>
        <!--  start posts  -->
        @if($posts->total() > 0)
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-img">
                                    <img src="{{$post->image_url}}" class="w-100 d-block mx-auto"
                                         style="height: 200px; object-fit: cover;" alt="">
                                </div>
                                <div class="card-body">
                                    <h5>{{$post->title}}</h5>
                                    <p class="lead"
                                       style="height: 50px;overflow: hidden;text-overflow: ellipsis;line-height: 1.2;">{{$post->description}}</p>
                                    <div class="alert alert-light p-2">
                                        <strong
                                            class="text-primary">{{$post->price}} {{$post->currency->name ?? $currencies[0]->name}}</strong>
                                    </div>
                                    @if(auth()->id() == $record->id)
                                        <p>{{__("activation")}}: {{$post->active_status}}</p>
                                    @endif
                                    @if($post->status == 1)
                                        @if($post->created_by != auth()->id())
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{route("post.show", $post->id)}}" class="btn btn-warning">
                                                    {{ __('buy now') }}
                                                </a>
                                                <a href="{{route(config('chatify.routes.prefix')).'/'.$record->id.'/'.$post->id}}"
                                                   class="btn btn-light">
                                                    {{ __('chat') }}
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <div class="alert alert-default-danger">{{__("sold out")}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {!! $posts->withQueryString()->links('pagination::bootstrap-4') !!}
        @else
            <div class="alert alert-default-warning text-center">{{__("no data found")}}</div>
    @endif
    <!--  end posts  -->
    </div>
    <!--  end browse  -->

@endsection

@section('scripts')
    <script>
        $("#sort_by").change(function () {
            $("#sort_form").submit();
        });
    </script>

@endsection
