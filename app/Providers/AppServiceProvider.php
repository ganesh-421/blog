<?php

namespace App\Providers;

use App\Models\User;
use App\Services\iNewsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(iNewsletter::class, function () {
            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us18'
            ]);
            return new MailchimpNewsletter($client/*, "Hello World"*/);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();
        // Model::unguard();
        Gate::define('admin', function (User $user) {
            return $user->email == "admin@gmail.com";
        });
        // to make directive directly.. (@admin)
        Blade::if('admin', function () {
            return request()->user()?->can('admin'); //question mark denotes "if request()->user() is not null" 
        });
    }
}
