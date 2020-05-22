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