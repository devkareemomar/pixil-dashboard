<div class="col-md-6">
    <form action="{{ route('countries.index') }}" method="GET">
        <div class="input-group">
            <select name="filter_column" class="form-select" id="filterColumnDropdown">
                <option value="name" {{request()->filter_column == 'name' ? 'selected' : ''}}>Name</option>
                <option value="short_name" {{request()->filter_column == 'short_name' ? 'selected' : ''}}>Short Name</option>
                <option value="language_id" {{request()->filter_column == 'language_id' ? 'selected' : ''}}>Language</option>
                <option value="currency_id" {{request()->filter_column == 'currency_id' ? 'selected' : ''}}>Currency</option>
            </select>
            <div id="filterValueContainer">
                <input type="text" name="filter_value" class="form-control" value="{{request()->filter_value}}">
            </div>
            <select name="language_id" class="form-select" id="languageDropdown" style="display: none;">
                <option value="">Select Language</option>
                @foreach ($languages as $language)
                <option value="{{ $language->id }}" {{request()->language_id == $language->id ? 'selected' : ''}}>{{ $language->name }}</option>
                @endforeach
            </select>
            <select name="currency_id" class="form-select" id="currencyDropdown" style="display: none;">
                <option value="">Select Currency</option>
                @foreach ($currencies as $currency)
                <option value="{{ $currency->id }}" {{request()->currency_id == $currency->id ? 'selected' : ''}}>{{ $currency->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
</div>

<script>
    window.onload = function() {
        const filterColumnDropdown = document.getElementById('filterColumnDropdown');
        const filterValueContainer = document.getElementById('filterValueContainer');
        const languageDropdown = document.getElementById('languageDropdown');
        const currencyDropdown = document.getElementById('currencyDropdown');

        filterColumnDropdown.addEventListener('change', function() {
            const selectedValue = this.value;

            if (selectedValue === 'language_id' || selectedValue === 'currency_id') {
                filterValueContainer.style.display = 'none';
                languageDropdown.style.display = selectedValue === 'language_id' ? 'block' : 'none';
                currencyDropdown.style.display = selectedValue === 'currency_id' ? 'block' : 'none';
            } else {
                filterValueContainer.style.display = 'block';
                languageDropdown.style.display = 'none';
                currencyDropdown.style.display = 'none';
            }
        });
        filterColumnDropdown.dispatchEvent(new Event('change'));
    };
</script>