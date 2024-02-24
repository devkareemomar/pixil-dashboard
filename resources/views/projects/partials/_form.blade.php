@php
    $project = $project ?? null;
@endphp
<div class="row">

    <div class="col-lg-12">
        <h4 class="mb-4">
            {{ __('General Info') }}
        </h4>
        @include('projects.partials.tabs.1')
    </div>
</div>
<hr class="my-4">
<div class="row">
    <div class="col-lg-12">
        <h4 class="mb-4">
            {{ __('General Options') }}
        </h4>
        <script>
            let isMultiCountry = {{ old('is_multi_country', $project?->is_multi_country) ?? 0 }};
            let showDonationComment = {{ old('show_donation_comment', $project?->show_donation_comment) ?? 0 }};
            let showBanner = {{ old('show_banner', $project?->show_banner) ?? 0 }};
            let highlighted = {{ old('highlighted', $project?->highlighted) ?? 0 }};
            let stock = {{ old('is_stock', $project?->is_stock) ?? 0 }};
            let show_donor_phone = {{ old('show_donor_phone', $project?->show_donor_phone) ?? 0 }};
            let show_donor_name = {{ old('show_donor_name', $project?->show_donor_name) ?? 0 }}
            countries = [];
        </script>
        <div class="row" x-data="{ show_donor_name: show_donor_name, show_donor_phone: show_donor_phone, stock: stock, isMultiCountry: isMultiCountry, showDonationComment: showDonationComment, showBanner: showBanner, highlighted: highlighted, countries: countries }">
            @include('projects.partials.tabs.2')
            @include('projects.partials.tabs.3')
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


        <script>



            $("#add").click(function() {
                $("#div_add").append(
                    '<div id="new_div"> <input id="add-input" class="form-control"  style="display: inline-block;width: 50%" type="text" name="videos[]">' +
                    '<input type="button"  class="btn btn-danger m-1" id="remove" style="display: inline-block" value="-"></div>'
                );
            });
            $("body").on("click", "#remove", function() {
                $(this).parents("#new_div").remove();
            })
        </script>

    </div>

</div>
