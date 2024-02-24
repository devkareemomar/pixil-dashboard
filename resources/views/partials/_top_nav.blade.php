@php
$setting  = \App\Models\Setting::first();
@endphp
<nav class="navbar navbar-light">
    <div class="navbar-left">
        <div class="logo-area">
            <a class="navbar-brand" href="{{ route('dashboard',app()->getLocale()) }}">
                @if($setting?->dark_application_logo_image)
                <img style="max-width: 45px; min-width: 45px" class="dark" src="{{ asset('storage/' . $setting?->dark_application_logo_image) }}" alt="svg">
                @endif
                @if($setting?->application_logo_image)
                <img style="max-width: 45px; min-width: 45px" class="light" src="{{ asset('storage/' . $setting?->application_logo_image) }}" alt="img">
                @endif
            </a>
            <a href="#" class="sidebar-toggle">
                <img class="svg" src="{{ asset('assets/img/svg/align-center-alt.svg') }}" alt="img"></a>
        </div>

        <div class="top-menu">
            <div class="hexadash-top-menu position-relative">
            <ul class="d-flex align-items-center flex-wrap">
    <li class="has-subMenu">
        <a href="#" class="active">{{ trans('Dashboard') }}</a>
        <ul class="subMenu">
            <li class="">
                <a href="{{url('/')}}">{{ trans('Home Page') }}</a>
            </li>
        </ul>
    </li>

    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Layouts') }}</a>
        <ul class="subMenu">
            <li class="l_sidebar">
                <a href="#" data-layout="light" onclick="setLayoutToStorage('light')">{{ trans('Light Mode') }}</a>
            </li>
            <li class="l_sidebar">
                <a href="#" data-layout="dark" onclick="setLayoutToStorage('dark')">{{ trans('Dark Mode') }}</a>
            </li>
            <li class="l_navbar">
                <a href="#" data-layout="side" onclick="setThemeToStorage('side')">{{ trans('Side Menu') }}</a>
            </li>
        </ul>
    </li>

    @can('project-read')
    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Projects') }}</a>
        <ul class="subMenu">
            @can('project-read')
            <li>
                <a href="{{route('projects.index')}}">{{ trans('Projects') }}</a>
            </li>
            @endcan
            @can('project status-read')
            <li>
                <a href="{{route('projectStatuses.index')}}">{{ trans('Project Status') }}</a>
            </li>
            @endcan
            @can('tag-read')
            <li>
                <a href="{{route('tags.index')}}">{{ trans('Tags') }}</a>
            </li>
            @endcan
            @can('category-read')
            <li>
                <a href="{{route('categories.index')}}">{{ trans('Categories') }}</a>
            </li>
            @endcan
            @can('division-read')
            <li>
                <a href="{{route('divisions.index')}}">{{ trans('Divisions') }}</a>
            </li>
            @endcan
        </ul>
    </li>
    @endcan

    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Statuses') }}</a>
        <ul class="subMenu">
            @can('form builder-read')
            <li>
                <a href="{{route('forms.index')}}">{{ trans('Forms') }}</a>
            </li>
            @endcan
            @can('form builder-read')
            <li>
                <a href="{{route('statuses')}}">{{ trans('Statuses') }}</a>
            </li>
            @endcan
        </ul>
    </li>

    {{-- @can('gift-read')
    <li>
        <a href="{{route('gifts.index')}}">{{ trans('Gift') }}</a>
    </li>
    @endcan --}}


    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Gifts') }}</a>
        <ul class="subMenu">
            @can('gift-read')
            <li>
                <a href="{{route('gifts.index')}}">{{ trans('Gift') }}</a>
            </li>
            @endcan
            <li>
                <a href="{{route('gifts.templates.index')}}">{{ trans('Templates') }}</a>
            </li>
        </ul>
    </li>

    @can('campaign-read')
    <li>
        <a href="{{route('campaigns.index')}}">{{ trans('Campaigns') }}</a>
    </li>
    @endcan

    @can('contact us-read')
    <li>
        <a href="{{route('contacts.index')}}">{{ trans('Contact Us') }}</a>
    </li>
    @endcan

    @can('donation-read')
    <li>
        <a href="{{route('donations.index')}}">{{ trans('Donations') }}</a>
    </li>
    @endcan

    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Transactions') }}</a>
        <ul class="subMenu">
            @can('cart-read')
            <li>
                <a href="{{route('carts.index')}}">{{ trans('Carts') }}</a>
            </li>
            @endcan
            @can('transaction-read')
            <li>
                <a href="{{route('transactions.index')}}">{{ trans('Transactions') }}</a>
            </li>
            @endcan
        </ul>
    </li>

    @can('slider-read')
    <li>
        <a href="{{route('sliders.index')}}">{{ trans('Sliders') }}</a>
    </li>
    @endcan

    @can('link-read')
    <li>
        <a href="{{route('links.index')}}">{{ trans('Links') }}</a>
    </li>
    @endcan

    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Media') }}</a>
        <ul class="subMenu">
            <li class="has-subMenu">
                <a href="#" class="">{{ trans('News') }}</a>
                <ul class="subMenu">
                    @can('news-read')
                    <li>
                        <a href="{{route('news.index')}}">{{ trans('News') }}</a>
                    </li>
                    @endcan
                    @can('news category-read')
                    <li>
                        <a href="{{route('news_categories.index')}}">{{ trans('News Categories') }}</a>
                    </li>
                    @endcan
                    @can('news tag-read')
                    <li>
                        <a href="{{route('news_tags.index')}}">{{ trans('News Tags') }}</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @can('album-read')
            <li>
                <a href="{{route('albums.index')}}">{{ trans('Albums') }}</a>
            </li>
            @endcan
        </ul>
    </li>

    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Basic Data') }}</a>
        <ul class="subMenu">
            @can('menu-read')
            <li>
                <a href="{{route('menus.index')}}">{{ trans('Menus') }}</a>
            </li>
            @endcan
            @can('visit-read')
            <li>
                <a href="{{route('visits.index')}}">{{ trans('Visits') }}</a>
            </li>
            @endcan
            @can('language-read')
            <li>
                <a href="{{route('languages.index')}}">{{ trans('Languages') }}</a>
            </li>
            @endcan
            @can('country-read')
            <li>
                <a href="{{route('countries.index')}}">{{ trans('Countries') }}</a>
            </li>
            @endcan
            @can('currency-read')
            <li>
                <a href="{{route('currencies.index')}}">{{ trans('Currencies') }}</a>
            </li>
            @endcan
        </ul>
    </li>

    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Administration') }}</a>
        <ul class="subMenu">
            @can('settings-update')
            <li>
                <a href="{{route('social-media.index')}}">{{ trans('Social Media') }}</a>
            </li>
            @endcan
            @can('settings-update')
            <li>
                <a href="{{route('settings.index')}}">{{ trans('Settings') }}</a
                </li>
            @endcan
            @can('site pages-read')
            <li>
                <a href="{{route('site-pages.index')}}">{{ trans('Site Pages') }}</a>
            </li>
            @endcan
            @can('user-read')
            <li>
                <a href="{{route('users.index')}}">{{ trans('Users') }}</a>
            </li>
            @endcan
            @can('role-read')
            <li>
                <a href="{{route('roles.index')}}">{{ trans('Roles') }}</a>
            </li>
            @endcan
            @can('audit-read')
            <li>
                <a href="{{route('audits.index')}}">{{ trans('Audit Log') }}</a>
            </li>
            @endcan
            @can('payment gateway-read')
            <li>
                <a href="{{route('payment-gateways.index')}}">{{ trans('Payment Gateways') }}</a>
            </li>
            @endcan
        </ul>
    </li>

    <li class="has-subMenu">
        <a href="#" class="">{{ trans('Reports') }}</a>
        <ul class="subMenu">
            <li>
                <a href="{{route('reports.index')}}">{{ trans('Reports') }}</a>
            </li>
            <li>
                <a href="{{route('reports.social-media')}}">{{ trans('Social Media Reports') }}</a>
            </li>
            <li>
                <a href="{{route('reports.alias-links')}}">{{ trans('Alias Links Reports') }}</a>
            </li>
        </ul>
    </li>
