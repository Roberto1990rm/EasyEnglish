<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Course;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
{
    View::composer(['layouts.app', 'layouts.main'], function ($view) {
        $view->with('navbarCourses', Course::with('lessons')->get());
    });
}
}
