<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-03 20:37
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\Module\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DestroyRequest
 * @package CrCms\Module\Http\Requests\Module
 */
class DestroyRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id' => trans('module::lang.module.id')
        ];
    }
}