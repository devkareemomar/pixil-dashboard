<div class="container card-body row">
	<div class="form-group col-6">
		<label for="application_name">{{ __('Application name') }}</label>
		<input type="text" class="form-control @error('application_name') is-invalid @enderror" id="application_name"
			name="application_name" value="{{ old('application_name',$setting->application_name) }}">
		<x-error-message name="application_name" />
	</div>
	<div class="form-group col-6">
		<label for="dark_application_logo_image">{{ __('Application Logo Image') }}</label>
		<input type="file" class="form-control @error('dark_application_logo_image') is-invalid @enderror"
			id="dark_application_logo_image" name="dark_application_logo_image">
		<x-image src="{{ $setting->dark_application_logo_image }}" />
		<x-error-message name="dark_application_logo_image" />
	</div>
	<div class="form-group col-6">
		<label for="application_logo_image">{{ __('Dark application Logo Image') }}</label>
		<input type="file" class="form-control @error('application_logo_image') is-invalid @enderror"
			id="application_logo_image" name="application_logo_image">
		<x-image src="{{ $setting->application_logo_image }}" />
		<x-error-message name="application_logo_image" />
	</div>
    <div class="form-group col-6">
		<label for="mobile_logo_image">{{ __('Mobile logo image') }}</label>
		<input type="file" class="form-control @error('mobile_logo_image') is-invalid @enderror"
			id="mobile_logo_image" name="mobile_logo_image">
		<x-image src="{{ $setting->mobile_logo_image }}" />
		<x-error-message name="mobile_logo_image" />
	</div>
	<div class="form-group col-6">
		<label for="custom_css_file">{{ __('Custom CSS File') }}</label>
		<input type="file" class="form-control @error('custom_css_file') is-invalid @enderror" id="custom_css_file"
			name="custom_css_file" value="{{ old('custom_css_file',$setting->custom_css_file) }}">
		<x-error-message name="custom_css_file" />
	</div>
	<hr style="margin: 2%;padding: 0">
	<div class="form-group col-6 gap-3 d-flex align-items-center">
		<label for="custom_css_file">{{ __('Primary Color') }}</label>
		<input type="color" class="form-control form-control-color" id="custom_css_file" name="color_scheme"
			value="{{ old('color_scheme',$setting->color_scheme) }}">
		<x-error-message name="color_scheme" />
	</div>

	<div class="form-group col-6 gap-3 d-flex align-items-center">
		<label for="custom_css_file">{{ __('Secondary Color') }}</label>
		<input type="color" class="form-control form-control-color" id="custom_css_file" name="secondary_color"
			value="{{ old('secondary_color',$setting->secondary_color) }}">
		<x-error-message name="secondary_color" />
	</div>
	<hr style="margin: 2%;padding: 0">

	<div class="form-group col-6 gap-3 d-flex align-items-center">
		<label for="custom_css_file">{{ __('Primary Button') }}</label>
		<input type="color" class="form-control form-control-color" id="custom_css_file" name="primary_button"
			value="{{ old('primary_button',$setting->primary_button) }}">
		<x-error-message name="primary_button" />
	</div>

	<div class="form-group col-6 gap-3 d-flex align-items-center">
		<label for="custom_css_file">{{ __('Secondary Button') }}</label>
		<input type="color" class="form-control form-control-color" id="custom_css_file" name="secondary_button"
			value="{{ old('secondary_button',$setting->secondary_button) }}">
		<x-error-message name="secondary_button" />
	</div>


	<hr style="margin: 2%;padding: 0">
	<h4>{{__('Header')}}</h4>
	<br><br>
	<div class="form-group col-xxl-4 col-sm-4 gap-3 d-flex align-items-center">
		<label for="custom_css_file">{{ __('Color') }}</label>
		<input type="color" class="form-control form-control-color" id="custom_css_file" name="header_color"
			value="{{ old('header_color',$setting->header_color) }}" x-model="color">
		<x-error-message name="header_color" />
	</div>

	<div class="form-group col-xxl-3 col-sm-3 gap-3">
		<label for="custom_css_file">{{ __('Size') }}</label>
		<input type="number" min="8" max="72" class="form-control" name="header_size"
			value="{{ old('header_size',$setting->header_size) }}" x-model="size">
		{{-- <select name="header_size" class="form-select" aria-label="multiple select example" x-model="size">--}}
			{{-- @foreach(range(8,72) as $size)--}}
			{{-- <option value="{{$size}}" --}} {{-- @selected(old('header_size',$setting->header_size) == $size)--}}
				{{-- >{{$size}}</option>--}}
			{{-- @endforeach--}}
			{{-- </select>--}}

		<x-error-message name="header_size" />
	</div>
	<div style="margin-top: -50px;" class="col-xxl-5 col-sm-5 justify-content-center align-items-center d-flex mt-1">
		<p class="text-capitalize" :style="`font-size: ${size}px; color: ${color}`">A sample</p>
	</div>
	<hr style="margin: 2%;padding: 0">
	<div class="form-group col-xxl-4 col-sm-4 gap-3 d-flex align-items-center">
		<label for="custom_css_file">{{ __('Footer Background Color') }}</label>
		<input type="color" class="form-control form-control-color" id="custom_css_file" name="footer_background_color"
			value="{{ old('footer_background_color',$setting->footer_background_color) }}">
		<x-error-message name="footer_background_color" />
	</div>

	<div class="form-group col-xxl-4 col-sm-4 gap-3 d-flex align-items-center">
		<label for="custom_css_file">{{ __('Shadow Transparency') }}</label>
		<input type="number" min="1" max="100" class="form-control" name="shadow_transparency"
			value="{{ old('shadow_transparency',$setting->shadow_transparency) }}">
		<x-error-message name="shadow_transparency" />
	</div>

	<div class="form-group col-xxl-4 col-sm-4 gap-3 d-flex align-items-center">
		<label for="font">{{ __('Font') }}</label>
		<select required name="font" class="form-select" aria-label="multiple select example">
			<option value="cairo" {{$setting->font =="cairo" ? "selected" :""}}>Cairo</option>
			<option value="arial" {{$setting->font =="arial" ? "selected" :""}}>Arial</option>
		</select>
		<x-error-message name="font" />
	</div>
	<hr style="margin: 2%;padding: 0">
	<div class="form-group col-3">
		<x-toggle-switch name="breadcrumb" label="{{ __('Breadcrumb') }}" value="{{ $setting->breadcrumb }}" />
		<x-error-message name="breadcrumb" />
	</div>
</div>
