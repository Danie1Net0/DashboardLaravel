<?php

namespace App\Services\Users\Interfaces;

use App\Services\BaseServiceInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;

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
     * @param object $data
     * @param int $id
     * @return User
     */
    public function updatePassword(object $data, int $id): User;

    /**
     * Envia verificação de cadastro por e-mail.
     *
     * @param Model $user
     */
    public function sendVerification(Model $user): void;
}