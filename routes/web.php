<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\BeatController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Models\Beat;
use App\Models\Music;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Genre;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\PurchasedMusicController;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Http\Controllers\SocialShareController;
use App\Http\Controllers\MpesaController;

Route::get('/cancel', function () {
    return view('paypal.cancel');
});


Route::get('/mpesa/success', [MpesaController::class, 'showSuccessPage'])->name('mpesa.success');

Route::get('mpesa/error', [MpesaController::class, 'showErrorPage'])->name('mpesa.error');
Route::get('/success2', [PaypalController::class, 'returnUrl'])->name('success2'); 

Route::get('/success', [PaypalController::class, 'handleSuccess'])->name('success');
Route::post('/ipn', [PaypalController::class, 'handleIPN']);

Route::get('/sitemap', function () {
    $sitemap = Sitemap::create();
    Product::all()->each(function (Product $product) use ($sitemap) {
        $sitemap->add(Url::create("/products/{$product->slug}"));
    });

// Adding the most recent 'about' post if it exists
$latestAboutPost = Product::where('category_name', 'About')->orderBy('created_at', 'desc')->first();
if ($latestAboutPost) {
    $sitemap->add(Url::create("/about")->setLastModificationDate($latestAboutPost->updated_at));
}

    Music::all()->each(function (Music $music) use ($sitemap) {
        $sitemap->add(Url::create("/msingle/{$music->slug}"));
    });
    $sitemap->writeTofile(public_path('sitemap.xml'));
    return redirect()
        ->route('home')
        ->withSuccess(__('sitemap created!!'));
});


