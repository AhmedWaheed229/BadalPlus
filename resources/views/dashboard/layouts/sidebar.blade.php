<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-yellow elevation-1">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{$settings->logo}}" alt="AdminLTE Logo" class="brand-image" style="    float: none;
    line-height: .8;
    margin-right: 0;
    margin-left: 0;
    margin-top: 0;
    max-height: 33px;
    width: 100%;
    object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('dashboard')}}" class="nav-link {{isActiveRoute('dashboard')}}">--}}
{{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                        <p>{{__('dashboard')}}</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
                @if(auth()->user()->admin)
                    <li class="nav-item
                    @if(
                        isActiveRoute('welcomes.index') ||
                        isActiveRoute('welcomes.create') ||
                        isActiveRoute('welcomes.edit') ||
                        isActiveRoute('slides.index') ||
                        isActiveRoute('slides.create') ||
                        isActiveRoute('slides.edit') ||
                        isActiveRoute('slide_lists.index') ||
                        isActiveRoute('slide_lists.create') ||
                        isActiveRoute('slide_lists.edit')
                        )
                        menu-is-opening menu-open
                    @endif"
                    >
                        <a href="#" class="nav-link
                        {{isActiveRoute('welcomes.index')}}
                        {{isActiveRoute('welcomes.create')}}
                        {{isActiveRoute('welcomes.edit')}}
                        {{isActiveRoute('slides.index')}}
                        {{isActiveRoute('slides.create')}}
                        {{isActiveRoute('slides.edit')}}
                        {{isActiveRoute('slide_lists.index')}}
                        {{isActiveRoute('slide_lists.create')}}
                        {{isActiveRoute('slide_lists.edit')}}
                            ">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                {{__('welcome section')}}
                                <i class="fas fa-angle-left @if(app()->getLocale() == 'ar') left @else right @endif"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('welcomes.index')}}"
                                   class="nav-link {{isActiveRoute('welcomes.index')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('welcome')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('welcomes.create')}}"
                                   class="nav-link {{isActiveRoute('welcomes.create')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('create')}} {{__('welcome')}} </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('slides.index')}}" class="nav-link {{isActiveRoute('slides.index')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('slides')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('slides.create')}}"
                                   class="nav-link {{isActiveRoute('slides.create')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('create')}} {{__('slides')}} </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('slide_lists.index')}}"
                                   class="nav-link {{isActiveRoute('slide_lists.index')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('slide lists')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('slide_lists.create')}}"
                                   class="nav-link {{isActiveRoute('slide_lists.create')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('create')}} {{__('slide lists')}} </p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item
                    @if(
                        isActiveRoute('categories.index') ||
                        isActiveRoute('categories.create') ||
                        isActiveRoute('categories.edit')
                        )
                        menu-is-opening menu-open
                    @endif"
                    >
                        <a href="#" class="nav-link
                        {{isActiveRoute('categories.index')}}
                        {{isActiveRoute('categories.create')}}
                        {{isActiveRoute('categories.edit')}}
                            ">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                {{__('categories')}}
                                <i class="fas fa-angle-left @if(app()->getLocale() == 'ar') left @else right @endif"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}"
                                   class="nav-link {{isActiveRoute('categories.index')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('categories')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.create')}}"
                                   class="nav-link {{isActiveRoute('categories.create')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('create')}} {{__('category')}} </p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item @if(isActiveRoute('why_us.index') ||isActiveRoute('why_us.create') || isActiveRoute('why_us.edit')) menu-is-opening menu-open @endif">
                        <a href="#"
                           class="nav-link {{isActiveRoute('why_us.index')}} {{isActiveRoute('why_us.create')}} {{isActiveRoute('why_us.edit')}}">
                            <i class="nav-icon fas fa-question"></i>
                            <p>
                                {{__('why_us')}}
                                <i class="fas fa-angle-left @if(app()->getLocale() == 'ar') left @else right @endif"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('why_us.index')}}" class="nav-link {{isActiveRoute('why_us.index')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('why_us')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('why_us.create')}}"
                                   class="nav-link {{isActiveRoute('why_us.create')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('create')}} {{__('why_us')}} </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item @if(isActiveRoute('currencies.index') ||isActiveRoute('currencies.create') || isActiveRoute('currencies.edit')) menu-is-opening menu-open @endif">
                        <a href="#"
                           class="nav-link {{isActiveRoute('currencies.index')}} {{isActiveRoute('currencies.create')}} {{isActiveRoute('currencies.edit')}}">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                {{__('currencies')}}
                                <i class="fas fa-angle-left @if(app()->getLocale() == 'ar') left @else right @endif"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('currencies.index')}}"
                                   class="nav-link {{isActiveRoute('currencies.index')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('currencies')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('currencies.create')}}"
                                   class="nav-link {{isActiveRoute('currencies.create')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('create')}} {{__('currency')}} </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item @if(isActiveRoute('users.index') ||isActiveRoute('users.create') || isActiveRoute('users.edit')) menu-is-opening menu-open @endif">
                        <a href="#"
                           class="nav-link {{isActiveRoute('users.index')}} {{isActiveRoute('users.create')}} {{isActiveRoute('users.edit')}}">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                {{__('users')}}
                                <i class="fas fa-angle-left @if(app()->getLocale() == 'ar') left @else right @endif"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link {{isActiveRoute('users.index')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('users')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.create')}}" class="nav-link {{isActiveRoute('users.create')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('create')}} {{__('user')}} </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('posts.index')}}" class="nav-link {{isActiveRoute('posts.index')}}">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>{{__('posts')}} {{__('all')}}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('recharge_requests')}}" class="nav-link {{isActiveRoute('recharge_requests')}}">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>{{__('Recharge Requests')}}</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('wallet')}}" class="nav-link {{isActiveRoute('wallet')}}">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>{{__('wallet')}}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profile', auth()->id())}}" class="nav-link {{isActiveRoute('profile')}}">
                        <i class="nav-icon far fa-user-circle"></i>
                        <p>{{__('profile')}}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('posts.create')}}" class="nav-link {{isActiveRoute('posts.create')}}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>{{__('posts')}}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route(config('chatify.routes.prefix'))}}"
                       class="nav-link {{isActiveRoute(config('chatify.routes.prefix')) . ' '. isActiveRoute("messages.user")}}">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>{{__('messages')}}</p>
                    </a>
                </li>

                @if(auth()->user()->admin)
                    <li class="nav-item">
                        <a href="{{route('settings.index')}}" class="nav-link {{isActiveRoute('settings.index')}}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>{{__('settings')}}</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
