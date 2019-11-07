<?php
namespace BrandStudio\Auth;

use Illuminate\Support\ServiceProvider;
use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Http\Middleware\MbAuthenticate;
use App;

class AuthServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->configure();
        $this->bindings();

        $this->registerMiddlewares();

        if ($this->app->runningInConsole()) {
            $this->publish();
        }
    }

    public function boot()
    {
        $this->loadRoutes();
        $this->loadResources();

        if ($this->app->runningInConsole()) {
            $this->loadMigrations();
            $this->publish();
        }
    }

    private function configure()
    {
        $this->mergeConfigFrom(__DIR__.'/config/auth.php', 'brandstudio.auth');
    }

    private function registerMiddlewares()
    {
        $this->app['router']->aliasMiddleware('mbauth', MbAuthenticate::class);
    }

    private function bindings()
    {
        $this->app->bind('brandstudio_auth',function() {
            return new AuthService(config('brandstudio.auth'));
        });
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/config/auth.php' => config_path('brandstudio/auth.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/brandstudio')
        ], 'translations');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/brandstudio')
        ], 'views');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/routes/brandstudio/' => base_path('routes/brandstudio')
        ], 'routes');
    }

    private function loadRoutes()
    {
        $path = '/routes/brandstudio/auth.php';
        $path = file_exists(base_path().$path) ? base_path().$path : __DIR__.$path;
        $this->loadRoutesFrom($path);
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/path/to/migrations');
    }

    private function loadResources()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'brandstudio');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'brandstudio');
    }
}
