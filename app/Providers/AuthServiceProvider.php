<?php

namespace App\Providers;

use App\Models\place;
use App\Models\resturant;
use App\Models\User;
use App\Policies\PlacePolicy;
use App\Policies\ResturantPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        place::class => PlacePolicy::class,
        resturant::class => ResturantPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        
    }
}
