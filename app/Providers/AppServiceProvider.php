<?php

namespace App\Providers;

use App\Models\Backend\Category;
use App\Models\Frontend\VideoUpload;
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
        // $categories = Category::take(4)->get();
        // view()->share('categories', $categories);

        $cats = VideoUpload::with('category')->get()->unique('category_id')->take(4);
        view()->share('cats', $cats);

        Paginator::useBootstrap();
    }
}
