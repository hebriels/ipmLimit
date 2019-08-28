<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Настройка </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="col-md-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <ul id="comfortSettings" class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab_0">Получатели</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#tab_1" data-toggle="tab"> Список на главной </a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_2" data-toggle="tab"> Cчета-Наличка-Доки </a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#tab_3" data-toggle="tab"> Подчиненность </a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_4" data-toggle="tab"> Настройка сайта </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_5" data-toggle="tab"> Вывод статистики </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_6" data-toggle="tab"> Уведомления </a>
                        </li>
                    </ul>
                    <div class="tab-content">
<!--Получатели-->
                        <div class="tab-pane active" id="tab_0">
                            <div class="kt-portlet">
                                <table id="tableUserAdmin"
                                       data-sort-name="departmentAdmin" data-sort-order="asc"
                                       data-toggle="table" data-mobile-responsive="true"
                                       data-cookie="true" data-cookie-id-table="tableUserAdmin">
                                    <thead>
                                    <tr>
                                        <th data-field="fioAdmin" data-align="center">Пользователь</th>
                                        <th data-field="departmentAdmin" data-align="center">Отдел</th>
                                        <th data-field="postsAdmin" data-align="center">Должность</th>
                                        <th data-field="invoiceAdmin" data-align="center">Получатель счета</th>
                                        <th data-field="payinvoiceAdmin" data-align="center">Получатель служебки</th>
                                        <th data-field="actionsAdmin" data-align="center">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($managers as $manager): ?>
                                        <?php if($manager['adminUser']!='delete'):?>
                                        <tr id="user-<?php echo $manager['id'];?>">
                                            <td><?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName']; ?></td>
                                            <td>
                                                <?php foreach ($allDepartments as $depart){
                                                    if($manager['userDepartment'] == $depart['id']){
                                                        echo $depart['nameDepartment'];
                                                    }
                                                };?>
                                            </td>
                                            <td>
                                                <?php foreach ($allPosts as $posts){
                                                    if($manager['userRole'] == $posts['id']){
                                                        echo $posts['postDepartment'];
                                                    }
                                                };?>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="invoice" data-type="select" data-pk="<?php echo $manager['id'];?>">
                                                    <?php foreach ($managers as $item){
                                                        if($manager['userToMail'] == $item['id']){
                                                            echo $item['userSurname'].' '.$item['userFirstName'];
                                                        }
                                                    };?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="invoicePay" data-type="select" data-pk="<?php echo $manager['id'];?>">
                                                    <?php foreach ($managers as $item){
                                                        if($manager['userToMailPay'] == $item['id']){
                                                            echo $item['userSurname'].' '.$item['userFirstName'];
                                                        }
                                                    };?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php
                                                    if($manager['holiday'] == 'false'){
                                                        echo '<button type="button" class="btn btn-xs btn-outline btn-success inHoliday" data-userid="'.$manager['id'].'">В отпуск</button>';
                                                    }else{
                                                        echo '<button type="button" class="btn btn-xs btn-outline btn-danger ofHoliday" data-userid="'.$manager['id'].'">В отпуске</button>';
                                                    }
                                                ;?>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!--Список на главной-->
                        <div class="tab-pane" id="tab_1">
                            <div class="kt-portlet">
                                <table id="listUserDashboard"
                                       data-sort-name="fio1" data-sort-order="asc"
                                       data-toggle="table" data-mobile-responsive="true">
                                    <thead>
                                    <tr>
                                        <th data-field="fio1" data-align="center">Пользователь</th>
                                        <th data-field="department1" data-align="center">Отдел</th>
                                        <th data-field="posts1" data-align="center">Должность</th>
                                        <th data-field="listUsers1" data-align="center">Кого показывать</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($managers as $manager): ?>
                                        <?php if($manager['adminUser']!='delete'):?>
                                        <tr id="userD-<?php echo $manager['id'];?>">
                                            <td><?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName']; ?></td>
                                            <td>
                                                <?php foreach ($allDepartments as $depart){
                                                    if($manager['userDepartment'] == $depart['id']){
                                                        echo $depart['nameDepartment'];
                                                    }
                                                };?>
                                            </td>
                                            <td>
                                                <?php foreach ($allPosts as $posts){
                                                    if($manager['userRole'] == $posts['id']){
                                                        echo $posts['postDepartment'];
                                                    }
                                                };?>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="checkListUsersDashboard" data-dash="<?php echo $manager['id'];?>" data-type="checklist" data-pk="<?php echo $manager['id'];?>"></a>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- Cчета-Наличка-Доки -->
                        <div class="tab-pane" id="tab_2">
                            <div class="kt-portlet">
                                <table id="listUserInvoice"
                                       data-sort-name="fio2" data-sort-order="asc"
                                       data-toggle="table" data-mobile-responsive="true" data-search="true">
                                    <thead>
                                    <tr>
                                        <th data-field="fio2" data-align="center">Пользователь</th>
                                        <th data-field="department2" data-align="center">Отдел</th>
                                        <th data-field="posts2" data-align="center">Должность</th>
                                        <th data-field="listUsers" data-align="center" data-visible="false">Счета</th>
                                        <th data-field="listUsersPay" data-align="center" data-visible="false">Служебки</th>
                                        <th data-field="listUsersDoc" data-align="center" data-visible="false">Документы</th>
                                        <th data-field="listUsersDocTest" data-align="center">Настройка</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($managers as $manager): ?>
                                        <?php if($manager['adminUser']!='delete'):?>
                                        <tr id="user-<?php echo $manager['id'];?>">
                                            <td><?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName']; ?></td>
                                            <td>
                                                <?php foreach ($allDepartments as $depart){
                                                    if($manager['userDepartment'] == $depart['id']){
                                                        echo $depart['nameDepartment'];
                                                    }
                                                };?>
                                            </td>
                                            <td>
                                                <?php foreach ($allPosts as $posts){
                                                    if($manager['userRole'] == $posts['id']){
                                                        echo $posts['postDepartment'];
                                                    }
                                                };?>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="checkListUsers" data-invoice="<?php echo $manager['id'];?>" data-type="checklist" data-pk="<?php echo $manager['id'];?>"></a>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="checkListUsersPay" data-invoicepay="<?php echo $manager['id'];?>" data-type="checklist" data-pk="<?php echo $manager['id'];?>"></a>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="checkListUsersDoc" data-invoicedoc="<?php echo $manager['id'];?>" data-type="checklist" data-pk="<?php echo $manager['id'];?>"></a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-brand btn-icon btn-settingUser" data-userid="<?php echo $manager['id'];?>" data-nameuser="<?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName'];;?>"><i class="flaticon-settings"></i></button>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!--Подчиненность-->
                        <!--<div class="tab-pane" id="tab_3">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-sliders"></i>Подчиненность</div>
                                </div>
                                <div class="portlet-body">
                                    <div id="listProgress"></div>
                                </div>
                            </div>
                        </div>-->
