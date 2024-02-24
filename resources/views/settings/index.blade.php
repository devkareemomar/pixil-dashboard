@extends('layout.app')

@section('title', __('Settings'))
@section('description', __('Manage application settings'))

@section('content')

    <style>
        input {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Settings') }}</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="dm-nav-controller" x-data='{ currentTab: "appearance", size: "{{ old('header_size', $setting?->header_size) ?? 0 }}", color: "{{ old('header_color',$setting?->header_color) ?? 'black' }}" }'>
                        <ul class="nav nav-fill flex-column flex-md-row btn-group  ">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-outline-light color-light nav-link"
                                        :class="{ 'active': currentTab === 'appearance' }"
                                        @click.prevent="currentTab = 'appearance'">{{__('Appearance')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-outline-light color-light nav-link"
                                        :class="{ 'active': currentTab === 'users_management' }"
                                        @click.prevent="currentTab = 'users_management'">{{__('Users Management')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-outline-light color-light nav-link"
                                        :class="{ 'active': currentTab === 'security' }"
                                        @click.prevent="currentTab = 'security'">{{__('Security')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-outline-light color-light nav-link"
                                        :class="{ 'active': currentTab === 'email_management' }"
                                        @click.prevent="currentTab = 'email_management'">{{__('Email Management')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-outline-light color-light nav-link"
                                        :class="{ 'active': currentTab === 'social_media' }"
                                        @click.prevent="currentTab = 'social_media'">{{__('Social Media')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-outline-light color-light nav-link"
                                   :class="{ 'active': currentTab === 'meta_tags' }"
                                   @click.prevent="currentTab = 'meta_tags'">{{__('Meta Tags')}}
                                </a>
                            </li>
                        </ul>
                        <div>
                            <div x-show="currentTab === 'appearance'">
                                @include('settings.partials.tabs.appearance')
                            </div>
                            <div x-show="currentTab === 'users_management'">
                                @include('settings.partials.tabs.users_management')
                            </div>
                            <div x-show="currentTab === 'security'">
                                @include('settings.partials.tabs.security')
                            </div>
                            <div x-show="currentTab === 'email_management'">
                                @include('settings.partials.tabs.email_management')
                            </div>
                            <div x-show="currentTab === 'payment'">
                                @include('settings.partials.tabs.payment')
                            </div>
                            <div x-show="currentTab === 'social_media'">
                                @include('settings.partials.tabs.social_media')
                            </div>
                            <div x-show="currentTab === 'meta_tags'">
                                @include('settings.partials.tabs.meta_tags')
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ __('Update Settings') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
