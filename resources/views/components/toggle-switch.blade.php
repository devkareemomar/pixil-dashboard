@props(['label', 'name', 'value'])

<div style="
    display: flex;
    height: 100%;
    align-items: center;
">
    <div class="form-check form-switch">
        <input type="hidden" value="0" name="{{ $name }}">
        <input class="form-check-input" type="checkbox" role="switch" value="1" name="{{ $name }}" id="{{ $name }}"
            @checked(old($name, $value ?? '' )==1) {{ $attributes }} />
        <x-error-message name="{{ $name }}"/>
        <label for="{{ $name }}" class="form-check-label">{{ __(':label', ['label' => $label]) }}</label>
    </div>
</div>
