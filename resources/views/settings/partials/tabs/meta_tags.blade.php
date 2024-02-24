<div class="container card-body row">
    <div class="form-group col-md-7 col-lg-7  col-12">
        <label for="meta_tags_head">{{ __('Meta Tag Head') }}</label>
        <input type="text" class="form-control @error('meta_tags_head') is-invalid @enderror"
               id="meta_tags_head" name="meta_tags_head" value="{{ old('meta_tags_head',$setting->meta_tags_head) }}">
        <x-error-message name="meta_tags_head"/>
    </div>
    <div class="form-group col-md-7 col-lg-7  col-12">
        <label for="meta_tags_body">{{ __('Meta Tag Body') }}</label>
        <input type="text" class="form-control @error('meta_tags_body') is-invalid @enderror"
               id="meta_tags_body" name="meta_tags_body" value="{{ old('meta_tags_body',$setting->meta_tags_body) }}">
        <x-error-message name="meta_tags_body"/>
    </div>
    <div class="form-group col-md-7 col-lg-7  col-12">
        <label for="meta_tags_footer">{{ __('Meta Tag Footer') }}</label>
        <input type="text" class="form-control @error('meta_tags_footer') is-invalid @enderror"
               id="meta_tags_footer" name="meta_tags_footer"
               value="{{ old('meta_tags_footer',$setting->meta_tags_footer) }}">
        <x-error-message name="meta_tags_footer"/>
    </div>
</div>