<!--Настройка сайта-->
                        <div class="tab-pane" id="tab_4">
                            <div class="kt-portlet">
                                <div class="accordion accordion-toggle-arrow" id="settingsSite">
                                    <!--Адрес сайта-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set1" aria-expanded="false" aria-controls="set1">
                                                <i class="flaticon2-layers-1"></i> Адрес сайта
                                            </div>
                                        </div>
                                        <div id="set1" class="collapse" data-parent="#settingsSite">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table id="user" class="table table-bordered table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width:30%"> Адрес </td>
                                                            <td style="width:70%"><?php echo $allOptions[0]['optionValue'];?>
                                                                <!--<a href="javascript:;" id="addressSite" data-type="text" data-pk="1">
                                                                    <?php /*if($allOptions[0]['optionValue']!=''){echo $allOptions[0]['optionValue'];}else{echo 'http://your__site.com';}*/?>
                                                                </a>-->
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Последний согласующий счетов-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set2" aria-expanded="false" aria-controls="set2">
                                                <i class="flaticon2-layers-1"></i> Последний согласующий счетов
                                            </div>
                                        </div>
                                        <div id="set2" class="collapse" data-parent="#settingsSite">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table id="user" class="table table-bordered table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width:30%">Выберите из списка</td>
                                                            <td style="width:70%">
                                                                <a href="javascript:;" class="lastSignatureInvoice" data-type="select" data-pk="1">
                                                                    <?php foreach ($managers as $manager){
                                                                        if($manager['id']==$allOptions[1]['optionValue']){
                                                                            echo $manager['userSurname'].' '.$manager['userFirstName'];
                                                                        }
                                                                    }?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Последний согласующий служебок-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set3" aria-expanded="false" aria-controls="set3">
                                                <i class="flaticon2-layers-1"></i> Последний согласующий служебок
                                            </div>
                                        </div>
                                        <div id="set3" class="collapse">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table id="user" class="table table-bordered table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width:30%">Выберите из списка</td>
                                                            <td style="width:70%">
                                                                <a href="javascript:;" class="lastSignaturePay" data-type="select" data-pk="1">
                                                                    <?php foreach ($managers as $manager){
                                                                        if($manager['id']==$allOptions[2]['optionValue']){
                                                                            echo $manager['userSurname'].' '.$manager['userFirstName'];
                                                                        }
                                                                    }?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Добавление пользователей к комментариям-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set4" aria-expanded="false" aria-controls="set4">
                                                <i class="flaticon2-layers-1"></i> Добавление пользователей к комментариям
                                            </div>
                                        </div>
                                        <div id="set4" class="collapse">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table id="listUserCommPartner" class="table table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:30%">Выберите из списка</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" class="addCommPartner" data-type="checklist" data-value="<?php echo $allOptions[3]['optionValue'];?>" data-pk="<?php echo $allOptions[3]['optionValue'];?>"></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Редактирование покупателя, объединение в проекте-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set5" aria-expanded="false" aria-controls="set5">
                                                <i class="flaticon2-layers-1"></i> Редактирование покупателя, объединение в проекте
                                            </div>
                                        </div>
                                        <div id="set5" class="collapse">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table id="listUserEditContragent" class="table table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:30%">Выберите из списка</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" class="addEditContragent" data-type="checklist" data-value="<?php echo $allOptions[4]['optionValue'];?>" data-pk="<?php echo $allOptions[4]['optionValue'];?>"></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Модуль "Наличка"-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set6" aria-expanded="false" aria-controls="set6">
                                                <i class="flaticon2-layers-1"></i> Модуль "Наличка"
                                            </div>
                                        </div>
                                        <div id="set6" class="collapse">
                                            <div class="card-body">
                                                <div class="form-horizontal">
                                                    <?php if($allOptions[5]['optionValue']=='true'){$checkModulePay = 'checked';}else{$checkModulePay = '';}?>
                                                    <label class="col-sm-4 col-xs-6 control-label" for="modulePay">Использовать</label>
                                                    <div class="col-sm-8 col-xs-6">
                                                        <input id="modulePay" name="modulePay" type="checkbox" <?php echo $checkModulePay;?> data-toggle="toggle" data-on="Да" data-off="Нет">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Настройка валюты-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set7" aria-expanded="false" aria-controls="set7">
                                                <i class="flaticon2-layers-1"></i> Настройка валюты
                                            </div>
                                        </div>
                                        <div id="set7" class="collapse">
                                            <div class="card-body">
                                                <div class="form-horizontal col-md-12">
                                                    <label class="col-sm-4 col-xs-6 control-label" for="currencyGlobal">Основная валюта</label>
                                                    <div class="col-sm-8 col-xs-6">
                                                        <a href="javascript:;" id="currencyGlobal" data-type="select" data-pk="1" data-value="<?php echo $allOptions[6]['optionValue'];?>" data-original-title="Select sex"></a>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal col-md-12 margin-top-15">
                                                    <?php if($allOptions[9]['optionValue']=='true'){$checkCurrencyCB = 'checked';}else{$checkCurrencyCB = '';}?>
                                                    <label class="col-sm-4 col-xs-6 control-label" for="currencyCB">Авто курс ЦБ</label>
                                                    <div class="col-sm-8 col-xs-6">
                                                        <input id="currencyCB" name="currencyCB" type="checkbox" <?php echo $checkCurrencyCB;?> data-toggle="toggle" data-on="Да" data-off="Нет">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 margin-top-15" id="divRateCurrency">
                                                    <label class="col-sm-12 control-label">Установка курса вручную</label>
                                                    <table id="user" class="table table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:30%"> Рубль </td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="rurRate" data-type="text" data-pk="1">
                                                                        <?php if($allCurrency[0]['rateCurrency']!=''){echo $allCurrency[0]['rateCurrency'];}else{echo 'не установлено';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%"> Евро </td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="eurRate" data-type="text" data-pk="1">
                                                                        <?php if($allCurrency[1]['rateCurrency']!=''){echo $allCurrency[1]['rateCurrency'];}else{echo 'не установлено';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%"> Доллар </td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="usdRate" data-type="text" data-pk="1">
                                                                        <?php if($allCurrency[2]['rateCurrency']!=''){echo $allCurrency[2]['rateCurrency'];}else{echo 'не установлено';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%"> Иена </td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="jpyRate" data-type="text" data-pk="1">
                                                                        <?php if($allCurrency[3]['rateCurrency']!=''){echo $allCurrency[3]['rateCurrency'];}else{echo 'не установлено';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- контроль отпусков -->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set8" aria-expanded="false" aria-controls="set8">
                                                <i class="flaticon2-layers-1"></i> Управление отпуском
                                            </div>
                                        </div>
                                        <div id="set8" class="collapse">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table id="listUserControlHoliday" class="table table-bordered table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width:30%">Выберите из списка</td>
                                                            <td style="width:70%">
                                                                <a href="javascript:;" class="controlHoliday" data-type="checklist" data-value="<?php echo $allOptions[7]['optionValue'];?>" data-pk="<?php echo $allOptions[7]['optionValue'];?>"></a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Рентабельность проекта-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set9" aria-expanded="false" aria-controls="set9">
                                                <i class="flaticon2-layers-1"></i> Рентабельность проекта
                                            </div>
                                        </div>
                                        <div id="set9" class="collapse">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table id="user" class="table table-bordered table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width:50%"> Процент рентабельности </td>
                                                            <td style="width:50%">
                                                                <a href="javascript:;" id="profitInProject" data-type="text" data-pk="1">
                                                                    <?php if($allOptions[8]['optionValue']!=''){echo $allOptions[8]['optionValue'];}else{echo '10';}?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Модуль "1С"-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set10" aria-expanded="false" aria-controls="set10">
                                                <i class="flaticon2-layers-1"></i> Модуль "1С"
                                            </div>
                                        </div>
                                        <div id="set10" class="collapse">
                                            <div class="card-body">
                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <?php if($allOptions[10]['optionValue']=='true'){$checkModuleOneC = 'checked';}else{$checkModuleOneC = '';}?>
                                                        <label class="col-sm-4 col-xs-6 control-label" for="moduleOneC">Использовать</label>
                                                        <div class="col-sm-8 col-xs-6">
                                                            <input id="moduleOneC" name="moduleOneC" type="checkbox" <?php echo $checkModuleOneC;?> data-toggle="toggle" data-on="Да" data-off="Нет">
                                                        </div>
                                                    </div>
                                                    <div class="form-group hiddenVisible" id="divOneC" style="margin-top: 15px;">
                                                        <table id="user" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th colspan="2">
                                                                    <p><span style="color: red;">*</span> Необходимо ввести адрес обработчика сервера 1С и выбрать сотрудника после чьего согласования данные будут отправляться на сервер 1С</p>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td style="width:30%">Адрес сервера</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="oneCServer" data-type="text" data-pk="1">
                                                                        <?php if($allOptions[12]['optionValue']!=''){echo $allOptions[12]['optionValue'];}else{echo 'http://182.13.76.19:10210/ar/invoice';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%">Выберите из списка</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" class="oneCLast" data-type="select" data-pk="1">
                                                                        <?php foreach ($managers as $manager){
                                                                            if($manager['id']==$allOptions[11]['optionValue']){
                                                                                echo $manager['userSurname'].' '.$manager['userFirstName'];
                                                                            }
                                                                        }?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Настройка почты и отправки-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set11" aria-expanded="false" aria-controls="set11">
                                                <i class="flaticon2-layers-1"></i> Настройка почты
                                            </div>
                                        </div>
                                        <div id="set11" class="collapse">
                                            <div class="card-body">
                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <?php if($allOptions[13]['optionValue']=='true'){$checkModulePost = 'checked';}else{$checkModulePost = '';}?>
                                                        <label class="col-sm-4 col-xs-6 control-label" for="postSettings">Включить почту </label>
                                                        <div class="col-sm-8 col-xs-6">
                                                            <input id="postSettings" name="postSettings" type="checkbox" <?php echo $checkModulePost;?> data-toggle="toggle" data-on="Да" data-off="Нет">
                                                        </div>
                                                    </div>
                                                    <div class="form-group hiddenVisible" id="divPostSettings" style="margin-top: 15px;">
                                                        <table id="user" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th colspan="2">
                                                                    <p><span style="color: red;">*</span> Необходимо добавить действующую (корпоративную) почту и пароль. Через эту почту будет происходить отправка информации сотрудникам.</p>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td style="width:30%">Почтовый адрес</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="postAddress" data-type="text" data-pk="1">
                                                                        <?php if($allOptions[14]['optionValue']!=''){echo $allOptions[14]['optionValue'];}else{echo 'yourmail@yourmail.com';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%">Пароль</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="postPass" data-type="text" data-pk="1">
                                                                        <?php if($allOptions[15]['optionValue']!=''){echo $allOptions[15]['optionValue'];}else{echo 'yourpass';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%">SMTP Хост</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="postSMTPHost" data-type="text" data-pk="1">
                                                                        <?php if($allOptions[16]['optionValue']!=''){echo $allOptions[16]['optionValue'];}else{echo 'ssl://smtp.yandex.ru';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%">SMTP Порт</td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="postSMTPPort" data-type="text" data-pk="1">
                                                                        <?php if($allOptions[17]['optionValue']!=''){echo $allOptions[17]['optionValue'];}else{echo '465';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Загрузка логотипа-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set12" aria-expanded="false" aria-controls="set12">
                                                <i class="flaticon2-layers-1"></i> Логотип компании
                                            </div>
                                        </div>
                                        <div id="set12" class="collapse">
                                            <div class="card-body">
                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 col-xs-6 control-label">Текущий логотип </label>
                                                        <div class="col-sm-8 col-xs-6">
                                                            <img src="/public/images/logos/<?php echo $imageLogo;?>" width="120" alt="logo" class="logo-default" style="margin: 20px 0 0;"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-top: 15px;">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 col-center">
                                                                <div class="file-loading">
                                                                    <input id="imgInvoice" name="imgInvoice[]" type="file" multiple>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9" style="margin-top: 30px;">
                                                                    <button type="button" id="submitLogo" class="btn green">Отправить</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--TimeZone-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set13" aria-expanded="false" aria-controls="set13">
                                                <i class="flaticon2-layers-1"></i> Настройка времени
                                            </div>
                                        </div>
                                        <div id="set13" class="collapse">
                                            <div class="card-body">
                                                <div class="form-horizontal col-md-12">
                                                    <label class="col-sm-4 col-xs-6 control-label" for="timezoneGlobal">Выбор часового пояса</label>
                                                    <div class="col-sm-8 col-xs-6">
                                                        <a href="javascript:;" id="timezoneGlobal" data-type="select" data-pk="1" data-value="<?php echo $allOptions[19]['optionValue'];?>" data-original-title="Select sex"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Модуль входящей документации-->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#set14" aria-expanded="false" aria-controls="set14">
                                                <i class="flaticon-open-box"></i> Модуль входящей документации
                                            </div>
                                        </div>
                                        <div id="set14" class="collapse">
                                            <div class="card-body">
                                                <span class="kt-switch kt-switch--icon">
                                                    <?php if($allOptions[20]['optionValue']=='true'){$checkModuleAddDoc = 'checked';}else{$checkModuleAddDoc = '';}?>
                                                    <label>
                                                        <input class="noticeSettings" type="checkbox" <?php echo $checkModuleAddDoc;?> id="moduleAddDoc" name="moduleAddDoc" data-noticetab="moduleAddDoc">
                                                        <span></span>
                                                    </label>
                                                </span>
                                                <table class="table table-striped- table-bordered responsive" id="dataAjaxAddDoc">
                                                    <thead>
                                                        <tr>
                                                            <th width="35%">Тема</th>
                                                            <th width="35%">Согласующий</th>
                                                            <th width="30%">Действие</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                <div class="row">
                                                    <button class="btn btn-primary enterAddThemeDoc">Добавить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--Отделы в статистике-->
                        <div class="tab-pane" id="tab_5">
                            <div class="kt-portlet">
                                <table id="listStatistics"
                                       data-sort-name="fio-stat" data-sort-order="asc"
                                       data-toggle="table" data-mobile-responsive="true">
                                    <thead>
                                    <tr>
                                        <th data-field="fio-stat" data-align="center">Пользователь</th>
                                        <th data-field="listUsersStat" data-align="center">Отделы</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($managers as $manager): ?>
                                        <?php if($manager['adminUser']!='delete'):?>
                                        <tr id="user-<?php echo $manager['id'];?>">
                                            <td class="col-md-3"><?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName']; ?></td>
                                            <td class="col-md-3">
                                                <a href="javascript:;" class="checkListDepartments" data-static="<?php echo $manager['id'];?>" data-type="checklist" data-pk="<?php echo $manager['id'];?>"></a>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!--Уведомления-->
                        <div class="tab-pane" id="tab_6">
                            <div class="kt-portlet">
                                <table id="listNoticeComments"
                                       data-sort-name="fio3" data-sort-order="asc"
                                       data-toggle="table" data-mobile-responsive="true">
                                    <thead>
                                    <tr>
                                        <th data-field="fio3" data-align="center">Пользователь</th>
                                        <th data-field="noticeMail1" data-align="center">Новый<br />счет Mail</th>
                                        <th data-field="noticeMail2" data-align="center">Подписаный<br />счет Mail</th>
                                        <th data-field="noticeMail3" data-align="center">Отказ<br />Mail</th>
                                        <th data-field="noticeMail4" data-align="center">Оплата<br />Mail</th>
                                        <th data-field="noticeMail5" data-align="center">Комментарий<br />Mail</th>
                                        <th data-field="noticeDash1" data-align="center">Новый<br />счет</th>
                                        <th data-field="noticeDash2" data-align="center">Подписаный<br />счет</th>
                                        <th data-field="noticeDash3" data-align="center">Отказ<br /></th>
                                        <th data-field="noticeDash4" data-align="center">Оплата<br /></th>
                                        <th data-field="noticeDash5" data-align="center">Комментарий<br /></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($managers as $manager): ?>
                                        <?php if($manager['adminUser']!='delete'):?>
                                        <tr id="noticeuser-<?php echo $manager['id'];?>">
                                            <td style="width: 10%;"><?php echo $manager['userSurname'].' '.$manager['userFirstName']; ?></td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                <?php foreach ($noticeSettings as $item){
                                                    if($manager['id'] == $item['user_id']){
                                                        if($item['noticeMailAddInvoice']=='true'){
                                                            $checkNotice = 'checked';
                                                        }else{
                                                            $checkNotice = '';
                                                        }
                                                    }
                                                };?>
                                                    <input class="noticeSettings" name="noticeMailAddInvoice" data-noticetab="noticeMailAddInvoice"
                                                       data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                       data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeMailSignInvoice']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeMailSignInvoice" data-noticetab="noticeMailSignInvoice"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeMailFailure']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeMailFailure" data-noticetab="noticeMailFailure"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeMailSuccess']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeMailSuccess" data-noticetab="noticeMailSuccess"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td style="width: 9%;">
                                            <td>
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeMailComment']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeMailComment" data-noticetab="noticeMailComment"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeDashAddInvoice']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeDashAddInvoice" data-noticetab="noticeDashAddInvoice"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeDashSignInvoice']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeDashSignInvoice" data-noticetab="noticeDashSignInvoice"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeDashFailure']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeDashFailure" data-noticetab="noticeDashFailure"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeDashSuccess']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeDashSuccess" data-noticetab="noticeDashSuccess"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                            <td style="width: 9%;">
                                                <div class="form-horizontal">
                                                    <?php foreach ($noticeSettings as $item){
                                                        if($manager['id'] == $item['user_id']){
                                                            if($item['noticeDashComment']=='true'){
                                                                $checkNotice = 'checked';
                                                            }else{
                                                                $checkNotice = '';
                                                            }
                                                        }
                                                    };?>
                                                    <input class="noticeSettings" name="noticeDashComment" data-noticetab="noticeDashComment"
                                                           data-userid="<?php echo $manager['id'];?>" type="checkbox" <?php echo $checkNotice;?>
                                                           data-toggle="toggle" data-on="Да" data-off="Нет">
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- модальное окно добавления тематики УВД -->
<div class="modal fade" id="modalAddTheme" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление темы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="addThemeNew" class="col-form-label"><span style="color: red;">*</span> Тема:</label>
                    <input type="text" class="form-control" id="addThemeNew">
                </div>
                <div class="form-group">
                    <label for="addChargUserNew"><span style="color: red;">*</span> Ответственный:</label>
                    <select class="form-control" style="width: 100% !important;" id="addChargUserNew">
                        <option></option>
                    </select>
                </div>
                <div class="d-none" id="validateTheme">
                    <p style="color: red;text-align: center;">Проверьте поле темы</p>
                </div>
                <div class="d-none" id="validateChargUser">
                    <p style="color: red;text-align: center;">Пользователь не выбран</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="saveAddTheme">Применить</button>
            </div>
        </div>
    </div>
</div>
<!-- модальное окно редактирования тематики УВД -->
<div class="modal fade" id="modalEditTheme" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление темы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="editThemeDoc" class="col-form-label"><span style="color: red;">*</span> Тема:</label>
                    <input type="text" class="form-control" id="editThemeDoc">
                </div>
                <div class="form-group">
                    <label for="editThemeChargUser"><span style="color: red;">*</span> Ответственный:</label>
                    <select class="form-control" style="width: 100% !important;" id="editThemeChargUser">
                        <option></option>
                    </select>
                </div>
                <div class="d-none" id="validateThemeEdit">
                    <p style="color: red;text-align: center;">Проверьте поле темы</p>
                </div>
                <div class="d-none" id="validateChargUserEdit">
                    <p style="color: red;text-align: center;">Пользователь не выбран</p>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="editThemeID" id="editThemeID">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="saveEditTheme">Применить</button>
            </div>
        </div>
    </div>
</div>
<!-- модальное окно настройки пользователя Счета-Наличка-Доки -->
<div class="modal fade" id="modalSettingUser" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headSetUser">Настройка видимости пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <form class="kt-form kt-form--label-right">
                <div class="modal-body">
                    <div class="kt-section">
                        <span class="kt-section__info">
                            Счета каких пользователей видит:
                        </span>
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12" for="selectPickerInvoice">Выбор с поиском</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <select class="form-control" id="selectPickerInvoice" multiple data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Множественный выбор</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectPickerInvoice">Всех в список</button>
                                    <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectPickerInvoice">Всех из списка</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section">
                        <span class="kt-section__info">
                            Служебки каких пользователей видит:
                        </span>
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12" for="selectPickerPay">Выбор с поиском</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <select class="form-control" id="selectPickerPay" multiple data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Множественный выбор</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectPickerPay">Всех в список</button>
                                    <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectPickerPay">Всех из списка</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section">
                        <span class="kt-section__info">
                            Документы каких пользователей видит:
                        </span>
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12" for="selectPickerDoc">Выбор с поиском</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <select class="form-control" id="selectPickerDoc" multiple data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Множественный выбор</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectPickerDoc">Всех в список</button>
                                    <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectPickerDoc">Всех из списка</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-brand kt-btn" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-secondary kt-btn saveSettingsUser">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$managers = json_encode($managers);
?>
<script>
    $(document).ready(function() {
        let urlOne = '/ajax/ajaxpost';

        $(document).on('click','.btn-settingUser',function () {
            let userID = $(this).data('userid');
            let nameUser = $(this).data('nameuser');
            $('#headSetUser').text('Настройка видимости пользователя - '+nameUser);
            $('.saveSettingsUser').val(userID);
            $('#modalSettingUser').modal('show');
            getUserSettingsType(userID,'from_invoice','selectPickerInvoice');
            getUserSettingsType(userID,'from_invoicePay','selectPickerPay');
            getUserSettingsType(userID,'from_doc','selectPickerDoc');
        });
        function getUserSettingsType(userID,type,selectID) {
            $('#'+selectID).empty();
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=getUserSettingsType&userID="+userID+"&type="+type,
                success: function (data){
                    //console.log(data);
                    let result = $.parseJSON(data);
                    //console.log(result.arrData);
                    $.each(result.arrData,function(col,val) {
                        let selectUsers = '\
                        <option value="'+val.id+'" '+val.selectedS+'>'+val.name+'</option>';
                        $('#'+selectID).append(selectUsers);
                    });
                    $('#'+selectID).selectpicker('refresh');
                }
            });
            //console.log($('.kt-selectpicker').val());
        }
        $('.allSelect').on('click',function () {
            let selectID = $(this).data('selectid');
            $('#'+selectID).selectpicker('selectAll');
        });
        $('.allDeselect').on('click',function () {
            let selectID = $(this).data('selectid');
            $('#'+selectID).selectpicker('deselectAll');
        });
        $('.saveSettingsUser').on('click',function () {
            let userID = $(this).val();
            saveSettingsUser(userID,$('#selectPickerInvoice').val(),'from_invoice');
            saveSettingsUser(userID,$('#selectPickerPay').val(),'from_invoicePay');
            saveSettingsUser(userID,$('#selectPickerDoc').val(),'from_doc');
            $('#modalSettingUser').modal('hide');
        });
        function saveSettingsUser(userID,newValue,tableCol) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=editListUsers&userID="+userID+"&newValue="+newValue+"&tableCol="+tableCol,
                success: function (data) {}
            });
        }
        //$('.kt-selectpicker').selectpicker('render');
//модуль УВД
        function dataAddDoc() {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=getThemeDoc",
                success: function (data){
                    let result = $.parseJSON(data);
                    //console.log(result);
                    $('#dataAjaxAddDoc').DataTable({
                        /*scrollY: '50vh',
                        scrollX: true,
                        scrollCollapse: true,*/
                        "paging":   false, //пагинация
                        "info":     false, //инфо о общем кол-ве страниц
                        "ordering": false, //отключение сортировки
                        "searching": false, //убрать поиск,
                        "data":result,
                        "deferRender": true,
                        "columns": [
                            { "data": "themeDoc" },
                            { "data": "chargUser" },
                            { "data": "action" }
                        ],
                        "language": {
                            "emptyTable": "Нет данных по выбранным критериям"
                        }

                    });
                }
            });
        }
        dataAddDoc();

        $('.enterAddThemeDoc').on('click',function () {
            $('#modalAddTheme').modal('show');
        });
        $(document).on('click','.btn-editTheme',function () {
            $('#editThemeID').val($(this).data('themeid'));
            $('#editThemeDoc').val($(this).data('themedoc'));
            $('#editThemeChargUser').val($(this).data('charguser')).trigger('change');
            $('#modalEditTheme').modal('show');
        });
        $('#saveEditTheme').on('click',function () {
            let editThemeID = $('#editThemeID').val();
            let editThemeDoc = $('#editThemeDoc').val();
            let editThemeChargUser = $('#editThemeChargUser').val();
            $('#validateThemeEdit,#validateChargUserEdit').addClass('d-none');
            if(editThemeDoc.length<1){
                $('#validateThemeEdit').removeClass('d-none');
            }else if (editThemeChargUser.length<1){
                $('#validateChargUserEdit').removeClass('d-none');
            }else{
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=editThemeDoc&editThemeID="+editThemeID+"&editThemeDoc="+editThemeDoc+"&editThemeChargUser="+editThemeChargUser,
                    success: function (data){
                        $('#modalEditTheme').modal('hide');
                        $('#dataAjaxAddDoc').DataTable().destroy();
                        dataAddDoc();
                    }
                });
            }
        });
        let managers = <?php echo $managers;?>;
        $('#addChargUserNew,#editThemeChargUser').select2({
            placeholder: "Выбрать пользователя"
        });
        $.each(managers,function(col,val) {
            let selectManagers = '<option value="'+val.id+'">'+val.userSurname+' '+val.userFirstName+'</option>';
            $('#addChargUserNew,#editThemeChargUser').append(selectManagers);
        });
        $('#saveAddTheme').on('click',function () {
            let themeNew = $('#addThemeNew').val();
            let chargUserNew = $('#addChargUserNew').val();
            $('#validateTheme,#validateChargUser').addClass('d-none');
            if(themeNew.length<1){
                $('#validateTheme').removeClass('d-none');
            }else if (chargUserNew.length<1){
                $('#validateChargUser').removeClass('d-none');
            }else{
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=addThemeDoc&themeNew="+themeNew+"&chargUserNew="+chargUserNew,
                    success: function (data){
                        $('#modalAddTheme').modal('hide');
                        $('#dataAjaxAddDoc').DataTable().destroy();
                        dataAddDoc();
                    }
                });
            }

        });
        $('body').on('click','.btn-deleteTheme',function () {
            let deleteThemeID = $(this).data('themeid');
            console.log(deleteThemeID);
            Swal.fire({
                title: "Удалить тему?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=deleteThemeDoc&deleteThemeID="+deleteThemeID,
                        success: function (data){
                            $('#dataAjaxAddDoc').DataTable().destroy();
                            dataAddDoc();
                        }
                    });
                }
            });
        });
