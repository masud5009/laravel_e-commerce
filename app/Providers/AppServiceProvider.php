<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Smtp;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $generalSetting = GeneralSetting::find(1);
        view()->share('generalSetting', $generalSetting);
        $categories = Category::limit(3)->get();
        view()->share('categories', $categories);


        Paginator::useBootstrap();

        $mailsetting = Smtp::first();
        if ($mailsetting) {
            $data = [
                'driver' =>  $mailsetting->transport,
                'host' =>   $mailsetting->host,
                'port' =>  $mailsetting->port,
                'encryption' => $mailsetting->encryption,
                'username' =>   $mailsetting->user_name,
                'password' =>   $mailsetting->password,
                'from' => [
                    'address' => $mailsetting->address,
                    'name' => 'MCommerce',
                ],
            ];
            Config::set('mail', $data);
        }
    }
}
