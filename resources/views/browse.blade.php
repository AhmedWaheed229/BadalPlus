@extends('layouts.app')

@section('content')

 <!--  start browse  -->
    <section class="browse">
        <div class="container">
            <div class="browse-header text-center">
                <div class="browse-header-content wow fadeInUp" data-wow-delay=".3s">
                    <h1>{{ $post_count }}</h1>
                    <h1>{{ __("available services") }}</h1>
                    <p>
                        {{__("we provide a high quality service for you with aprovement for you and the buyer to get the required needs") }}.
                    </p>
                </div>
                <form class="search-form wow fadeInUp" data-wow-delay=".7s">
                    <div class="input-group">
                        <label for="search"><img src="{{ asset("images/search.png") }}" alt=""></label>
                        <input name="title" value="{{ request("title") }}" id="search" class="form-control">
                        <button class="btn btn-default">{{ __("Search") }}</button>
                    </div>
                </form>
            </div>

            <div class="browse-filter">
                <form class="row">
                    <div class="col-md-4 col-6">
                        <div class="mb-3 wow fadeInUp" data-wow-delay=".3s">
                            <select name="category" id="main_categories">
                                <option value="">{{ __("Choose From Categories") }}</option>
                                @foreach ($main_categories as $category)
                                    <option @if(request("category") == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="mb-3 wow fadeInUp" data-wow-delay=".5s">
                            <select name="sub_category" id="sub_categories">
                                <option value="">{{ __("Choose From Subcategories") }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="mb-3 wow fadeInUp" data-wow-delay="1s">
                            <select name="currency">
                                <option value="">{{ __("Choose Currency") }}</option>
                                @foreach ($currencies as $currency)
                                    <option @if(request("currency") == $currency->id) selected @endif value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1 col-3">
                        <button class="btn btn-default" type="submit">{{ __("filter") }}</button>
                    </div>
                </form>
            </div>

            <div class="browse-content">
                <div class="browse-content-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-4 col-8 wow fadeInUp" data-wow-delay=".5s">
                            <h5>{{ __("Showing") }} {{ $posts->total() }} {{ __("post") }}</h5>
                        </div>
                        {{--
                        <div class="col-md-4 col-4">
                            <form class="sort-form wow fadeInUp" data-wow-delay=".7s" >
                                <div class="input-group">
                                    <label for="sort">Sort by:</label>
                                    <select id="sort">
                                        <option>Newest Post</option>
                                        <option>Oldest Post</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                          --}}
                    </div>
                </div>

                <div class="row">
                    @foreach ($posts as $post)
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
                                    <strong>{{ __("Added By") }}:
                                        <a href="{{ route("profile",  $post->created_by) }}">{{ $post->user->name ?? "" }}</a>
                                    </strong>
                                    <div class="alert alert-light p-2">
                                        <strong
                                            class="text-primary">{{$post->price}} {{$post->currency->name ?? $currencies[0]->name}}</strong>
                                    </div>

                                    @if($post->status == 1)
                                        @if(auth()->id() != $post->created_by)
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{route("post.show", $post->id)}}" class="btn btn-warning">
                                                    {{ __('buy now') }}
                                                </a>
                                                <a href="{{route(config('chatify.routes.prefix')).'/'.$post->created_by.'/'.$post->id}}"
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
                <div class="d-flex justify-content-center mt-3">
                    {!! $posts->withQueryString()->links("pagination::bootstrap-4") !!}
                </div>

            </div>
        </div>
    </section>
    <!--  end browse  -->
@endsection

@section("scripts")

<script>
    @if(request("category"))
        $(window).load(function(){
            getSubCategories('{{ request("category") }}');
        });
    @endif

    $("#main_categories").change(function(){
        var id = $(this).val();
        getSubCategories(id);
    });

    function getSubCategories($id){
        $.ajax({
            url : '{{ route("web.getSubCategoris") }}',
            type : 'GET',
            data : {id : $id},
            success : function(result){
                var old_cat = "{{ request("sub_category") }}";
                var selected = "";
                var html = '<option value="">{{ __("Choose From Subcategories") }}</option>';
                $.each(result , function(index,val) {
                    old_cat == val.id ? selected = "selected" : selected = "";
                    html += '<option '+ selected +' value="'+ val.id +'">'+ val.name +'</option>';
                });
                $("#sub_categories").html(html);
            }
        });
    }
</script>
@endsection
