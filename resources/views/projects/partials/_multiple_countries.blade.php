<div class=row">
    <div class="mb-3 col-4">
        <x-toggle-switch name="is_multi_country" label="{{ __('Is Multi Country') }}" :value="$project?->is_multi_country"
            x-on:click="isMultiCountry = !isMultiCountry"
            x-on:change="new Tagify(document.getElementById('suggested_values0'))" />
        <x-error-message name="is_multi_country" />
    </div>
    <template x-if="isMultiCountry">
        <div class="mb-3 col-12" id="div_add_country">
            <label for="country_id" class="form-label">{{ __('Countries') }}</label>
            <div class="row">
                <div class="col-4">
                    <select class="form-control" style="display: inline-block;" id="country_id" name="countries[0][id]"
                        onchange="countries.push(parseInt(this.value));"
                        onfocus="var index = countries.indexOf(parseInt(this.value)); if (index > -1) { countries.splice(index, 1); }">

                        required>
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" x-show="!countries.includes({{ $country->id }})"
                                @selected($country->id == $project?->countries()?->first()?->id)>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <input type="number" class="form-control" name="countries[0][total_wanted]"
                        value="{{ $project?->countries()?->first()?->pivot?->total_wanted }}" min="1"
                        oninput="validity.valid||(value='');" required placeholder="{{ __('Required amount') }}" />
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="countries[0][suggested_values]"
                        id="suggested_values0" value="{{ $project?->countries()?->first()?->pivot?->suggested_values }}"
                        min="1" required placeholder="{{ __('Suggested values') }}" />
                </div>
                <script>
                    $(document).ready(() => {
                        new Tagify(document.getElementById('suggested_values0'))
                    });
                </script>
                <div class="col-2">
                    <input type="button" class="btn btn-secondary" id="add_country" style="display: inline-block;"
                        value="+">
                </div>
            </div>
            @if (isset($project))
                @foreach ($project->countries as $project_country)
                    @if ($loop->first)
                        @continue
                    @endif
                    <div Class="row" id="new_div_country">
                        <div class="col-4">
                            <select class="form-control" id="country_id" name="countries[{{ $loop->iteration }}][id]"
                                required>
                                <option disabled>Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected($project_country->id == $country->id)
                                        x-show="!countries.includes({{ $country->id }})">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="number" class="form-control"
                                name="countries[{{ $loop->iteration }}][total_wanted]"
                                value="{{ $project_country->pivot?->total_wanted ?? 0 }}" required min="0"
                                oninput="validity.valid||(value='');" placeholder="{{ __('Required amount') }}">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control"
                                name="countries[{{ $loop->iteration }}][suggested_values]"
                                id="suggested_values{{ $loop->iteration }}"
                                value="{{ $project_country->pivot?->suggested_values }}" required min="0"
                                placeholder="{{ __('Suggested values') }}">
                        </div>
                        <div class="col-2">
                            <input type="button" class="btn btn-danger my-1" id="remove_country"
                                style="display: inline-block;" value="-">
                        </div>
                    </div>
                    <script>
                        $(document).ready(() => {
                            new Tagify(document.getElementById('suggested_values' + '{{ $loop->iteration }}'))
                        })
                    </script>
                @endforeach
            @endif
            <x-error-message name="countries.*" />

            <script>
                $(document).ready(() => {
                    $("body").on("click", "#add_country", function() {

                        let count = $("#div_add_country").children().length - 1;

                        let newElementHTML = `
                                <div class="row" id="new_div_country_${count}">
                                    <div class="col-4">
                                        <select class="form-control" id="country_id" name="countries[${count}][id]" required>
                                            <option disabled>Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"  x-show="!countries.includes({{ $country->id }})">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" class="form-control" name="countries[${count}][total_wanted]" value="" required min="0" oninput="validity.valid||(value='');" placeholder="{{ __('Required amount') }}">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" name="countries[${count}][suggested_values]" id="suggested_values${count}" value="" required min="0" placeholder="{{ __('Suggested values') }}">
                                    </div>
                                    <div class="col-2">
                                        <input type="button" class="btn btn-danger my-1" id="remove_country" style="display: inline-block;" value="-">
                                    </div>
                                </div>
                            `;
                        // Append the cloned element to the container
                        $("#div_add_country").append(newElementHTML);

                        new Tagify(document.getElementById('suggested_values' + count));
                    });


                    $("#div_add_country").on("click", ".btn-danger", function() {
                        // Find the parent row and remove it
                        $(this).closest(".row").remove();
                    });

                });

            </script>
        </div>

    </template>
    <template x-if="!isMultiCountry">
        <div class="mb-3 row">
            <div class="col-4">
                <label for="country_id" class="form-label">{{ __('Country') }}</label>
                <select class="form-control" id="country_id" name="country_id" required>
                    <option value="">{{ __('Select Country') }}</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @selected(old('country_id', $project?->country_id) == $country->id)>
                            {{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="total_wanted" class="form-label">{{ __('Total Wanted') }}</label>
                <input type="number" class="form-control" id="total_wanted" name="total_wanted" min="0"
                    oninput="validity.valid||(value='');"
                    value="{{ old('total_wanted', $project?->total_wanted ?? 0) }}" required
                    placeholder="{{ __('Required amount') }}" />
                <x-error-message name="total_wanted" />
            </div>
        </div>
    </template>
</div>
