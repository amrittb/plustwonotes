<?php namespace App\Acl;

class PostsGuard extends ActionGuard{

    /**
     * Returns create action control rules.
     *
     * @return array
     */
    public function getCreatePostActionControlRules() {
        return [
            'User:hasPermission:post.create'
        ];
    }

    /**
     * Returns Draft Action control rules.
     *
     * @return array
     */
    public function getDraftPostActionControlRules() {
        return [
            'User:hasPermission:post.create',
            'posts:isCreatedBy:#User'
        ];
    }

    /**
     * Returns edit action control rules.
     *
     * @return array
     */
    public function getEditPostActionControlRules() {
        return [
            'User:hasPermission:post.update',
            'posts:isCreatedBy:#User|User:isContentCreatorOnly'
        ];
    }

    /**
     * Returns publish action control rules.
     *
     * @return array
     */
    public function getPublishPostActionControlRules() {
        return [
            'User:hasPermission:post.publish'
        ];
    }

    /**
     * Return destroy action control rules.
     *
     * @return array
     */
    public function getDestroyPostActionControlRules() {
        return [
            'User:hasPermission:post.destroy',
            'posts:isCreatedBy:#User|User:isContentCreatorOnly'
        ];
    }

    /**
     * Returns read destroyed action control rules.
     *
     * @return array
     */
    public function getReadDestroyedPostActionControlRules() {
        return [
            'User:hasPermission:post.destroy'
        ];
    }
}