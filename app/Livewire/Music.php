<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Beat;
use App\Models\Music as Song;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Genre;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Music extends Component
{
    use WithPagination;

protected $paginationTheme = 'bootstrap';

    public $search;

    public $music;


    public function incrementLikes(Request $request, $musicId)
    {
        $this->music = Song::findOrFail($musicId);
        $this->music->increment('likes');
        $this->music->save();
    }

    public function render()
    {

        $allMusic = Song::latest()->where('artist', 'like', "%{$this->search}%")->paginate(15);
        $products = Product::latest()->paginate(10)->withQueryString();

        $downloads = Song::where('downloads', '>', 0)
            ->orderBy('downloads', 'desc')
            ->take(6)
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
        return view('livewire.music',compact('allMusic', 'products', 'downloads', 'metaTags', 'genres'));
    }
}
