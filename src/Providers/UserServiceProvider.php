<?php

namespace CrCms\User\Providers;

use CrCms\Foundation\App\Providers\ModuleServiceProvider;
use CrCms\User\Events\BehaviorCreatedEvent;
use CrCms\User\Events\ForgetPasswordEvent;
use CrCms\User\Events\RegisteredEvent;
use CrCms\User\Listeners\BehaviorCreatedListener;
use CrCms\User\Listeners\ForgetPasswordMailListener;
use CrCms\User\Listeners\RegisterMailListener;
use CrCms\User\Listeners\Repositories\UserBehaviorListener;
use CrCms\User\Listeners\Repositories\UserListener;
use CrCms\User\Repositories\UserBehaviorRepository;
use CrCms\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Event;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;

/**
 * Class ModuleServiceProvider
 * @package CrCms\User\Providers
 */
class UserServiceProvider extends ModuleServiceProvider
{
    /**
     * @var string
     */
    protected $basePath = __DIR__ . '/../../';

    /**
     * @var string
     */
    protected $name = 'user';

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        $this->publishes([
            $this->basePath . 'config/auth.php' => config_path('auth.php'),
            $this->basePath . 'config/config.php' => config_path("{$this->name}.php"),
            $this->basePath . 'resources/lang' => resource_path("lang/vendor/{$this->name}"),
        ]);

        $this->loadViewsFrom($this->basePath . '/resources/views', $this->name);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        parent::register();

        $this->mergeConfigFrom(
            $this->basePath . 'config/auth.php', 'auth'
        );

        $this->app->register(\Illuminate\Auth\AuthServiceProvider::class);
        $this->app->register(\Illuminate\Auth\Passwords\PasswordResetServiceProvider::class);
        $this->app->register(LaravelServiceProvider::class);
    }
}