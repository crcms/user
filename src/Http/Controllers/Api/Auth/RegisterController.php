<?php

namespace CrCms\User\Http\Controllers\Api\Auth;

use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Models\UserModel;
use CrCms\User\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * @param array $data
     * @return UserModel
     */
    protected function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * @param Request $request
     * @param UserModel $user
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function registered(Request $request, UserModel $user)
    {
        $token = auth()->fromUser($user);
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
