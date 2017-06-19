<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OwnersCurrentsRequest extends Request
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
            'first_name'    => 'required|min:3',
            'last_name'     => 'required|min:3',
            'phone'         => 'required',
            'cell_phone'    => 'required',
            'email'         => 'required|unique:owners_currents',
            'availability'  =>  'required|min:3'
        ];
    }
}
