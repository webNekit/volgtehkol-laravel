<?php

namespace App\Providers;

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
        $this->loadViewsFrom(base_path('resources/views/web/home'), 'home');
        $this->loadViewsFrom(base_path('resources/views/web/info'), 'info');
        $this->loadViewsFrom(base_path('resources/views/web/college'), 'college');
        $this->loadViewsFrom(base_path('resources/views/web/abiturients'), 'abiturients');
        $this->loadViewsFrom(base_path('resources/views/web/students'), 'students');
        $this->loadViewsFrom(base_path('resources/views/web/additional_education'), 'additional_education');
        $this->loadViewsFrom(base_path('resources/views/web/news'), 'news');
        $this->loadViewsFrom(base_path('resources/views/web/events'), 'events');
        $this->loadViewsFrom(base_path('resources/views/web/docs'), 'docs');
        $this->loadViewsFrom(base_path('resources/views/web/staff'), 'staff');
        $this->loadViewsFrom(base_path('resources/views/web/specials'), 'specials');
        $this->loadViewsFrom(base_path('resources/views/web/contacts'), 'contacts');
    }
}
