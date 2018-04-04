<?php

namespace CrCms\Module\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    use RequestTrait {
        rules as _rules;
    }

    public function rules() : array
    {
        $rules = $this->_rules();
        $rules['sign'] = ['required', 'max:50', Rule::unique('modules')->ignore($this->route()->parameter('module'))];
        return $rules;
    }
}