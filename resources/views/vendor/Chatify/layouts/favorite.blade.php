<div class="favorite-list-item">
    <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
        style="background-image: url('{{ asset($user->image_url) }}');">
    </div>
{{--    <p>{{ strlen($user->name) > 5 ? substr($user->name,0,10).'..' : $user->name }}</p>--}}
    <p style="overflow:hidden; white-space: nowrap; width: 60px;  text-overflow: ellipsis;">{{$user->first_name}} {{$user->last_name}}</p>
</div>
