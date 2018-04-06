<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-05 17:34
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories\Magic;

use CrCms\Repository\AbstractMagic;
use CrCms\Repository\Contracts\QueryRelate;

/**
 * Class UserMagic
 * @package CrCms\User\Repositories\Magic
 */
class UserMagic extends AbstractMagic
{
    /**
     * @param QueryRelate $queryRelate
     * @param string $name
     * @return QueryRelate
     */
    public function byName(QueryRelate $queryRelate,string $name): QueryRelate
    {
        return $queryRelate->where('name',$name);
    }

}