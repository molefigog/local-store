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
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index()
    {
        return view('live-search');
    }
    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        $results = Music::where('artist', 'like', '%' . $query . '%')->get();

        return response()->json($results);
    }
    public function landingPage(Request $request): View
    {
        $allMusic = Music::latest()->paginate(15)->withQueryString();
        $products = Product::latest()->paginate(10)->withQueryString();
        $recentlyAddedSongs = Music::latest()->take(10)->get();
        $downloads = Music::where('downloads', '>', 0)
            ->orderBy('downloads', 'desc')
            ->take(10)
            ->get();
        $genres = Genre::withCount('music')
            ->latest()
            ->paginate(10) // You might want to adjust the pagination as needed
            ->withQueryString();
        $setting = Setting::firstOrFail();
        $appName = config('app.name');
        $url = config('app.url');

        $title = $setting ? $setting->site : $appName;
        $image = asset("storage/$setting->image");
        $keywords = "GW ENT, genius Works ent, KS, K Fire, K-Fire, Elliotgog, GOG";

        // Call Share method and capture its result
        // $shareButtons = $this->Share();

        $metaTags = [
            'title' => $title,
            'description' => $setting->description,
            'image' =>  $image,
            'keywords' => $keywords,
            'url' =>  $url,
        ];

        return view('music', compact('allMusic', 'products', 'downloads', 'metaTags', 'genres'));
    }

    public function Share()
    {
        // Replace with your logic to generate title, image, and description
        // Assuming you want to share the first music item
        $music = Music::latest()->firstOrFail();

        // Get the base URL dynamically
        $title = $music->title;
        $image = url($music->image ? Storage::url($music->image) : '');
        $description = $music->description;
        $baseUrl = config('app.url');
        $url = "{$baseUrl}/msingle/{$music->slug}";

        // Generate social share buttons
        $shareButtons = \Share::page($url, 'Check out this music: ' . $music->title)
            ->facebook()
            ->twitter()
            ->whatsapp();

        return $shareButtons;
    }
    public function songsPage(Request $request): View
    {
        $search = $request->get('search', '');

        // Fetch all music with search filter
        $music = Music::search($search)->latest()->paginate(10)->withQueryString();
        $genres = Genre::withCount('music')->get();
        $genre = Genre::firstOrFail();
        $setting = Setting::firstOrFail();
        $appName = config('app.name');
        $url = config('app.url');

        $title = $setting ? $setting->site : $appName;
        // $image = asset('storage/$setting->site');
        $image = asset("storage/$setting->image");
        $keywords = "GW ENT, genius Works ent, KS, K Fire, K-Fire, Elliotgog, GOG";

        $metaTags = [
            'title' => $setting->site,
            'description' => $setting->description,
            'image' =>  $image,
            'keywords' => $keywords,
            'url' =>  $url,
        ];

        return view('songs', compact('allMusic', 'products', 'downloads', 'metaTags', 'genres'));
    }
    public function beatsPage(Request $request): View
    {

        $search = $request->get('search', '');
        $beats = Beat::search($search)->latest()->paginate(15)->withQueryString();
        $products = Product::search($search)->latest()->paginate(10)->withQueryString();
        $recentlyAddedSongs = Beat::latest()->take(10)->get();
        $downloads = Music::where('downloads', '>', 0)
            ->orderBy('downloads', 'desc')
            ->take(10)
            ->get();
        $genres = Genre::withCount('music')
            ->latest()
            ->paginate(10) // You might want to adjust the pagination as needed
            ->withQueryString();
        $setting = Setting::firstOrFail();
        $appName = config('app.name');
        $url = config('app.url');

        $title = $setting ? $setting->site : $appName;
        $image = asset("storage/$setting->site");
        $keywords = "GW ENT, genius Works ent, KS, K Fire, K-Fire, Elliotgog, GOG";

        $metaTags = [
            'title' => $setting->site,
            'description' => $setting->description,
            'image' =>  $image,
            'keywords' => $keywords,
            'url' =>  $url,
        ];


        return view('beatz', compact('beats', 'products', 'downloads', 'metaTags', 'genres'));
    }
    public function songsByArtist($artistName)
    {
        $artist = User::where('name', $artistName)->firstOrFail();

        $musicCollection = DB::table('music_user')
            ->where('user_id', $artist->id)
            ->join('music', 'music_user.music_id', '=', 'music.id')
            ->latest('music.created_at')
            ->paginate(10);
        $downloads = Music::where('downloads', '>', 0)
            ->orderBy('downloads', 'desc')
            ->take(10)
            ->get();
        $genres = Genre::withCount('music')
            ->latest()
            ->paginate(10) // You might want to adjust the pagination as needed
            ->withQueryString();
        $setting = Setting::firstOrFail();
        $appName = config('app.name');
        $url = config('app.url');

        // $title = $setting ? $setting->site : $appName;
        // $image = asset('storage/og-tag.jpg');
        $keywords = "GW ENT, genius Works ent, KS, K Fire, K-Fire, Elliotgog, GOG";


        $musicCount = $musicCollection->total();

        // Pick an image from the user's music collection
        $image = null;
        if ($musicCollection->isNotEmpty()) {
            // Get the last music item from the paginator
            $lastMusic = $musicCollection->last();
            // Construct the image URL
            $image = asset('storage/' . $lastMusic->image);
        }

        $description = 'This is the public folder of ' . $artist->name . '. Total Tracks ' . $musicCount;
        $baseUrl = config('app.url');
        $url = "{$baseUrl}/songs/{$artist->name}";

        // Generate social share buttons
        $shareButtons = \Share::page($url, 'Check out this music: ' . $artist->name)
            ->facebook()
            ->twitter()
            ->whatsapp();

        $metaTags = [
            'title' => $artist->name,
            'description' => $description,
            'image' =>  $image,
            'keywords' => $keywords,
            'url' =>  $url,
        ];
        return view('songs_by_artist', compact('musicCollection', 'artist', 'shareButtons', 'downloads', 'metaTags'));
    }
    public function sitemap()
    {
        $sitemap = Sitemap::create();
        Product::all()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(Url::create("/products/{$product->slug}"));
        });
        $latestAboutPost = Product::where('category_name', 'About')->orderBy('created_at', 'desc')->first();
        if ($latestAboutPost) {
            $sitemap->add(Url::create("/about")->setLastModificationDate($latestAboutPost->updated_at));
        }
        Music::all()->each(function (Music $music) use ($sitemap) {
            $sitemap->add(Url::create("/msingle/{$music->slug}"));
        });
        $sitemap->writeTofile(public_path('sitemap.xml'));
        return redirect()
            ->route('gee')
            ->withSuccess(__('sitemap created!!'));
    }
}