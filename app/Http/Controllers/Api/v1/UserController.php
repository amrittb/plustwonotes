<?php namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\UsersApiTransformer;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

class UserController extends ApiController{

    /**
     * Syncs Roles for the user.
     * 
     * @param Request $request
     * @return array
     */
    public function syncRoles(Request $request){
        return $this->respond([
            'message' => 'Roles synced successfully.'
        ]);
    }
    
    /**
     * Returns transformer for current resource.
     *
     * @return TransformerAbstract
     */
    protected function getTransformer() {
        return new UsersApiTransformer();
    }
}