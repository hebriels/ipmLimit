<?php
//здесь добавляем страницы которые разрешены разным пользователям
return ['all' => ['login'],
    'mngr' => [],
    'admin' => ['logout', 'add', 'edit', 'del', 'table', 'departments', 'posts', 'organization', 'controls']
];