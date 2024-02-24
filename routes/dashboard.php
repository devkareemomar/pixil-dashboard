<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FormBuilderDataController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HelpListController;
use App\Http\Controllers\HelpTypeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsTagController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageBuilderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SitePageController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\VisitsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SocialMediaController;

Route::get('/databaseConnection', function () {
    return view('database-connection');
})->name('databaseConnection');

Route::post('/post/databaseConnection', function (\Illuminate\Http\Request $request) {

    $envData = [
        'DB_DATABASE' => $request->input('database_name'),
        'DB_USERNAME' => $request->input('username'),
        'DB_PASSWORD' => $request->input('password'),
        'APP_DEBUG' => 'false'
    ];
    foreach ($envData as $key => $value) {
        $envContents = file_get_contents(config('app.api_path') . '/.env');
        $pattern = "/^$key=.*/m";
        $replacement = "$key=$value";
        $newEnvContents = preg_replace($pattern, $replacement, $envContents);
        if ($newEnvContents !== false) {
            file_put_contents(config('app.api_path') . '/.env', $newEnvContents);
        }
    }
    foreach ($envData as $key => $value) {
        $envContents = file_get_contents(base_path('.env'));
        $pattern = "/^$key=.*/m";
        $replacement = "$key=$value";
        $newEnvContents = preg_replace($pattern, $replacement, $envContents);
        if ($newEnvContents !== false) {
            file_put_contents(base_path('.env'), $newEnvContents);
        }
    }


    return redirect('/');
});
Route::middleware('auth')->group(function () {


    Route::get('tas/api', [NewsTagController::class, 'api'])->name('tags.api');


    Route::get('page-builder', [PageBuilderController::class, 'index']);
    Route::get('page-builder/{page}', [PageBuilderController::class, 'show'])->name('page-builder.show');
    Route::post('page-builder/{page}', [PageBuilderController::class, 'save'])->excludedMiddleware(['csrf']);

    Route::get('user/setting', [UserSettingController::class, 'index'])->name('userSetting');
    Route::patch('user/setting/update', [UserSettingController::class, 'update'])->name('userSettingUpdate');

    Route::get('user/change/password', [UserSettingController::class, 'changePassword_index'])->name('userChangePassword');
    Route::post('user/change/password/update', [UserSettingController::class, 'changePassword_update'])->name('userChangePasswordUpdate');
    Route::get('user/log/login', [UserSettingController::class, 'logLogin'])->name('userLogLogin');


    Route::get('projects/export', [ProjectController::class, 'export'])->name('projects.export');
    Route::get('projectStatus/export', [ProjectStatusController::class, 'export'])->name('projectStatus.export');
    Route::get('tags/export', [TagController::class, 'export'])->name('tags.export');
    Route::get('categories/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::get('news/export', [NewsController::class, 'export'])->name('news.export');
    Route::get('newsCategories/export', [NewsCategoryController::class, 'export'])->name('newsCategories.export');
    Route::get('newsTags/export', [NewsTagController::class, 'export'])->name('newsTags.export');
    Route::get('campaigns/export', [CampaignController::class, 'export'])->name('campaigns.export');
    Route::get('links/export', [LinkController::class, 'export'])->name('links.export');
    Route::get('careers/export', [CareerController::class, 'export'])->name('careers.export');
    Route::get('menus/export', [MenuController::class, 'export'])->name('menus.export');
    Route::get('visits/export', [VisitsController::class, 'export'])->name('visits.export');
    Route::get('contacts/export', [ContactController::class, 'export'])->name('contacts.export');
    Route::get('helpTypes/export', [HelpTypeController::class, 'export'])->name('helpTypes.export');
    Route::get('helpList/export', [HelpListController::class, 'export'])->name('helpList.export');
    Route::get('languages/export', [LanguageController::class, 'export'])->name('languages.export');
    Route::get('countries/export', [CountryController::class, 'export'])->name('countries.export');
    Route::get('currencies/export', [CurrencyController::class, 'export'])->name('currencies.export');
    Route::get('users/export', [UserController::class, 'export'])->name('users.export');
    Route::get('roles/export', [RoleController::class, 'export'])->name('roles.export');
    Route::get('audits/export', [AuditController::class, 'export'])->name('audits.export');
    Route::get('donations/export', [DonationController::class, 'export'])->name('donations.export');
    Route::get('transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
    Route::get('carts/export', [CartController::class, 'export'])->name('carts.export');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('reports/social-media/export', [ReportController::class, 'exportSocialMedia'])->name('reports.social-media.export');
    Route::get('reports/alias-links/export', [ReportController::class, 'exportAliasLinks'])->name('reports.alias-links.export');

    Route::post('project/album/{project_id}', [ProjectController::class, 'addAlbum'])->name('project.album');

    Route::delete('site-pages/deleteSelectRow', [SitePageController::class, 'deleteSelectRow'])->name('site-pages.deleteSelectRow');
    Route::get('site-pages/{id}/duplicate', [SitePageController::class, 'duplicate'])->name('site-pages.duplicate');
    Route::get('site-pages/{id}/activate', [SitePageController::class, 'activate'])->name('site-pages.activate');
    Route::get('languages/{id}/translations', [LanguageController::class, 'translations'])->name('languages.translations');
    Route::Post('languages/{id}/updateTranslations', [LanguageController::class, 'updateTranslations'])->name('languages.updateTranslations');
    Route::Post('links/{id}/generate', [LinkController::class, 'generate'])->name('links.generate');

    Route::resources([
        'users' => UserController::class,
        'roles' => RoleController::class,
        'languages' => LanguageController::class,
        'countries' => CountryController::class,
        'currencies' => CurrencyController::class,
        'projects' => ProjectController::class,
        'categories' => CategoryController::class,
        'tags' => TagController::class,
        'news' => NewsController::class,
        'campaigns' => CampaignController::class,
        'menus' => MenuController::class,
        'projectStatuses' => ProjectStatusController::class,
        'links' => LinkController::class,
        'contacts' => ContactController::class,
        'careers' => CareerController::class,
        'help_types' => HelpTypeController::class,
        'helps' => HelpListController::class,
        'sliders' => SliderController::class,
        'albums' => AlbumController::class,
        'news_categories' => NewsCategoryController::class,
        'news_tags' => NewsTagController::class,
        'notifications' => NotificationController::class,
        'carts' => CartController::class,
        'transactions' => TransactionController::class,
        'site-pages' => SitePageController::class,
        'divisions' => DivisionController::class,
        'pages' => PageController::class,
        'forms' => FormBuilderController::class,
        'payment-gateways' => PaymentGatewayController::class,
        'formData' => FormBuilderDataController::class,
        'social-media' => SocialMediaController::class,
    ]);
    Route::get('statuses', [FormBuilderDataController::class,'index'])->name('statuses');

    Route::delete('languages/selectRow/delete', [LanguageController::class, 'deleteSelectRow'])->name('languages.deleteSelectRow');
    Route::delete('currencies/selectRow/delete', [CurrencyController::class, 'deleteSelectRow'])->name('currencies.deleteSelectRow');
    Route::delete('countries/selectRow/delete', [CountryController::class, 'deleteSelectRow'])->name('countries.deleteSelectRow');
    Route::delete('users/selectRow/delete', [UserController::class, 'deleteSelectRow'])->name('users.deleteSelectRow');
    Route::delete('roles/selectRow/delete', [RoleController::class, 'deleteSelectRow'])->name('roles.deleteSelectRow');
    Route::delete('forms/selectRow/delete', [FormBuilderController::class, 'deleteSelectRow'])->name('forms.deleteSelectRow');
    Route::delete('formData/selectRow/delete', [FormBuilderDataController::class, 'deleteSelectRow'])->name('formData.deleteSelectRow');
    Route::delete('social-media/selectRow/delete', [SocialMediaController::class, 'deleteSelectRow'])->name('social-media.deleteSelectRow');


    Route::delete('carts/selectRow/delete', [CartController::class, 'deleteSelectRow'])->name('carts.deleteSelectRow');
    Route::delete('contacts/selectRow/delete', [ContactController::class, 'deleteSelectRow'])->name('contacts.deleteSelectRow');
    Route::delete('helpType/selectRow/delete', [HelpTypeController::class, 'deleteSelectRow'])->name('help_types.deleteSelectRow');
    Route::delete('helps/selectRow/delete', [HelpListController::class, 'deleteSelectRow'])->name('helps.deleteSelectRow');

    Route::delete('menus/selectRow/delete', [MenuController::class, 'deleteSelectRow'])->name('menus.deleteSelectRow');
    Route::delete('sliders/selectRow/delete', [SliderController::class, 'deleteSelectRow'])->name('sliders.deleteSelectRow');
    Route::delete('transactions/selectRow/delete', [TransactionController::class, 'deleteSelectRow'])->name('transactions.deleteSelectRow');

    Route::delete('links/selectRow/delete', [LinkController::class, 'deleteSelectRow'])->name('links.deleteSelectRow');
    Route::delete('careers/selectRow/delete', [CareerController::class, 'deleteSelectRow'])->name('careers.deleteSelectRow');
    Route::delete('albums/selectRow/delete', [AlbumController::class, 'deleteSelectRow'])->name('albums.deleteSelectRow');

    Route::delete('news/selectRow/delete', [NewsController::class, 'deleteSelectRow'])->name('news.deleteSelectRow');
    Route::delete('newsTags/selectRow/delete', [NewsTagController::class, 'deleteSelectRow'])->name('news_tags.deleteSelectRow');
    Route::delete('newsCategory/selectRow/delete', [NewsCategoryController::class, 'deleteSelectRow'])->name('news_categories.deleteSelectRow');

    Route::delete('projectStatus/selectRow/delete', [ProjectStatusController::class, 'deleteSelectRow'])->name('projectStatuses.deleteSelectRow');
    Route::delete('tags/selectRow/delete', [TagController::class, 'deleteSelectRow'])->name('tags.deleteSelectRow');
    Route::delete('categories/selectRow/delete', [CategoryController::class, 'deleteSelectRow'])->name('categories.deleteSelectRow');
    Route::delete('divisions/selectRow/delete', [DivisionController::class, 'deleteSelectRow'])->name('divisions.deleteSelectRow');
    Route::delete('pages/selectRow/delete', [PageController::class, 'deleteSelectRow'])->name('pages.deleteSelectRow');

    Route::delete('projects/selectRow/delete', [ProjectController::class, 'deleteSelectRow'])->name('projects.deleteSelectRow');
    Route::delete('campaigns/selectRow/delete', [CampaignController::class, 'deleteSelectRow'])->name('campaigns.deleteSelectRow');
    Route::delete('payment-gateways/selectRow/delete', [PaymentGatewayController::class, 'deleteSelectRow'])->name('payment-gateways.deleteSelectRow');
    Route::patch('notification/readAll', [NotificationController::class, 'updateAll'])->name('notifications.updateAll');
    Route::delete('notification/destroyAll', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');



    Route::get('user/setting', [UserSettingController::class, 'index'])->name('userSetting');
    Route::patch('user/setting/update', [UserSettingController::class, 'update'])->name('userSettingUpdate');

    Route::get('user/change/password', [UserSettingController::class, 'changePassword_index'])->name('userChangePassword');
    Route::post('user/change/password/update', [UserSettingController::class, 'changePassword_update'])->name('userChangePasswordUpdate');

    Route::post('change/language/{language_id}', [UserSettingController::class, 'changeLanguage'])->name('changeLanguage');


    Route::get('user/log/login', [UserSettingController::class, 'logLogin'])->name('userLogLogin');


    Route::post('storeMedia/{album_id}', [AlbumController::class, 'storeMedia'])->name('storeMedia');
    Route::post('destroyMedia/{media_id}', [AlbumController::class, 'destroyMedia'])->name('destroyMedia');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');


    Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
        Route::post('/{project}/attach-countries', [ProjectController::class, 'attachCountries'])->name('attachCountries');
        Route::post('/{project}/attach-tags', [ProjectController::class, 'attachTags'])->name('attachTags');
        Route::post('/{project}/attach-categories', [ProjectController::class, 'attachCategories'])->name('attachCategories');
        Route::post('/{project}/attach-languages', [ProjectController::class, 'attachLanguages'])->name('attachLanguages');

        Route::post('/{project}/gallery', [GalleryController::class, 'storeMedia'])->name('gallery.store');
        Route::delete('/gallery/{media}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    });


    Route::get('/visits', [VisitsController::class, 'index'])->name('visits.index');
    Route::get('/visits/page/{visit_id}', [VisitsController::class, 'page'])->name('visits.page');
    Route::get('/visits/user/{user_id}', [VisitsController::class, 'user'])->name('visits.user');

    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');

    Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');
    Route::get('/audits/{id}', [AuditController::class, 'show'])->name('audits.show');

    Route::get('/gifts', [\App\Http\Controllers\GiftController::class, 'index'])->name('gifts.index');
    Route::get('/gift_templates', [\App\Http\Controllers\GiftController::class, 'gift_templates'])->name('gifts.templates.index');
    Route::get('/gift_templates/create', [\App\Http\Controllers\GiftController::class, 'create_gift_templates'])->name('gifts.templates.create');
    Route::post('/gift_templates/store', [\App\Http\Controllers\GiftController::class, 'store_gift_templates'])->name('gifts.templates.store');
    Route::get('/gift_templates/edit{id}', [\App\Http\Controllers\GiftController::class, 'edit_gift_templates'])->name('gifts.templates.edit');
    Route::put('/gift_templates/update/{id}', [\App\Http\Controllers\GiftController::class, 'update_gift_templates'])->name('gifts.templates.update');
    Route::delete('/gift_templates/destroy/{id}', [\App\Http\Controllers\GiftController::class, 'destroy_gift_templates'])->name('gifts.templates.destroy');
    Route::delete('gift_templates/deleteSelectRow', [\App\Http\Controllers\GiftController::class, 'deleteSelectRow'])->name('gifts.templates.deleteSelectRow');


    Route::post('addcustommenu', [MenuController::class, 'addcustommenu'])->name('addcustommenu');
    Route::post('deleteitemmenu', [MenuController::class, 'deleteitemmenu'])->name('deleteitemmenu');
    Route::post('deletemenug', [MenuController::class, 'deletemenug'])->name('deletemenug');
    Route::post('createnewmenu', [MenuController::class, 'createnewmenu'])->name('createnewmenu');
    Route::post('generatemenucontrol', [MenuController::class, 'generatemenucontrol'])->name('generatemenucontrol');
    Route::post('updateitem', [MenuController::class, 'updateitem'])->name('updateitem');

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('reports/social-media', [ReportController::class, 'socialMediaReport'])->name('reports.social-media');

    Route::get('reports/alias-links', [ReportController::class, 'aliasLinksReport'])->name('reports.alias-links');

});
