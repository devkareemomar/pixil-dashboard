@php
$setting = \App\Models\Setting::first();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="{{ trans('description') }}" />
	<title>{{ $setting->application_name }} | @yield('title')</title>
	<?php
    if (app()->getLocale() == "ar") {
        $rtl = '.rtl';
    } else {
        $rtl = '';
    }
	?>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset( 'assets/css/plugin' . $rtl . '.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style' . $rtl . '.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
	<link rel="stylesheet"
		href="{{ asset('assets/css/custom.css') }}?v={{ filemtime(public_path('assets/css/custom.css')) }}">
	{{--
	<link rel="stylesheet" href="{{ asset('css/app' . $rtl . '.min.css') }}">--}}
	@if($setting?->application_logo_image)
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $setting?->application_logo_image) }}">
	@endif
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	@if(app()->getLocale() === 'ar')
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;500;600&display=swap" rel="stylesheet">

	@endif
	<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
		rel="stylesheet" />
	<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />
	@stack('styles')
</head>