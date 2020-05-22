<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepositoryInterface
 *
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    /**
     * Lista todos os recursos.
     *
     * @param int|null $paginate
     * @return LengthAwarePaginator
     */
    public function all(int $paginate = null): LengthAwarePaginator;

    /**
     * Filtra os recursos a partir dos parâmetros informados.
     *
     * @param array $params
     * @param int|null $paginate
     * @return LengthAwarePaginator
     */
    public function filter(array $params, int $paginate = null): LengthAwarePaginator;

    /**
     * Filtra os recursos a partir dos parâmetros 'where' ou 'orWhere'.
     *
     * @param array $where
     * @param array $orWhere
     * @param int|null $paginate
     * @return LengthAwarePaginator
     */
    public function find(array $where, array $orWhere = [], int $paginate = null): LengthAwarePaginator;

    /**
     * Busca um Recurso por ID.
     *
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model;
}