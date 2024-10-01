<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Admin::updateOrCreate(
            ['email' => 'youssef@gmail.com'],
            [
                'name' => 'يوسف السروجي',
                'email' => 'youssef@gmail.com',
                'password' => '123123123',
                'phone' => '01124684262',
                'role' => 'superadmin',
                'image' => 'images/default-image.jpeg'
            ]
        );
        Paginator::useBootstrap();
    }
}