//отображение настроек 1С
        if($('#moduleOneC').prop('checked')){
            $('#divOneC').removeClass('hiddenVisible');
        }else{
            $('#divOneC').addClass('hiddenVisible');
        }
        $('#moduleOneC').change(function (){
            if($('#moduleOneC').prop('checked')){
                $('#divOneC').removeClass('hiddenVisible');
            }else{
                $('#divOneC').addClass('hiddenVisible');
            }
        });
//отображение настроек почты
        if($('#postSettings').prop('checked')){
            $('#divPostSettings').removeClass('hiddenVisible');
        }else{
            $('#divPostSettings').addClass('hiddenVisible');
        }
        $('#postSettings').change(function (){
            if($('#postSettings').prop('checked')){
                $('#divPostSettings').removeClass('hiddenVisible');
            }else{
                $('#divPostSettings').addClass('hiddenVisible');
            }
        });
//Получить название активной вкладки
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var activeTab = $(e.target).attr('href');
            Cookies.set('activeTab', activeTab);
        });
//Ставим куки на активную вкладку
        if(Cookies.get('activeTab') == null){
            $('#comfortSettings a[href="#tab_0"]').tab('show');
        }else{
            var tabActiv = "[href=\""+Cookies.get('activeTab')+"\"";
            $('#comfortSettings a'+tabActiv).tab('show');
        }
