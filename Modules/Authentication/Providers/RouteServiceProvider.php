<?php

namespace Modules\Authentication\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
     protected $apiModule            = '\Modules\Authentication\Http\Controllers\Api';
     protected $frontendModule       = '\Modules\Authentication\Http\Controllers\Frontend';
     protected $dashboardModule      = '\Modules\Authentication\Http\Controllers\Dashboard';
     protected $dashboardVendordModule = '\Modules\Authentication\Http\Controllers\Vendor';



    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapDashboardRoutes();
        $this->mapDashboardVendorRoutes();
    }

    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(function() {

            if (File::allFiles(module_path('Authentication', 'Routes/dashboard'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/dashboard')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }

    protected function mapDashboardVendorRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard-vendor')
        ->namespace($this->dashboardVendordModule)->group(function() {

            if (File::allFiles(module_path('Authentication', 'Routes/vendor'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/vendor')) as $file) {
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

            if (File::allFiles(module_path('Authentication', 'Routes/frontend'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/frontend')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            if (File::allFiles(module_path('Authentication', 'Routes/api'))) {
                foreach (File::allFiles(module_path('Authentication', 'Routes/api')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }
}
