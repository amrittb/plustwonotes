<?php namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\UsersApiTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

class UserController extends ApiController{

    /**
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $users
     * @param Manager $fractal
     */
    public function __construct(UserRepositoryInterface $users,Manager $fractal){
        parent::__construct($fractal);

        $this->users = $users;
    }

    /**
     * Syncs Roles for the user.
     *
     * @param User $user
     * @param Request $request
     * @return array
     */
    public function syncRoles(User $user,Request $request){
        $result = $this->users->syncRoles($user,$request->get('roleIds'));

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