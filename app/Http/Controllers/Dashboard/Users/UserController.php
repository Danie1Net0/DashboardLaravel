<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Exceptions\TransactionException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Services\Users\Interfaces\UserServiceInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers\Dashboard\Users
 */
class UserController extends Controller
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
        $this->middleware(['auth', 'verified', 'role:admin']);
        $this->middleware(['permission:list-users'])->only('index');
        $this->middleware(['permission:create-user'])->only('store');
        $this->middleware(['permission:edit-user'])->only('edit');
        $this->middleware(['permission:update-user'])->only('update');
        $this->middleware(['permission:delete-user'])->only('delete');

        $this->userService = $userService;
    }

    /**
     * Lista todos usuários.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $users = $this->userService->filter($request->all(), $request->get('paginate'));
        $params = $request->only('search', 'paginate');

        return view('dashboard.users.index', compact('users', 'params'));
    }

    /**
     * Exibe formulário para cadastro de usuário.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.users.create');
    }

    /**
     * Cadastra novo usuário.
     *
     * @param CreateUserRequest $request
     * @return RedirectResponse
     * @throws TransactionException
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        try {
            $request->request->add(['send_verification' => true]);
            $this->userService->create($request->all());

            return redirect()->route('usuarios.index')
                ->with('success', 'Usuário cadastrado com sucesso! Uma mensagem de verificação foi enviada por e-mail');
        } catch (Exception $exception) {
            throw new TransactionException($exception->getMessage());
        }
    }

    /**
     * Exibe formulário para edição de usuário.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user = $this->userService->findById($id);
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Atualiza o usuário.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws TransactionException
     */
    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        try {
            $this->userService->update($request->all(), $id);
            return redirect()->route('usuarios.edit', $id)->with('success', 'Usuário atualizado com sucesso!');
        } catch (Exception $exception) {
            throw new TransactionException($exception->getMessage());
        }
    }

    /**
     * Deleta o usuário.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws TransactionException
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $this->userService->delete($id);
            return redirect()->route('usuarios.index')->with('success', 'Usuário deletado com sucesso!');
        } catch (Exception $exception) {
            throw new TransactionException($exception->getMessage());
        }
    }
}
