<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // // Definir los roles
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'prestadorServicio']);

        // // Definir los permisos
        // Permission::create(['name' => 'acceder a la sección de registro']);
        // Permission::create(['name' => 'acceder a la sección de asistencia']);

        // // Asignar permisos a los roles
        // Role::findByName('admin')->givePermissionTo(['acceder a la sección de registro', 'acceder a la sección de asistencia']);
        // Role::findByName('prestadorServicio')->givePermissionTo('acceder a la sección de asistencia');
    }
}
