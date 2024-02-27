<?php

namespace App\Models;

use App\Models\Beat;
use App\Models\Music;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'image'];

    protected $searchableFields = ['*'];

    public function music()
    {
        return $this->hasMany(Music::class);
    }
    public function beat()
    {
        return $this->hasMany(Beat::class);
    }

}
