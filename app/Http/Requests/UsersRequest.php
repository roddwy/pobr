<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
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
            'first_name'    =>  'required|min:2',
            'last_name'     =>  'required|min:2',
            'ci'            =>  'unique:users|required|min:2',
            'phone'         =>  'unique:users|required|min:2',
            'cell_phone'    =>  'unique:users|required|min:2',
            'email'         =>  'unique:users|required|min:2',
            'type_user_id'  =>  'required',
        ];
    }
}
