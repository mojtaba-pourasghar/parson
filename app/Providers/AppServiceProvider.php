<?php

namespace App\Providers;

use Cms\View\ThemeViewFinder;
use Cms\View\Composers;
use Composer\Composer;
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
        $this->app->singleton('theme.finder',function ($app){

            $finder = new ThemeViewFinder($app['files'],$app['config']['view.paths']);

            $config = $app['config']['cms.theme'];
            $finder->setBasePath($app['path.public'].'/'.$config['folder']);
            $finder->setActiveTheme($config['active']['front'],$config['active']['mobile'],$config['active']['back']);
            return $finder;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->setFinder($this->app['theme.finder']);
        $this->app['view']->composer(['layouts.auth','layouts.default'],Composers\AddStatusMessage::class);
        $this->app['view']->composer(['layouts.default'],Composers\AddWarningMessage::class);
        $this->app['view']->composer('layouts.default',Composers\AddAdminUser::class);
        $this->app['view']->composer('*',Composers\InjectSiteInformation::class);
        $this->app['view']->composer('*',Composers\AddSiteUser::class);
    }
}
