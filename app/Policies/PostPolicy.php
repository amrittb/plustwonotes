<?php namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy {

    use HandlesAuthorization;

    /**
     * Determines whether the user can view the post.
     * 
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function view(User $user,Post $post) {
        return $post->isReadable();
    }

    /**
     * Determine whether the user can view the post list in backend.
     *
     * @param User|App\Models\User $user
     * @return mixed
     */
    public function viewListInBackend(User $user) {
        return $user->isNotStudentOnly();
    }

    /**
     * Determine if the user can view deleted post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function viewDeletedList(User $user) {
        return $user->hasPermission('post.destroy');
    }

    /**
     * Determine whether the user can create post.
     *
     * @param User|App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->hasPermission('post.create');
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param User|App\Models\User $user
     * @param Post|App\Models\Post $post
     * @return mixed
     */
    public function update(User $user, Post $post) {
        return $user->hasPermission('post.update') and $post->isEditableByUser($user);
    }

    /**
     * Determine if the user can draft the post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function draft(User $user, Post $post) {
        return $user->hasPermission('post.create') and $post->isDraftableByUser($user);
    }

    /**
     * Determine if the user can content ready the post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function contentready(User $user,Post $post) {
        return $user->hasPermission('post.create') and $post->isContentReadyableByUser($user);
    }

    /**
     * Determine if the user can publish the post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function publish(User $user, Post $post) {
        return $user->hasPermission('post.publish') and $post->isPublishable();
    }

    /**
     * Determine if the user can publish the post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function unpublish(User $user, Post $post) {
        return $user->hasPermission('post.publish') and $post->isUnpublishable();
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param User|App\Models\User $user
     * @param Post|App\Models\Post $post
     * @return mixed
     */
    public function destroy(User $user, Post $post) {
        return $user->hasPermission('post.destroy') and $post->isDeletableByUser($user);
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param User|App\Models\User $user
     * @param Post|App\Models\Post $post
     * @return mixed
     */
    public function restore(User $user, Post $post) {
        return $user->hasPermission('post.destroy') and $post->isRestoreableByUser($user);
    }
}
