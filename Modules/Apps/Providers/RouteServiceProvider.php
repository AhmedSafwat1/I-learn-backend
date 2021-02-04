<?php

namespace Modules\Apps\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
     protected $apiModule       = '\Modules\Apps\Http\Controllers\Api';
     protected $frontendModule  = '\Modules\Apps\Http\Controllers\Frontend';
     protected $dashboardModule = '\Modules\Apps\Http\Controllers\Dashboard';
     protected $dashboardVendordModule = '\Modules\Apps\Http\Controllers\Vendor';

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

            if (File::allFiles(module_path('Apps', 'Routes/dashboard'))) {
                foreach (File::allFiles(module_path('Apps', 'Routes/dashboard')) as $file) {
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

            if (File::allFiles(module_path('Apps', 'Routes/vendor'))) {
                foreach (File::allFiles(module_path('Apps', 'Routes/vendor')) as $file) {
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

              if (File::allFiles(module_path('Apps', 'Routes/frontend'))) {
                  foreach (File::allFiles(module_path('Apps', 'Routes/frontend')) as $file) {
                      require_once($file->getPathname());
                  }
              }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            if (File::allFiles(module_path('Apps', 'Routes/api'))) {
                foreach (File::allFiles(module_path('Apps', 'Routes/api')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }
}
