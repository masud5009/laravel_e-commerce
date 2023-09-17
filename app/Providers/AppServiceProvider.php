<?php

namespace App\Providers;
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
        Paginator::useBootstrap();

        $mailsetting = Smtp::first();
        if ($mailsetting) {
            $data = [
                'dirver' =>  $mailsetting->transport,
                'host' =>   $mailsetting->host,
                'port' =>  $mailsetting->port,
                'encryption' => $mailsetting->encryption,
                'username' =>   $mailsetting->user_name,
                'password' =>   $mailsetting->password,
                'form' => [
                    'address' => $mailsetting->mail_from,
                    'name' => 'MCommerce',
                ],
            ];
            Config::set('mail', $data);
        }
    }
}
