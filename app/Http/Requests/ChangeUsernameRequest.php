<?php

namespace LaravelFrance\Http\Requests;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Guard;
use LaravelFrance\Http\Requests\Request;

class ChangeUsernameRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Gate $gate)
    {
        return $gate->check('profile.can_change_username');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();
        return [
            'username' => ['required', 'unique:users,username,'.$user->id.',id']
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Veuillez indiquer un pseudo',
            'username.unique' => 'Ce pseudo est déjà utilisé !'
        ];
    }
}
