@extends('layouts.app')

@section('content')

<!--  start browse  -->

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
