<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchTower extends FormRequest
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
        return [
            'sr_x_axis' => 'required|numeric|min:0|max:90',
            'sr_y_axis' => 'required|numeric|min:0|max:180',
            'sr_radius' => 'required|numeric',
        ];
    }
}
