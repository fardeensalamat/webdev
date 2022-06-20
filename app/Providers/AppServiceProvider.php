<?php

namespace App\Providers;

use App\Models\Page;
use Laravel\Passport\Passport;
use App\Models\WebsiteParameter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Passport::routes();

        view()->share('menupages', Page::orderBy('page_title')->take(4)->whereActive(true)->whereListInMenu(true)->get());
        
        $websiteParameter = WebsiteParameter::latest()->first();
        view()->share('websiteParameter', $websiteParameter);

    }
}
