<?php

namespace App\Providers;

use App\Models\Admin\Category;
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

        $categories = Category::where('parent_id', null)->get();
        view()->share('categories', $categories);

        // $ProductFlatRate = Product::pluck('flat_rate','free_shipping_status')->toArray();
        // view()->share('ProductFlatRate',$ProductFlatRate);

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
