<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Interface\NewsInterface;
use App\Models\Language;
use App\Models\News;
use App\Models\NewsLanguage;
use App\Models\NewsTag;
use Illuminate\Support\Facades\DB;


class NewsServices implements NewsInterface
{
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        return $this->news->paginate();
    }

    public function show($news_id)
    {
        return $this->news->findOrFail($news_id);
    }

    public function edit($news_id)
    {
        return $this->news->findOrFail($news_id);
    }

    public function store($request)
    {

        $data = $request['news'];
        $default_language = Language::where('is_default', 1)->first();
        $request['slug'] = Helper::makeSlugFromTitle($data[$default_language->id]['title'], $request['slug'] ?? null);
        $news = $this->news->create([
            'title' => $data[$default_language->id]['title'],
            'description' => $data[$default_language->id]['description'],
            'short_description' => $data[$default_language->id]['short_description'],
            'image' => $request['image']
        ]);

        foreach (json_decode($request['tags']) as $tag) {
            $tag_name = NewsTag::firstOrCreate(
                ['name' => $tag->value],
                ['slug' => null]);
            DB::table('tag_news_tags')->insert(['news_id' => $news->id, 'news_tags_id' => $tag_name->id]);
        }
        if (isset($request['categories'])) {
            foreach ($request['categories'] as $category) {
                DB::table('category_news_categories')->insert(['news_id' => $news->id, 'news_categories_id' => $category]);
            }
        }
        $this->addTranslation($data, $news);

        return true;
    }

    public function update($request, $news_id)
    {
        $news = $this->news->findOrFail($news_id);
        if (isset($request['categories'])) {
            DB::table('category_news_categories')->where('news_id', $news_id)->delete();
            foreach ($request['categories'] as $category) {
                DB::table('category_news_categories')->insert(['news_id' => $news->id, 'news_categories_id' => $category]);
            }
        }
        if (isset($request['tags'])) {
            DB::table('tag_news_tags')->where('news_id', $news_id)->delete();
            foreach (json_decode($request['tags']) as $tag) {
                $tag_name = NewsTag::firstOrCreate(
                    ['name' => $tag->value],
                    ['slug' => null]);
                DB::table('tag_news_tags')->insert(['news_id' => $news->id, 'news_tags_id' => $tag_name->id]);
            }
        }

        $news->update($request);
        return true;
    }

    public function destroy($news_id)
    {
        $this->news->findOrFail($news_id)->delete();
        return true;
    }

    public function addTranslation($news, $model)
    {
        $model->newsLanguage()->delete();
        foreach ($news as $key => $new) {
            $language_code=Language::where('id',$key)->first();
            NewsLanguage::create([
                'language_id' => $key,
                'news_id' => $model->id,
                'title' => $new['title'],
                'description' => $new['description'],
                'short_description' => $new['short_description'],
                'lang_code'=>$language_code->short_name
            ]);
        }
    }

}
