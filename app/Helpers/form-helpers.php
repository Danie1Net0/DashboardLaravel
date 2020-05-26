<?php

use Illuminate\Support\Facades\Auth;

/**
 * Retorna o nome do campo, formatando-o para validação, caso seja um array.
 * Exemplo:
 *  name='names[]' passa a ser: name='names.names'
 *
 * @param string $name
 * @return string
 */
function getName(string $name): string {
    $fieldName = $name;

    if (preg_match('/\[(.*?)\]/', $name)) {
        $fieldName = str_replace('[', '.', $name);
        $fieldName = str_replace(']', '', $fieldName);
    }

    return $fieldName;
}

/**
 * Retorna o id do campo, a partir do nome, formatando-o, caso seja um array.
 * Exemplo:
 *  name='names[]' gera o id='names'
 *
 * @param string $name
 * @return string
 */
function getId(string $name): string {
    $fieldId = $name;

    if (preg_match('/\[(.*?)\]/', $name)) {
        $fieldId = str_replace('[', '_', getName($name));
        $fieldId = str_replace(']', '', $fieldId);
    }

    return $fieldId;
}

/**
 * Verifica se o campo é do tipo 'password'.
 *
 * @param string $type
 * @param string $name
 * @param bool $notRemember
 * @return bool
 */
function isPassword(string $type, string $name, bool $notRemember = null): bool {
    return $type === 'password' || $name === 'password' || $name === 'password_confirmation' || isset($notRemember);
}

/**
 * Retorna opções "Ativo" ou "Inativo" para seleção de status.
 *
 * @return array
 */
function statusOptions(): array
{
    return [
        ['value' => '1', 'content' => 'Ativo'],
        ['value' => '0', 'content' => 'Inativo'],
    ];
}

/**
 * Retorna opções de "Roles" para cadastro de usuários.
 *
 * @return array
 */
function createUserRoleOptions(): array
{
    $roles =  [['value' => 'user', 'content' => 'Usuário']];

    if (Auth::user()->hasRole('super-admin')) {
        array_push($roles, ['value' => 'admin', 'content' => 'Administrador']);

        if (Auth::user()->hasPermissionTo('create-super-admin'))
            array_push($roles, ['value' => 'super-admin', 'content' => 'Super-administrador']);
    }

    return $roles;
}