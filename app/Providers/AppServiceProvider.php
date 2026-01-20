<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();

        // ห้ามลบเอาไว้เป็นตัวอย่างโค้ด
        // Blade::directive('truncate', function ($expression) {
        //     list($text, $length) = explode(',', $expression);
        //     return "<?php echo Str::limit($text, $length); ? >";
        // });

        Blade::directive('moss', function ($expression) {
            $e  = explode(',', $expression);
            $str =   '<?php
                        $ex = explode("-",' . $e[0] . ');
                        $year = $ex[0];
                        echo $year;
                    ?>';
            return $str;
        });
    }
}
