<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="описание"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-table/bootstrap-table.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-toggle/css/bootstrap-toggle.css" rel="stylesheet" type="text/css" />
    <!-- Быстрое редактирование -->
    <link href="/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <link href="/assets/global/plugins/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <link href="/assets/global/plugins/bootstrap-fileinput/css/fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-fileinput/themes/explorer/theme.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/layout2/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/assets/layouts/layout2/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link href="/assets/pages/css/login-2.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" />

    <script src="/public/scripts/jguery.js"></script>
    <script src="/public/scripts/form.js"></script>
    <title><?php echo $title; ?></title>
</head>
<?php
    if($this->route['action'] != 'login'){
        $classBody = 'page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed';
    }else{
        $classBody = 'login';
}?>
<body class="<?php echo $classBody;?>">

<?php if($this->route['action'] != 'login'): ?>

<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="/">
                <img src="/public/images/logos/<?php echo $imageLogo;?>" height="34.4" alt="logo" class="logo-default" style="margin: 20px 0 0;"/>
            </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!--<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default"> 1 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3><span class="bold">1 событие</span></h3>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">just now</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!--<li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="/public/images/ava/mixa-ava.jpg" />
                            <span class="username username-hide-on-mobile"> Михаил </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="#"><i class="icon-user"></i> Профиль </a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-calendar"></i> Календарь </a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-envelope-open"></i> Входящие
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-rocket"></i> Задачи
                                    <span class="badge badge-success"> 7 </span>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- END USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <a href="/admin/logout" style="padding: 0;" title="Выход"><i class="icon-logout"></i></a>

                    </li>
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- END SIDEBAR -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-hover-submenu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item <?php if($this->route['action']=='table'){echo 'active open';}?>">
                    <a href="/admin/table" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">Пользователи</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item <?php if($this->route['action']=='add'){echo 'active open';}?>">
                    <a href="/admin/add" class="nav-link nav-toggle">
                        <i class="icon-user-follow"></i>
                        <span class="title">Добавить пользователя</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item <?php if($this->route['action']=='organization'){echo 'active open';}?>">
                    <a href="/admin/organization" class="nav-link nav-toggle">
                        <i class="icon-pie-chart"></i>
                        <span class="title">Организации</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item <?php if($this->route['action']=='departments'){echo 'active open';}?>">
                    <a href="/admin/departments" class="nav-link nav-toggle">
                        <i class="icon-directions"></i>
                        <span class="title">Отделы</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item <?php if($this->route['action']=='posts'){echo 'active open';}?>">
                    <a href="/admin/posts" class="nav-link nav-toggle">
                        <i class="icon-briefcase"></i>
                        <span class="title">Должности</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item <?php if($this->route['controls']=='posts'){echo 'active open';}?>">
                    <a href="/admin/controls" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Управление</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
<?php endif ?>

<?php echo $content; ?>

<?php if($this->route['action'] != 'login'): ?>

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2018 &copy; Все права защищены
        <a target="_blank" href="http://1kwt.com">MOTOR</a>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->

    <!-- BEGIN CORE PLUGINS -->
    <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery.cookie.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/assets/global/plugins/moment.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-table/bootstrap-table.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-table/extensions/cookie/bootstrap-table-cookie.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-table/bootstrap-table-ru-RU.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-toggle/js/bootstrap-toggle.js" type="text/javascript"></script>

    <script src="/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="/assets/global/plugins/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/js/locales/ru.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/themes/explorer/theme.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/js/plugins/purify.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="/public/scripts/fileinput/scriptLogoinput.js" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/pages/scripts/table-bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/form-validation-md.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="/assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
    <script src="/assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
    <script src="/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
<?php endif;?>

</body>
</html>


