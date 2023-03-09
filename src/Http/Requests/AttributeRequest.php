<?php

namespace DnSoft\Eav\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');
        $table = 'attributes';

        return [
            'name'       => 'required',
            'slug'       => "required|unique:{$table},slug,".$id,
            'input_type' => $id ? '' : 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'       => __('eav::attribute.name'),
            'slug'       => __('eav::attribute.slug'),
            'input_type' => __('eav::attribute.input_type'),
        ];
    }
}
