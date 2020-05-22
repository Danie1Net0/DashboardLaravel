<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Users\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Validation\Validator as ValidatorRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return ValidatorRules
     */
    protected function validator(array $data): ValidatorRules
    {
        $rules = (new CreateUserRequest())->rules();
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Model
     */
    protected function create(array $data)
    {
        return $this->userService->create($data);
    }
}
