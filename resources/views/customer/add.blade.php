@section('title', $title)
@section('description', $description)
@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                    <h4 class="text-capitalize">{{ __('menu.customer-add-new') }}</h4>
                </div>
            </div>
        </div>
        <div class="card mb-50">
            <div class="row justify-content-center">
                <div class="col-sm-5 col-10">
                    <div class="mt-40 mb-50">
                        <form action="{{ route('customer.store', app()->getLocale()) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="account-profile d-flex align-items-center mb-4 ">
                                <div class="ap-img pro_img_wrapper">
                                    <input id="profile-picture" type="file" accept="image/*" name="profile-picture"
                                           class="d-none image-upload-field"
                                           data-preview-element="profile-picture-preview">
                                    <!-- Profile picture image-->
                                    <label for="profile-picture">
                                        <img src="{{ asset( 'assets/img/svg/user.svg' ) }}" alt="{{ __('menu.user') }}"
                                             class="profile-picture-preview ap-img__main rounded-circle wh-120 bg-lighter d-flex">

                                        <span
                                            title="{{ __('menu.pick-an-image') }}"
                                            id="remove_pro_pic"
                                            class="cross clear-input-file-btn"
                                            data-input-has-file="0"
                                            data-pick-title="{{ __('menu.pick-an-image') }}"
                                            data-pick-icon="{{ asset( 'assets/img/svg/camera-white.svg' ) }}"
                                            data-clear-title="{{ __('menu.remove') }}"
                                            data-clear-icon="{{ asset( 'assets/img/svg/close-white.svg' ) }}"
                                            data-input-element-id="profile-picture"
                                            data-preview-element="profile-picture-preview"
                                            data-default-preview-image="{{ asset( 'assets/img/svg/user.svg' ) }}"
                                        >
                                            <img src="{{ asset( 'assets/img/svg/camera-white.svg' ) }}"
                                                 alt="{{ __('menu.camera') }}">
                                        </span>
                                    </label>
                                </div>
                                <div class="account-profile__title">
                                    <h6 class="fs-15 ms-20 fw-500 text-capitalize">{{ __('menu.profile-photo') }}</h6>
                                </div>
                            </div>

                            <div class="edit-profile__body">
                                <div class="form-group mb-25">
                                    <label for="name" class="color-dark fs-14 fw-500 align-center">{{ __('menu.name') }}
                                        <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                           name="name" value="{{ old('name') }}" id="name"
                                           placeholder="{{ __('menu.name') }}">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-25">
                                    <label for="email"
                                           class="color-dark fs-14 fw-500 align-center">{{ __('menu.email-address') }}
                                        <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                           name="email" id="email" value="{{ old('email') }}"
                                           placeholder="{{ __('menu.email-address') }}">
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-25">
                                    <label for="phone"
                                           class="color-dark fs-14 fw-500 align-center">{{ __('menu.phone') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                           name="phone" value="{{ old('phone') }}" id="phone"
                                           placeholder="{{ __('menu.phone') }}">
                                    @if ($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-25">
                                    <label for="profession"
                                           class="color-dark fs-14 fw-500 align-center">{{ __('menu.profession') }}
                                        <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                           name="profession" id="profession" value="{{ old('profession') }}"
                                           placeholder="{{ __('menu.profession') }}">
                                    @if ($errors->has('profession'))
                                        <p class="text-danger">{{ $errors->first('profession') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-25">
                                    <label for="gender"
                                           class="color-dark fs-14 fw-500 align-center">{{ __('menu.gender') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="gender"
                                            id="gender">
                                        <option value="">Choose Gender</option>
                                        <option
                                            value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('menu.male') }}</option>
                                        <option
                                            value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('menu.female') }}</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <p class="text-danger">{{ $errors->first('gender') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-25">
                                    <label for="address"
                                           class="color-dark fs-14 fw-500 align-center">{{ __('menu.address') }}</label>
                                    <textarea class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                              name="address" style="height: 175px;"
                                              id="address"
                                              placeholder="{{ __('menu.address') }}">{{ old('address') }}</textarea>
                                </div>
                                <div class="form-group mb-25">
                                    <label for="status"
                                           class="color-dark fs-14 fw-500 align-center">{{ __('menu.status') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="status"
                                            id="status">
                                        @foreach (get_status_meta() as $status_key => $status_meta)
                                            <option
                                                value="{{ $status_key }}" {{ old('status') == $status_key ? 'selected' : '' }}>
                                                {{ $status_meta['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <p class="text-danger">{{ $errors->first('status') }}</p>
                                    @endif
                                </div>
                                <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                    <button type="submit"
                                            class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">{{ __('menu.submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
