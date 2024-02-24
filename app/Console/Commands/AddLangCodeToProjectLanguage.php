<?php

namespace App\Console\Commands;

use App\Models\LanguageProject;
use Illuminate\Console\Command;

class AddLangCodeToProjectLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-lang-code-to-project-language';

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
        $languageProject = LanguageProject::with('language')->get();
        foreach ($languageProject as $item) {
            $item->lang_code = $item->language->short_name;
            $item->save();
        }
    }
}
