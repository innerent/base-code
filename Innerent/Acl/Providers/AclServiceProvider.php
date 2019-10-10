<?php

namespace Innerent\Acl\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Innerent\Acl\Console\PermissionCommand;
use Innerent\Acl\Contracts\Role;
use Innerent\Acl\Models\Role as RoleModel;
use Innerent\Acl\Policies\RolePolicy;
use Innerent\Acl\Repositories\RoleRepository;
use Innerent\Foundation\Traits\HasPolicies;

class AclServiceProvider extends ServiceProvider
{
    use HasPolicies;

    protected $policies = [
        RoleModel::class => RolePolicy::class
    ];
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->registerPolicies();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->commands([
            PermissionCommand::class
        ]);

        $this->app->bind(
            Role::class,
            RoleRepository::class
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('acl.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'acl'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/acl');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/acl';
        }, \Config::get('view.paths')), [$sourcePath]), 'acl');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/acl');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'acl');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'acl');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
