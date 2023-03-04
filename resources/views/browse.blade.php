@extends('layouts.app')

@section('content')

<!--  start browse  -->

                        {{-- <div class="col-md-4 col-4">
                            <form class="sort-form wow fadeInUp" data-wow-delay=".7s" >
                                <div class="input-group">
                                    <label for="sort">Sort by:</label>
                                    <select id="sort">
                                        <option>Newest Post</option>
                                        <option>Oldest Post</option>
                                    </select>
                                </div>
                            </form>
                        </div> --}}


                <div class="row">
                    @foreach ($posts as $post)
                        {{-- <div class="col-md-4">
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
                        </div> --}}
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {!! $posts->withQueryString()->links("pagination::bootstrap-4") !!}
                </div>

                <table>
                    <thead>
                        <tr>
                            <td>Buy from</td>
                            <td>Pay with</td>
                            <td>trade speed</td>
                            <td>Price per Bitcoin <i class="fa-regular fa-circle-question"></i></td>
                            <td><span><i class="fa-solid fa-arrow-down-short-wide"></i></span><span><i class="fa-solid fa-info"></i></span></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h1>Username</h1>
                                <span><i class="fa-regular fa-thumbs-up"></i><h2>425</h2></span>
                                <span><i style="color: #3F9F4D;" class="fa-solid fa-circle"></i><h2>Active now</h2></span>
                            </td>
                            <td>
                                <h1>ANY Credit/Debit Card</h1>
                                <h2>5557r5288r5268 TD</h2>
                                <span>50/50 Fee</span>
                            </td>
                            <td>
                                <span><h1>5 min</h1><i class="fa-regular fa-clock"></i></span>
                            </td>
                            <td>
                                <h1>1 USD = 1.01 USD of BTC</h1>
                                <div>
                                    <span><h2>Min purchase:</h2><h3>290 USD</h3></span>
                                    <span><h2>Max purchase:</h2><h3>2,066 USD</h3></span>
                                </div>
                            </td>
                            <td>   
                                <h1>22,863,22 USD</h1>
                                <span><i class="fa-solid fa-arrow-down"></i><h2>1%</h2><ion-icon name="alert"></ion-icon></span>
                                <button>Buy</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
