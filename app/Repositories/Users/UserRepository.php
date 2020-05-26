<?php

namespace App\Repositories\Users;

use App\Repositories\Users\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        return $this->queryByUserRole()->paginate($paginate);
    }

    /**
     * @inheritDoc
     */
    public function filter(array $params, int $paginate = null): LengthAwarePaginator
    {
        $query = $this->queryByUserRole();

        if (isset($params['search'])) {
            $query->where(function (Builder $query) use ($params) {
                $query->orWhere('name', 'LIKE', "%{$params['search']}%");
                $query->orWhere('email', 'LIKE', "%{$params['search']}%");

                if (strcasecmp($params['search'], 'Ativo') == 0 || strcasecmp($params['search'], 'Inativo') == 0)
                    $query->orWhere('active', strcasecmp($params['search'], 'Ativo') == 0);

                if (strcasecmp($params['search'], 'Super-administrador') == 0 ||
                    strcasecmp($params['search'], 'Administrador') == 0 ||
                    strcasecmp($params['search'], 'Usuário') == 0)
                    $query->orWhereHas('roles', function (Builder $query) use ($params) {
                        $roleName = array_search(Str::ucfirst($params['search']), trans("role-names"));
                        $query->where('name', $roleName);
                    });
            });
        }

        return $query->paginate($paginate ?? 5);
    }

    /**
     * @inheritDoc
     */
    public function find(array $where, array $orWhere = [], int $paginate = null): LengthAwarePaginator
    {
        $query = $this->queryByUserRole();
        $where && $orWhere ? $query->where($where)->orWhere($orWhere)->get() : $query->where($where)->get();

        return $query->paginate($paginate ?? 5);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Model
    {
        $query = $this->queryByUserRole();
        $query->where('id', $id);

        if (is_null($query->first()))
            throw new ModelNotFoundException('Usuário não encontrado');


        return $query->first();
    }

    /**
     * Retorna construtor de busca baseado nas funções do usuário autenticado.
     *
     * @return Builder
     */
    private function queryByUserRole(): Builder
    {
        $query = User::query();

        $query->where('id', '<>', Auth::id());

        if (Auth::user()->hasRole('super-admin') && !Auth::user()->hasPermissionTo('list-super-admins'))
            $query->whereHas('roles', function (Builder $query) {
                $query->where('name', '<>', 'super-admin');
            });

        if (!Auth::user()->hasRole('super-admin'))
            $query->whereHas('roles', function (Builder $query) {
                $query->where('name','user');
            });

        return $query;
    }
}