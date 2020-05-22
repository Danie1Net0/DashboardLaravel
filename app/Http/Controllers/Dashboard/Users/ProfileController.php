<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Exceptions\TransactionException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdatePasswordRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Services\Users\Interfaces\UserServiceInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Dashboard\Users
 */
class ProfileController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * ProfileController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->middleware(['auth', 'verified', 'permission:edit-profile']);
        $this->userService = $userService;
    }

    /**
     * Exibe formulário para edição de dados do usuário.
     *
     * @return View
     */
    public function editProfile(): View
    {
        return view('dashboard.profile.profile');
    }

    /**
     * Atualiza dados do usuário.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws TransactionException
     */
    public function updateProfile(UpdateUserRequest $request, int $id): RedirectResponse
    {
        try {
            $this->userService->update($request->all(), $id);
            return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso!');
        } catch (Exception $exception) {
            throw new TransactionException($exception->getMessage());
        }
    }

    /**
     * Exibe formulário para edição de senha.
     *
     * @return View
     */
    public function editPassword(): View
    {
        return view('dashboard.profile.password');
    }

    /**
     * Atualiza senha do usuário.
     *
     * @param UpdatePasswordRequest $request
     * @param $id
     * @return RedirectResponse
     * @throws TransactionException
     */
    public function updatePassword(UpdatePasswordRequest $request, $id): RedirectResponse
    {
        try {
            $this->userService->updatePassword($request->all(), $id);
            return redirect()->route('password.edit')->with('success', 'Senha atualizada com sucesso!');
        } catch (Exception $exception) {
            throw new TransactionException($exception->getMessage());
        }
    }
}
