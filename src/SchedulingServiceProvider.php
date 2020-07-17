<?php

namespace Dcat\Admin\Extension\Scheduling;

use Illuminate\Support\ServiceProvider;

class SchedulingServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $extension = Scheduling::make();

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, Scheduling::NAME);
        }

        $this->app->booted(function () use ($extension) {
            $extension->routes(__DIR__.'/../routes/web.php');
        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
