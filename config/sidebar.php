<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sidebar Items
    |--------------------------------------------------------------------------
    |
    | Itens do sidebar do dashboard.
    |
    */

    'sidebar_items' => [
        [
            'title' => 'Dados Pessoais',
            'permission' => 'edit-profile',
            'icon' => 'fas fa-id-card-alt',
            'subitems' => [
                [
                    'title' => 'Perfil',
                    'icon' => 'fas fa-user-edit',
                    'route' => 'profile.edit',
                ],
                [
                    'title' => 'Senha',
                    'icon' => 'fas fa-user-lock',
                    'route' => 'password.edit',
                ]
            ]
        ],
        [
            'title' => 'Usuários',
            'role' => 'admin',
            'permission' => 'list-users',
            'icon' => 'fa fa-users-cog',
            'subitems' => [
                [
                    'title' => 'Listar',
                    'icon' => 'fas fa-stream',
                    'route' => 'home',
                ]
            ]
        ],
    ]
];