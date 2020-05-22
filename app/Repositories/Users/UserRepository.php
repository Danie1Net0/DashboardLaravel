<?php

namespace App\Repositories\Users;

use App\Repositories\Users\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 * @package App\Repositories\Users
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(int $paginate = null): LengthAwarePaginator
    {
        return User::paginate($paginate);
    }

    /**
     * @inheritDoc
     */
    public function filter(array $params, int $paginate = null): LengthAwarePaginator
    {
        $query = User::query();
        $query->where('id', '<>', Auth::id());

        if (isset($params['search'])) {
            $query->where('name', 'LIKE', "%{$params['search']}%");
            $query->orWhere('email', 'LIKE', "%{$params['search']}%");
        }

        return $query->paginate($paginate ?? 5);
    }

    /**
     * @inheritDoc
     */
    public function find(array $where, array $orWhere = [], int $paginate = null): LengthAwarePaginator
    {
        $query = User::query();
        $where && $orWhere ? $query->where($where)->orWhere($orWhere)->get() : $query->where($where)->get();

        return $query->paginate($paginate ?? 5);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Model
    {
        return User::findOrFail($id);
    }
}