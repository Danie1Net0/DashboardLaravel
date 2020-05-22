<?php

namespace App\Http\Requests\Users;

use App\Rules\Users\PasswordVerificationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class UpdatePasswordRequest
 * @package App\Http\Requests\Users
 */
class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->hasPermissionTo('edit-profile');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'string', new PasswordVerificationRule()],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }
}
