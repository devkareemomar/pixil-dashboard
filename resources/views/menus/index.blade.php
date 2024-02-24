@extends('layout.app')

@section('title', __('Create Menu'))
@section('description', __('Create a new menu with items'))

@section('content')
    @php
        $currentUrl = url()->current();
        $dir = config('app.locale') == 'ar' ? 'rtl' : 'ltr' ;
    @endphp
    <style>
        .card-body {
            padding: 0 1.56rem !important;
        }

        .select2-container--default .select2-selection--multiple,
        .select2-container--default .select2-selection--single {
            height: 35px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
        }

        @if(app()->getLocale()=="ar")
    .select2-container--default .select2-selection--single .select2-selection__arrow {
            left: auto;
            right: 4%;
        }

        label {
            padding-bottom: 7px;
        }

        .div-menu input, .div-menu label {
            text-align: right;
            float: right;
        }

        #hwpwrap #customize-info.open .accordion-section-title::after, #hwpwrap .control-section.open .accordion-section-title::after, #hwpwrap .nav-menus-php .menu-item-edit-active .item-edit::before, #hwpwrap .widget.open .widget-top a.widget-action::after {
            left: -230px;
        }

        #hwpwrap .control-section .accordion-section-title::after {
            left: -230px;
        }

        @endif
    </style>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
    </head>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="{{asset('assets/menu/style.css')}}" rel="stylesheet">
    <div style="padding: 2%">
        <div class="card">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Create Menu') }}</h4>
            </div>
            <div class="card-body">
                <div id="hwpwrap">
                    <div
                        class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
                        <div id="wpwrap">
                            <div id="wpcontent">
                                <div id="wpbody">
                                    <div id="wpbody-content">
                                        <div class="wrap">

                                            <form class="row py-15" method="get" id="myForm" action="{{ $currentUrl }}">

                                                <div class="col-xl-2 col-lg-3 col-md-4 col-12">
                                                    <label>{{__('Select the menu you want to edit :')}}</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    {!! App\Models\Menu::selectHtml('menu_id', $menulist) !!}

                                                </div>
                                            </form>
                                            <hr style="margin:1% 0">
                                            <div id="nav-menus-frame" style="margin-left: 0">
                                                <div class="row">
                                                    @if(request()->has('menu_id') && !empty(request()->input("menu_id")))
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <div style="width: 100%; float: none;padding: 0 ; margin: 0"
                                                                 id="menu-settings-column"
                                                                 class="metabox-holder">

                                                                <div class="clear"></div>

                                                                <div class="side_menu_section">
                                                                    <form id="nav-menu-meta" action=""
                                                                          class="nav-menu-meta"
                                                                          method="post"
                                                                          enctype="multipart/form-data">

                                                                        <div id="side-sortables"
                                                                             class="accordion-container">
                                                                            <ul class="outer-border">
                                                                                <li class="control-section accordion-section  add-page"
                                                                                    id="add-page">
                                                                                    <h3 class="accordion-section-title hndle"
                                                                                        tabindex="0">
                                                                                        {{__('Custom Link')}} <span
                                                                                            class="screen-reader-text">{{__('Press return or enter to expand')}}</span>
                                                                                    </h3>
                                                                                    <div
                                                                                        class="accordion-section-content ">
                                                                                        <div class="inside">
                                                                                            <div class="customlinkdiv"
                                                                                                 id="customlinkdiv">
                                                                                                <div
                                                                                                    id="menu-item-name-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-name">
                                                                                                        {{__('Label')}}
                                                                                                        <span
                                                                                                            class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <input
                                                                                                        id="custom-menu-item-name"
                                                                                                        name="name"
                                                                                                        type="text"
                                                                                                        style="width: 100%;"
                                                                                                        class="form-control regular-text menu-item-textbox input-with-default-title"
                                                                                                        title="Label menu"
                                                                                                        required>

                                                                                                </div>

                                                                                                <div
                                                                                                    id="menu-item-url-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-url">
                                                                                                        {{__('URL')}}
                                                                                                        <span
                                                                                                            class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <input
                                                                                                        id="custom-menu-item-url"
                                                                                                        name="url"
                                                                                                        type="url"
                                                                                                        style="width: 100%;"
                                                                                                        class="form-control menu-item-textbox "
                                                                                                        placeholder="{{__('url')}}"
                                                                                                        required>
                                                                                                </div>
                                                                                                <Br>
                                                                                                <p class="button-controls">

                                                                                                    <a href="#"
                                                                                                       onclick="addcustommenu()"
                                                                                                       class="btn btn-primary mb-3 submit-add-to-menu right">{{__('Add menu item')}}</a>
                                                                                                    <span
                                                                                                        class="spinner"
                                                                                                        id="spincustomu"></span>
                                                                                                </p>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <div class="side_menu_section">
                                                                    <form id="nav-menu-pages" action=""
                                                                          class="nav-menu-meta"
                                                                          method="post"
                                                                          enctype="multipart/form-data">
                                                                        <div id="side-sortables"
                                                                             class="accordion-container">
                                                                            <ul class="outer-border">
                                                                                <li class="control-section accordion-section add-page"
                                                                                    id="add-page">
                                                                                    <h3 class="accordion-section-title hndle"
                                                                                        tabindex="0">
                                                                                        {{__('Add Page')}} <span
                                                                                            class="screen-reader-text">{{__('Press return or enter to expand')}}</span>
                                                                                    </h3>
                                                                                    <div
                                                                                        class="accordion-section-content ">
                                                                                        <div class="inside">
                                                                                            <div class="customlinkdiv"
                                                                                                 id="customlinkdiv">
                                                                                                <p id="menu-item-page_id-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-page_id">
                                                                                                        <select
                                                                                                            id="custom-menu-item-page_id"
                                                                                                            name="page_id"
                                                                                                            class="menu-locale inline-block"
                                                                                                            title="Label menu"
                                                                                                            required>
                                                                                                            <option>{{__('Select page')}}
                                                                                                            </option>
                                                                                                            @foreach($pages as $page)
                                                                                                                <option
                                                                                                                    value="{{$page->id}}">
                                                                                                                    {{$page->title}}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </label>
                                                                                                </p>
                                                                                                <div
                                                                                                    id="menu-item-name-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-name">
                                                                                                        {{__('Label')}}<span class="text-danger">*</span></label>
                                                                                                    <input
                                                                                                        id="custom-menu-item-name_page"
                                                                                                        name="name"
                                                                                                        style="width: 100%"
                                                                                                        type="text"
                                                                                                        class="regular-text menu-item-textbox input-with-default-title form-control"
                                                                                                        title="Label menu"
                                                                                                        required>
                                                                                                    <Br>
                                                                                                </div>
                                                                                                <br>
                                                                                                <p class="button-controls">
                                                                                                    <a href="#"
                                                                                                       onclick="addcustommenu('page')"
                                                                                                       class="btn btn-primary mb-3 submit-add-to-menu right">{{__('Add menu item')}}</a>
                                                                                                    <span
                                                                                                        class="spinner"
                                                                                                        id="spincustomu"></span>
                                                                                                </p>
                                                                                                <div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <div class="side_menu_section">
                                                                    <form id="nav-menu-projects" action=""
                                                                          class="nav-menu-meta"
                                                                          method="post"
                                                                          enctype="multipart/form-data">
                                                                        <div id="side-sortables"
                                                                             class="accordion-container">
                                                                            <ul class="outer-border">
                                                                                <li class="control-section accordion-section add-page"
                                                                                    id="add-page">
                                                                                    <h3 class="accordion-section-title hndle"
                                                                                        tabindex="0">
                                                                                        {{__('Add Project')}} <span
                                                                                            class="screen-reader-text">{{__('Press return or
																	enter to expand')}}</span>
                                                                                    </h3>
                                                                                    <div
                                                                                        class="accordion-section-content ">
                                                                                        <div class="inside">
                                                                                            <div class="customlinkdiv"
                                                                                                 id="customlinkdiv">
                                                                                                <div id="menu-item-project_id-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-project_id">
                                                                                                        {{__('Select project')}}
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                        <select
                                                                                                            id="custom-menu-item-project_id"
                                                                                                            name="project_id"
                                                                                                            class="menu-locale inline-block"
                                                                                                            title="Label menu"
                                                                                                            required>
                                                                                                            <option value="" disabled>{{__('Select project')}}
                                                                                                            </option>
                                                                                                            @foreach($projects as $projects)
                                                                                                                <option
                                                                                                                    value="{{$projects->id}}">
                                                                                                                    {{$projects->name}}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>

                                                                                                </div>
                                                                                                <div id="menu-item-name-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-name">
                                                                                                        {{__('Label')}}
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                        <input
                                                                                                            id="custom-menu-item-name_project"
                                                                                                            name="name"
                                                                                                            type="text"
                                                                                                            style="width: 100%;"
                                                                                                            class="form-control regular-text menu-item-textbox input-with-default-title"
                                                                                                            title="Label menu"
                                                                                                            required>

                                                                                                </div>
                                                                                                <div class="button-controls">
                                                                                                    <br>
                                                                                                    <a href="#"
                                                                                                       onclick="addcustommenu('project')"
                                                                                                       class="btn btn-primary mb-3 submit-add-to-menu right">{{__('Add menu item')}}</a>
                                                                                                    <span
                                                                                                        class="spinner"
                                                                                                        id="spincustomu"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <div class="side_menu_section">
                                                                    <form id="nav-menu-news" action=""
                                                                          class="nav-menu-meta"
                                                                          method="post"
                                                                          enctype="multipart/form-data">
                                                                        <div id="side-sortables"
                                                                             class="accordion-container">
                                                                            <ul class="outer-border">
                                                                                <li class="control-section accordion-section add-page"
                                                                                    id="add-page">
                                                                                    <h3 class="accordion-section-title hndle"
                                                                                        tabindex="0">
                                                                                        {{__('Add news')}} <span
                                                                                            class="screen-reader-text">{{__('Press return or
																	enter to expand')}}</span>
                                                                                    </h3>
                                                                                    <div
                                                                                        class="accordion-section-content ">
                                                                                        <div class="inside">
                                                                                            <div class="customlinkdiv"
                                                                                                 id="customlinkdiv">
                                                                                                <div id="menu-item-news_id-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-news_id">
                                                                                                    </label>
                                                                                                        <select
                                                                                                            id="custom-menu-item-news_id"
                                                                                                            name="news_id"
                                                                                                            class="menu-locale inline-block w-100"
                                                                                                            title="Label menu"
                                                                                                            required>
                                                                                                            <option>{{__('Select news')}}
                                                                                                            </option>
                                                                                                            @foreach($news as $news)
                                                                                                                <option
                                                                                                                    value="{{$news->id}}">
                                                                                                                    {{$news->title}}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>

                                                                                                </div>
                                                                                                <p id="menu-item-name-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-name">
                                                                                                        <span>{{__('Label')}}</span>&nbsp;<span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                        <input
                                                                                                            id="custom-menu-item-name_news"
                                                                                                            name="name"
                                                                                                            type="text"
                                                                                                            style="width: 100%;"
                                                                                                            class="form-control regular-text menu-item-textbox input-with-default-title"
                                                                                                            title="Label menu"
                                                                                                            required>

                                                                                                </p>
                                                                                                <p class="button-controls">
                                                                                                    <br>
                                                                                                    <a href="#"
                                                                                                       onclick="addcustommenu('news')"
                                                                                                       class="btn btn-primary mb-3 submit-add-to-menu right">{{__('Add menu item')}}</a>
                                                                                                    <span
                                                                                                        class="spinner"
                                                                                                        id="spincustomu"></span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </form>
                                                                </div>


                                                                <div class="side_menu_section">
                                                                    <form id="nav-menu-forms" action=""
                                                                          class="nav-menu-meta"
                                                                          method="post"
                                                                          enctype="multipart/form-data">
                                                                        <div id="side-sortables"
                                                                             class="accordion-container">
                                                                            <ul class="outer-border">
                                                                                <li class="control-section accordion-section add-page"
                                                                                    id="add-page">
                                                                                    <h3 class="accordion-section-title hndle"
                                                                                        tabindex="0">
                                                                                        {{__('Add forms')}} <span
                                                                                            class="screen-reader-text">{{__('Press return or
																	enter to expand')}}</span>
                                                                                    </h3>
                                                                                    <div
                                                                                        class="accordion-section-content ">
                                                                                        <div class="inside">
                                                                                            <div class="customlinkdiv"
                                                                                                 id="customlinkdiv">
                                                                                                <p id="menu-item-form_id-wrap">

                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-form_id">
                                                                                                        <select
                                                                                                            id="custom-menu-item-form_id"
                                                                                                            name="form_id"
                                                                                                            class="menu-locale inline-block w-100"
                                                                                                            title="Label menu"
                                                                                                            required>
                                                                                                            <option>{{__('Select form')}}
                                                                                                            </option>
                                                                                                            @foreach($forms as $form)

                                                                                                                <option
                                                                                                                    value="{{$form->id}}">
                                                                                                                    {{$form->status_name}}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </label>
                                                                                                </p>
                                                                                                <div id="menu-item-name-wrap">
                                                                                                    <label class="howto"
                                                                                                           for="custom-menu-item-name">
                                                                                                        <span>{{__('Label')}}</span>&nbsp;<span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                        <input
                                                                                                            id="custom-menu-item-name_form"
                                                                                                            name="name"
                                                                                                            type="text"
                                                                                                            style="width: 100%"
                                                                                                            class="form-control regular-text menu-item-textbox input-with-default-title"
                                                                                                            title="Label menu"
                                                                                                            required>

                                                                                                </div>
                                                                                                <p class="button-controls">
                                                                                                    <br>
                                                                                                    <a href="#"
                                                                                                       onclick="addcustommenu('form')"
                                                                                                       class="btn btn-primary mb-3 submit-add-to-menu right">{{__('Add menu item')}}</a>
                                                                                                    <span
                                                                                                        class="spinner"
                                                                                                        id="spincustomu"></span>
                                                                                                </p>
                                                                                                <div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                    <div class="col-lg-9 col-md-9 col-12">
                                                        <div style="width: 100% !important;"
                                                             id="menu-management-liquid">
                                                            <div id="menu-management">
                                                                <div id="update-nav-menu">
                                                                    <div class="menu-edit ">
                                                                        <div id="nav-menu-header">
                                                                            <div
                                                                                class="major-publishing-actions row p-10">
                                                                                <div class="col-lg-6 col-md-6 col-12">
                                                                                    <label>{{__('Name')}}<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input name="menu-name"
                                                                                           id="menu-name"
                                                                                           type="text"
                                                                                           class="form-control"
                                                                                           title="{{__('Enter menu name')}}"
                                                                                           value="@if(isset($indmenu)){{$indmenu->name}}@endif">
                                                                                    <input type="hidden" id="idmenu"
                                                                                           value="@if(isset($indmenu)){{$indmenu->id}}@endif"/>
                                                                                </div>


                                                                                <div class="col-lg-6 col-md-6 col-12">
                                                                                    <label>{{__('Locale')}}<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select name="menu-locale"
                                                                                            id="menu-locale"
                                                                                            class="menu-locale mt-10 inline-block"
                                                                                            title="Enter menu locale">
                                                                                        @foreach($languages as $locale)
                                                                                            <option
                                                                                                value="{{$locale->short_name}}" @selected(isset($indmenu) && $indmenu->locale==$locale->short_name)>
                                                                                                {{$locale->name}}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>

                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-12">
                                                                                    <Br>
                                                                                    <label>{{__('Position')}}<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select name="menu-position"
                                                                                            id="menu-position"
                                                                                            class="menu-position mt-10 inline-block"
                                                                                            title="Enter menu position">
                                                                                        @foreach(['header','footer','sidebar','mobile','top']
                                                                                        as $position)
                                                                                            <option
                                                                                                value="{{$position}}"
                                                                                                @selected(isset($indmenu) && $indmenu->
                                                                                            position==$position) >{{__($position)}}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                {{--                                                                                <div class="col-lg-12 col-md-12 col-12">--}}
                                                                                {{--                                                                                    <label>{{__('Is Active')}}</label>--}}
                                                                                {{--                                                                                    <input name="menu-is_active"--}}
                                                                                {{--                                                                                           id="menu-is_active"--}}
                                                                                {{--                                                                                           type="checkbox"--}}
                                                                                {{--                                                                                           class="menu-is_active mt-10"--}}
                                                                                {{--                                                                                           title="Enter menu is_active"--}}
                                                                                {{--                                                                                           @checked(isset($indmenu) && $indmenu->is_active)--}}
                                                                                {{--                                                                                           value="1">--}}
                                                                                {{--                                                                                    <input class="form-check-input"--}}
                                                                                {{--                                                                                           type="checkbox"--}}
                                                                                {{--                                                                                           role="switch"--}}
                                                                                {{--                                                                                           value="1"--}}
                                                                                {{--                                                                                           name="is_active"--}}
                                                                                {{--                                                                                           id="flexSwitchCheckChecked menu-is_active" @checked(isset($indmenu) && $indmenu->is_active)>--}}

                                                                                {{--                                                                                </div>--}}
                                                                            </div>
                                                                        </div>
                                                                        <div id="post-body">
                                                                            @if(request()->has("menu_id"))
                                                                                <h5 style="padding: 2% 0">{{__('Menu Structure')}}</h5>
                                                                            @else
                                                                                {{__('Please enter the name and select "Create menu" button')}}
                                                                            @endif
                                                                            <div id="post-body-content" dir="ltr">

                                                                                <ul class="menu ui-sortable"
                                                                                    id="menu-to-edit">
                                                                                    @if(isset($menus))
                                                                                        @foreach($menus as $m)
                                                                                            <li id="menu-item-{{$m->id}}"
                                                                                                class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending"
                                                                                                style="display: list-item;">
                                                                                                <dl class="menu-item-bar">
                                                                                                    <dt class="menu-item-handle">
                                                                                    <span class="item-title"> <span
                                                                                            class="menu-item-title"> <span
                                                                                                id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span
                                                                                                style="color: transparent;">|{{$m->id}}|</span> </span> <span
                                                                                            class="is-submenu"
                                                                                            style="@if($m->depth==0)display: none;@endif">{{__('Sub Element')}}</span> </span>
                                                                                                        <span
                                                                                                            class="item-controls"> <span
                                                                                                                class="item-type">{{__('Link')}}</span> <span
                                                                                                                class="item-order hide-if-js"> <a
                                                                                                                    href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44"
                                                                                                                    class="item-move-up"><abbr
                                                                                                                        title="Move Up">↑</abbr></a> | <a
                                                                                                                    href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44"
                                                                                                                    class="item-move-down"><abbr
                                                                                                                        title="Move Down">↓</abbr></a> </span> <a
                                                                                                                class="item-edit"
                                                                                                                id="edit-{{$m->id}}"
                                                                                                                href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a> </span>
                                                                                                    </dt>
                                                                                                </dl>

                                                                                                <div
                                                                                                    class="menu-item-settings"
                                                                                                    id="menu-item-settings-{{$m->id}}">
                                                                                                    <input type="hidden"
                                                                                                           class="edit-menu-item-id"
                                                                                                           name="menuid_{{$m->id}}"
                                                                                                           value="{{$m->id}}"/>
                                                                                                    <div class="row">
                                                                                                        <div
                                                                                                            class="col-12 px-20 div-menu description description-thin"
                                                                                                            style="width: 100%">
                                                                                                            <label
                                                                                                                for="edit-menu-item-title-{{$m->id}}">{{__('Label')}}
                                                                                                                <span
                                                                                                                    class="text-danger">*</span>
                                                                                                            </label>
                                                                                                            <br>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                id="idlabelmenu_{{$m->id}}"
                                                                                                                class="edit-menu-item-title form-control"
                                                                                                                name="idlabelmenu_{{$m->id}}"
                                                                                                                value="{{$m->label}}"
                                                                                                                required>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-12 px-20 div-menu field-css-classes description description-thin"
                                                                                                            style="width: 100% ;margin-top: 45px">
                                                                                                            <label
                                                                                                                for="edit-menu-item-classes-{{$m->id}}">
                                                                                                                {{__('Class CSS (optional)')}}</label>
                                                                                                            <br>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                id="clases_menu_{{$m->id}}"
                                                                                                                class="code edit-menu-item-classes form-control"
                                                                                                                name="clases_menu_{{$m->id}}"
                                                                                                                value="{{$m->class}}">
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-12 px-20 div-menu field-css-url description description-wide"
                                                                                                            style="width: 100% ;margin-top: 45px">
                                                                                                            <label
                                                                                                                for="edit-menu-item-url-{{$m->id}}">
                                                                                                                {{__('Url')}}
                                                                                                                <span
                                                                                                                    class="text-danger">*</span></label>
                                                                                                            <br>
                                                                                                            <input
                                                                                                                type="url"
                                                                                                                id="url_menu_{{$m->id}}"
                                                                                                                class="code edit-menu-item-url form-control"
                                                                                                                name="url_menu_{{$m->id}}"
                                                                                                                value="{{$m->link}}"
                                                                                                                required>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-12 px-20 div-menu field-css-icon description description-wide"
                                                                                                            style="width: 100% ;margin-top: 5px">
                                                                                                            <label
                                                                                                                for="edit-menu-item-icon-{{$m->id}}">
                                                                                                                {{__('Icon')}}</label>
                                                                                                            <br>
                                                                                                            <input
                                                                                                                type="file"
                                                                                                                id="icon_menu_{{$m->id}}"
                                                                                                                class="widefat code edit-menu-item-icon form-control"
                                                                                                            />
                                                                                                            @if(isset($m->icon))
                                                                                                                <img
                                                                                                                    src="{{asset('storage/'.$m->icon)}}"
                                                                                                                    alt="{{$m->label}}"
                                                                                                                    style="width: 50px;height: 50px">
                                                                                                            @endif
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-12 px-20 div-menu form-check form-switch field-css-is_mega description description-wide"
                                                                                                            style="width: 100% ;margin-top: 5px">
                                                                                                            <label
                                                                                                                for="edit-menu-item-is_mega-{{$m->id}}"
                                                                                                                class="form-check-label"
                                                                                                            >{{ __('Is Miga') }}</label>
                                                                                                            <br>
                                                                                                            <input
                                                                                                                id="edit-menu-item-is_mega-{{$m->id}}"
                                                                                                                class="edit-menu-item-is_mega form-check-input"
                                                                                                                type="checkbox"
                                                                                                                role="switch"
                                                                                                                value="1"
                                                                                                                name="is_mega"
                                                                                                                @checked($m->is_mega)
                                                                                                            />
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-12 px-20 div-menu field-css-image description description-wide"
                                                                                                            style="width: 100% ;margin-top: 5px">
                                                                                                            <label
                                                                                                                for="edit-menu-item-image-{{$m->id}}">
                                                                                                                {{ __('Image') }}</label>
                                                                                                            <br>
                                                                                                            <input
                                                                                                                type="file"
                                                                                                                id="image_menu_{{$m->id}}"
                                                                                                                class="widefat code edit-menu-item-image form-control"
                                                                                                            />
                                                                                                            @if(isset($m->image))
                                                                                                                <img
                                                                                                                    src="{{asset('storage/'.$m->image)}}"
                                                                                                                    alt="{{$m->label}}"
                                                                                                                    style="width: 50px;height: 50px">
                                                                                                            @endif
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-12 px-20 div-menu menu-item-actions description-wide submitbox"
                                                                                                            style="width: 100% ;margin-top: 5px">
                                                                                                            <a class="btn btn-danger item-delete submitdelete deletion "
                                                                                                               style="display: inline-block;padding: 1px 9%"
                                                                                                               id="delete-{{$m->id}}"
                                                                                                               href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">{{__('Delete')}}</a>

                                                                                                            {{--                                                                                                            <a class="item-cancel submitcancel hide-if-no-js button-primary"--}}
                                                                                                            {{--                                                                                                               id="cancel-{{$m->id}}"--}}
                                                                                                            {{--                                                                                                               href="{{ $currentUrl }}?edit-menu-item={{$m->id}}&cancel=1424297719#menu-item-settings-{{$m->id}}">{{__('Cancel')}}</a>--}}
                                                                                                            {{--                                                                                                            <span--}}
                                                                                                            {{--                                                                                                                class="meta-sep hide-if-no-js"> | </span>--}}
                                                                                                            <button
                                                                                                                onclick="getmenus(true)"
                                                                                                                style="display: inline-block"
                                                                                                                class="btn btn-primary"
                                                                                                                id="update-{{$m->id}}"
                                                                                                            >{{__('Update item')}}
                                                                                                            </button>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                                <ul class="menu-item-transport"></ul>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </ul>
                                                                                <div class="menu-settings">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="nav-menu-footer">
                                                                            <div class="major-publishing-actions">

                                                                                @if(request()->has('action'))
                                                                                    <div class="publishing-action">
                                                                                        <a onclick="createnewmenu()"
                                                                                           name="save_menu"
                                                                                           id="save_menu_header"
                                                                                           class="btn btn-primary mb-3 menu-save">{{__('Create menu')}}</a>
                                                                                    </div>
                                                                                @elseif(request()->has("menu_id"))
                                                                                    <div class="publishing-action">

                                                                                        <a onclick="getmenus(true)"
                                                                                           name="save_menu"
                                                                                           id="save_menu_header"
                                                                                           class="btn btn-primary mb-3 menu-save">{{__('Save menu')}}</a>
                                                                                        <span class="spinner"
                                                                                              id="spincustomu2"></span>
                                                                                    </div>


                                                                                    <!-- <div class="publishing-action">
                                                                        <span class="delete-action">
                                                                            <a class="submitdelete deletion menu-delete btn btn-danger"
                                                                               onclick="deletemenu()"
                                                                               href="javascript:void(9)"><i
                                                                                    class="fa fa-fimes"></i> {{__('Delete menu')}}
                                                                                    </a>
                                                                                </span>

                                                                    </div> -->
                                                                                @else
                                                                                    <!-- <div class="publishing-action">
                                                                <a onclick="createnewmenu()" name="save_menu"
                                                                   id="save_menu_header"
                                                                   class="btn btn-primary mb-3 menu-save">{{__('Create menu')}}</a>
                                                            </div> -->
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('menus.scripts')
    <script>
        function submitForm() {
            document.getElementById("myForm").submit();
        }
    </script>
@endsection
