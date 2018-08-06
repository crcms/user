<?php

namespace CrCms\User\Providers;

use CrCms\Foundation\App\Providers\ModuleServiceProvider;
use CrCms\User\Models\UserModel;
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

        config(['auth.providers.users.model' => UserModel::class]);

        $this->publishes([
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

        $this->app->register(\Illuminate\Auth\AuthServiceProvider::class);
        $this->app->register(\Illuminate\Auth\Passwords\PasswordResetServiceProvider::class);
        $this->app->register(LaravelServiceProvider::class);
    }
}