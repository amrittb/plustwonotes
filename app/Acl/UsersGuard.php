<?php namespace App\Acl;

class UsersGuard extends ActionGuard{

    /**
     * Returns post list action control.
     * 
     * @return array
     */
    public function getListPostActionControlRules() {
        return [
            'User:isNotStudentOnly'
        ];
    }

    /**
     * Returns user list action control rules.
     *
     * @return array
     */
    public function getListUserActionControlRules() {
        return [
            'User:hasPermission:user.list'
        ];
    }

    /**
     * Returns user edit action control rules.
     *
     * @return array
     */
    public function getEditUserActionControlRules() {
        return [
            'users:isLoggedIn'
        ];
    }
}