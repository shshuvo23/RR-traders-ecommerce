<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Let's get the route param by name to get the User object value

        $id = $this->id;
        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:admins,email,'.$id,
            // 'username' => 'required|unique:users,username,'.$user->id,
            'roles' => 'required',
            'status' => 'required',
        ];
    }
}
