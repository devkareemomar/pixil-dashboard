<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\NewsRequest;
use App\Interface\NewsInterface;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NewsController extends Controller
{
    private $news;

    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        $results = News::query()->filter()->paginate();
        return view('news.index', compact('results'));
    }

    public function create()
    {
        return view('news.create');

    }

    public function show($news_id)
    {
        $result = $this->news->show($news_id);
        return view('news.show', compact('result'));
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        // if ($request->hasFile('image')) {
        //     $data['image'] = $request->file('image')->store('images', 'public');
        // }
        $this->news->store($data);
        return redirect()->route('news.index')->with('success', __('News created successfully.'));
    }

    public function edit($news_id)
    {
        $result = $this->news->edit($news_id);
        $newsTags = implode(',', $result->tags()->pluck('name')->all());
        return view('news.edit', compact('result', 'newsTags'));
    }

    public function update(NewsRequest $request, $news_id)
    {
        $data = $request->validated();
        // if ($request->hasFile('image')) {
        //     $data['image'] = $request->file('image')->store('images', 'public');

        // }
        $this->news->update($data, $news_id);
        return redirect()->route('news.index')->with('success', __('News updated successfully.'));
    }

    public function destroy($news_id)
    {
        $this->news->destroy($news_id);
        return back()->with('success', __('News deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(News::class, $selectedRows);
        return back()->with('success', __('News deleted successfully.'));

    }

    public function export()
    {
        $array = [
            __('ID'),
            __('Title'),
            __('Short Description'),
            __('Description'),
            __('Slug'),
            __('Tag'),
            __('Category'),
        ];
        $data = News::select('news.id', 'news.title', 'news.short_description', 'news.description', 'news.slug',
            DB::raw('GROUP_CONCAT(DISTINCT news_tags.name) AS tag_name'),
            DB::raw('GROUP_CONCAT(DISTINCT news_categories.name) AS category_name'))
            ->leftJoin('category_news_categories', 'news.id', '=', 'category_news_categories.news_id')
            ->leftJoin('news_categories', 'category_news_categories.news_categories_id', '=', 'news_categories.id')
            ->leftJoin('tag_news_tags', 'news.id', '=', 'tag_news_tags.news_id')
            ->leftJoin('news_tags', 'tag_news_tags.news_tags_id', '=', 'news_tags.id')
            ->groupBy('news.id')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'News.csv');
    }
}
