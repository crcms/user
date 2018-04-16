<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-05 17:34
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories\Magic;

use function CrCms\Foundation\App\Helpers\date_to_timestamp;
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
    public function byName(QueryRelate $queryRelate, string $name): QueryRelate
    {
        return $queryRelate->where('name', $name);
    }

    /**
     * @param QueryRelate $queryRelate
     * @param string $email
     * @return QueryRelate
     */
    public function byEmail(QueryRelate $queryRelate, string $email): QueryRelate
    {
        return $queryRelate->where('email', $email);
    }

    /**
     * @param QueryRelate $queryRelate
     * @param string $tel
     * @return QueryRelate
     */
    public function byTel(QueryRelate $queryRelate, string $tel): QueryRelate
    {
        return $queryRelate->where('tel', $tel);
    }

    /**
     * @param QueryRelate $queryRelate
     * @param array $dateTimes
     * @return QueryRelate
     */
    public function byCreatedAt(QueryRelate $queryRelate, array $dateTimes): QueryRelate
    {
        return $queryRelate->whereBetween('created_at', date_to_timestamp($dateTimes));
    }
}