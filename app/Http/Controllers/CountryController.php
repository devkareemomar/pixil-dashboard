<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Models\CountryLanguage;
use App\Models\Currency;
use App\Models\Language;
use App\Repositories\CountryRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CountryController extends Controller
{
    public function __construct(
        protected CountryRepository  $countryRepository,
        protected CurrencyRepository $currencyRepository,
        protected LanguageRepository $languageRepository
    )
    {
        $this->middleware('permission:country-read|country-create|country-update|country-delete', ['only' => ['index']]);
        $this->middleware('permission:country-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:country-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $countries = Country::filter()->paginate();

        $currencies = Currency::all();
        $languages = Language::all();


        return view('countries.index', compact('countries', 'currencies', 'languages'));
    }

    public function show($id)
    {
        $country = $this->countryRepository->find($id);
        return view('countries.show', compact('country'));
    }

    public function create()
    {
        $currencies = $this->currencyRepository->all();
        $languages = $this->languageRepository->all();

        return view('countries.create', compact('currencies', 'languages'));
    }

    public function store(CountryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('flag')) {
            $data['flag'] = $request->file('flag')->store('flags', 'public');
        }
        $default_language = Language::where('is_default', 1)->first();
        $countries=$request['countries'];
        $country = $this->countryRepository->create([
            'name' => $countries[$default_language->id]['name'],
            ...$data
        ]);
        $this->addTranslation($countries, $country);
        return redirect()->route('countries.index')->with('success', __('Country created successfully.'));
    }

    public function edit($id)
    {
        $country = $this->countryRepository->find($id);
        $currencies = $this->currencyRepository->all();
        $languages = $this->languageRepository->all();
        return view('countries.edit', compact('country', 'currencies', 'languages'));
    }

    public function update(CountryRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('flag')) {
            $data['flag'] = $request->file('flag')->store('flags', 'public');
        }
        $default_language = Language::where('is_default', 1)->first();
        $countries=$request['countries'];
        $country = $this->countryRepository->update($id,[
            'name' => $countries[$default_language->id]['name'],
            ...$data
        ]);
        $this->addTranslation($countries, $country);

        return redirect()->route('countries.index')->with('success', __('Country updated successfully.'));
    }
    public function addTranslation($countries, $model)
    {
        $model->countryLanguage()->delete();
        foreach ($countries as $key => $country) {
            CountryLanguage::create([
                'language_id' => $key,
                'country_id' => $model->id,
                'name' => $country['name'],
            ]);
        }
    }
    public function destroy($id)
    {
        $this->countryRepository->delete($id);
        return redirect()->route('countries.index')->with('success', __('Country deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Country::class, $selectedRows);
        return back()->with('success', __('Country deleted successfully.'));

    }

    public function export()
    {
        $array = [
            '#',
            __('Name'),
            __('Short Name'),
            __('Language'),
            __('Currency')
        ];
        $data = Country::select('countries.id', 'countries.name', 'countries.short_name', 'languages.name as language', 'currencies.name as currency')
            ->leftJoin('languages', 'countries.language_id', 'languages.id')
            ->leftJoin('currencies', 'countries.currency_id', 'currencies.id')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'Countries.csv');
    }
}
