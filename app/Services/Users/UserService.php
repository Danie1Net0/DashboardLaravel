<?php

namespace App\Services\Users;

use App\Notifications\Auth\EmailVerificationNotification;
use App\Repositories\Users\Interfaces\UserRepositoryInterface;
use App\Services\Users\Interfaces\UserServiceInterface;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

/**
 * Class UserService
 * @package App\Services\Users
 */
class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function findAll(int $paginate = null): LengthAwarePaginator
    {
        return $this->userRepository->all($paginate);
    }

    /**
     * @inheritDoc
     */
    public function filter(array $params, int $paginate = null): LengthAwarePaginator
    {
        return $this->userRepository->filter($params, $paginate);
    }

    /**
     * @inheritDoc
     */
    public function find(array $where, array $orWhere = [], int $paginate = null): LengthAwarePaginator
    {
        return $this->userRepository->find($where, $orWhere, $paginate);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Model
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'email_verified_at' => null,
                'password' => Hash::make($data['password']),
                'avatar' => 'public/user_avatar/default.png',
            ]);

            if (isset($data['roles'])) {
                $user->assignRole($data['roles']);
                collect($data['roles'])->map(fn ($item, $key) =>
                $user->givePermissionTo(Role::findByName($item)->getPermissionNames()));
            } else {
                $user->assignRole('user');
            }

            return $user;
        });
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, int $id): Model
    {
        return DB::transaction(function () use ($data, $id) {
            $user = $this->userRepository->findById($id);

            if (isset($data['avatar'])) {
                $pathAvatar = gettype($data['avatar']) != 'string' ?
                    $pathAvatar = $this->updateAvatar($user->avatar, $data['avatar']) :
                    $pathAvatar = $data['avatar'];
            }

            $user->update([
                'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email,
                'avatar' => $pathAvatar ?? $user->avatar,
            ]);

            if (isset($data['roles']))
                $user->syncRoles($data['roles']);

            return $user;
        });
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            return User::destroy($id);
        });
    }

    /**
     * @inheritDoc
     */
    public function updateAvatar(string $currentAvatar, object $newAvatar): string
    {
        if ($currentAvatar != 'public/user_avatar/default.png')
            Storage::delete($currentAvatar);

        return Storage::put('public/user_avatar', $newAvatar);
    }


    public function updatePassword(object $data, int $id): User
    {
        return DB::transaction(function () use ($data, $id) {
            $user = $this->userRepository->findById($id);
            $user->update(['password' => Hash::make($data['password'])]);

            return $user;
        });
    }

    /**
     * @inheritDoc
     */
    public function sendVerification(Model $user): void
    {
        $user->notify(new EmailVerificationNotification());
    }
}