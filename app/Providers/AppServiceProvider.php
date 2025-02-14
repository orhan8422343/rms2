<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\BasicSetting as BS;
use App\Models\Social;
use App\Models\Language;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;

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

        $socials = Social::orderBy('serial_number', 'ASC')->get();
        $langs = Language::all();

        view()->composer('*', function ($view)
        {
            if (session()->has('lang')) {
                $currentLang = Language::where('code', session()->get('lang'))->first();
            } else {
                $currentLang = Language::where('is_default', 1)->first();
            }

            $bs = $currentLang->basic_setting;
            $be = $currentLang->basic_extended;
            $activeTheme = $bs->theme;




            $apopups = $currentLang->popups()->where('status', 1)->orderBy('serial_number', 'ASC')->get();

            if (Menu::where('language_id', $currentLang->id)->count() > 0) {
                $menus = Menu::where('language_id', $currentLang->id)->first()->menus;
            } else {
                $menus = json_encode([]);
            }

            if ($currentLang->rtl == 1) {
                $rtl = 1;
            } else {
                $rtl = 0;
            }

            $view->with('activeTheme', $activeTheme );
            $view->with('bs', $bs );
            $view->with('be', $be );
            $view->with('currentLang', $currentLang );
            $view->with('apopups', $apopups);
            $view->with('menus', $menus );
            $view->with('rtl', $rtl );
        });
        View::share('langs', $langs);
        View::share('socials', $socials);
    }
}
