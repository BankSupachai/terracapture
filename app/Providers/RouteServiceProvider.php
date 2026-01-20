<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::prefix('recorder')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/recorder.php'));

            Route::prefix('lumina')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/lumina.php'));

            Route::prefix('admin')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            Route::prefix('terra')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/terra.php'));

            Route::prefix('book')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/book.php'));

            Route::prefix('mockup')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/mockup.php'));

            Route::prefix('tablet')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/tablet.php'));

            Route::prefix('track')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/track.php'));

            Route::prefix('master')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/master.php'));

            Route::prefix('test')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/test.php'));

            Route::prefix('mongodb')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/mongodb.php'));

            Route::prefix('auth')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/auth.php'));

            Route::prefix('mobile')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/mobile.php'));

            Route::prefix('note')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/note.php'));

            Route::prefix('migration')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/migration.php'));

            Route::prefix('screening')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/screening.php'));

            Route::prefix('capture')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/capture.php'));
                

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
