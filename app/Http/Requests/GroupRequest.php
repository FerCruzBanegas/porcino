<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'date'          => 'required|date_format:Y-m-d',
            'code'          => 'required',
            'location'      => 'required|integer',
            'items'         => 'required|array',
            'items.*.males' => 'required|integer',
        ];
    }
}
