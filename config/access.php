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
        'super-admin' => [
            'list-admins', 'create-admin', 'edit-admin', 'update-admin', 'delete-admin'
        ],
        'admin' => [
            'edit-profile',
            'list-users', 'create-user', 'edit-user', 'update-user', 'delete-user'
        ],
        'user' => [
            'edit-profile'
        ]
    ],
    'roles' => [
        // 'other_role',
    ],
    'permissions' => [
        // 'other_permission'
    ]
];