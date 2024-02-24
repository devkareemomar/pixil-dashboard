@props(['filter_attributes'])

@if($filter_attributes)
<style>
    .card-body {
        padding: 0 1.56rem !important;
    }

    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-selection--single {
        height: 33px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.5;
    }

    @if(app()->getLocale()=="ar") .select2-container--default .select2-selection--single .select2-selection__arrow {
        left: auto;
        right: 4%;
    }

    label {
        padding-bottom: 7px;
    }

    @endif
</style>
<form method="GET">
    <a id="showFilter" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
        <i class="fa fa-caret-down"></i>
        <label class="form-check-label">{{ __('Filter Options') }}</label>
    </a>
    <div class="card-header filter" style="width: 100%;padding-bottom:10px;padding-top:10px ;display: none ">
        <div class="row" style="width: 100%">

            @foreach($filter_attributes as $key => $value)
            @php
            $title = ucfirst(str_replace('_id', '', $key));
            $title = str_replace('_', ' ', $title);
            @endphp
            <div class="col-3">
                <label for="filter[{{ $key }}]">{{ __($title) }}</label>
                @if(is_iterable($value))
                <select name="filter[{{ $key }}]" id="filter[{{ $key }}]" class="">
                    <option value="">{{__('Select')}}</option>
                    @foreach($value as $sub_key => $option)
                    @php
                    $optionId = $option->id ?? $sub_key;
                    @endphp
                    <option value="{{ $optionId }}" @php $request_value=request("filter") ? request("filter")[$key] : null; @endphp @selected(($request_value)==$optionId && $request_value !='' )>
                        {{ $option?->name ?? $option }}
                    </option>
                    @endforeach
                </select>
                @else
                <input type="{{$value}}" name="filter[{{ $key }}]" id="filter[{{ $key }}]" class="form-control" placeholder="{{__('Search by')}} {{ __($title) }}" value='{{ request("filter") ? request("filter")[$key] : "" }}'>
                @endif
            </div>
            @endforeach
            <div class="col-1">
                <button type="submit" class="btn btn-secondary" style="height:30px;margin-top: 25px;width: 40%;"><span class="nav-icon uil uil-search" style="padding: 0;margin:0"></span>
                </button>
            </div>

        </div>

    </div>


</form>

<script>
    $(document).ready(function() {
        $('#showFilter').click(function() {
            $('.filter').slideToggle("slide");
            $(this).find('i').toggleClass('fa-caret-down fa-caret-up');
        });
    });
</script>
@endif