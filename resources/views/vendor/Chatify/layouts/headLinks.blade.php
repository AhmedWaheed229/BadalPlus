{{-- Meta tags --}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
<meta name="id" content="{{ $id }}">
<meta name="post" content="{{ $post_id ?? 0 }}">
<meta name="type" content="{{ $type }}">
<meta name="messenger-color" content="{{ $messengerColor }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ url('/').'/'.app()->getlocale().'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">
{{-- scripts --}}
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
 <script src="{{ asset('js/app.js') }}"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

{{-- styles --}}
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
{{--  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />  --}}

{{-- Messenger Color Style--}}
@include('Chatify::layouts.messengerColor')
