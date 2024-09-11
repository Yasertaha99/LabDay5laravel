<?php

namespace App\Providers;

use App\Policies\postPolicy;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\User;

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
        Gate::define('update-post', function (Post $post, User $user) {
            return $post->creator_id === $user->id;

        });


        Gate::policy(Post::class, postPolicy::class);



    }
}
