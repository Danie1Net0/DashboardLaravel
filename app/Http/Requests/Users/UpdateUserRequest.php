<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Users
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->hasAnyPermission(['edit-profile', 'edit-user']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'avatar' => ['nullable', 'file', 'max:3072', 'image'],
            'active' => ['nullable', 'boolean']
        ];
    }
}