//Функция получения текущей даты и времени
        function datetimeToday() {
            return moment().format('DD.MM.YYYY');
        }
//в отпуск
        $('.inHoliday').on('click',function () {
            var userInHolidayID = $(this).data('userid');
            var dateToday = datetimeToday();
            Swal.fire({
                title: "Отправить в отпуск?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    $.ajax({
                        url: urlOne, type: 'POST', dataType: "text",
                        data: "adminAjax=holiday&userID="+userInHolidayID+"&typeHoliday=true&dateToday="+dateToday+"&autoDelegate=true",
                        success: function(data) {
                            window.location = "/admin/controls/";
                        }
                    });
                }
            });
        });
//из отпуска
        $('.ofHoliday').on('click',function () {
            var userOfHolidayID = $(this).data('userid');
            var dateToday = datetimeToday();
            Swal.fire({
                title: "Вернуть из отпуска?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    $.ajax({
                        url: urlOne, type: 'POST', dataType: "text",
                        data: "adminAjax=holiday&userID="+userOfHolidayID+"&typeHoliday=false&dateToday="+dateToday+"&autoDelegate=true",
                        success: function(data) {
                            window.location = "/admin/controls/";
                        }
                    });
                }
            });

        });
//иерархия отделов
        function getListComfort() {
            $.ajax({
                url: urlOne, type: "POST",
                dataType: "text",
                data: "adminAjax=getListProgress",
                cache: false,
                success: function (data) {
                    var result = $.parseJSON(data);
                    //console.log(result.progress);
                    $('#listProgress').jstree({
                        'plugins' : ['state','types','dnd'],
                        'core' : {
                            'check_callback' : true,
                            'data' : result.progress
                        },

                        'types' : {
                            "default" : {
                                "icon": "glyphicon glyphicon-th-list",
                                "max_depth": 4
                                //'level_1': '543'
                            }

                        }
                    }).bind('move_node.jstree', function(e, data) {
                        var params = {
                            id: +data.node.id,
                            old_parent: +data.old_parent,
                            new_parent: +data.parent,
                            old_position: +data.old_position,
                            new_position: +data.position
                        };
                        moveCategory(params);
                        //console.log(params);
                    });
                }
            });
        }
        getListComfort();
        function moveCategory(params) {
            var data = $.extend(params, {
                adminAjax: 'updateProgress'
            });
            $.ajax({
                url: urlOne, type: 'post',
                data: data,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                }
            });
        }
