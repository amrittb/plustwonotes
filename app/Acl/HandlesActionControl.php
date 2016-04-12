<?php namespace App\Acl;

use Illuminate\Http\Request;
use Illuminate\Container\BindingResolutionException;

trait HandlesActionControl {

    /**
     * Resolved parameters for action control.
     *
     * @var array
     */
    protected $resolvedParams = [];

    /**
     * Incoming Request object.
     *
     * @var \Illuminate\Http\Request $request
     */
    protected $request;

    /**
     * Handle Action Control
     *
     * @param Request $request
     * @return bool
     */
    protected function handleActionControl(Request $request) {
        $this->request = $request;

        $rules = $this->getRules($this->request);

        return $this->validateRules($rules);
    }

    /**
     * Returns the permission in array.
     *
     * @param Request $request
     * @return array
     */
    private function getRules(Request $request) {
        $actions = $request->route()->getAction();

        return array_has($actions,'acl')?$actions['acl']:'';
    }

    /**
     * Validates the rules.
     *
     * @param $rules
     * @return bool
     */
    private function validateRules($rules) {
        if (is_null($rules)) {
            return false;
        }

        foreach ($rules as $rule) {
            $flag = $this->validateRule($rule);

            if( ! $flag){
                return false;
            }
        }

        return true;
    }

    /**
     * Checks to see if a rule passes.
     *
     * @param $ruleString
     * @return bool
     */
    private function validateRule($ruleString) {
        //  Explode the rule so that we can get extra conditions for when the rule is applied.
        $subRules = explode('|',$ruleString);

        $result = false;

        //  Validate the rule until all sub rules of the rule is completed.
        while(($rule = array_pop($subRules)) != null){
            //  Explode the rule into components
            $ruleParams = $this->getRuleParams($rule);

            list($objectKey,$method) = $this->getObjectAndMethod($ruleParams);

            $result = $this->getValidatorResult($objectKey, $method, $ruleParams);

            if( ! $result && count($subRules)){
                return true;
            }
        }

        return $result;
    }

    /**
     * Returns the rule params from a rule.
     *
     * @param $rule
     * @return mixed
     */
    private function getRuleParams($rule) {
        return explode(':', $rule);
    }

    /**
     * Returns the object name and method name from the rule params.
     *
     * @param $ruleParams
     * @return array
     */
    private function getObjectAndMethod(& $ruleParams) {
        $objectKey = array_shift($ruleParams);

        $method = array_shift($ruleParams);

        return [ $objectKey, $method ];
    }

    /**
     * Returns the validator result by calling the function on the object.
     *
     * @param $objectKey
     * @param $method
     * @param $ruleParams
     * @return mixed
     */
    private function getValidatorResult($objectKey, $method, $ruleParams) {
        $object = $this->getParameter($objectKey);

        $params = $this->compileParameters($ruleParams);

        return call_user_func_array([$object, $method], $params);
    }

    /**
     * Returns parameter object.
     *
     * @param $paramString
     * @return mixed|string
     */
    private function getParameter($paramString) {
        if(array_has($this->resolvedParams,$paramString)){
            return $this->resolvedParams[$paramString];
        }

        return $this->resolveParameter($paramString);
    }

    /**
     * Resolves parameter object.
     *
     * @param $paramString
     * @return mixed|string
     * @throws BindingResolutionException
     */
    private function resolveParameter($paramString) {
        if ($paramString == "User") {
            return $this->resolvedParams["User"] = $this->request->user();
        } else {
            $resolved = $this->request->route()->getParameter($paramString);

            if($resolved == null){
                throw new BindingResolutionException("Binding for key [{$paramString}] cannot be resolved from the route");
            }

            return $this->resolvedParams[$paramString] = $resolved;
        }
    }

    /**
     * Compiles parameters to include resolved objects.
     *
     * @param $ruleParams
     * @return mixed
     */
    private function compileParameters($ruleParams) {
        foreach ($ruleParams as $key => $param) {
            // If the first character is a #, then resolve an object with the following string as a key.
            if(substr($param,0,1) == "#"){
                $param = str_replace("#","",$param);

                $ruleParams[$key] = $this->getParameter($param);
            }
        }

        return $ruleParams;
    }
}