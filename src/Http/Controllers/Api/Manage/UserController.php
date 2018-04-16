<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-05 16:56
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Http\Controllers\Api\Manage;

use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Http\Resources\UserResource;
use CrCms\User\Repositories\Magic\UserMagic;
use CrCms\User\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package CrCms\User\Http\Controllers\Api\Manage
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->repository = $userRepository;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $paginate = $this->repository->magic(new UserMagic($request->all()))->paginate();
        return $this->response->paginator($paginate,UserResource::class);
    }
}