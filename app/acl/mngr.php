<?php
//здесь добавляем страницы которые разрешены разным пользователям
return ['all' => ['login'],
    'mngr' => [
        'logout',
        'add',
        'editinvoice',
        'editpay',
        'chat',
        'dashboard',
        'testsite',
        'profile',
        'invoice',
        'analitics',
        'document',
        'edit',
        'underreport',
        'reportpay',
        'staffer',
        'avatar',
        'changepwd',
        'onepay',
        'onedoc',
        'del',
        'projects',
        'contragents',
        'holiday',
        'controls',
        'posts',
        'departments',
        'organization',
        'users',
        'crushtests',
        'alertusers'
    ],
    'admin' => []
];