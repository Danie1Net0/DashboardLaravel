<?php

namespace App\Services\Users\Interfaces;

use App\Services\BaseServiceInterface;
use App\User;

/**
 * Interface UsuarioServiceInterface
 *
 * @package App\Services\Usuarios\Interfaces
 */
interface UserServiceInterface extends BaseServiceInterface
{
    /**
     * Atualiza avatar do usuário
     *
     * @param string $currentAvatar
     * @param object $newAvatar
     * @return string
     */
    public function updateAvatar(string $currentAvatar, object $newAvatar): string;

    /**
     * Atualiza senha do usuário.
     *
     * @param array $data
     * @param int $id
     * @return User
     */
    public function updatePassword(array $data, int $id): User;
}