<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Front\HomeController;

/* ============================== ADMIN ============================== */

use App\Http\Controllers\Admin\{AboutController,
    AuthController,
    ContactController,
    DashboardController,
    EmailSubscriptionController,
    FreeSampleBoxController,
    GalleryController,
    HomePageController,
    ReportController,
    SentMailController,
    TechnicalCertificateController,
    SettingController,
    FaqController,
    ResourceController,
    InstallationGuidesController,
    CategoryController,
    ProductController,
    ProductColorController,
    OfferController,
    FreeSampleController};

/* ============================== ADMIN ROUTES ============================== */

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product-color', ProductColorController::class);
    Route::resource('offer', OfferController::class);
    Route::group(['prefix' => 'free-sample', 'as' => 'free-sample.'], function () {

        Route::resource('box', FreeSampleBoxController::class);

        Route::resource('/', FreeSampleController::class)
            ->parameters(['' => 'free_sample'])
            ->names([
                'index'   => 'index',
                'create'  => 'create',
                'store'   => 'store',
                'show'    => 'show',
                'edit'    => 'edit',
                'update'  => 'update',
                'destroy' => 'destroy',
            ]);
    });

    Route::post('report/upload-image', [ReportController::class, 'uploadImage'])->name('report.upload-image');
    Route::post('report/delete-image', [ReportController::class, 'deleteImage'])->name('report.delete-image');
    Route::resource('report', ReportController::class);

    Route::resource('email-subscription', EmailSubscriptionController::class);

    Route::get('sent-mail', [SentMailController::class, 'index'])->name('sent-mail.index');
    Route::delete('sent-mail/{id}', [SentMailController::class, 'destroy'])->name('sent-mail.destroy');
    Route::get('sent-mail/send', [SentMailController::class, 'sendPage'])->name('sent-mail.send');
    Route::post('sent-mail/send', [SentMailController::class, 'send']);

    Route::get('settings', [SettingController::class, 'index'])->name('setting.index');
    Route::put('settings', [SettingController::class, 'update'])->name('setting.update');

    Route::get('contact-infos', [ContactController::class, 'infos'])->name('contact.infos');
    Route::put('contact-infos', [ContactController::class, 'infoUpdate'])->name('contact.infoUpdate');
    Route::resource('contact', ContactController::class);

    Route::get('home-settings', [HomePageController::class, 'index'])->name('home-settings.index');
    Route::put('home-settings', [HomePageController::class, 'update'])->name('home-settings.update');

    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::put('{id}', [AboutController::class, 'update'])->name('update');
        Route::resource('factories', \App\Http\Controllers\Admin\AboutFactoryController::class)
            ->only(['store', 'update', 'destroy']);
    });

    Route::resource('faqs', FaqController::class)->except('show');

    Route::prefix('resources')->name('resources.')->group(function () {
        Route::post('upload-image', [ResourceController::class, 'uploadImage'])->name('upload-image');
        Route::post('delete-image', [ResourceController::class, 'deleteImage'])->name('delete-image');

        Route::get('online-catalog', [ResourceController::class, 'catalog'])->name('catalog');
        Route::put('online-catalog', [ResourceController::class, 'updateCatalog'])->name('catalog.update');

        Route::get('warranties', [ResourceController::class, 'warranties'])->name('warranties');
        Route::put('warranties', [ResourceController::class, 'updateWarranties']);

        Route::get('care-and-maintenance', [ResourceController::class, 'careAndMaintenance'])->name('care-and-maintenance');
        Route::put('care-and-maintenance', [ResourceController::class, 'updateCareAndMaintenance']);

        Route::resource('installation-guides', InstallationGuidesController::class);
        Route::resource('gallery', GalleryController::class)->except(['show', 'edit', 'update']);
        Route::resource('technical-certificates', TechnicalCertificateController::class);
    });
});

/* ============================== AUTH ============================== */

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/* ============================== PUBLIC ============================== */

Route::get('unsubscribe/{email}', [EmailSubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/subscribe-email', [HomeController::class, 'subscribeEmail'])->name('subscribe-email');

/* ============================== SITEMAP ============================== */

Route::get('sitemap.xml', [\App\Http\Controllers\SiteMapController::class, 'index']);

/* ============================== FRONT ============================== */
Route::group([
    'prefix' => LaravelLocalization::setLocale(), // Locale otomatik prefix
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {

    /* ================= HOME ================= */

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get(
        LaravelLocalization::transRoute('routes.get_inspired') . '/{count}',
        [HomeController::class, 'getInspireds']
    )->name('get-inspireds');

    Route::get(
        LaravelLocalization::transRoute('routes.about'),
        [HomeController::class, 'about']
    )->name('about');

    Route::get(
        LaravelLocalization::transRoute('routes.faq'),
        [HomeController::class, 'faq']
    )->name('faq');

    Route::get(
        LaravelLocalization::transRoute('routes.estimate_cost'),
        [HomeController::class, 'estimateCost']
    )->name('estimate-cost');

    Route::post(
        LaravelLocalization::transRoute('routes.estimate_cost'),
        [HomeController::class, 'saveEstimateCost']
    );

    Route::get(
        LaravelLocalization::transRoute('routes.free_samples'),
        [HomeController::class, 'freeSamples']
    )->name('free-samples');

    Route::post(
        LaravelLocalization::transRoute('routes.free_samples'),
        [HomeController::class, 'saveFreeSamples']
    );

    Route::get('/news/{slug}/{id}', [HomeController::class, 'news'])->name('news');

    Route::get(
        LaravelLocalization::transRoute('routes.contact'),
        [HomeController::class, 'contact']
    )->name('contact');

    Route::post(
        LaravelLocalization::transRoute('routes.contact'),
        [HomeController::class, 'saveContact']
    );

    Route::get(
        LaravelLocalization::transRoute('routes.news'),
        [HOmeController::class, 'allNews']
    )->name('all-news');

    Route::get("/getNews", [HomeController::class, 'getNews'])->name('getNews');

    /* ================= RESOURCES ================= */

    // Burada nested setLocale grubu kaldırıldı
    Route::prefix(LaravelLocalization::transRoute('routes.resources.main')) // sadece slug: 'recursos' veya 'resources'
    ->name('resources.')
        ->group(function () {

            Route::get('/', [HomeController::class, 'resources'])->name('main');

            Route::get(
                LaravelLocalization::transRoute('routes.resources.catalog'),
                [HomeController::class, 'catalog']
            )->name('catalog');

            Route::get(
                LaravelLocalization::transRoute('routes.resources.warranties'),
                [HomeController::class, 'warranties']
            )->name('warranties');

            Route::get(
                LaravelLocalization::transRoute('routes.resources.care_and_maintenance'),
                [HomeController::class, 'careAndMaintenance']
            )->name('care-and-maintenance');

            Route::get(
                LaravelLocalization::transRoute('routes.resources.installation_guides'),
                [HomeController::class, 'installationGuides']
            )->name('installation-guides');

            Route::get(
                LaravelLocalization::transRoute('routes.resources.technical_certificates'),
                [HomeController::class, 'technicalCertificates']
            )->name('technical-certificates');

            Route::get(
                LaravelLocalization::transRoute('routes.resources.get_inspired_page'),
                [HomeController::class, 'getInspiredPage']
            )->name('get-inspired-page');
        });

    /* ⚠️ HER ZAMAN EN SON */
    Route::get('/{slug}', [HomeController::class, 'category'])->name('category');
});
