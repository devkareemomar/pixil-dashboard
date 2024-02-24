@php
$paymentGateway = $paymentGateway ?? null;
@endphp
{{--$table->string('name')->unique();--}}
{{--$table->text('description')->nullable();--}}
{{--$table->boolean('status')->default(true);--}}
{{--$table->string('api_key');--}}
{{--$table->string('secret_key')->nullable();--}}
{{--$table->string('redirect_url')->nullable();--}}
{{--$table->string('cancel_url')->nullable();--}}
<div class="form-group">
	<label>{{ __('Name') }} <span class="text-danger">*</span></label>
	<input type="text" name="name" class="form-control" value="{{ old('name', $paymentGateway?->name) }}" required>
	@error('name')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Key') }} <span class="text-danger">*</span></label>
	<input type="text" name="key" class="form-control" value="{{ old('key', $paymentGateway?->key) }}" disabled>
	@error('key')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Description') }}</label>
	<textarea name="description"
		class="form-control ckeditor">{{ old('description', $paymentGateway?->description) }}</textarea>
	@error('description')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Status') }} <span class="text-danger">*</span></label>
	<select name="status" class="form-control" required>
		<option value="1" @selected(old('status', $paymentGateway?->status) == 1)>
			{{ __('Active') }}
		</option>
		<option value="0" @selected(old('status', $paymentGateway?->status) == 0)>
			{{ __('Inactive') }}
		</option>
	</select>
	@error('status')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('API key') }} <span class="text-danger">*</span></label>
	<input type="text" name="api_key" class="form-control" value="{{ old('api_key', $paymentGateway?->api_key) }}"
		required>
	@error('api_key')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Secret key') }}</label>
	<input type="text" name="secret_key" class="form-control"
		value="{{ old('secret_key', $paymentGateway?->secret_key) }}">
	@error('secret_key')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Redirect URL') }}</label>
	<input type="text" name="redirect_url" class="form-control"
		value="{{ old('redirect_url', $paymentGateway?->redirect_url) }}">
	@error('redirect_url')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Cancel URL') }}</label>
	<input type="text" name="cancel_url" class="form-control"
		value="{{ old('cancel_url', $paymentGateway?->cancel_url) }}">
	@error('cancel_url')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>