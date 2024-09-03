<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Auth\Access\Response;

class BlogPostPolicy
{
    /**
     * Determine whether the user can update the blog post.
     */
    public function update(User $user, BlogPost $blogPost): Response
    {
        return $user->id === $blogPost->user_id
                    ? Response::allow()
                    : Response::deny('You do not own this blog post.');
    }

    /**
     * Determine whether the user can delete the blog post.
     */
    public function delete(User $user, BlogPost $blogPost): Response
    {
        return $user->id === $blogPost->user_id
                    ? Response::allow()
                    : Response::deny('You do not own this blog post.');
    }
}
