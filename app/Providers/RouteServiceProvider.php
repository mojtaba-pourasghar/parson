<?php

namespace App\Providers;

use App\Page;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';
    public const ADMIN_DASHBORD = 'backend/dashbord';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */

    protected function mapWebRoutes()
    {
        /*Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));*/

        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/backend.php');
            $Agent = new Agent();

            if ($Agent->isMobile() || $Agent->isTablet()) {
                require base_path('routes/mobile.php');
            }else require base_path('routes/web.php');
        });

        $router = app()->make('router');
        /*  foreach (Page::all() as $page) {
              Route::get('/{'.$page->uri.'}', ['as' => $page->name, 'uses' => 'App\Http\Controllers\PagesController@show']);
          }*/
        foreach (Page::all() as $page) {
            $router->get($page->uri, ['as' => $page->title, function () use ($page, $router) {
                return $this->app->call('App\Http\Controllers\PagesController@show', [
                    'page' => $page, 'parameters' => $router->current()->parameters()
                ]);
            }]);
        }
    }
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));

        $router = app()->make('router');

        foreach (Page::all() as $page) {
            $router->get('api'.$page->uri, ['as' => $page->title, function () use ($page, $router) {
                return $this->app->call('App\Http\Controllers\Api\PagesController@show', [
                    'page' => $page, 'parameters' => $router->current()->parameters()
                ]);
            }]);
        }
    }
}
