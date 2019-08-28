<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="описание"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            //google: {"families":["Roboto:300,400,500,600,700"]},
            google: {"families":["Exo+2:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;}});
    </script>

    <link href="/assets/vendors/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

    <link href="/assets/vendors/plugins/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="/assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />-->
    <link href="/assets/vendors/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <?php if($this->route['action'] == 'add' || $this->route['action'] == 'editinvoice' || $this->route['action'] == 'editpay' || $this->route['action'] == 'profile' || $this->route['action'] == 'controls'):?>
        <link href="/assets/vendors/plugins/bootstrap-fileinput/css/fileinput.css" rel="stylesheet" type="text/css" />
        <link href="/assets/vendors/plugins/bootstrap-fileinput/themes/explorer-fas/theme.css" rel="stylesheet" type="text/css" />
    <?php endif;?>

    <!--<link href="/assets/global2/plugins/morris/morris.css" rel="stylesheet" type="text/css" />-->
    <?php if($this->route['action'] == 'onedoc'): ?>
        <link href="/assets/vendors/plugins/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />
    <?php endif;?>
    <?php if($this->route['action'] == 'dashboard' ||
        $this->route['action'] == 'document' ||
        $this->route['action'] == 'analitics' ||
        $this->route['action'] == 'projects' ||
        $this->route['action'] == 'contragents' ||
        $this->route['action'] == 'holiday' ||
        $this->route['action'] == 'staffer' ||
        $this->route['action'] == 'controls' ||
        $this->route['action'] == 'posts' ||
        $this->route['action'] == 'departments' ||
        $this->route['action'] == 'organization' ||
        $this->route['action'] == 'users' ||
        $this->route['action'] == 'onepay' ||
        $this->route['action'] == 'onedoc'): ?>
        <link href="/assets/vendors/plugins/bootstrap-table/bootstrap-table.css" rel="stylesheet" type="text/css" />
        <link href="/assets/vendors/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.css" rel="stylesheet" type="text/css" />
        <link href="/assets/vendors/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
    <?php endif;?>

    <link href="/assets/vendors/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
    <!--<link href="/assets/global2/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />-->

<?php if($this->route['action'] == 'dashboard' || $this->route['action'] == 'document' || $this->route['action'] == 'analitics'): ?>
    <link href="/assets/vendors/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
    <!--<link href="/assets/vendors/plugins/dataTables-1.10.18/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />-->
<?php endif;?>
<?php if($this->route['action'] == 'controls' ||
    $this->route['action'] == 'posts' ||
    $this->route['action'] == 'alertusers' ||
    $this->route['action'] == 'organization' ||
    $this->route['action'] == 'users' ||
    $this->route['action'] == 'departments'):?>
    <link href="/assets/vendors/plugins/x-editable/bootstrap-editable.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/jsTree/themes/default/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<?php endif;?>
<?php if($this->route['action'] == 'login' || $this->route['action'] == 'index'):?>
    <link href="/assets/css/login.css" rel="stylesheet" type="text/css" />
<?php endif;?>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/favicon.ico" />

    <script src="/assets/vendors/plugins/jquery/dist/jquery.js"></script>
<?php //if($this->route['action'] != 'analitics'):?>
    <!--<script src="/public/scripts/form2.js"></script>-->
<?php //endif;?>
    <title><?php echo $title; ?></title>
    <link rel="canonical" href="/" />
    <meta property="og:title" content="SAMA IPM" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://ipm2.samaprof.ru" />
    <meta property="og:image" content="http://ipm2.samaprof.ru/assets/images/logos/logo250x250.jpg" />
    <meta property="og:image:width" content="250" />
    <meta property="og:image:height" content="250" />
    <meta property="og:site_name" content="SAMA IPM" />
    <meta property="og:description" content="Система контроля проектов" />
</head>
<?php
    if($this->route['action'] != 'login' && $this->route['action'] != 'index'){
        $classBody = 'kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading';
    }else{
        $classBody = 'kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading';
    }
?>
<body class="<?php echo $classBody;?>">
<?php if($this->route['action'] != 'login' && $this->route['action'] != 'index'): ?>

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="javascript:;">
                <img alt="Logo" height="35" src="/assets/images/logos/<?php echo $defaultDownload['imageLogo'];?>" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon2-user"></i></button>
        </div>
    </div>
    <!-- end:: Header Mobile -->

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->
        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

            <!-- begin:: Aside -->
            <div class="kt-aside__brand kt-grid__item" id="kt_aside_brand">
                <div class="kt-aside__brand-logo">
                    <a href="javascript:;">
                        <img alt="Logo" height="35" src="/assets/images/logos/<?php echo $defaultDownload['imageLogo'];?>" />
                    </a>
                </div>
            </div>
            <!-- end:: Aside -->

            <!-- Меню -->
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
                    <ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if($this->route['action']=='dashboard'){echo 'kt-menu__item--active';}?>" aria-haspopup="true">
                            <a href="/mngr/dashboard" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-architecture-and-city"></i>
                                <span class="kt-menu__link-text">Главная</span>
                            </a>
                        </li>
                        <li class="kt-menu__item <?php if($this->route['action']=='document'){echo 'kt-menu__item--active';}?>" aria-haspopup="true">
                            <a href="/mngr/document" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-document"></i>
                                <span class="kt-menu__link-text">Документы</span>
                            </a>
                        </li>
                        <li class="kt-menu__item <?php if($this->route['action']=='add'){echo 'kt-menu__item--active';}?>" aria-haspopup="true">
                            <a href="/mngr/add" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-add-circular-button"></i>
                                <span class="kt-menu__link-text">Добавить</span>
                            </a>
                        </li>
                        <?php if(!empty($defaultDownload['allowedListUsers'][0]['from_Statistic'])):?>
                            <li class="kt-menu__item <?php if($this->route['action']=='analitics'){echo 'kt-menu__item--active';}?>" aria-haspopup="true">
                                <a href="/mngr/analitics" class="kt-menu__link ">
                                    <i class="kt-menu__link-icon flaticon2-analytics-2"></i>
                                    <span class="kt-menu__link-text">Аналитика</span>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php /*if($modulePay=='true'):*/?><!--
                            <li class="kt-menu__item <?php /*if($this->route['action']=='underreport'){echo 'kt-menu__item--active';}*/?>" aria-haspopup="true">
                                <a href="/mngr/underreport" class="kt-menu__link ">
                                    <i class="kt-menu__link-icon flaticon2-sheet"></i>
                                    <span class="kt-menu__link-text">Подотчет</span>
                                </a>
                            </li>
                        --><?php /*endif;*/?>
                        <li class="kt-menu__item <?php if($this->route['action']=='projects'){echo 'kt-menu__item--active';}?>" aria-haspopup="true">
                            <a href="/mngr/projects" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-indent-dots"></i>
                                <span class="kt-menu__link-text">Проекты</span>
                            </a>
                        </li>
                        <li class="kt-menu__item <?php if($this->route['action']=='contragents'){echo 'kt-menu__item--active';}?>" aria-haspopup="true">
                            <a href="/mngr/contragents" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-files-and-folders"></i>
                                <span class="kt-menu__link-text">Контрагенты</span>
                            </a>
                        </li>
                        <?php if($defaultDownload['userControlHoliday']=='true'):?>
                            <li class="kt-menu__item <?php if($this->route['action']=='holiday'){echo 'kt-menu__item--active';}?>" aria-haspopup="true">
                                <a href="/mngr/holiday" class="kt-menu__link ">
                                    <i class="kt-menu__link-icon flaticon2-group"></i>
                                    <span class="kt-menu__link-text">Отпуска</span>
                                </a>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <!-- #Меню -->

        </div>
        <!-- end:: Aside -->

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                <!-- Header Левое меню -->
                <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">
                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item  kt-menu__item--active" id="clickImprovement" aria-haspopup="true">
                                <a href="javascript:void(0)" class="kt-menu__link ">
                                    <span class="kt-menu__link-text">Улучшайзер</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- #Header Левое меню -->

                <!-- Header Правое меню -->
                <div class="kt-header__topbar">

                    <!-- Уведомления -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" data-placement="right">
                        <span class="kt-header__topbar-icon kt-userpic--circle" style="border-radius: 50%;" id="kt_quick_panel_toggler_btn">
                            <i class="flaticon2-bell-alarm-symbol"></i>
                        </span>
                        <!--<span class="kt-badge kt-badge--danger kt-badge--md count-notice"></span>-->
                    </div>
                    <!-- #Уведомления -->

                    <!-- Меню пользователя -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile"><?php if(isset($_SESSION['mngr'])){echo $_SESSION['mngr']['userSurname'].' '. $_SESSION['mngr']['userFirstName'];}?></span>
                                <img alt="ava" src="/assets/images/ava/<?php if(isset($defaultDownload['userPathAvatar'])){echo $defaultDownload['userPathAvatar'];}?>" />
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                            <!--begin: Head -->
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(/assets/media/misc/bg-1.jpg)">
                                <div class="kt-user-card__avatar">
                                    <img alt="ava" src="/assets/images/ava/<?php if(isset($defaultDownload['userPathAvatar'])){echo $defaultDownload['userPathAvatar'];}?>" />
                                </div>
                                <div class="kt-user-card__name">
                                    <?php if(isset($_SESSION['mngr'])){echo $_SESSION['mngr']['userSurname'].' '. $_SESSION['mngr']['userFirstName'];}?>
                                </div>
                            </div>
                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                <a href="/mngr/profile" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon-profile-1 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Профиль
                                        </div>
                                    </div>
                                </a>
                                <?php if($defaultDownload['adminUsers']=='true'):?>
                                    <a href="/mngr/users" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon-users kt-font-brand"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Пользователи
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/mngr/organization" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon-map-location kt-font-brand"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Организации
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/mngr/departments" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon-presentation-1 kt-font-brand"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Отделы
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/mngr/posts" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon-network kt-font-brand"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Должности
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/mngr/controls" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon-settings kt-font-brand"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Управление
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/mngr/alertusers" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-speaker"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Оповещение
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/mngr/crushtests" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-safe"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                КрашТесты
                                            </div>
                                        </div>
                                    </a>
                                <?php endif;?>

                                <div class="kt-notification__custom kt-space-between">
                                    <a href="/mngr/logout" class="btn btn-label btn-label-brand btn-sm btn-bold">Выход</a>
                                </div>
                            </div>
                            <!--end: Navigation -->

                        </div>
                    </div>
                    <!-- #Меню пользователя -->

                </div>
                <!-- #Header Правое меню -->

            </div>
            <!-- #Header -->
<?php endif;?>
<!--///////////////////////////////-->
            <script src="/assets/vendors/plugins/jquery/dist/jquery.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/popper.js/dist/umd/popper.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/js-cookie/src/js.cookie.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/moment/min/moment.min.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/jquery.blockui.min.js" type="text/javascript"></script>

            <!--<script src="/assets/global2/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

            <script src="/assets/global2/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

            <script src="/assets/global2/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>-->
            <?php if($this->route['action'] == 'onedoc'):?>
                <script src="/assets/vendors/plugins/summernote/summernote-bs4.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/summernote/lang/summernote-ru-RU.js" type="text/javascript"></script>
            <?php endif;?>
            <?php if($this->route['action'] == 'dashboard' ||
                $this->route['action'] == 'document' ||
                $this->route['action'] == 'analitics' ||
                $this->route['action'] == 'projects' ||
                $this->route['action'] == 'contragents' ||
                $this->route['action'] == 'holiday' ||
                $this->route['action'] == 'staffer' ||
                $this->route['action'] == 'controls' ||
                $this->route['action'] == 'posts' ||
                $this->route['action'] == 'departments' ||
                $this->route['action'] == 'organization' ||
                $this->route['action'] == 'users' ||
                $this->route['action'] == 'onepay' ||
                $this->route['action'] == 'onedoc'):?>
                <script src="/assets/vendors/plugins/bootstrap-table/bootstrap-table.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-table/extensions/cookie/bootstrap-table-cookie.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-table/extensions/export/bootstrap-table-export.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.js" type="text/javascript"></script>
                <!--<script src="/assets/vendors/plugins/bootstrap-table/extensions/select2-filter/bootstrap-table-select2-filter.js" type="text/javascript"></script>-->
                <script src="/assets/vendors/plugins/bootstrap-table/bootstrap-table-ru-RU.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/datatables/datatables.js" type="text/javascript"></script>
            <?php endif;?>

            <?php if($this->route['action'] == 'projects'):?>
                <script src="/assets/vendors/plugins/bootstrap-table/extensions/select2-filter/bootstrap-table-select2-filter.js" type="text/javascript"></script>
            <?php endif;?>
            <?php if($this->route['action'] == 'add' || $this->route['action'] == 'editinvoice' || $this->route['action'] == 'editpay' || $this->route['action'] == 'profile' || $this->route['action'] == 'controls'):?>
                <script src="/assets/vendors/plugins/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-fileinput/js/locales/ru.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-fileinput/js/plugins/purify.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
            <?php endif;?>

            <?php if($this->route['action'] == 'dashboard'):?>
                <script src="/assets/vendors/plugins/jszip.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jszip-utils.js" type="text/javascript"></script>
            <?php endif;?>
            <script src="/assets/vendors/plugins/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
            <script src="/assets/vendors/plugins/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
            <!--<script src="/assets/global2/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="/assets/global2/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
            <script src="/assets/global2/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>

            -->
            <!-- Экспорт -->
            <?php if($this->route['action'] == 'dashboard' || $this->route['action'] == 'document' || $this->route['action'] == 'analitics' || $this->route['action'] == 'projects' || $this->route['action'] == 'contragents'):?>
                <script src="/assets/vendors/plugins/tableExport/tableExport.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/tableExport/libs/js-xlsx/xlsx.core.min.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/tableExport/libs/FileSaver/FileSaver.min.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/tableExport/libs/jsPDF/jspdf.min.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/tableExport/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js" type="text/javascript"></script>
            <?php endif;?>

            <script src="/assets/vendors/plugins/select2/dist/js/select2.js" type="text/javascript"></script>

            <?php if($this->route['action'] == 'document' || $this->route['action'] == 'dashboard' || $this->route['action'] == 'analitics'): ?>
                <script src="/assets/vendors/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/datatables/datatables.js" type="text/javascript"></script>
                <!--<script src="/assets/vendors/plugins/dataTables-1.10.18/js/jquery.dataTables.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/dataTables-1.10.18/js/dataTables.bootstrap.js" type="text/javascript"></script>-->
            <?php endif;?>
            <?php if($this->route['action'] == 'controls' ||
                $this->route['action'] == 'posts' ||
                $this->route['action'] == 'alertusers' ||
                $this->route['action'] == 'organization' ||
                $this->route['action'] == 'users' ||
                $this->route['action'] == 'departments'):?>
                <script src="/assets/vendors/plugins/jquery.inputmask.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/x-editable/bootstrap-editable.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jsTree/jstree.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-select/dist/js/i18n/defaults-ru_RU.js" type="text/javascript"></script>
            <?php endif;?>
            <?php if($this->route['action'] == 'add' || $this->route['action'] == 'editinvoice' || $this->route['action'] == 'editpay' || $this->route['action'] == 'index'):?>
                <script src="/assets/vendors/plugins/jquery-validation/jquery.validate.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery-validation/additional-methods.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery-validation/localization/messages_ru.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery-validation.init.js" type="text/javascript"></script>
                <script src="/public/scripts/validation/formAddInvoice.js"></script>
            <?php endif;?>

            <script>
                let KTAppOptions = {
                    "colors":{
                        "state":{
                            "brand":"#2c77f4",
                            "light":"#ffffff",
                            "dark":"#282a3c",
                            "primary":"#5867dd",
                            "success":"#34bfa3",
                            "info":"#36a3f7",
                            "warning":"#ffb822",
                            "danger":"#fd3995"
                        },
                        "base":{
                            "label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],
                            "shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]
                        }
                    }
                };
            </script>

<!--///////////////////////////////-->
<?php echo $content; ?>
<!--///////////////////////////////-->
            <!-- Footer -->
            <?php if($this->route['action'] != 'login' && $this->route['action'] != 'index'): ?>
            <div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-footer__copyright">
                    2019 &copy; <b>S<span style="color: green;">A</span>MA</b>
                    <span style="color: #00aaaa;"><b>&nbsp;СИСТЕМА КОНТРОЛЯ ПРОЕКТОВ</b></span>
                </div>
                <div class="kt-footer__menu">
                    <?php
                    //echo " MySQL: ".get_num_queries()." Запросов: "; timer_stop(1);
                    echo '<span style="opacity: 0.5;"> | Память: '.round(memory_get_usage()/1024/1024, 2).' Мб</span>';?>
                </div>
            </div>
            <?php endif;?>
            <!-- #Footer -->

        </div>
    </div>
</div>
<!-- end:: Page -->
<!-- Данные уведомлений -->
<div id="kt_quick_panel" class="kt-quick-panel">
    <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
    <div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
        <h3 class="kt-head__title">Уведомления&nbsp;
            <span class="btn btn-label-primary btn-sm btn-bold btn-font-md count-notice-text">нет событий</span>
            <a id="clearListNotice" class="btn btn-label-info btn-sm btn-bold btn-font-md hiddenVisible">очистить</a>
        </h3>
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist"></ul>
    </div>
    <div class="kt-quick-panel__content">
        <div class="tab-content">
            <div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_invoice" role="tabpanel">
                <div class="kt-notification-v2 listing-notice-invoice">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- #Данные уведомлений -->
<!-- Прокрутка -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- #Прокрутка -->

    <div class="modal fade" id="modalImprovement" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Что бы вы улучшили?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Мы постоянно улучшаем работу и функционал программы, а также учитываем все Ваши пожелания, если у Вас возникли идеи как можно улучшить данную программу для Вашего удобства – опишите свои идеи, мы рассмотрим каждую идею и включим их в ближайшее обновление! </p>

                    <div class="form-group">
                        <label for="textImprovement" class="col-form-label">Идеи:</label>
                        <textarea type="text" class="form-control" id="textImprovement"></textarea>
                    </div>
                    <div class="hiddenVisible" id="validateDivImprovement">
                        <p style="color: red;text-align: center;">Пустое сообщение</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idProject" id="idProject">
                    <input type="hidden" name="userID" id="userID" value="<?php if(isset($_SESSION['mngr']['id'])){echo $_SESSION['mngr']['id'];}?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveImprovement">Отправить</button>
                </div>
            </div>
        </div>
    </div>

<?php if($this->route['action'] == 'add' || $this->route['action'] == 'editinvoice' || $this->route['action'] == 'editpay' || $this->route['action'] == 'controls'):?>
    <script src="/public/scripts/fileinput/scriptFileinput.js" type="text/javascript"></script>
<?php endif;?>
<?php if($this->route['action'] == 'profile' || $this->route['action'] == 'controls'):?>
    <script src="/public/scripts/fileinput/scriptLogoinput.js" type="text/javascript"></script>
<?php endif;?>
    <script>
        let urlOne = '/ajax/ajaxpost';
        //таймзона
        let timezone = '<?php echo $defaultDownload['timezone'];?>';
        function datetimeToday() {
            return moment().utcOffset(timezone).format('DD.MM.YYYY HH:mm');
        }
        function datetimeStamp() {
            return moment().utcOffset(timezone).format('YYYY-MM-DD HH:mm:ss');
        }
        //#таймзона
        $(document).ready(function()
        {
            $('[data-toggle="popover"]').popover();

            var userID = "<?php if(isset($_SESSION['mngr']['id'])){echo $_SESSION['mngr']['id'];}else{echo '';};?>";
            var userRole = "<?php if(isset($_SESSION['mngr']['userRole'])){echo $_SESSION['mngr']['userRole'];}else{echo '';};?>";

            var editInvoice = "<?php if(isset($_SESSION['mngr']['editInvoice'])){echo $_SESSION['mngr']['editInvoice'];}else{echo 'false';}?>";
            var targetInvoice = "<?php if(isset($_SESSION['mngr']['idInvoice'])){echo $_SESSION['mngr']['idInvoice'];}else{echo 'false';}?>";
            var actionRout = "<?php echo $this->route['action'];?>";
            if(actionRout ==='editinvoice' || actionRout ==='index' || actionRout ==='login') {
            }else{
                if(editInvoice === 'false'){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=testEditInvoice",
                        success: function (data){
                            var result = $.parseJSON(data);
                            //console.log(result);
                            if(result.testEditInvoice!==false){
                                Swal.fire({
                                    title: "ВНИМАНИЕ!",
                                    text: "Вы забыли отредактировать счет",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    cancelButtonText: "Отменить редактирование!",
                                    confirmButtonText: "Редактировать",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((value)=>{
                                    if (value === false){
                                        $.ajax({
                                            url: urlOne, type: "POST", dataType: "text",
                                            data: "mainAjax=labelEdit&idInvoice="+result.testEditInvoice.id+"&typeAdd=invoice&label=false",
                                            success: function (data) {}
                                        });
                                    }else{
                                        window.location=('/mngr/editinvoice/'+result.testEditInvoice.id);
                                    }
                                });
                            }
                        }
                    });
                }else{
                    Swal.fire({
                        title: "ВНИМАНИЕ!",
                        text: "Вы забыли отредактировать счет",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        cancelButtonText: "Отменить редактирование!",
                        confirmButtonText: "Редактировать",
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((value)=>{
                        if (value === false){
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "mainAjax=labelEdit&idInvoice="+targetInvoice+"&typeAdd=invoice&label=false",
                                success: function (data) {}
                            });
                        }else{
                            window.location=('/mngr/editinvoice/'+targetInvoice);
                        }
                    });
                }
            }

//Выводим существующие уведомления
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=loadNoticeDB&userID="+userID,
                success: function (data) {
                    //console.log(data);
                    let result = $.parseJSON(data);
                    if(result.allNoticeCount > 0){
                        $('#kt_quick_panel_toggler_btn').addClass('animateBtn');
                        /*$('.count-notice').text(result.allNoticeCount);//кол-во уведомлений*/
                        let doing = '';
                        if(result.allNoticeCount === 1){
                            doing = 'событие';
                        }else if(result.allNoticeCount > 1 && result.allNoticeCount <= 4){
                            doing = 'события';
                        }else if(result.allNoticeCount > 4){
                            doing = 'событий';
                        }
                        $('.count-notice-text').text(result.allNoticeCount+' '+doing);//кол-во событий
                        $('#clearListNotice').removeClass('hiddenVisible');//показать кнопку очистки списка
                    }
                    $('.listing-notice-invoice').empty();
                    $.each(result.allNoticeUser,function(col,val){
                        var textNotice = '';
                        var iconNotice = '';
                        var iconLabel = '';
                        var urlNotice = 'staffer/'+val.invoice_id;
                        switch (val.whatIs){
                            case 'invoice':
                                textNotice = "Новый счет";
                                iconNotice = 'flaticon2-mail-1';
                                iconLabel = 'kt-font-brand';
                                break;
                            case 'comment':
                                if(val.tableUser==='forPay'){
                                    textNotice = "комментарий";
                                    iconNotice = 'flaticon-comment';
                                    iconLabel = 'kt-font-success';
                                    urlNotice = 'onepay/'+val.invoice_id;
                                }else{
                                    textNotice = "комментарий";
                                    iconNotice = 'flaticon-comment';
                                    iconLabel = 'kt-font-success';
                                }
                                break;
                            case 'failure':
                                textNotice = "отказ (счет)";
                                iconNotice = 'flaticon-close';
                                iconLabel = 'kt-font-danger';
                                break;
                            case 'update':
                                textNotice = "передал счет";
                                iconNotice = 'info-circle';
                                iconLabel = 'kt-font-info';
                                break;
                            case 'updatePay':
                                textNotice = "передал служебку";
                                iconNotice = 'info-circle';
                                iconLabel = 'kt-font-info';
                                urlNotice = 'onepay/'+val.invoice_id;
                                break;
                            case 'success':
                                if(val.tableUser==='forPay'){
                                    textNotice = "Деньги выданы";
                                    iconNotice = 'flaticon2-checkmark';
                                    iconLabel = 'kt-font-success';
                                    urlNotice = 'onepay/'+val.invoice_id;
                                }else{
                                    textNotice = "оплачено";
                                    iconNotice = 'flaticon2-checkmark';
                                    iconLabel = 'kt-font-success';
                                }
                                break;
                            case 'newpay':
                                textNotice = "Новая служебка";
                                iconNotice = 'la la-ruble';
                                iconLabel = 'kt-font-brand';
                                urlNotice = 'onepay/'+val.invoice_id;
                                break;
                            case 'newDoc':
                                textNotice = "Входящий документ";
                                iconNotice = 'flaticon-folder-1';
                                iconLabel = 'kt-font-brand';
                                urlNotice = 'onedoc/'+val.invoice_id;
                                break;
                            case 'signDoc':
                                textNotice = "Документ на согласование";
                                iconNotice = 'flaticon-list';
                                iconLabel = 'kt-font-warning';
                                urlNotice = 'onedoc/'+val.invoice_id;
                                break;
                            case 'reloadDoc':
                                textNotice = "Документ возвращен на доработку";
                                iconNotice = 'flaticon2-circular-arrow';
                                iconLabel = 'kt-font-danger';
                                urlNotice = 'onedoc/'+val.invoice_id;
                                break;
                            case 'successDoc':
                                textNotice = "Документ согласован";
                                iconNotice = 'flaticon2-checkmark';
                                iconLabel = 'kt-font-success';
                                urlNotice = 'onedoc/'+val.invoice_id;
                                break;
                            case 'reportPay':
                                textNotice = "Отчет по подотчету";
                                iconNotice = 'edit';
                                iconLabel = 'kt-font-warning';
                                urlNotice = 'reportpay/'+val.invoice_id;
                                break;
                            case 'reportFailure':
                                textNotice = "Отчет на доработку";
                                iconNotice = 'edit';
                                iconLabel = 'kt-font-danger';
                                urlNotice = 'reportpay/'+val.invoice_id;
                                break;
                            case 'reportSuccess':
                                textNotice = "Отчет принят в бухгалтерию";
                                iconNotice = 'check';
                                iconLabel = 'label-success';
                                urlNotice = 'onepay/'+val.invoice_id;
                                break;
                            case 'reportLastSuccess':
                                textNotice = "Отчет по подотчету";
                                iconNotice = 'check';
                                iconLabel = 'label-success';
                                urlNotice = 'reportpay/'+val.invoice_id;
                                break;
                            case 'failurepay':
                                textNotice = "отказ (служебка)";
                                iconNotice = 'flaticon-close';
                                iconLabel = 'kt-font-danger';
                                urlNotice = 'onepay/'+val.invoice_id;
                                break;
                            default:
                                textNotice = "подписан cчет";
                                iconNotice = 'info-circle';
                                iconLabel = 'label-info';
                                break;
                        }
                        let output = '\
                            <a class="kt-notification-v2__item btnFromNotice" data-noticeid="'+val.id+'"\
                                href="/mngr/'+urlNotice+'">\
                                <div class="kt-notification-v2__item-icon">\
                                    <i class="'+iconNotice+' '+iconLabel+'"></i>\
                                </div>\
                                <div class="kt-notification-v2__itek-wrapper">\
                                    <div class="kt-notification-v2__item-title">\
                                        '+textNotice+'\
                                    </div>\
                                    <div class="kt-notification-v2__item-desc">\
                                        '+val.initiatorName+'\
                                    </div>\
                                </div>\
                            </a>';
                        $('.listing-notice-invoice').append(output);
                    });
                }
            });

//Запускаем проверку уведомлений каждые 30 сек.
            window.setInterval(function(){
                //console.log(userID);
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=loadNoticeDB&userID="+userID,
                    success: function (data) {
                        let result = $.parseJSON(data);
                        //console.log(result);
                        if(result.allNoticeCount > 0){
                            $('#kt_quick_panel_toggler_btn').addClass('animateBtn');
                            /*$('.count-notice').text(result.allNoticeCount);//кол-во уведомлений*/
                            let doing = '';
                            if(result.allNoticeCount === 1){
                                doing = 'событие';
                            }else if(result.allNoticeCount > 1 && result.allNoticeCount <= 4){
                                doing = 'события';
                            }else if(result.allNoticeCount > 4){
                                doing = 'событий';
                            }
                            $('.count-notice-text').text(result.allNoticeCount+' '+doing);//кол-во событий
                            $('#clearListNotice').removeClass('hiddenVisible');//показываем кнопку очистки списка
                        }else{
                            $('#kt_quick_panel_toggler_btn').removeClass('animateBtn');
                            /*$('.count-notice').text('');//кол-во уведомлений*/
                            $('.count-notice-text').text('нет событий');//кол-во событий
                            $('#clearListNotice').addClass('hiddenVisible');//убираем кнопку
                        }
                        $('.listing-notice-invoice').empty();
                        $.each(result.allNoticeUser,function(col,val){
                            let textNotice = '';
                            let iconNotice = '';
                            let iconLabel = '';
                            let urlNotice = 'staffer/'+val.invoice_id;
                            switch (val.whatIs){
                                case 'invoice':
                                    textNotice = "Новый счет";
                                    iconNotice = 'flaticon2-mail-1';
                                    iconLabel = 'kt-font-brand';
                                    break;
                                case 'comment':
                                    if(val.tableUser==='forPay'){
                                        textNotice = "комментарий";
                                        iconNotice = 'flaticon-comment';
                                        iconLabel = 'kt-font-success';
                                        urlNotice = 'onepay/'+val.invoice_id;
                                    }else{
                                        textNotice = "комментарий";
                                        iconNotice = 'flaticon-comment';
                                        iconLabel = 'kt-font-success';
                                    }
                                    break;
                                case 'failure':
                                    textNotice = "отказ (счет)";
                                    iconNotice = 'flaticon-close';
                                    iconLabel = 'kt-font-danger';
                                    break;
                                case 'update':
                                    textNotice = "передал счет";
                                    iconNotice = 'info-circle';
                                    iconLabel = 'kt-font-info';
                                    break;
                                case 'updatePay':
                                    textNotice = "передал служебку";
                                    iconNotice = 'info-circle';
                                    iconLabel = 'kt-font-info';
                                    urlNotice = 'onepay/'+val.invoice_id;
                                    break;
                                case 'success':
                                    if(val.tableUser==='forPay'){
                                        textNotice = "Деньги выданы";
                                        iconNotice = 'flaticon2-checkmark';
                                        iconLabel = 'kt-font-success';
                                        urlNotice = 'onepay/'+val.invoice_id;
                                    }else{
                                        textNotice = "оплачено";
                                        iconNotice = 'flaticon2-checkmark';
                                        iconLabel = 'kt-font-success';
                                    }
                                    break;
                                case 'newpay':
                                    textNotice = "Новая служебка";
                                    iconNotice = 'la la-ruble';
                                    iconLabel = 'kt-font-brand';
                                    urlNotice = 'onepay/'+val.invoice_id;
                                    break;
                                case 'newDoc':
                                    textNotice = "Входящий документ";
                                    iconNotice = 'flaticon-folder-1';
                                    iconLabel = 'kt-font-brand';
                                    urlNotice = 'onedoc/'+val.invoice_id;
                                    break;
                                case 'signDoc':
                                    textNotice = "Документ на согласование";
                                    iconNotice = 'flaticon-list';
                                    iconLabel = 'kt-font-warning';
                                    urlNotice = 'onedoc/'+val.invoice_id;
                                    break;
                                case 'reloadDoc':
                                    textNotice = "Документ возвращен на доработку";
                                    iconNotice = 'flaticon2-circular-arrow';
                                    iconLabel = 'kt-font-danger';
                                    urlNotice = 'onedoc/'+val.invoice_id;
                                    break;
                                case 'successDoc':
                                    textNotice = "Документ согласован";
                                    iconNotice = 'flaticon2-checkmark';
                                    iconLabel = 'kt-font-success';
                                    urlNotice = 'onedoc/'+val.invoice_id;
                                    break;
                                case 'reportPay':
                                    textNotice = "Отчет по подотчету";
                                    iconNotice = 'edit';
                                    iconLabel = 'kt-font-warning';
                                    urlNotice = 'reportpay/'+val.invoice_id;
                                    break;
                                case 'reportFailure':
                                    textNotice = "Отчет на доработку";
                                    iconNotice = 'edit';
                                    iconLabel = 'kt-font-danger';
                                    urlNotice = 'reportpay/'+val.invoice_id;
                                    break;
                                case 'reportSuccess':
                                    textNotice = "Отчет принят в бухгалтерию";
                                    iconNotice = 'check';
                                    iconLabel = 'label-success';
                                    urlNotice = 'onepay/'+val.invoice_id;
                                    break;
                                case 'reportLastSuccess':
                                    textNotice = "Отчет по подотчету";
                                    iconNotice = 'check';
                                    iconLabel = 'label-success';
                                    urlNotice = 'reportpay/'+val.invoice_id;
                                    break;
                                case 'failurepay':
                                    textNotice = "отказ (служебка)";
                                    iconNotice = 'flaticon-close';
                                    iconLabel = 'kt-font-danger';
                                    urlNotice = 'onepay/'+val.invoice_id;
                                    break;
                                default:
                                    textNotice = "подписан cчет";
                                    iconNotice = 'info-circle';
                                    iconLabel = 'label-info';
                                    break;
                            }
                            let output = '\
                            <a class="kt-notification-v2__item btnFromNotice" data-noticeid="'+val.id+'"\
                                href="/mngr/'+urlNotice+'">\
                                <div class="kt-notification-v2__item-icon">\
                                    <i class="'+iconNotice+' '+iconLabel+'"></i>\
                                </div>\
                                <div class="kt-notification-v2__itek-wrapper">\
                                    <div class="kt-notification-v2__item-title">\
                                        '+textNotice+'\
                                    </div>\
                                    <div class="kt-notification-v2__item-desc">\
                                        '+val.initiatorName+'\
                                    </div>\
                                </div>\
                            </a>';
                            $('.listing-notice-invoice').append(output);
                        });
                    }
                });
            },30000);

            $('#clearListNotice').on('click',function () {
                $('#clearListNotice').addClass('hiddenVisible');//убираем кнопку
                /*$('.count-notice').text('');//кол-во уведомлений*/
                $('.count-notice-text').text('нет событий');//кол-во событий
                $('.listing-notice li:not(:first)').remove();//очистить список
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=deleteAllNoticeUserID",
                    success: function () {
                    }
                })
            });

            $('#clickAddInvoiceHeader').on('click',function () {
                window.location = ('/mngr/add');
            });

            $('.listing-notice').on('click','.btnFromNotice', function () {
                var noticeid = $(this).data('noticeid');
                console.log(noticeid);
                /*$.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=deleteNoticeDB&noticeid="+noticeid,
                    success: function () {
                    }
                })*/
            });

            /*function datetimeToday() {
                var Data = new Date();
                var Day = Data.getDate(); var Month = Data.getMonth(); var Year = Data.getFullYear();
                var Hour = Data.getHours(); var Minutes = Data.getMinutes();
                switch (Month)
                {
                    case 0: fMonth="01"; break;
                    case 1: fMonth="02"; break;
                    case 2: fMonth="03"; break;
                    case 3: fMonth="04"; break;
                    case 4: fMonth="05"; break;
                    case 5: fMonth="06"; break;
                    case 6: fMonth="07"; break;
                    case 7: fMonth="08"; break;
                    case 8: fMonth="09"; break;
                    case 9: fMonth="10"; break;
                    case 10: fMonth="11"; break;
                    case 11: fMonth="12"; break;
                }
                if(Day<10){Day='0'+Day;}
                if(Hour<10){Hour='0'+Hour;}
                if(Minutes<10){Minutes='0'+Minutes;}
                return Day+'.'+fMonth+'.'+Year+' '+Hour+':'+Minutes;
            }*/

            $('#clickImprovement').on('click',function () {
                $('#modalImprovement').modal('show');
            });
            $('#saveImprovement').on('click',function () {

                var userMail = $.cookie('userMail');
                var userName = $.cookie('userSurname')+' '+$.cookie('userFirstName');
                var textImprovement = $('#textImprovement').val();
                var dateToday = datetimeToday();
                console.log(userMail);
                console.log(userName);
                console.log(dateToday);
                if(textImprovement==='') {
                    $('#validateDivImprovement').removeClass('hiddenVisible');
                }else{
                    $('#modalImprovement').modal('hide');
                    Swal.fire({
                        title: "Отправлено!",
                        text: "Ваши идеи отправлены, спасибо что помогаете улучшать ресурс. В ближайшее время Вы получите обратную связь!",
                        type: "success",
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=insertImprovement&userMail="+userMail+"&userName="+userName+"&textImprovement="+textImprovement+"&dateToday="+dateToday,
                        success: function (data) {
                            window.location = ('/mngr/projects');
                        }
                    });
                }

            });
        });
        //сортировка денег
        function priceSorter(a, b) {
            var a = String(a).replace(/(&nbsp;|р\.)/g, '');
            var b = String(b).replace(/(&nbsp;|р\.)/g, '');
            a = parseInt(a);
            b = parseInt(b);
            if (a > b) return 1;
            if (a < b) return -1;
            return 0;
        }
        //преобразуем дату 01.01.1970 в 19700101
        function dateParseToSort(str){
            var arr1 = str.split('.');
            return parseInt(arr1[2]+arr1[1]+arr1[0]);
        }
        //сортировка по дате
        function dateSorter(a, b) {
            var a = dateParseToSort(a);
            var b = dateParseToSort(b);
            if (a > b) return 1;
            if (a < b) return -1;
            return 0;
        }

    </script>
    <script src="/assets/js/scripts.bundle.js" type="text/javascript"></script>
</body>
</html>