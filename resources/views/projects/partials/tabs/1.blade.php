<!-- tran -->
<div class="row">
    <div class="col-12">
        <!-- Tab Nav -->
        <div class="dm-nav-controller">
            <ul class="nav nav-fill flex-column flex-md-row btn-group" id="tabs-icons-text" role="tablist">
                @php
                    $languages = \App\Models\Language::get();
                    $languages_count = count($languages);
                @endphp
                @foreach($languages as $language)
                    <li class="nav-item ">
                        <a class="btn btn-sm btn-outline-light color-light nav-link {{$language->is_default ? 'active':''}}"
                           style="margin-bottom: 12px"
                           id="tabs-icons-text-{{$language->id}}-tab" data-bs-toggle="tab"
                           href="#tabs-icons-text-{{$language->id}}" role="tab"
                           aria-controls="tabs-icons-text-{{$language->id}}" aria-selected="true">
                            <img src="{{asset('storage/'.$language->flag)}}" class="img-fluid" width="30px"
                                 height="30px" alt="">
                            {{$language->name}}
                        </a>
                    </li>

                @endforeach


            </ul>
        </div>
        <!-- End of Tab Nav -->
        <!-- Tab Content -->
        <div class="card border-0">
            <div class="p-0">
                <div class="tab-content" id="tabcontent2">
                    @foreach(\App\Models\Language::get() as $language)
                        @php
                            if(isset($project))
                            {
                            $currentLanguageProject = $project->languageProjects()->where('language_id',
                            $language->id)->first();
                            }
                        @endphp
                        <div class="tab-pane fade {{$language->is_default ? 'show active':''}} "
                             x-data="{ slug: '{{ old('slug', $currentLanguageProject->slug ?? '') }}' }"
                             id="tabs-icons-text-{{$language->id}}" role="tabpanel"
                             aria-labelledby="tabs-icons-text-{{$language->id}}-tab">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>{{__('Name')}}
                                        @if($language->is_default)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <input {{ $language->is_default ? 'required':'' }}
                                           x-on:input="slug = $event.target.value.toLowerCase().replace(/ /g, '-')"
                                           type="text" name="projects[{{$language->id}}][name]" class="form-control"
                                           value="{{old('name', $currentLanguageProject->name ?? '')}}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('Slug')}} @if($language->is_default)
                                            <span class="text-danger">*</span>
                                        @endif</label>
                                    <input {{ $language->is_default ? 'required':'' }} type="text"
                                           name="projects[{{$language->id}}][slug]" class="form-control"
                                           x-model="slug">
                                    @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">{{__('Description')}}
                                    @if($language->is_default)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <textarea {{
									$language->is_default ? 'required':'' }} type="text"
                                          name="projects[{{$language->id}}][description]" class="form-control"
                                          id="description-{{$language->id}}">{{ old('description',$currentLanguageProject->description ?? '') }}</textarea>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="short_description">{{__('Short Description')}}
                                    @if($language->is_default)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <input {{ $language->is_default ? 'required':'' }} type="text"
                                       name="projects[{{$language->id}}][short_description]"
                                       class="form-control"
                                       id="short_description" value="{{
								old('short_description',$currentLanguageProject->short_description ?? '') }}">
                                @error('short_description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace('description-{{$language->id}}');
                        </script>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- End of Tab Content -->
    </div>
</div>
<!-- tran -->
