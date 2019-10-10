<?php

return [
    'name' => 'Acl',

    'default_actions' => ['create', 'read', 'update', 'destroy'],

    'permissions' => [
        'role',
        'post' => [
            'actions' => ['deactivate', 'sdfs']
        ],
        'user' => [
            'actions' => ['deactivate', 'edit'],
            'strict' => true
        ],
        'plan',
        'owner',
        'contract',
        'renter',
        'property',
    ],
];
