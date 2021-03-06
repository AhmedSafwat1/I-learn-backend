<?php

namespace Modules\Learn\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class LearnServiceProvider extends ServiceProvider
{
    protected $mapPaymentGetWay = [
        "knet" => \Modules\Core\Packages\Payment\KnetPaymentService::class,
    ];
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Learn', 'Database/Migrations'));
        $this->regisetrPaymentService();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Learn', 'Config/config.php') => config_path('learn.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Learn', 'Config/config.php'), 'learn'
        );
    }
    public function regisetrPaymentService(){
       
        $this->app->singleton(
            \Modules\Core\Packages\Payment\Contract\PaymenInterface::class,
            function ($app) {
                $class =   $this->mapPaymentGetWay["knet"];
                if(isset($this->mapPaymentGetWay[(request())->payment_method])){
                    $class =   $this->mapPaymentGetWay[$this->payment_method] ;
                }
            
                return  new $class;
            }
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/learn');

        $sourcePath = module_path('Learn', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/learn';
        }, \Config::get('view.paths')), [$sourcePath]), 'learn');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/learn');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'learn');
        } else {
            $this->loadTranslationsFrom(module_path('Learn', 'Resources/lang'), 'learn');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Learn', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
