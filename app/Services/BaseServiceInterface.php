<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseServiceInterface
 *
 * @package App\Services\Usuarios\Interfaces
 */
interface BaseServiceInterface
{
    /**
     * Lista todos os recursos.
     *
     * @param int|null $paginate
     * @return LengthAwarePaginator
     */
    public function findAll(int $paginate = null): LengthAwarePaginator;

    /**
     * Filtra recursos por parâmetros específicos.
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
    public function find(array $where, array $orWhere, int $paginate = null): LengthAwarePaginator;

    /**
     * Busca recurso por ID.
     *
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model;

    /**
     * Cadastra novo recurso.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Atualiza recurso por ID.
     *
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id): Model;

    /**
     * Deleta recurso por ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}