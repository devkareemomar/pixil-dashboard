<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\News;
use Illuminate\Console\Command;

class add_slug_to_exists_news extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add_slug_to_exists_news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (News::all()->chunk(50) as $items) {
            foreach ($items as $item) {
                if (! $item->slug) {
                    $item->slug = Helper::makeSlugFromTitle($item->title);
                    $item->save();
                }
            }
        }
    }
}
