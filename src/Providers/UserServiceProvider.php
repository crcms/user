<?php

namespace CrCms\User\Providers;

use CrCms\Foundation\App\Providers\ModuleServiceProvider;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Events\AuthInfoEvent;
use CrCms\User\Events\BehaviorCreatedEvent;
use CrCms\User\Events\ForgetPasswordEvent;
use CrCms\User\Events\RegisteredEvent;
use CrCms\User\Listeners\BehaviorCreatedListener;
use CrCms\User\Listeners\ForgetPasswordMailListener;
use CrCms\User\Listeners\RegisterMailListener;
use CrCms\User\Listeners\Repositories\AuthLogListener;
use CrCms\User\Listeners\Repositories\UserBehaviorListener;
use CrCms\User\Listeners\Repositories\UserListener;
use CrCms\User\Repositories\AuthLogRepository;
use CrCms\User\Repositories\UserBehaviorRepository;
use CrCms\User\Repositories\UserRepository;
use CrCms\User\Services\Behaviors\BehaviorFactory;
use CrCms\User\Services\Passwords\PasswordBroker;
use CrCms\User\Services\Passwords\PasswordBrokerManager;
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
    protected function repositoryListener(): void
    {
        UserRepository::observer(UserListener::class);
        UserBehaviorRepository::observer(UserBehaviorListener::class);
    }

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

        $this->listens();
    }

    /**
     * @return void
     */
    protected function listens()
    {
        Event::listen(RegisteredEvent::class, RegisterMailListener::class);
        Event::listen(RegisteredEvent::class, BehaviorCreatedListener::class);

        Event::listen(ForgetPasswordEvent::class, ForgetPasswordMailListener::class);

        Event::listen(BehaviorCreatedEvent::class, BehaviorCreatedListener::class);
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