<div class="row">
    <div class="col-12">
        <!-- Tab Nav -->
        <div class="dm-nav-controller">
            <ul class="nav nav-fill flex-column flex-md-row btn-group" id="tabs-icons-text" role="tablist">

                @foreach(\App\Models\Language::get() as $language)

                    <li class="nav-item" >
                        <a class="btn btn-sm btn-outline-light color-light nav-link {{$language->is_default == 1 ? 'active':''}}"
                           style="margin-bottom: 12px"
                           id="tabs-icons-text-{{$language->id}}-tab" data-bs-toggle="tab"
                           href="#tabs-icons-text-{{$language->id}}" role="tab"
                           aria-controls="tabs-icons-text-{{$language->id}}" aria-selected="true">
                            <img width="3%" src="{{asset('storage/'.$language->flag)}}">
                            {{$language->name}}
                        </a>
                    </li>
                @endforeach



            </ul>
        </div>
        <!-- End of Tab Nav -->
        <!-- Tab Content -->
        <div class="card border-0">
            <div class="card-body p-0">
                <div class="tab-content" id="tabcontent2">
                    @foreach(\App\Models\Language::get() as $language)
                        @php
                            if(isset($album))
                                {
                                    $isDefaultLanguage = $language->is_default;
                                    $currentLanguageAlbum = $album->album_language()->where('language_id', $language->id)->first();
                                }
                        @endphp
                        <div class="tab-pane fade {{$language->is_default ? 'show active':''}} "
                             id="tabs-icons-text-{{$language->id}}" role="tabpanel"
                             aria-labelledby="tabs-icons-text-{{$language->id}}-tab">
                            <div class="form-group">
                                <label>{{__('Title')}} <span class="text-danger">*</span></label>
                                <input required type="text" name="albums[{{$language->id}}][title]" class="form-control"
                                       value="{{ old('title',$currentLanguageAlbum->title ?? '') }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{__('Description')}} <span class="text-danger">*</span></label>
                                <input required type="text" name="albums[{{$language->id}}][description]"
                                       class="form-control"
                                       value="{{ old('description',$currentLanguageAlbum->description ?? '') }}">
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- End of Tab Content -->
    </div>
</div>

@if(!isset($album))
<div class="col-12">
    <label>{{__('AddImage')}}</label>
    <input class="form-control" type="file" name="images[]" multiple>
    @error('images.*')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<br><br>
<div class="col-12">
    <label>{{__('AddVideoUrl')}}</label>
    <div id="div_add">
        <input class="form-control" style="display: inline-block;width: 50%" type="text" name="videos[]">
        <input type="button" class="btn btn-secondary" id="add" style="display: inline-block" value="+">
    </div>
    @error('videos.*')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

<br><br>
@endif
<div class="col-6">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" value="1" name="is_active"
               id="flexSwitchCheckChecked" @checked($album->is_active ?? 1)>
        <x-error-message name="is_active"/>
        <label class="form-check-label" for="flexSwitchCheckChecked"> {{__('Is active')}}</label>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $("#add").click(function () {
        $("#div_add").append('<br><br> <div id="new_div" "> <input id="add-input" class="form-control"  style="display: inline-block;width: 50%" type="text" name="videos[]">'
            + '<input type="button"  class="btn btn-danger" id="remove" style="display: inline-block" value="-"></div>');

    });
    $("body").on("click", "#remove", function () {
        $(this).parents("#new_div").remove();
    })



</script>

