<!doctype html>
<html lang="{{app()->getLocale()}}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->name }}</title>

    <link rel="icon" type="image/png" href="{{asset($settings->icon_url)}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('js/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('js/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('css/style_ar.css')}}">
    @endif
</head>
<body>
<!-- start navbar-->
<nav style="background-color: #eca9001a; width: 100%;" class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('images/logo.png')}}" alt="Badal Plus">
        </a>
        <button class="navbar-toggler btn-default" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <img src="{{asset('images/bars.webp')}}" alt="Badal Plus"
                style="height: 25px; width: 25px; object-fit: contain">
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav @if(app()->getLocale() == 'ar') me-auto @else ms-auto @endif mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route("browse") }}">{{ __("browse") }}</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{__('login')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-default sign-up-btn" href="{{ route('register') }}">{{__('Sign up')}}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">{{__('dashboard')}}</a>
                    </li>
                @endguest
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale() == 'ar' ? 'en' : 'ar', null, [], true) }}">
                        {{ app()->getLocale() == 'ar' ? 'En' : 'ع' }}
                        <img src="{{asset(app()->getLocale() == 'ar' ? 'images/en.png' : 'images/ar.png')}}" alt=""
                             height="24">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end navbar-->
@yield('content')

<section style="background-color: #c4c4c41a;" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="footer_site_desc">
                    <img src="{{asset($settings->logo)}}" alt="">
                    <p>
                        {{$settings->content}}
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="footer_services">
                    <h4>{{__('services')}}</h4>
                    <ul>
                        @foreach ($main_categories as $category)
                            <li><a href="{{route("browse", ["category"=>$category->id])}}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div class="footer_contacts_us">
                    <h4>{{__('Contacts us')}}</h4>
                    <ul>
                        <li>
                            <a href="mailto:{{$settings->email}}">
                                <img src="{{asset('images/email.png')}}" alt="">
                                {{$settings->email}}
                            </a>
                        </li>
                        <li>
                            <a href="tel:{{$settings->phone}}">
                                <img src="{{asset('images/phone.png')}}" alt="">
                                {{$settings->phone}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @guest
                @if(isActiveRoute('login') != 'active')
                    @if(isActiveRoute('register') != 'active')
                        <div class="col-md-3">
                            <div class="footer_login">
                                <form method="POST" action="{{route('login')}}">
                                    @csrf
                                    <div class="mb-3 form-group">
                                        <label for="email">{{__('email')}}</label>
                                        <input type="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email" autocomplete="username">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label for="password">{{__('password')}}</label>
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password"
                                            autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 footer-login-btn">
                                        <button type="submit" class="btn btn-default">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
            @endguest
        </div>
    </div>
    <div class="copy-right text-center">
        {{ __("Copyright") }} © {{ date("Y") }} {{$settings->name}}
    </div>
</section>

<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/slick/slick.min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


<script src="{{asset('service-worker.js')}}"></script>
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>

{{--  <script>
  const beamsClient = new PusherPushNotifications.Client({
    instanceId: '672da587-76a3-4101-bf44-5d9e4fb286d5',
  });

  beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => {})
    .catch();
</script>  --}}
@yield('scripts')
</body>
</html>
