<?php

return [
    [
        'name' => 'Carts',
        'flag' => 'cart.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'cart.create',
        'parent_flag' => 'cart.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'cart.edit',
        'parent_flag' => 'cart.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'cart.destroy',
        'parent_flag' => 'cart.index',
    ],
];
