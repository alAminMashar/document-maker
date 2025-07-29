<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreateRoutePermissionsCommand extends Command
{
    protected $signature = 'permissions:sync';
    protected $description = 'Sync application routes with permissions';

    public function handle()
    {
        $routes = Route::getRoutes();
        $permissions = collect();

        foreach ($routes as $route) {
            // Only consider named routes
            if ($route->getName()) {
                $permissions->push($route->getName());
            }
        }

        $existingPermissions = Permission::whereIn('name', $permissions)->pluck('name')->toArray();
        $newPermissions = $permissions->diff($existingPermissions);

        if ($newPermissions->isEmpty()) {
            $this->info('All permissions are already up to date.');
            return;
        }

        foreach ($newPermissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // // Remove 'route.permissions' if it exists in the database
        // $removed = Permission::where('name', 'route.permissions')->delete();

        // if ($removed) {
        //     $this->info("'route.permissions' was removed from the database.");
        // }


        $this->info(count($newPermissions) . ' new permissions created.');
    }
}
