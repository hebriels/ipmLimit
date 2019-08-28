<?php //bugs($managers[0]); ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <h1 class="page-title">Настройка взаимодействий</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <ul id="comfortSettings" class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_0" data-toggle="tab"> Получатели </a>
                        </li>
                        <li>
                            <a href="#tab_1" data-toggle="tab"> Список на главной </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab"> Cчета и служебки </a>
                        </li>
                        <!--<li>
                            <a href="#tab_3" data-toggle="tab"> Подчиненность </a>
                        </li>-->
                        <li>
                            <a href="#tab_4" data-toggle="tab"> Настройка сайта </a>
                        </li>
                        <li>
                            <a href="#tab_5" data-toggle="tab"> Вывод статистики </a>
                        </li>
                        <li>
                            <a href="#tab_6" data-toggle="tab"> Уведомления </a>
                        </li>
                    </ul>
                    <div class="tab-content">
<!--Получатели-->
                        <div class="tab-pane active" id="tab_0">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-sliders"></i>Получатели</div>
                                </div>
                                <div class="mt-bootstrap-tables">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-body">
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
<!--Список на главной-->
                        <div class="tab-pane" id="tab_1">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-sliders"></i>Список на главной</div>
                                </div>
                                <div class="mt-bootstrap-tables">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-body">
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
<!--Счета и служебки-->
                        <div class="tab-pane" id="tab_2">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-sliders"></i>Счета и служебки</div>
                                </div>
                                <div class="mt-bootstrap-tables">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-body">
                                                    <table id="listUserInvoice"
                                                           data-sort-name="fio2" data-sort-order="asc"
                                                           data-toggle="table" data-mobile-responsive="true">
                                                        <thead>
                                                        <tr>
                                                            <th data-field="fio2" data-align="center">Пользователь</th>
                                                            <th data-field="department2" data-align="center">Отдел</th>
                                                            <th data-field="posts2" data-align="center">Должность</th>
                                                            <th data-field="listUsers" data-align="center">Показывать счета</th>
                                                            <th data-field="listUsersPay" data-align="center">Показывать служебки</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($managers as $manager): ?>
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
                                                            </tr>
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
                            <div class="portlet box blue col-md-6">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-cogs"></i>Настройка сайта</div>
                                </div>
                                <div class="portlet-body">
                                    <div class="panel-group accordion" id="settingsSite">
                                        <!--Адрес сайта-->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent1" href="#set1">Адрес сайта</a>
                                                </h4>
                                            </div>
                                            <div id="set1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <table id="user" class="table table-bordered table-striped">
                                                            <tbody>
                                                            <tr>
                                                                <td style="width:30%"> Адрес </td>
                                                                <td style="width:70%">
                                                                    <a href="javascript:;" id="addressSite" data-type="text" data-pk="1">
                                                                        <?php if($allOptions[0]['optionValue']!=''){echo $allOptions[0]['optionValue'];}else{echo 'http://your__site.com';}?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Последний согласующий счетов-->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent2" href="#set2">Последний согласующий счетов</a>
                                                </h4>
                                            </div>
                                            <div id="set2" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent3" href="#set3">Последний согласующий служебок</a>
                                                </h4>
                                            </div>
                                            <div id="set3" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent4" href="#set4">Добавление пользователей к комментариям</a>
                                                </h4>
                                            </div>
                                            <div id="set4" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent5" href="#set5">Редактирование покупателя, объединение в проекте</a>
                                                </h4>
                                            </div>
                                            <div id="set5" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent6" href="#set6">Модуль "Наличка"</a>
                                                </h4>
                                            </div>
                                            <div id="set6" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent7" href="#set7">Настройка валюты</a>
                                                </h4>
                                            </div>
                                            <div id="set7" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- контроль отпусков -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent8" href="#set8">Управление отпуском</a>
                                                </h4>
                                            </div>
                                            <div id="set8" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent9" href="#set9">Рентабельность проекта</a>
                                                </h4>
                                            </div>
                                            <div id="set9" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent10" href="#set10">Модуль "1С"</a>
                                                </h4>
                                            </div>
                                            <div id="set10" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent11" href="#set11">Настройка почты</a>
                                                </h4>
                                            </div>
                                            <div id="set11" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed"
                                                       data-toggle="collapse" data-parent="#parent12" href="#set12">Логотип компании</a>
                                                </h4>
                                            </div>
                                            <div id="set12" class="panel-collapse collapse">
                                                <div class="panel-body">
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
                                    </div>
                                </div>
                            </div>
                        </div>
<!--Отделы в статистике-->
                        <div class="tab-pane" id="tab_5">
                            <div class="portlet box blue col-md-6">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-sliders"></i>Отделы в статистике</div>
                                </div>
                                <div class="mt-bootstrap-tables">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-body">
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
                                                            <tr id="user-<?php echo $manager['id'];?>">
                                                                <td class="col-md-3"><?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName']; ?></td>
                                                                <td class="col-md-3">
                                                                    <a href="javascript:;" class="checkListDepartments" data-static="<?php echo $manager['id'];?>" data-type="checklist" data-pk="<?php echo $manager['id'];?>"></a>
                                                                </td>
                                                            </tr>
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
<!--Уведомления-->
                        <div class="tab-pane" id="tab_6">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-sliders"></i>Настройка уведомлений</div>
                                </div>
                                <div class="mt-bootstrap-tables">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-body">
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var urlOne = '/ajax/ajaxpost';
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
            $.cookie('activeTab', activeTab);
        });
//Ставим куки на активную вкладку
        if($.cookie('activeTab') == null){
            $('#comfortSettings a[href="#tab_0"]').tab('show');
        }else{
            var tabActiv = "[href=\""+$.cookie('activeTab')+"\"";
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
            swal({
                title: "Отправить в отпуск?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }, function (isConfirm) {
                if(isConfirm){
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
            swal({
                title: "Вернуть из отпуска?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }, function (isConfirm) {
                if(isConfirm){
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
                        $('[data-static="'+resultUserID+'"]').attr('data-value',val.from_Statistic);
                    });
                }
            });
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "adminAjax=getListUsers",
                success: function(data) {

                    var result = $.parseJSON(data);
                    $('.checkListUsers').editable({
                        emptytext: 'Не установлено',
                        source : result,
                        success: function(response, newValue) {
                            var userID = $(this).data('pk');
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
                            var userID = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editListUsers&userID="+userID+"&newValue="+newValue+"&tableCol=from_invoicePay",
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
                            swal({
                                title: "Ошибка!",
                                text: "Я не могу обработать запрос если нет прикрепленных файлов!",
                                type: "warning"
                            });
                        }else{
                            swal({
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

    });
</script>