<?php

return [
    [
        'name' => 'Cart details',
        'flag' => 'cart-detail.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'cart-detail.create',
        'parent_flag' => 'cart-detail.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'cart-detail.edit',
        'parent_flag' => 'cart-detail.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'cart-detail.destroy',
        'parent_flag' => 'cart-detail.index',
    ],
];
