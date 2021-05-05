<?php

namespace App\Providers;


use App\Models\Post;

use App\Models\Story;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
         'App\Models\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!App::runningUnitTests()) {
            Gate::define('edit_post', function (User $user, Post $post) {
                return $user->id === $post->user_id;
            });
            Gate::define('delete_post', function (User $user, Post $post) {
                return $user->id === $post->user_id;
            });

            Gate::define('delete-story', function (User $user, Story $story) {
                return $user->id === $story->user_id;
            });
        }
    }

}
