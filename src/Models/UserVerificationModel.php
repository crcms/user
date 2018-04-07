<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-07 20:38
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Models;

use CrCms\Foundation\App\Models\Model;

/**
 * Class UserVerificationModel
 * @package CrCms\User\Models
 */
class UserVerificationModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_verification';

//    /**
//     * @var bool
//     */
//    public $timestamps = true;

    /**
     * @var string
     */
    protected $dateFormat = 'U';
}