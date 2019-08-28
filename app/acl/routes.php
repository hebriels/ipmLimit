<?php
return [
    //MainController
    '' => ['controller' => 'main', 'action' => 'index'],
    //ManagerController
    'mngr/login' => ['controller' => 'mngr', 'action' => 'login'],
    'mngr/logout' => ['controller' => 'mngr', 'action' => 'logout'],
    'mngr/add' => ['controller' => 'mngr', 'action' => 'add'],
    'mngr/editinvoice/{id:\d+}' => ['controller' => 'mngr', 'action' => 'editinvoice'],
    'mngr/editpay/{id:\d+}' => ['controller' => 'mngr', 'action' => 'editpay'],
    'mngr/staffer/{id:\d+}' => ['controller' => 'mngr', 'action' => 'staffer'],
    'mngr/dashboard' => ['controller' => 'mngr', 'action' => 'dashboard'],
    'mngr/testsite' => ['controller' => 'mngr', 'action' => 'testsite'],
    'mngr/profile' => ['controller' => 'mngr', 'action' => 'profile'],
    'mngr/avatar' => ['controller' => 'mngr', 'action' => 'avatar'],
    'mngr/changepwd' => ['controller' => 'mngr', 'action' => 'changepwd'],
    'mngr/invoice' => ['controller' => 'mngr', 'action' => 'invoice'],
    'mngr/analitics' => ['controller' => 'mngr', 'action' => 'analitics'],
    'mngr/analitics/project{project:\d+}' => ['controller' => 'mngr', 'action' => 'analitics'],
    'mngr/analitics/contragent{contragent:\d+}' => ['controller' => 'mngr', 'action' => 'analitics'],
    'mngr/document' => ['controller' => 'mngr', 'action' => 'document'],
    'mngr/edit/{id:\d+}' => ['controller' => 'mngr', 'action' => 'edit'],
    'mngr/underreport' => ['controller' => 'mngr', 'action' => 'underreport'],
    'mngr/onepay/{id:\d+}' => ['controller' => 'mngr', 'action' => 'onepay'],
    'mngr/onedoc/{id:\d+}' => ['controller' => 'mngr', 'action' => 'onedoc'],
    'mngr/reportpay/{id:\d+}' => ['controller' => 'mngr', 'action' => 'reportpay'],
    'mngr/del/{id:\d+}' => ['controller' => 'mngr', 'action' => 'del'],
    'mngr/projects' => ['controller' => 'mngr', 'action' => 'projects'],
    'mngr/contragents' => ['controller' => 'mngr', 'action' => 'contragents'],
    'mngr/holiday' => ['controller' => 'mngr', 'action' => 'holiday'],
    'mngr/controls' => ['controller' => 'mngr', 'action' => 'controls'],
    'mngr/posts' => ['controller' => 'mngr', 'action' => 'posts'],
    'mngr/departments' => ['controller' => 'mngr', 'action' => 'departments'],
    'mngr/organization' => ['controller' => 'mngr', 'action' => 'organization'],
    'mngr/users' => ['controller' => 'mngr', 'action' => 'users'],
    'mngr/crushtests' => ['controller' => 'mngr', 'action' => 'crushtests'],
    'mngr/alertusers' => ['controller' => 'mngr', 'action' => 'alertusers'],
    //AdminController
    'admin/login' => ['controller' => 'admin', 'action' => 'login'],
    'admin/logout' => ['controller' => 'admin', 'action' => 'logout'],
    'admin/add' => ['controller' => 'admin', 'action' => 'add'],
    'admin/table' => ['controller' => 'admin', 'action' => 'table'],
    'admin/departments' => ['controller' => 'admin', 'action' => 'departments'],
    'admin/posts' => ['controller' => 'admin', 'action' => 'posts'],
    'admin/organization' => ['controller' => 'admin', 'action' => 'organization'],
    'admin/controls' => ['controller' => 'admin', 'action' => 'controls'],
    'admin/edit/{id:\d+}' => ['controller' => 'admin', 'action' => 'edit'],
    'admin/del/{id:\d+}' => ['controller' => 'admin', 'action' => 'del'],
    //AjaxController
    'ajax/ajaxpost' => ['controller' => 'ajax','action' => 'ajaxpost']
];