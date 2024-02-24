<tr>
    <th>{{ __('Tags') }}</th>
    @forelse($project->tags as $tag)
        <td>{{ $tag->name }}</td>
    @empty
        <td>{{ __('No Data Found') }}</td>
    @endforelse
    <td>
        @include('projects.partials._tags')
    </td>
</tr>
{{--<tr>--}}
{{--    <th>{{ __('Countries') }}</th>--}}
{{--    @forelse($project->countries as $country)--}}
{{--        <td>{{ $country->name }}</td>--}}
{{--    @empty--}}
{{--        <td>{{ __('No Data Found') }}</td>--}}
{{--    @endforelse--}}
{{--    <td>--}}
{{--        @include('projects.partials._countries')--}}
{{--    </td>--}}
{{--</tr>--}}
<tr>
    <th>{{ __('Categories') }}</th>
    @forelse($project->categories as $category)
        <td>{{ $category->name }}</td>
    @empty
        <td>{{ __('No Data Found') }}</td>
    @endforelse
    <td>
        @include('projects.partials._categories')
    </td>
</tr>
<tr>
    <th>{{ __('Languages') }}</th>
    @forelse($project->languages as $language)
        <td>{{ $language->name }}</td>
    @empty
        <td>{{ __('No Data Found') }}</td>
    @endforelse
    <td>
        @include('projects.partials._languages')
    </td>
</tr>
<tr>
    <th>{{ __('Gallery') }}</th>
    @include('projects.partials._gallery')
</tr>
