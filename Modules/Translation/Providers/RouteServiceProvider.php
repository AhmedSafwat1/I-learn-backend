<?php

namespace Modules\Translation\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
     protected $apiModule       = '\Modules\Translation\Http\Controllers\Api';
     protected $frontendModule  = '\Modules\Translation\Http\Controllers\Frontend';
     protected $dashboardModule = '\Modules\Translation\Http\Controllers\Dashboard';

    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(function() {

            if (File::allFiles(module_path('Translation', 'Routes/dashboard'))) {
                foreach (File::allFiles(module_path('Translation', 'Routes/dashboard')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }


    protected function mapWebRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(function() {

            if (File::allFiles(module_path('Translation', 'Routes/frontend'))) {
                foreach (File::allFiles(module_path('Translation', 'Routes/frontend')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            if (File::allFiles(module_path('Translation', 'Routes/api'))) {
                foreach (File::allFiles(module_path('Translation', 'Routes/api')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }
}
