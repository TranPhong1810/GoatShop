<?php

namespace App\Providers;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\ProvinceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $seviceBindings = [
        'App\Services\Interfaces\UserServiceInterface'=> 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface'=> 'App\Repositories\UserRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface'=> 'App\Repositories\DistrictRepository',
        'App\Repositories\Interfaces\WardRepositoryInterface'=> 'App\Repositories\WardRepository',
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach($this->seviceBindings as $key => $val){
            $this->app->bind($key, $val);
        }
        $this->app->bind(ProvinceRepositoryInterface::class, ProvinceRepository::class);
        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
