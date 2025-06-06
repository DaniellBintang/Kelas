<?php
// app/Providers/RatingServiceProvider.php

namespace App\Providers;

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RatingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Create a Blade directive for star ratings
        Blade::directive('stars', function ($expression) {
            return "<?php echo App\Http\Controllers\RatingController::getStarRating($expression); ?>";
        });
    }
}
