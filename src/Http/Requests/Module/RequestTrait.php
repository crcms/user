<?php

namespace CrCms\Module\Http\Requests\Module;

use Illuminate\Validation\Rule;

/**
 * Trait RequestTrait
 * @package CrCms\Module\Http\Requests\Module
 */
trait RequestTrait
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'sign' => ['required', 'max:50', Rule::unique('modules')],
            'namespace' => ['required', 'max:150'],
            'status' => ['required', 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => trans('module::lang.module.name'),
            'sign' => trans('module::lang.module.sign'),
            'namespace' => trans('module::lang.module.namespace'),
            'status' => trans('module::lang.module.status'),
        ];
    }
}