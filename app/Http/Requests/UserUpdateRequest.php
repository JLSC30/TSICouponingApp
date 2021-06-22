<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$this->user->id],
            // 'password' => ['sometimes', 'required', 'confirmed', 'min:8'],
            'password' => $this->password != null ? ['sometimes', 'required', 'min:8']: [''],
            // 'password' => ['required', 'confirmed', Password::defaults()] //Used this for much secure password validation
        ];
    }
}
