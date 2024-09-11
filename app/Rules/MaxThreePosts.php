<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class MaxThreePosts implements Rule
{
    
    public function passes($attribute, $value)
    {
        $user = Auth::user();

        $postCount = Post::where('user_id', $user->id)->count();

        return $postCount < 3;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can only create up to 3 posts.';
    }
}
