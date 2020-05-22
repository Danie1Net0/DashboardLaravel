<?php

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