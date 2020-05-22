<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sidebar Items
    |--------------------------------------------------------------------------
    |
    | Funções e Permissões utilizadas para controle de acesso pela biblioteca
    | Spatie/Laravel-Permission.
    |
    */

    'roles_and_permissions' => [
        'admin' => [
            'list-users', 'create-user', 'edit-user', 'update-user', 'delete-user'
        ],
        'user' => [
            'edit-profile'
        ]
    ]
];