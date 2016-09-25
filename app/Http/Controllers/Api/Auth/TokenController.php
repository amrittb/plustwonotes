<?php namespace App\Http\Controllers\Api\Auth;

use League\Fractal\Manager;
use Tymon\JWTAuth\Facades\JWTAuth;
use League\Fractal\TransformerAbstract;
use App\Http\Controllers\Api\ApiController;

class TokenController extends ApiController {

    /**
     * AuthTokenController constructor.
     *
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal){
        parent::__construct($fractal);

        $this->middleware('web',['only' => 'getAuthToken']);
        $this->middleware('auth:web',['only' => 'getAuthToken']);
    }

    /**
     * Returns JWT Auth Token.
     *
     * @return mixed
     */
    public function getAuthToken() {
        $token = JWTAuth::fromUser(\Auth::user());

        return $this->respond([
            '_token' => $token,
        ]);
    }

    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    protected function getTransformer() {
        return null;
    }
}