Route::get('songs', function (Request $request) {
    $search = $request->get('search', '');

    // Fetch all music with search filter
    $music = Music::search($search)->latest()->paginate(10)->withQueryString();
    $genres = Genre::withCount('music')->get();
    // Fetch recently added songs
    $recentlyAddedSongs = Music::latest()->take(10)->get();

    // Fetch the first genre (you might need to adjust this logic)
    $genre = Genre::firstOrFail();

    $metaTags = [
        'title' => $genre->title,
        'description' => 'Browse music by genre hip hop, Local, amapiano.... ',
        'image' => Storage::url($genre->image),
    ];

    return view('songs', compact(
        'search',
        'metaTags',
        'recentlyAddedSongs',
        'music', // Change 'Music' to 'music'
        'genres' // Include the 'genres' variable here
    ));
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('beatz', function (Request $request) {
    $search = $request->get('search', '');
    $beats = Beat::search($search)->latest()->paginate(15)->withQueryString();
    $products = Product::search($search)->latest()->paginate(10)->withQueryString();
    $recentlyAddedSongs = Beat::latest()->take(10)->get();
    $downloads = Music::where('downloads', '>', 0)
        ->orderBy('downloads', 'desc')
        ->take(10)
        ->get();
    $setting = Setting::firstOrFail();
    $appName = config('app.name');
    $url = config('app.url');

    $title = $setting ? $setting->site : $appName;
    $image = asset('storage/og-tag.jpg');
    $keywords = "GW ENT, genius Works ent, KS, K Fire, K-Fire, Elliotgog, GOG";

    $metaTags = [
        'title' => $setting->site,
        'description' => $setting->description,
        'image' =>  $image,
        'keywords' => $keywords,
        'url' =>  $url,
    ];

    $recipeData = [
        "@context" => "https://schema.org/",
        "@type" => "Recipe",
        "name" => "Mseja Local Music",
        "author" => [
            "@type" => "Person",
            "name" => "Elliot Gog"
        ],
        "datePublished" => "2021-05-01",
        "description" => "Best way to sell digital Items with M-Pesa.",
        "prepTime" => "PT20M"
    ];
    $siteData = [
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "Genius Works Ent",
        "alternateName" => "GW-ENT",
        "url" => "https://gw-ent.co.za/"
    ];

    return view('beatz', compact('beats', 'products', 'downloads', 'metaTags', 'recipeData', 'siteData', 'search',));
})->name('beatz');

Route::get('msingle/{slug}', [MusicController::class, 'showBySlug'])
    ->where('slug', '[a-zA-Z0-9\-]+')  // Regular expression pattern for the slug
    ->name('msingle.slug');

    
Route::get('beat/{slug}', [BeatController::class, 'showBySlug'])
->where('slug', '[a-zA-Z0-9\-]+')  // Regular expression pattern for the slug
->name('beat.slug');
// Route::get('songs', [MusicController::class, 'genre'])->name('genres');


// installation routes

Route::get('/setup-database', [MigrationController::class, 'showDatabaseSetupForm'])->name('setup-database');
Route::post('/run-migrations', [MigrationController::class, 'runMigrations'])->name('run-migrations');
Route::post('/run-seeder', [MigrationController::class, 'runSeeder'])->name('run-seeder');
Route::get('/run-optimize', [MigrationController::class, 'runOptimize'])->name('run.optimize');

Route::get('social-share', [SocialShareController::class, 'index']);
// sms routes


Route::get('/data', [DataController::class, 'index']);
Route::get('/send-sms', [SMSController::class, 'sendSMSForm'])->name('send-sms-form');
Route::get('/send-sms2', [SMSController::class, 'sendSMSForm2'])->name('send-sms-form2');
Route::post('/send-sms', [SMSController::class, 'sendSMS'])->name('send-sms-send');
Route::post('/send-sms1', [SMSController::class, 'sendSMS2'])->name('send-sms-send2');
// Route::post('/v1/mpesa', [WebhookController::class, 'store']);


Route::get('music/download/{mp3}', [MusicController::class, 'downloadMp3'])->name('mp3.download');
Route::get('music/download/{music}', [MpesaController::class, 'downloadSong'])->name('music.download');
Route::get('download/{beat}', [MpesaController::class, 'downloadBeat'])->name('beat.download');

Route::post('/manual', [TopUpController::class, 'processOrder'])->name('manual');
Route::post('/order', [TopUpController::class, 'beatOrder'])->name('beat-order');
Route::post('/check-otp', [TopUpController::class, 'checkOtp'])->name('check-otp');
// music routes
Route::get('/download-music/{music_id}', [MusicController::class, 'downloadMusic'])
    ->middleware('canDownloadMusic')
    ->name('download-music');

Route::get('/download-beat/{beat_id}', [BeatController::class, 'downloadBeat'])
    ->middleware('canDownloadBeat')
    ->name('download-beat');

Route::post('/buy-beat', [BeatController::class, 'buyBeat'])->name('buy-beat');
Route::post('/buy-music', [MusicController::class, 'buyMusic'])->name('buy-music');
Route::post('/pay', [MusicController::class, 'pay'])->name('pay');
Route::get('about', [ProductController::class, 'about'])->name('about');
Route::get('/songs/genre/{genre}', [MusicController::class, 'songsByGenre'])->name('songs-by-genre');
Route::get('/songs/{artist}', [MusicController::class, 'songsByArtist'])->name('songs-by-artist');
/*
|--------------------------------------------------------------------------|
| Admin Routes                                                             |
|--------------------------------------------------------------------------|
*/
Route::get('/app-reset', [OwnerController::class, 'runScheduledTasks']);
Route::get('/expired-items', [OwnerController::class, 'wipeOut']);
Route::get('/generate-sitemap', [OwnerController::class, 'siteMap']);
// Route::get('/email-monthly-schedule', [OwnerController::class, 'monthlyEmail']);

Route::post('/clear-download-link', [MusicController::class, 'clearDownloadLink'])->name('clear-download-link');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/total-users', [UserController::class, 'getTotalUsers'])->name('admin.total-users');

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
    Route::get('msingle/{music}', [MusicController::class, 'show'])->name('/msingle');

    Route::resource('categories', CategoryController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('owners', OwnerController::class);
    Route::resource('settings', SettingController::class);

    Route::get('all-music', [MusicController::class, 'index'])->name('all-music.index');
    Route::post('all-music', [MusicController::class, 'store'])->name('all-music.store');
    Route::get('all-music/create', [MusicController::class, 'create',])->name('all-music.create');
    Route::get('all-music/{music}', [MusicController::class, 'show'])->name('all-music.show');
    Route::get('all-music/{music}/edit', [MusicController::class, 'edit',])->name('all-music.edit');
    Route::put('all-music/{music}', [MusicController::class, 'update',])->name('all-music.update');
    Route::delete('all-music/{music}', [MusicController::class, 'destroy',])->name('all-music.destroy');

    Route::get('beats', [BeatController::class, 'index'])->name('beats.index');
    Route::post('beats', [BeatController::class, 'store'])->name('beats.store');
    Route::get('beats/create', [BeatController::class, 'create',])->name('beats.create');
    Route::get('beats/{beat}', [BeatController::class, 'show'])->name('beats.show');
    Route::get('beats/{beat}/edit', [BeatController::class, 'edit',])->name('beats.edit');
    Route::put('beats/{beat}', [BeatController::class, 'update',])->name('beats.update');
    Route::delete('beats/{beat}', [BeatController::class, 'destroy',])->name('beats.destroy');

    Route::resource('products', ProductController::class);

    Route::get('edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('edit-profile', [ProfileController::class, 'update'])->name('update-profile');
    Route::get('/top-up', [TopUpController::class, 'showTopUpForm'])->name('top-up');
    Route::post('/top-up', [TopUpController::class, 'processTopUp'])->name('process-top-up');

    Route::get('/purchased-musics', [MusicController::class, 'purchasedMusics'])->name('purchased-musics');
    Route::get('/purchased-beatz', [BeatController::class, 'purchasedBeats'])->name('purchased-beatz');
    Route::get('/transaction', [PaypalController::class, 'index'])->name('log');
    Route::get('/sales', [PurchasedMusicController::class, 'index'])->name('sales');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/topup/{id}', [UserController::class, 'creditUp'])->name('creditup');
    Route::delete('users/{id}', [UserController::class, 'deleteuser'])->name('users.delete');
});
