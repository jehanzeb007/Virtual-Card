<?php

return [
    'admin.orders' => [
        'index' => 'order::permissions.index',
        'show' => 'order::permissions.show',
        'edit' => 'order::permissions.edit',
    ],
    'admin.cards' => [
        'index' => 'order::card.permissions.index',
        'show' => 'order::card.permissions.show',
        'edit' => 'order::card.permissions.edit',
        'create' => 'order::card.permissions.edit',
    ]
];
