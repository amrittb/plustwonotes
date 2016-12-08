<?php namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use League\Fractal\TransformerAbstract;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Response as IlluminateResponse;

class TokenController extends ApiController {

    /**
     * Authenticates a user via API.
     *
     * @param Request $request
     * @return mixed
     */
    public function authenticate(Request $request) {
        try {
            if( ! $token = JWTAuth::attempt([
                    'email' => $request->input('identifier'),
                    'password' => $request->input('secret')
            ])) {
                return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)
                            ->respondWithError("Invalid Credentials.");
            }
        } catch (JWTException $e) {
            return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                        ->respondWithError("Couldn't create token.");
        }

        return $this->respond([
            'token' => $token
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
