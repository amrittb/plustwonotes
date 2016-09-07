<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller {

	/**
	 * UserRepository instance.
	 *
	 * @var UserRepositoryInterface
	 */
	private $users;

	/**
	 * Create a UserController instance.
	 *
	 * @param UserRepositoryInterface $users
	 */
	public function __construct(UserRepositoryInterface $users){
		$this->users = $users;

		$this->middleware('auth',['except' => 'show']);

        $this->bindAuthorizationMiddlewares();
	}

    /**
     * Binds Authorization middlewares.
     *
     * @return void
     */
    private function bindAuthorizationMiddlewares() {
        $this->middleware('can:view,users', ['only' => 'show']);
        $this->middleware('can:update,users', ['only' => ['edit', 'update']]);
        $this->middleware('can:viewList,App\Models\User', ['only' => 'index']);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$users = $this->users->allActive();

		return view('users.index',compact('users'));
	}

    /**
	 * Display the specified resource.
	 *
	 * @param User $user
	 * @return Response
	 */
	public function show(User $user) {
		return view('users.show',compact('user'));
	}

    /**
	 * Show the form for editing the specified resource.
	 *
	 * @param User $user
	 * @return Response
	 */
	public function edit(User $user) {
		return view('users.edit',compact('user'));
	}

    /**
	 * Update the specified resource in storage.
	 *
	 * @param User $user
	 * @param UpdateUserRequest $userRequest
	 * @return Response
	 */
	public function update(User $user, UpdateUserRequest $userRequest) {
		$result = $this->users->updateUser($userRequest->all(),$user);

		if($result) {
			return redirect()->back()->with('message','User Updated!');
		} else {
			return redirect()->back()->withInput()->with('message','Something went wrong!');
		}
	}
}
