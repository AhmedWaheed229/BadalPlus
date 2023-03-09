{{-- -------------------- Saved Messages --------------------
@if($get == 'saved')
    <table class="messenger-list-item m-li-divider" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            <td>
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #68a5ff;"></span>
            </div>
            </td>
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif
--}}
{{-- -------------------- All users/group list -------------------- --}}
@if($get == 'users')
<table class="messenger-list-item" data-post_id="{{ $user->post_id ?? $post_id }}" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m"
        style="background-image: url('{{ asset('images/users/'.$user->image) }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-post_id="{{ $user->post_id ?? $post->id }}" data-id="{{ $user->id }}" data-type="user">
            @php
                $fn =$user->first_name .' '.$user->last_name;
            @endphp

            {{ strlen($user->post_title) > 30 ? trim(substr($user->post_title,0,30)) .'..' : $user->post_title}} <br>
            {{ strlen($fn) > 20 ? $user->first_name . ' .....' : $fn }}

            <span @if(app()->getlocale() == 'ar') style="float:left" @endif >{{ $lastMessage->created_at->diffForHumans() }}</span>
            <br>
        </p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">'.__('You').' :</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {!!
                strlen($lastMessage->body) > 35
                ? trim(substr($lastMessage->body, 0, 35)).'..'
                : $lastMessage->body
            !!}
            @else
            <span class="fas fa-file"></span> Attachment
            @endif
        </span>
        {{-- New messages counter --}}
            @php
                $dd = app()->getlocale() == 'ar' ? "style='float:left'" : "";
            @endphp
            {!! $unseenCounter > 0 ? "<b ". $dd .">".$unseenCounter."</b>" : '' !!}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
        <div class="avatar av-m"
        style="background-image: url('{{ asset('images/users/'.$user->image) }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->first_name . ' '.$user->last_name) > 30 ? trim(substr($user->first_name . ' '.$user->last_name,0,30)).'..' : $user->first_name . ' '.$user->last_name }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


