<?php namespace App\Acl;

abstract class ActionGuard {

    /**
     * Returns the rules for an action.
     *
     * @param $action
     * @return mixed
     */
    public function getRules($action) {
        $method = $this->getMethodName($action);

        return $this->{$method}();
    }

    /**
     * Returns the method name to get the rules.
     *
     * @param $action
     * @return string
     */
    private function getMethodName($action) {
        return "get" . camel_case(ucfirst($action)) . "ActionControlRules";
    }
}