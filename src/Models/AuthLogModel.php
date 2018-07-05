<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/5 21:43
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Models;

use CrCms\Foundation\App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthLogModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'auth_logs';

    /**
     * @return BelongsTo
     */
    public function belongsToUser(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }
    
}