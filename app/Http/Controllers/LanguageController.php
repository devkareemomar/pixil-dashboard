<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class LanguageController extends Controller
{
    public function __construct(protected LanguageRepository $languageRepository)
    {
        $this->middleware('permission:language-read|language-create|language-update|language-delete', ['only' => ['index']]);
        $this->middleware('permission:language-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:language-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:language-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $languages = Language::filter()->paginate();
        return view('languages.index', compact('languages'));
    }

    public function show($id)
    {
        $language = $this->languageRepository->find($id);
        return view('languages.show', compact('language'));
    }

    public function create()
    {
        return view('languages.create');
    }

    public function store(LanguageRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('flag')) {
            $data['flag'] = $request->file('flag')->store('flags', 'public');
        }
        $this->languageRepository->create($data);
        return redirect()->route('languages.index')->with('success', __('Language created successfully.'));
    }

    public function edit($id)
    {
        $language = $this->languageRepository->find($id);
        return view('languages.edit', compact('language'));
    }

    public function update(LanguageRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('flag')) {
            $data['flag'] = $request->file('flag')->store('flags', 'public');
        }
        $this->languageRepository->update($id, $data);
        return redirect()->route('languages.index')->with('success', __('Language updated successfully.'));
    }

    public function destroy($id)
    {
        if (Language::count() === 1) {
            // add error message to $errors variable in blade
            return redirect()->route('languages.index')->withErrors(['error' => 'You can not delete the last language.']);
        }
        $this->languageRepository->delete($id);
        return redirect()->route('languages.index')->with('success', __('Language deleted successfully.'));
    }

    public function switchLang($lang)
    {
        if (!array_key_exists($lang, Config::get('languages'))) {
            return Redirect::back();
        }

        $url = url()->previous();
        $base_url = URL::to('/');
        $base_url_rx = str_replace('/', '[\/]', $base_url . '/');
        $match_pattern = '/' . $base_url_rx . '\w{2}/';
        $replace = $base_url . '/' . $lang;
        $translation_url = preg_replace($match_pattern, $replace, $url);

        return Redirect::to($translation_url);
    }

    public function deleteSelectRow(Request $request)
    {
        $data = $request->input('selectedRows');
        if ($data == null) {
            return back()->withErrors([__('please select row')]);
        }
        if (count($request->input('selectedRows')) == Language::count()) {
            $default_language = Language::where('is_default', 1)->first();
            unset($data[array_search($default_language->id, $data)]);
        }
        DeleteRow::helperDeleteSelectedRows(Language::class, $data);
        return back()->with('success', __('Language deleted successfully.'));

    }

    public function export()
    {
        $array = [
            __('ID'),
            __('Name'),
            __('Short Name'),
            __('Is Default'),
        ];
        $data = Language::select('id', 'name', 'short_name', 'is_default')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'language.csv');
    }

    public function translations()
    {
        $language = Language::findOrfail(request('id'));
        $translations = $this->getTranslations($language->short_name);
        return view('languages.translations', compact('language', 'translations'));
    }

    public function updateTranslations()
    {
        $language = Language::findOrfail(request('id'));
        $newTranslations = array_combine(request('keys') ?? [], request('values') ?? []);

        $translations = json_encode(array_merge(request('translations'), $newTranslations));
        file_put_contents(resource_path("../lang/$language->short_name.json"), $translations);

        return back()->with('success', __('Translations updated successfully.'));
    }


    private function getTranslations($short_name)
    {
        if (!file_exists(resource_path("../lang/$short_name.json"))) {
            $langFile = fopen(resource_path("../lang/$short_name.json"), "w");
            $defaultLangFile = file_get_contents(resource_path("../lang/ar.json"));
            // remove all values from the file
            $defaultLangFile = json_decode($defaultLangFile, true);
            foreach ($defaultLangFile as $key => $value) {
                $defaultLangFile[$key] = '';
            }
            $defaultLangFile = json_encode($defaultLangFile);
            fwrite($langFile, $defaultLangFile);
            fclose($langFile);
        }
        return json_decode(file_get_contents(resource_path("../lang/$short_name.json")));
    }

}
