<?php

namespace App\Providers;

use App\Interface\AlbumInterface;
use App\Interface\CampaignInterface;
use App\Interface\CareerInterface;
use App\Interface\ContactInterface;
use App\Interface\FormBuilderDataInterface;
use App\Interface\FormBuilderInterface;
use App\Interface\HelpListInterface;
use App\Interface\HelpTypeInterface;
use App\Interface\LinkInterface;
use App\Interface\NewsInterface;
use App\Interface\NewsTagInterface;
use App\Interface\NotificationInterface;
use App\Interface\ProjectStatusInterface;
use App\Interface\TagInterface;
use App\Interface\UserSettingInterface;
use App\Models\Setting;
use App\Models\SitePage;
use App\Services\AlbumServices;
use App\Services\CampaignServices;
use App\Services\CareerServices;
use App\Services\ContactServices;
use App\Services\FormBuilderDataServices;
use App\Services\FormBuilderServices;
use App\Services\HelpListServices;
use App\Services\HelpTypeServices;
use App\Services\LinkServices;
use App\Services\NewsServices;
use App\Services\NewsTagServices;
use App\Services\NotificationServices;
use App\Services\ProjectStatusServices;
use App\Services\TagServices;
use App\Services\UserSettingServices;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        if (env('APP_KEY') == null) {
            $retryLimit = 3; // Maximum number of retries
            $retryCount = 0; // Counter for retries
            while ($retryCount < $retryLimit) {
                try {
                    Artisan::call('storage:link');
                    Artisan::call('key:generate');
                    break;
                } catch (\Exception $e) {
                    $retryCount++;
                }
            }
        }
        $url = explode('/', url()->current());
        if (end($url) != "databaseConnection") {
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                $envContents = file_get_contents(base_path('.env'));
                $pattern = "/^APP_DEBUG=.*/m";
                $replacement = "APP_DEBUG=true";
                $newEnvContents = preg_replace($pattern, $replacement, $envContents);
                if ($newEnvContents !== false) {
                    file_put_contents(base_path('.env'), $newEnvContents);
                }
                $link = url('/dashboard/databaseConnection');
                echo "<h1 style='color: red'>Error in Database connection</h1><a href='$link'><h3>Please check your connection</h3></a>";
                die();
            }
            if (!Schema::hasTable('users') || !Schema::hasTable('form_builder_data') || !Schema::hasTable('form_builder_data')|| !Schema::hasTable('site_pages')) {
                Artisan::call('migrate:fresh --seed');
                $response = Http::get('https://rc.keyframe-eg.net/super/public/api/update/request');
                if ($response->successful()) {
                    $page_builders = $response->json();
                    if (!SitePage::first()) {
                        foreach ($page_builders as $page_builder) {
                            SitePage::create($page_builder);
                        }
                    }
                }
            }
        }

        Paginator::useBootstrap();

        $this->app->bind(TagInterface::class, TagServices::class);
        $this->app->bind(NewsInterface::class, NewsServices::class);
        $this->app->bind(CampaignInterface::class, CampaignServices::class);
        $this->app->bind(ProjectStatusInterface::class, ProjectStatusServices::class);
        $this->app->bind(LinkInterface::class, LinkServices::class);
        $this->app->bind(ContactInterface::class, ContactServices::class);
        $this->app->bind(CareerInterface::class, CareerServices::class);
        $this->app->bind(HelpListInterface::class, HelpListServices::class);
        $this->app->bind(HelpTypeInterface::class, HelpTypeServices::class);
        $this->app->bind(AlbumInterface::class, AlbumServices::class);
        $this->app->bind(NewsTagInterface::class, NewsTagServices::class);
        $this->app->bind(UserSettingInterface::class, UserSettingServices::class);
        $this->app->bind(NotificationInterface::class, NotificationServices::class);
        $this->app->bind(FormBuilderInterface::class, FormBuilderServices::class);
        $this->app->bind(FormBuilderDataInterface::class, FormBuilderDataServices::class);

        $this->registerMailConfig();

    }

    private function registerMailConfig()
    {
        $settings = Setting::first();
        
        $config = [
            'driver' => 'smtp',
            'host' => $settings->smtp_host,
            'port' => $settings->smtp_port,
            'from' => [
                'address' => $settings->default_from_address,
                'name' => $settings->default_from_display_name,
            ],
            'encryption' => $settings->smtp_enable_ssl ? 'ssl' : 'tls',
            'username' => $settings->smtp_user_name,
            'password' => $settings->smtp_password,
        ];

        Config::set('mail', $config);
    }
}