//список пользователей
        $.fn.editable.defaults.mode = 'inline';
        function ajaxUsersInvoice() {

            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "adminAjax=getListUsers",
                success: function(data) {
                    var result = $.parseJSON(data);

                    $('.invoice').editable({
                        emptytext: 'Не установлено',
                        showbuttons: false,
                        source : result,
                        success: function(response, newValue) {
                            var id = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editToMail&id="+id+"&name="+newValue+"&rowName=userToMail",
                                success: function (data) {}
                            });
                        }
                    });
                    $('.invoicePay').editable({
                        emptytext: 'Не установлено',
                        showbuttons: false,
                        source : result,
                        success: function(response, newValue) {
                            var id = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editToMail&id="+id+"&name="+newValue+"&rowName=userToMailPay",
                                success: function (data) {}
                            });
                        }
                    });
                    $('.lastSignatureInvoice').editable({
                        emptytext: 'Не установлено',
                        showbuttons: false,
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('lastSignInvoice',newValue);
                        }
                    });
                    $('.lastSignaturePay').editable({
                        emptytext: 'Не установлено',
                        showbuttons: false,
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('lastSignPay',newValue);
                        }
                    });
                    $('.oneCLast').editable({
                        emptytext: 'Не установлено',
                        showbuttons: false,
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('oneCLast',newValue);
                        }
                    });
                    $('.addCommPartner').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('addCommPartner',newValue);
                        }
                    });
                    $('.addEditContragent').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('addEditContragent',newValue);
                        }
                    });
                    $('.controlHoliday').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('controlHoliday',newValue);
                        }
                    });
                }
            });
        }
        ajaxUsersInvoice();
