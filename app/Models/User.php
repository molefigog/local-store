<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Music;
use App\Models\Items;
use App\Models\Beat;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
// use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    // use HasSuperAdmin;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'mobile_number',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $attributes = [
        'avatar' => 'avatars/default_avatar.png',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }
    protected static function boot()
    {
        parent::boot();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address. Elliotgog')
                ->action('Verify Email Address', $url);
        });
    }
     public function musics()
    {
        return $this->belongsToMany(Music::class, 'music_user');
    }

     public function beat()
    {
        return $this->belongsToMany(Beat::class, 'beat_user');
    }
    // User.php (User model)


    public function purchasedMusic()
    {
        return $this->belongsToMany(Music::class, 'items', 'user_id', 'music_id');
    }
    public function purchasedBeat()
    {
        return $this->belongsToMany(Beat::class, 'items', 'user_id', 'music_id');
    }
    public function items()
    {
        return $this->hasMany(Items::class);
    }
    public static function search($query, $text){
		//search table record
		$search_condition = '(
				id LIKE ?  OR
				name LIKE ?  OR
				email LIKE ?  OR
				mobile_number LIKE ?  OR
				remember_token LIKE ?
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"id",
			"name",
			"email",
			"mobile_number",
			"balance",
			"role",
			"avatar"
		];
	}


	/**
     * return exportList page fields of the model.
     *
     * @return array
     */
	public static function exportListFields(){
		return [
			"id",
			"name",
			"email",
			"mobile_number",
			"balance",
			"role",
			"avatar"
		];
	}


	/**
     * return view page fields of the model.
     *
     * @return array
     */
	public static function viewFields(){
		return [
			"name",
			"email",
			"mobile_number",
			"balance",
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
			"name",
			"email",
			"mobile_number",
			"balance",
			"id"
		];
	}


	/**
     * return accountedit page fields of the model.
     *
     * @return array
     */
	public static function accounteditFields(){
		return [
			"name",
			"email",
			"mobile_number",
			"avatar",
			"id"
		];
	}


	/**
     * return accountview page fields of the model.
     *
     * @return array
     */
	public static function accountviewFields(){
		return [
			"id",
			"name",
			"email",
			"mobile_number",
			"balance"
		];
	}


	/**
     * return exportAccountview page fields of the model.
     *
     * @return array
     */
	public static function exportAccountviewFields(){
		return [
			"id",
			"name",
			"email",
			"mobile_number",
			"balance"
		];
	}


	/**
     * return edit page fields of the model.
     *
     * @return array
     */
	public static function editFields(){
		return [
			"name",
			"email",
			"mobile_number",
			"avatar",
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


	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->name;
	}

    public function UserBalance(){
		return $this->balance;
	}
}
