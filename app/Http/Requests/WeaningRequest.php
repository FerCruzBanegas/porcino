<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeaningRequest extends FormRequest
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
            'reproducer' => 'required|numeric',
            'date'       => 'required|date_format:Y-m-d',
            'quantity'   => 'required|numeric',
            'weight'     => 'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'average'    => 'max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
        ];
    }
}
