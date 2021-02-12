<?php

namespace Modules\Learn\Providers;


use Modules\Learn\Events\PaiedEvent;
use Modules\Learn\Events\HomeWorkSolutionEvent;
use Modules\Learn\Listeners\PaiedListener;
use Modules\Learn\Listeners\HomeWorkSolutionListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        HomeWorkSolutionEvent::Class => [
            HomeWorkSolutionListener::class
        ],

        PaiedEvent::class => [
            PaiedListener::class
        ]
        

    ];
}