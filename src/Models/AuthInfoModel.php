<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 10:00
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Models;

use CrCms\Foundation\App\Models\Model;

/**
 * Class LoginInfoModel
 * @package CrCms\User\Models
 */
class AuthInfoModel extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $dates = ['created_at'];

    /**
     * @var string
     */
    protected $table = 'auth_info';
}