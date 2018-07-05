<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/5 20:35
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Tests;


use Illuminate\Foundation\Testing\TestCase;

class AbcTest extends TestCase
{

    use \CrCms\Foundation\Testing\CreatesApplication;

    public function testTrue()
    {
        return $this->assertEquals(true,true);
    }

}