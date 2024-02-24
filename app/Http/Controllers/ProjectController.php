<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\ProjectRequest;
use App\Interface\TagInterface;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Country;
use App\Models\Language;
use App\Models\LanguageProject;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepository  $projectRepository,
        protected CategoryRepository $categoryRepository,
        protected CountryRepository  $countryRepository,
        protected TagInterface       $tag,
        protected LanguageRepository $languageRepository,
    ) {
        $this->middleware('permission:project-read|project-create|project-update|project-delete', ['only' => ['index']]);
        $this->middleware('permission:project-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $projects = $this->filterCampaign();
        $projects = $projects?->filter()->paginate();
        $categories = $this->categoryRepository->all();
        $campaigns = Campaign::pluck('title', 'id')->toArray();

        return view('projects.index', compact('projects', 'categories', 'campaigns'));
    }

    public function show($id)
    {
        $project = $this->projectRepository->find($id);
        $countries = $this->countryRepository->all();
        $tags = $this->tag->index();
        $categories = $this->categoryRepository->all();
        $languages = $this->languageRepository->all();

        return view('projects.show', compact('project', 'countries', 'tags', 'categories', 'languages'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_category')->get();
        $subCategories = Category::whereNotNull('parent_category')->get();
        $countries = Country::all();
        $projectStatuses = ProjectStatus::all();
        return view('projects.create', compact('categories', 'subCategories', 'countries', 'projectStatuses'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        if ($data['suggested_values'] != null) {

            $data['suggested_values'] = implode(',', array_column(json_decode($data['suggested_values']), 'value'));

            Validator::make($data, [
                'suggested_values' => 'regex:/^[0-9,]+$/',
            ], [
                'suggested_values.regex' => __('Suggested values must be numbers only'),
            ])->validate();
            $suggested = explode(',', $data['suggested_values']);
        }
        if (isset($data['suggested_label']) && $data['suggested_label'] != null) {

            $data['suggested_label'] = implode(',', array_column(json_decode($data['suggested_label']), 'value'));

            Validator::make($data, [
                'suggested_label' => 'string',
            ], [
                'suggested_label.string' => __('Suggested values must be string only'),
            ])->validate();
            $suggested = array_combine(explode(',', $data['suggested_label']), explode(',', $data['suggested_values']));
        }

        $data['suggested_values'] = isset($suggested) ? json_encode($suggested) : '';


        if (isset($data['is_stock'])) {
            if ($data['is_stock'] == 1) {
                $data['total_earned'] =  $data['stock'];
            }
        }

        if (isset($data['show_donor_name'])) {
            $data['show_donor_name'] == 1 ?: $data['donor_name_required'] = 0;
        }
        if (isset($data['show_donor_phone'])) {
            $data['show_donor_phone'] == 1 ?: $data['donor_phone_required'] = 0;
        }
        if (isset($data['show_donation_comment'])) {
            $data['show_donation_comment'] == 1 ?: $data['donation_comment'] = null;
        }

        if (isset($data['video']) != null) {
            if (str_contains($data['video'], 'youtube.com/watch')) {
                $data['video'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "//www.youtube.com/embed/$1", $data['video']);
            }
            if (str_contains($data['video'], '//vimeo.com')) {
                $data['video'] = preg_replace('/vimeo.com/i', 'player.vimeo.com/video', $data['video']);
            }
        }
        $data['creator_id'] = Auth::id();
        $data['thumbnail'] = $this->handleFileUpload($request, 'thumbnail', 'thumbnails');
        $data['main_image'] = $this->handleFileUpload($request, 'main_image', 'main_images');
        $data['banner_image'] = $this->handleFileUpload($request, 'banner_image', 'banner_images');
        $data['total_wanted'] = $request->has('countries') ? array_sum(array_column($request->input('countries'), 'total_wanted')) : $request->input('total_wanted');

        $projects = $request['projects'];
        $default_language = Language::where('is_default', 1)->first();

        $project = $this->projectRepository->create([
            'name' => $projects[$default_language->id]['name'],
            'description' => $projects[$default_language->id]['description'],
            'slug' => $projects[$default_language->id]['slug'],
            'short_description' => $projects[$default_language->id]['short_description'],
            ...$data
        ]);
        $this->attachCountries($request, $project);
        $this->addTranslation($projects, $project);
        $this->addImages($request, $project);
        return redirect()->route('projects.index')->with('success', __('Project created successfully.'));
    }

    public function addImages(Request $request, $project)
    {
        if ($request->hasFile('images')) {
            $project->images()->delete();
            foreach ($request->file('images') as $image) {
                $project->images()->create([
                    'path' => $image->store('projects', 'public')
                ]);
            }
        }
    }

    public function addTranslation($projects, $projectModel)
    {
        $projectModel->languages()->detach();
        foreach ($projects as $key => $project) {
            $language = Language::find($key);
            LanguageProject::create([
                'language_id' => $key,
                'project_id' => $projectModel->id,
                'name' => $project['name'],
                'description' => $project['description'],
                'slug' => $project['slug'],
                'short_description' => $project['short_description'],
                'lang_code' => $language->short_name ?? null,
            ]);
        }
    }

    public function edit($id)
    {
        $project = $this->projectRepository->find($id);
        $countries = $this->countryRepository->all();
        $tags = $this->tag->index();
        $categories = Category::whereNull('parent_category')->get();
        $subCategories = Category::whereNotNull('parent_category')->get();
        $languages = $this->languageRepository->all();
        $countries = Country::all();
        $projectStatuses = ProjectStatus::all();
        return view('projects.edit', compact('project', 'categories', 'subCategories', 'tags', 'countries', 'languages', 'projectStatuses', 'countries'));
    }

    public function update(ProjectRequest $request, $id)
    {

        $data = $request->validated();

        $data['creator_id'] = Auth::id();
        $data['thumbnail'] = $this->handleFileUpload($request, 'thumbnail', 'thumbnails');
        $data['main_image'] = $this->handleFileUpload($request, 'main_image', 'main_images');
        $data['banner_image'] = $this->handleFileUpload($request, 'banner_image', 'banner_images');
        $data['total_wanted'] = $request->has('countries') ? array_sum(array_column($request->input('countries'), 'total_wanted')) : $request->input('total_wanted');
        $data['suggested_label'] = ($data['is_full_unit']) ?  $data['suggested_label'] : null;
        $projects = $request['projects'];
        $default_language = Language::where('is_default', 1)->first();




        if ($data['suggested_values'] != null) {

            $data['suggested_values'] = implode(',', array_column(json_decode($data['suggested_values']), 'value'));

            Validator::make($data, [
                'suggested_values' => 'regex:/^[0-9,]+$/',
            ], [
                'suggested_values.regex' => __('Suggested values must be numbers only'),
            ])->validate();
            $suggested = explode(',', $data['suggested_values']);
        }

        if (isset($data['suggested_label']) && $data['suggested_label'] != null) {

            $data['suggested_label'] = implode(',', array_column(json_decode($data['suggested_label']), 'value'));

            // Validator::make($data, [
            //     'suggested_label' => 'string',
            // ], [
            //     'suggested_label.string' => __('Suggested values must be string only'),
            // ])->validate();

            $keysLable = array_keys(explode(',', $data['suggested_label']));
            $keysValues = array_keys(explode(',', $data['suggested_values']));

            if ($keysLable != $keysValues) {
                return redirect()->back()
                        ->withErrors(__("the suggested_label must be equal to suggested_values"))
                        ->withInput();
            }


            $suggested = array_combine(explode(',', $data['suggested_label']), explode(',', $data['suggested_values']));
        }

        $data['suggested_values'] = isset($suggested) ? json_encode($suggested) : '';

        $project_data = $this->projectRepository->update($id, [
            'name' => $projects[$default_language->id]['name'],
            'description' => $projects[$default_language->id]['description'],
            'slug' => $projects[$default_language->id]['slug'],
            'short_description' => $projects[$default_language->id]['short_description'],
            ...$data
        ]);
        $this->attachCountries($request, $project_data);
        $this->addTranslation($projects, $project_data);
        $this->addImages($request, $project_data);

        return redirect()->route('projects.index')->with('success', __('Project updated successfully.'));
    }

    public function destroy($id)
    {
        $this->projectRepository->delete($id);
        return redirect()->route('projects.index')->with('success', __('Project deleted successfully.'));
    }

    public function attachCountries(Request $request, Project $project)
    {
        if ($request->has('countries')) {
            $project->countries()->detach();
            $countries = $request->input('countries');
            foreach ($countries as $country) {
                if ($country['suggested_values'] != null && is_array(array_column(json_decode($country['suggested_values']), 'value'))) {
                    $country['country_suggested_values'] = implode(',', array_column(json_decode($country['suggested_values']), 'value'));
                    Validator::make($country, [
                        'country_suggested_values' => 'regex:/^[0-9,]+$/',
                    ], [
                        'country_suggested_values.regex' => __('Suggested values must be numbers only'),
                    ])->validate();
                    $project->countries()->attach($country['id'], ['total_wanted' => $country['total_wanted'], 'suggested_values' => $country['country_suggested_values']]);
                }
            }
        }
    }

    public function attachTags(Request $request, Project $project)
    {
        $tagsIds = $request->input('tags');
        $project->tags()->sync($tagsIds);

        return back()->with('success', __('Tags attached successfully'));
    }

    public function attachCategories(Request $request, Project $project)
    {
        $categoriesIds = $request->input('categories');
        $project->categories()->sync($categoriesIds);

        return back()->with('success', __('Categories attached successfully'));
    }

    public function attachLanguages(Request $request, Project $project)
    {
        $languagesIds = $request->input('languages');
        $project->languages()->sync($languagesIds);

        return back()->with('success', __('Languages attached successfully'));
    }

    public function handleFileUpload($request, $inputName, $storagePath)
    {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store($storagePath, 'public');
        }

        return null;
    }

    public function addAlbum(Request $request, $project_id)
    {
        DB::table('album_projects')
            ->where('project_id', $project_id)
            ->delete();
        foreach ($request->albums as $album) {
            DB::table('album_projects')->insert([
                'project_id' => $project_id,
                'album_id' => $album,
            ]);
        }
        return back()->with('success', __('Album added successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
        if ($selectedRows == null) {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Project::class, $selectedRows);
        return back()->with('success', __('Project deleted successfully.'));
    }

    public function export()
    {
        // $array = [
        //     '#', __('Name'), __('Slug'), __('SKU'), __('Total Earned'), __('Total Wanted'),
        //     __('Description'), __('Short Description'), __('Start Date'),
        //     __('End Date'), __('Active'), __('Stock'), __('Is Zakat'), __('Category'), __('Sub Category'),
        //     __('Tag'), __('Project status')
        // ];
        $array = [
            '#', __('Name'), __('Total Earned'), __('Total Wanted'), __('Project status'),
            __('Start date'), __('End date')

        ];

        $data = Project::select(
            'projects.id',
            'projects.name',
            'total_earned',
            'total_wanted',
            'project_statuses.name as Project status',
            'start_date',
            'end_date',
        )
            ->leftJoin('project_statuses', 'projects.project_status_id', '=', 'project_statuses.id')
            ->groupBy('projects.id')
            ->filter()->get();

        return Excel::download(new exportToExcel($data, $array), 'Projects.csv');
    }

    private function filterCampaign()
    {
        $campaign = request()->filter['campaign_id'] ?? null;
        if ($campaign) {
            $campaign = Campaign::find($campaign);
            return $campaign->projects();
        }
        return Project::query();
    }
}
