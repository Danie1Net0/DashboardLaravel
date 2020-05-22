<?php

namespace App\Repositories\Users;

use App\Repositories\Users\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

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

        if (isset($params['name']))
            $query->orWhere('name', 'LIKE', "%{$params['name']}%");

        if (isset($params['email']))
            $query->orWhere('email', 'LIKE', "%{$params['email']}%");

        return $query->paginate($paginate ?? 10);
    }

    /**
     * @inheritDoc
     */
    public function find(array $where, array $orWhere = [], int $paginate = null): LengthAwarePaginator
    {
        $query = User::query();
        $where && $orWhere ? $query->where($where)->orWhere($orWhere)->get() : $query->where($where)->get();

        return $query->paginate($paginate ?? 10);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Model
    {
        return User::findOrFail($id);
    }
}