<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'site',
        'description',
        'tagline',
        'logo',
        'favicon',
        'image',
    ];

    protected $searchableFields = ['*'];
}
