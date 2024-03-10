<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Beat;
use App\Models\Music;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Genre;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request): View
    {
        $search = $request->get('search', '');
        $allMusic = Music::search($search)->latest()->paginate(15)->withQueryString();
        $products = Product::search($search)->latest()->paginate(10)->withQueryString();
        $recentlyAddedSongs = Music::latest()->take(10)->get();
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

        return view('music', compact('allMusic', 'products', 'downloads', 'metaTags', 'recipeData', 'siteData', 'search',));
    }
    public function sitemap()
    {

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
    }
}