</ul>

            </div>
        </div>
    </div>
    <div class="navbar-right">
        <ul class="navbar-right__menu">

            <li class="nav-notification">
                <div class="dropdown-custom">
                    <a href="javascript:;" class="{{\App\Models\Notification::where('is_read',0)->count() != 0 ? "nav-item-toggle icon-active" :""}}">
                        <img class="svg" src="{{ asset('assets/img/svg/alarm.svg') }}" alt="img">
                    </a>
                    <div class="dropdown-wrapper">
                        <h2 class="dropdown-wrapper__title">{{ __('Notifications') }} <span class="badge-circle badge-warning ms-1">{{\App\Models\Notification::where('is_read',0)->count()}}</span>
                        </h2>
                        <ul>
                            @foreach(\App\Models\Notification::orderBy('created_at','desc')->take(5)->get() as $notification)
                                <li class="nav-notification__single  d-flex flex-wrap" style="{{$notification->is_read !=0 ? '':"background:#cbcbcba8"}}">
                                    <div class="nav-notification__type nav-notification__type--success">
                                        <img src="{{ asset('assets/img/svg/log-in.svg') }}" alt="log-in" class="svg">
                                    </div>
                                    <div class="nav-notification__details">
                                        <p>
                                            <a href="" class="subject stretched-link text-truncate"
                                               style="max-width: 180px;">{{$notification->user?->email}}</a>
                                            <span>{{__('New Sign Up ')}} </span>
                                        </p>
                                        <p>
                                            <span class="time-posted">{{\Illuminate\Support\Carbon::now()->diffInHours(\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:s:i', $notification->created_at))}} hours ago</span>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{route('notifications.index')}}" class="dropdown-wrapper__more">{{ __('See all incoming activity') }}</a>
                    </div>
                </div>
            </li>

            <li class="nav-flag-select">
                <div class="dropdown-custom">
                    @foreach (\App\Models\Language::all() as $language)
                        @if(auth()->user() && $language->id == auth()->user()->language_id)
                            <a href="javascript:;" class="nav-item-toggle"><img
                                    src="{{ asset('storage/'.$language->flag) }}"
                                    alt="" class="rounded-circle"></a>
                        @endif
                    @endforeach
                    <div class="dropdown-wrapper dropdown-wrapper--small">
                        @foreach (\App\Models\Language::all() as $language)
                            <form action="{{route('changeLanguage',[$language->id])}}" method="post">
                                @csrf
                                <button style="border: none;background: none ;padding: 4%"><img
                                        src="{{ asset('storage/'.$language->flag) }}"
                                        alt="">{{$language->name}}</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </li>
            <li class="nav-author">
                <div class="dropdown-custom">
                    <a href="javascript:;" class="nav-item-toggle"><img
                            src="{{ auth()->user() && auth()->user()->photo != null ? asset('storage/'.auth()->user()
                            ->photo) :
                            asset('assets/img/author-nav.jpg') }}"
                            alt="" class="rounded-circle">
                        @if(Auth::check())
                            <span class="nav-item__title">{{ Auth::user()->name }}<i
                                    class="las la-angle-down nav-item__arrow"></i></span>
                        @endif
                    </a>
                    <div class="dropdown-wrapper">
                        <div class="nav-author__info">
                            <div class="author-img">
                                <img
                                    src="{{ auth()->user() && auth()->user()->photo != null ? asset('storage/'.auth()
                                    ->user()
                                    ->photo) : asset('assets/img/author-nav.jpg') }}"
                                    alt="" class="rounded-circle">
                            </div>
                            <div>
                                @if(Auth::check())
                                    <h6 class="text-capitalize">{{ Auth::user()->name }}</h6>
                                @endif

                            </div>
                        </div>
                        <div class="nav-author__options">
                            <ul>
                                <li>
                                    <a href="{{route('userSetting')}}">
                                        <img src="{{ asset('assets/img/svg/settings.svg') }}" alt="settings"
                                             class="svg">{{ __('Profile Settings') }}</a>
                                </li>
                                <li>
                                    <a href="{{route('userChangePassword')}}">
                                        <img src="{{ asset('assets/img/svg/settings.svg') }}" alt="user" class="svg">
                                        {{ __('Change Password') }}</a>
                                </li>
                                <li>
                                    <a href="{{route('userLogLogin')}}">
                                        <img src="{{ asset('assets/img/svg/key.svg') }}" alt="key" class="svg"> {{ __('Log Login') }}</a>
                                </li>

                            </ul>
                            <a href="" class="nav-author__signout"
                               onclick="event.preventDefault();document.getElementById('logout').submit();">
                                <img src="{{ asset('assets/img/svg/log-out.svg') }}" alt="log-out" class="svg">
                                {{ __('Sign Out') }}</a>
                            <form style="display:none;" id="logout" action="{{ route('logout') }}" method="POST">
                                @csrf
                                @method('post')
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="navbar-right__mobileAction d-md-none">
            <a href="#" class="btn-search">
                <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg feather-search">
                <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg feather-x">
            </a>
            <a href="#" class="btn-author-action">
                <img src="{{ asset('assets/img/svg/more-vertical.svg') }}" alt="more-vertical" class="svg"></a>
        </div>
    </div>
</nav>
