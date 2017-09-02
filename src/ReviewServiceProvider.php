<?php

namespace Viviniko\Review;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Viviniko\Review\Console\Commands\ReviewTableCommand;

class ReviewServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/review.php' => config_path('review.php'),
        ]);

        // Register commands
        $this->commands('command.review.table');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/review.php', 'review');

        $this->registerReviewService();

        $this->registerCommands();
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.review.table', function ($app) {
            return new ReviewTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the user service provider.
     *
     * @return void
     */
    protected function registerReviewService()
    {
        $this->app->singleton(
            \Viviniko\Review\Contracts\ReviewService::class,
            \Viviniko\Review\Services\Review\EloquentReview::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            \Viviniko\Review\Contracts\ReviewService::class,
        ];
    }
}