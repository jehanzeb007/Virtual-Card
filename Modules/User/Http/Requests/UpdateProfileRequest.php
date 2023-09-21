<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;

class UpdateProfileRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'user::attributes.users';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = auth()->id();

        return [
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'username' => 'required|unique:users,username2,'.auth()->id(),
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed',
        ];
    }
}
