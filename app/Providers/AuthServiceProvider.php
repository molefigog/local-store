<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Owner;
use App\Models\Setting;
use App\Models\User;
use App\Models\Product;
use App\Models\Music;
use App\Policies\OwnerPolicy;
use App\Policies\SettingPolicy;
use App\Policies\UserPolicy;
use App\Policies\ProductPolicy;
use App\Policies\MusicPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Owner::class => OwnerPolicy::class,
        Setting::class => SettingPolicy::class,
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Music::class => MusicPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            // If the user is a super admin, grant all abilities.
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}
