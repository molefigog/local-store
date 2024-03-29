<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Music extends Model
{
    use HasFactory;
    use Searchable;


    protected $fillable = [
        'genre_id',
        'artist',
        'title',
        'amount',
        'image',
        'demo',
        'file',
        'description',
        'duration',
        'size',
        'downloads',
        'md',
        'slug',

    ];
    protected static function boot()
    {
        parent::boot();

        // Event listener for creating a new record
        static::creating(function ($music) {
            $music->slug = Str::slug(str_replace(' ', '-', $music->title));
        });

        // Event listener for updating an existing record
        static::updating(function ($music) {
            $music->slug = Str::slug(str_replace(' ', '-', $music->title));
        });
    }


    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function purchasedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'purchased', 'music_id', 'user_id')->withTimestamps();
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'music_user')->withTimestamps();
    }
    
}
