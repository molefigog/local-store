<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RyanChandler\Comments\Concerns\HasComments;

class Music extends Model
{
    use HasFactory;
    use Searchable;
    use HasComments;


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
	public static function search($query, $text){
		//search table record
		$search_condition = '(
				artist LIKE ?  OR
				title LIKE ?  OR
				amount LIKE ?  OR
				id LIKE ?  OR
				demo LIKE ?  OR
				description LIKE ?  OR
				duration LIKE ?  OR
				size LIKE ?  OR
				slug LIKE ?
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}


	/**
     * return list page fields of the model.
     *
     * @return array
     */
	public static function listFields(){
		return [
			"artist",
			"title",
			"amount",
			"image",
			"file",
			"downloads",
			"id"
		];
	}


	/**
     * return exportList page fields of the model.
     *
     * @return array
     */
	public static function exportListFields(){
		return [
			"artist",
			"title",
			"amount",
			"image",
			"file",
			"downloads",
			"id"
		];
	}


	/**
     * return view page fields of the model.
     *
     * @return array
     */
	public static function viewFields(){
		return [
			"genre_id",
			"artist",
			"title",
			"amount",
			"image",
			"file",
			"downloads",
			"id"
		];
	}


	/**
     * return exportView page fields of the model.
     *
     * @return array
     */
	public static function exportViewFields(){
		return [
			"genre_id",
			"artist",
			"title",
			"amount",
			"image",
			"file",
			"downloads",
			"id"
		];
	}


	/**
     * return edit page fields of the model.
     *
     * @return array
     */
	public static function editFields(){
		return [
			"genre_id",
			"artist",
			"title",
			"amount",
			"image",
			"demo",
			"file",
			"description",
			"duration",
			"size",
			"downloads",
			"md",
			"slug",
			"id"
		];
	}


	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = true;
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

}
