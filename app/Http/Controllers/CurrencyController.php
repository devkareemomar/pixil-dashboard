<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Models\CurrencyLanguage;
use App\Models\Language;
use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CurrencyController extends Controller
{

    public function __construct(protected CurrencyRepository $currencyRepository)
    {
        $this->middleware('permission:currency-read|currency-create|currency-update|currency-delete', ['only' => ['index']]);
        $this->middleware('permission:currency-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:currency-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:currency-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $currencies = Currency::filter()->paginate();
        return view('currencies.index', compact('currencies'));
    }

    public function show($id)
    {
        $currency = $this->currencyRepository->find($id);
        return view('currencies.show', compact('currency'));
    }

    public function create()
    {
        return view('currencies.create');
    }

    public function store(CurrencyRequest $request)
    {
        $data = $request->validated();
        $default_language = Language::where('is_default', 1)->first();
        $currencies = $request['currencies'];
        $currency = $this->currencyRepository->create([
            'name' => $currencies[$default_language->id]['name'],
            ...$data
        ]);
        $this->addTranslation($currencies, $currency);

        return redirect()->route('currencies.index')->with('success', __('Currency created successfully.'));
    }

    public function edit($id)
    {
        $currency = $this->currencyRepository->find($id);
        return view('currencies.edit', compact('currency'));
    }

    public function update(CurrencyRequest $request, $id)
    {
        $data = $request->validated();
        $default_language = Language::where('is_default', 1)->first();
        $currencies = $request['currencies'];
        $currency = $this->currencyRepository->update($id, [
            'name' => $currencies[$default_language->id]['name'],
            ...$data
        ]);
        $this->addTranslation($currencies, $currency);
        return redirect()->route('currencies.index')->with('success', __('Currency updated successfully.'));
    }

    public function addTranslation($currencies, $model)
    {
        $model->currencyLanguage()->delete();
        foreach ($currencies as $key => $currency) {
            CurrencyLanguage::create([
                'language_id' => $key,
                'currency_id' => $model->id,
                'name' => $currency['name'],
            ]);
        }
    }

    public function destroy($id)
    {
        $this->currencyRepository->delete($id);
        return redirect()->route('currencies.index')->with('success', __('Currency deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
        if ($selectedRows == null) {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Currency::class, $selectedRows);
        return back()->with('success', __('Currency deleted successfully.'));

    }

    public function export()
    {
        $array = [
            __('#'),
            __('Name'),
            __('Code'),
            __('Is Default'),
            __('Exchange Rate'),

        ];
        $data = Currency::select('#', 'name', 'code', 'is_default', 'exchange_rate')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'Currencies.csv');
    }
}
