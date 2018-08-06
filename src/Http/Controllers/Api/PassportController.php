<?php

/**
 * @author simon <simon@crcms.cn>
 * @datetime 2018-08-06 07:21
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Http\Controllers\Api;

use CrCms\Foundation\App\Handlers\JWTPassportHandler;
use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class PassportController
 * @package CrCms\User\Http\Controllers\Api
 */
class PassportController extends Controller
{
    /**
     * @param Request $request
     * @param UserRepository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request, UserRepository $repository)
    {
        $handler = new JWTPassportHandler($request, $repository);

        return $this->response->data($handler->handle());
    }
}