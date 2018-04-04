<?php

namespace CrCms\User\Providers;

use CrCms\Module\Providers\ModuleServiceProvider;
use CrCms\User\Listeners\Repositories\UserListener;
use CrCms\User\Repositories\UserRepository;

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
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * @return void
     */
    public function register(): void
    {
        parent::register();

        $this->mergeConfigFrom(
            $this->basePath ."config/auth.php", 'auth'
        );
    }
}