//валюта
        function ajaxCurrency() {
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "adminAjax=getListCurrency",
                success: function(data) {
                    var result = $.parseJSON(data);
                    $('#currencyGlobal').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('currencyGeneral',newValue);
                        }
                    });
                }
            });
        }
        ajaxCurrency();

        ajaxCheck();
        function ajaxCheck() {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=getListUserInvoice",
                success: function (data) {
                    var result = $.parseJSON(data);
                    //console.log(result);
                    $.each(result,function(col,val){
                        var resultUserID = val.user_id;
                        $('[data-dash="'+resultUserID+'"]').attr('data-value',val.from_Dashboard);
                        $('[data-invoice="'+resultUserID+'"]').attr('data-value',val.from_invoice);
                        $('[data-invoicepay="'+resultUserID+'"]').attr('data-value',val.from_invoicePay);
                        $('[data-invoicedoc="'+resultUserID+'"]').attr('data-value',val.from_doc);
                        $('[data-static="'+resultUserID+'"]').attr('data-value',val.from_Statistic);
                    });
                }
            });
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "adminAjax=getListUsers",
                success: function(data) {

                    let result = $.parseJSON(data);
                    $('.checkListUsers').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            let userID = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editListUsers&userID="+userID+"&newValue="+newValue+"&tableCol=from_invoice",
                                success: function (data) {}
                            });
                        }
                    });
                    $('.checkListUsersPay').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            let userID = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editListUsers&userID="+userID+"&newValue="+newValue+"&tableCol=from_invoicePay",
                                success: function (data) {}
                            });
                        }
                    });
                    $('.checkListUsersDoc').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            let userID = $(this).data('pk');
                            console.log(newValue);
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editListUsers&userID="+userID+"&newValue="+newValue+"&tableCol=from_doc",
                                success: function (data) {}
                            });
                        }
                    });
                    $('.checkListUsersDashboard').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            var userID = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editListUsers&userID="+userID+"&newValue="+newValue+"&tableCol=from_Dashboard",
                                success: function (data) {}
                            });
                        }
                    });
                }
            });
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "adminAjax=getDepartments",
                success: function(data) {
                    var result = $.parseJSON(data);
                    //console.log(result);
                    $('.checkListDepartments').editable({
                        emptytext: 'Не установлено',
                        placement: 'right',
                        source : result,
                        success: function(response, newValue) {
                            var userID = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editListUsers&userID="+userID+"&newValue="+newValue+"&tableCol=from_Statistic",
                                success: function (data) {}
                            });
                        }
                    });
                }
            });


        }

        $('#addressSite').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxTwoParamsOption('addressSite',newValue);
            }
        });

        $('#oneCServer').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxTwoParamsOption('oneCServer',newValue);
            }
        });

        $('#postAddress').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxTwoParamsOption('postAddress',newValue);
            }
        });
        $('#postPass').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxTwoParamsOption('postPass',newValue);
            }
        });
        $('#postSMTPHost').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxTwoParamsOption('postSMTPHost',newValue);
            }
        });
        $('#postSMTPPort').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxTwoParamsOption('postSMTPPort',newValue);
            }
        });

        $('#profitInProject').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxTwoParamsOption('profitInProject',newValue);
            }
        });

        function ajaxTwoParamsOption(option,params) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=editOptions&option="+option+"&params="+params,
                success: function (data) {}
            });
        }
        $('#modulePay').change(function() {
            ajaxTwoParamsOption('modulePay',$(this).prop('checked'));
        });
        $('#moduleAddDoc').change(function() {
            ajaxTwoParamsOption('moduleAddDoc',$(this).prop('checked'));
        });
        $('#moduleOneC').change(function() {
            ajaxTwoParamsOption('oneC',$(this).prop('checked'));
        });
        $('#postSettings').change(function() {
            ajaxTwoParamsOption('postSettings',$(this).prop('checked'));
        });
        $('#currencyCB').change(function() {
            ajaxTwoParamsOption('currencyCB',$(this).prop('checked'));
        });
        $('.noticeSettings').change(function() {
            ajaxThreeParams($(this).data('userid'),$(this).data('noticetab'),$(this).prop('checked'));
        });

        function ajaxThreeParams(userID,notice,params) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=editNotice&userID="+userID+"&notice="+notice+"&params="+params,
                success: function (data) {}
            });
        }

        $('#rurRate').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxCurrencyOption('RUR','rateCurrency',newValue);
            }
        });

        $('#eurRate').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxCurrencyOption('EUR','rateCurrency',newValue);
            }
        });

        $('#usdRate').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxCurrencyOption('USD','rateCurrency',newValue);
            }
        });

        $('#jpyRate').editable({
            type: 'text',
            success: function(response, newValue) {
                ajaxCurrencyOption('JPY','rateCurrency',newValue);
            }
        });

        function ajaxCurrencyOption(currency,tableValue,params) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=editCurrencyOption&currency="+currency+"&tableValue="+tableValue+"&params="+params,
                success: function (data) {}
            });
        }

        $('#submitLogo').on('click',function () {
            var formData = new FormData();
            $.each($('#imgInvoice')[0].files, function(key, value) {
                formData.append('file[]', value);
            });
            formData.append('adminAjax','updateLogo');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        console.log(data);
                        if(data.error==='noImage'){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Я не могу обработать запрос если нет прикрепленных файлов!",
                                type: "warning"
                            });
                        }else{
                            Swal.fire({
                                title: "Идет отправка!",
                                type: "success",
                                showConfirmButton: false,
                                timer: 10000
                            });
                            window.location = ('/admin/controls');
                        }
                    }
                });
        });

//timezone
        function ajaxTimezone() {
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "mainAjax=getListTimezone",
                success: function(data) {
                    var result = $.parseJSON(data);
                    $('#timezoneGlobal').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            ajaxTwoParamsOption('timezone',newValue);
                        }
                    });
                }
            });
        }
        ajaxTimezone();

    });
</script>