<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            Gate::define('access-admin', function ($user) {

              return $user->is_admin; // Checks if user is admin
            });

            Gate::define('owner-of-task', function ($user, Task $task) {
            return $task->users()->where('users.id', $user->id)->exists();
            });

            Gate::define('owner-alone', function ($user, Task $task) {
                $ownerIds = $task->users()->pluck('users.id');
                return $ownerIds->count() === 1 && $ownerIds->contains($user->id);
            });
    }
}
