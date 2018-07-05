<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/6 6:46
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Feature;


use CrCms\Foundation\Testing\CreatesApplication;
use CrCms\User\Models\UserModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\TestCase;

class RegisterMailSendTest extends TestCase
{
    use CreatesApplication;

    public function testSend()
    {
        $user = UserModel::first();

        event(new Registered($user));
    }

}