<?php
    $arrDep = [''];
    $bossID = false;
    foreach ($allDepartments as $item){
        $arrDep[] = htmlspecialchars_decode ($item['nameDepartment']);
        if($item['bossID']==$_SESSION['mngr']['id']){
            $bossID = true;
        }
    }
    $arrInit = [''];
    foreach ($allUsers as $item){
        $arrInit[] = $item['userSurname'].' '.$item['userFirstName'];
    }
    $arrOrg = [''];
    foreach ($allOrganization as $item){
        $arrOrg[] = $item['nameOrganization'];
    }
    $arrContr = [''];
    foreach ($allContragents as $item){
        $arrContr[] = htmlspecialchars_decode ($item['name_contragent']);
    }
?>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Панель пользователя </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <?php /*if($bossID):*/?>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <table class="table table-striped table-bordered responsive table-hover tableDepartmentStatistic">
                    <thead>
                        <tr>
                            <!--<th> Отдел </th>
                            <th> Руководитель </th>-->
                            <th> Счета </th>
                            <th> Служебки </th>
                            <th> Документы </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <?php if(!empty($invoiceWork)):?>
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
						<i class="flaticon-search"></i>
					</span>
                    <div class="kt-portlet__head-title">
                        <h4>Где мой счет?</h4>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table id="whereInvoice" data-toggle="table" data-toolbar="#whereInvoiceToolbar"
                       class="table-sm">
                    <thead>
                        <tr>
                            <th>Согласующий</th>
                            <th>Счет</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($listAction['arrUserInvoice'] as $signatureNext){
                                echo '<tr><td>';
                                foreach ($allUsers as $oneUserSign){
                                    if($signatureNext==$oneUserSign['id']){
                                        echo $oneUserSign['userSurname'].' '.$oneUserSign['userFirstName'];
                                    }
                                }
                                echo '</td><td>';
                                foreach ($invoiceWork as $item){
                                    if($item['signature']==$signatureNext){
                                        $today = date("Y-m-d H:i:s");
                                        $date2 = new DateTime($today);
                                        if(empty($item['date_signature'])){
                                            $date1 = new DateTime($item['date_edit']);
                                            $diff = $date2->diff($date1);
                                        }else{
                                            $arrSign = json_decode($item['date_signature'],true);
                                            $lastArr = array_pop($arrSign);
                                            $date1 = new DateTime($lastArr['date']);
                                            $diff = $date2->diff($date1);
                                        }
                                        echo '<a href="/mngr/staffer/'.$item['id'].'" target="_blank" class="btn btn-sm btn-default btn-font-sm">
                                        '.$item['summInvoiceForPayment'].' '.$defaultDownload['currencySimbol'].'<br/>'.$diff->format('%aд:%hч:%iм').'</a>';
                                    }
                                }
                                echo '</td></tr>';
                            }

                        ?>
                    </tbody>

                </table>
            </div>
        </div>
        <?php endif;?>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <?php if($userTestInHoliday=='true'):?>
                <div class="note note-warning">
                    <h4 class="block">Внимание! Все думают что вы в отпуске.</h4>
                    <p> Если готовы приступить к работе нажмите кнопку -  <button type="button" class="btn btn-primary" id="ofHoliday"> Выйти из отпуска </button></p>
                </div>
                <?php endif;?>
                <?php
                    $viewDashbord = false;
                    if(strripos($defaultDownload['allowedListUsers'][0]['from_invoice'], ",") ||
                        strripos($defaultDownload['allowedListUsers'][0]['from_invoicePay'], ",") ||
                        strripos($defaultDownload['allowedListUsers'][0]['from_doc'], ",")){
                        $viewDashbord = true;
                    }
                    $tableId = 'tableInvoiceHome';
                    $tableNeedPay = 'tableNeedPay';
                    $tableIdPay = 'tableInvoicePayHome';
                    $tableExpencePay = 'tableExpencePay';
                ?>
                <?php if($viewDashbord==true):?>
                <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" id="liNav-1">
                            <a class="nav-link active" data-toggle="tab" href="#table1" data-target="#table1" id="linkNav-1">Счета<span class="kt-badge kt-badge--danger kt-badge--md blinkInform"></span></a>
                        </li>
                    <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                        <li class="nav-item" id="liNav-2">
                            <a class="nav-link" data-toggle="tab" href="#table2" data-target="#table2" id="linkNav-2">Платежки<span class="kt-badge kt-badge--brand kt-badge--md blinkInform"></span></a>
                        </li>
                    <?php endif;?>
                        <li class="nav-item" id="liNav-3">
                            <a class="nav-link" data-toggle="tab" href="#table3" data-target="#table3" id="linkNav-3">Наличка<span class="kt-badge kt-badge--brand kt-badge--md blinkInform"></span></span></a>
                        </li>
                        <li class="nav-item" id="liNav-4">
                            <a class="nav-link" data-toggle="tab" href="#table4" data-target="#table4" id="linkNav-4">Подотчет<span class="kt-badge kt-badge--danger kt-badge--md blinkInform"></span></a>
                        </li>
                    <li class="nav-item" id="liNav-5">
                        <a class="nav-link" data-toggle="tab" href="#table5" data-target="#table5" id="linkNav-5">Документы<span class="kt-badge kt-badge--danger kt-badge--md blinkInform"></span></a>
                    </li>
                </ul>
                <div class="tab-content">
    <!-- Счета -->
                    <div class="tab-pane active" role="tabpanel" id="table1">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                                    <h3 class="kt-portlet__head-title">
                                        Счета требующие действий <span id="<?php echo 'summHeader-'.$tableId;?>"></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="portlet-body" data-tablename="<?php echo $tableId;?>">
                                <div id="<?php echo $tableId;?>Toolbar" class="btn-group">
                                    <div class="form-group form-md-checkboxes">
                                        <div class="md-checkbox-inline">
                                            <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                                                <div class="md-checkbox has-success">
                                                    <button type="button" id="printPDF" name="printPDF" class="btn btn-default"
                                                            data-toggle="popover" data-trigger="hover" data-placement="auto"
                                                            data-content="Скачать выбранные"><i class="fa fa-download"></i>Скачать</button>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="<?php echo $tableId;?>" data-toggle="table" data-toolbar="#<?php echo $tableId;?>Toolbar"
                                           class="table-sm"
                                           data-sort-name="<?php echo $tableId;?>-date" data-sort-order="desc"
                                           data-select-item-name="selectItemName"
                                           data-show-columns="true" data-search="true"
                                           data-pagination="true" data-page-size="25" data-page-list="[5, 10, 15, 20, 25, 30]"
                                           data-show-export="true" data-export-types="['xlsx','excel']"
                                           data-filter-control="true" data-filter-show-clear="true" data-hide-unused-select-options="true"
                                           data-striped="true" data-unique-id="<?php echo $tableId;?>-id"
                                           data-cookie="true" data-cookie-id-table="<?php echo $tableId;?>">
                                        <thead>
                                        <tr>
                                            <th data-visible="false" data-field="<?php echo $tableId;?>-id" data-switchable="false"></th>
                                            <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                                                <th data-visible="false" data-field="<?php echo $tableId;?>-download" data-switchable="false"></th>
                                                <th data-field="state" data-checkbox="true"></th>
                                            <?php endif;?>
                                            <th data-field="<?php echo $tableId;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                            <th data-field="<?php echo $tableId;?>-invoiceNumber" data-align="center" data-sortable="true" data-visible="false">Счет №</th>
                                            <th data-field="<?php echo $tableId;?>-contractNumber" data-align="center" data-sortable="true">Проект</th>
                                            <th data-field="<?php echo $tableId;?>-department" data-filter-control="select" data-align="center" data-sortable="true" data-visible="false">Отдел</th>
                                            <th data-field="<?php echo $tableId;?>-initiator" data-filter-control="select" data-align="center" data-sortable="true">Инициатор</th>
                                            <th data-field="<?php echo $tableId;?>-organization" data-filter-control="select" data-align="center" data-sortable="true" data-visible="false">Организация</th>
                                            <th data-field="<?php echo $tableId;?>-kontragent" data-filter-control="select" data-align="center" data-sortable="true">Поставщик</th>
                                            <th data-field="<?php echo $tableId;?>-summ" data-align="center" data-sortable="true" data-sorter="priceSorter">Сумма</th>
                                            <th data-field="<?php echo $tableId;?>-actions" data-align="center">Действия</th>
                                            <th data-field="<?php echo $tableId;?>-notice" data-align="center">Примечания</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($allInvoice as $myData): ?>
                                            <?php if($myData['signature'] == $_SESSION['mngr']['id']):?>
                                                <?php
                                                $userName = $myData['initiatorSurname'] . ' ' . $myData['initiatorFirstName'];
                                                $preview = getImageFolder($myData['pathScanInvoice']);
                                                if($myData['urgentPayment']=='on'){$infoTR = 'table-danger';}else{$infoTR = '';}
                                                ?>
                                                <tr class="<?php echo $infoTR;?>">
                                                    <td><?php echo $myData['id'];?></td>
                                                    <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                                                        <td><?php echo '/file/invoice/'.$myData['pathScanInvoice'];?></td>
                                                        <td></td>
                                                    <?php endif;?>
                                                    <td><?php echo $myData['dateCreate'];?></td>
                                                    <td><?php echo $myData['numberInvoice'];?></td>
                                                    <td><?php
                                                        if(!empty($myData['numberContract'])){
                                                            foreach ($allProjects as $allProject) {
                                                                if($myData['numberContract'] == $allProject['id']){
                                                                    foreach ($allContragents as $itemContr){
                                                                        if(!empty($allProject['idContragent'])){
                                                                            if($allProject['idContragent'] == $itemContr['id']){
                                                                                $nameContragent = $itemContr['name_contragent'];
                                                                            }
                                                                        }else{
                                                                            $nameContragent = "<b style='color:red;'>нет привязки к покупателю!</b>";
                                                                        }
                                                                    }
                                                                    echo '<a href="javascript:;" class="linkContract" id="contragent-'.$myData['id'].'"
                                                                    data-numcont="'.$myData['numberContract'].'" data-toggle="popover" data-trigger="hover"
                                                                    data-placement="auto" data-html="true" title="Покупатель" data-content="'.$nameContragent.'">'.$allProject['nameProject'].'</a>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php $count = count($allUsers)-1;
                                                        for($i=0;$i<=$count;$i++){
                                                            if($myData['mngrId']==$allUsers[$i]['id']){
                                                                foreach ($allDepartments as $allDepartment){
                                                                    if($allUsers[$i]['userDepartment'] == $allDepartment['id']){
                                                                        echo $allDepartment['nameDepartment'];
                                                                    }
                                                                }
                                                            }
                                                        }?></td>
                                                    <td><?php echo $userName;?></td>
                                                    <td><?php foreach ($allOrganization as $itemOrg){
                                                            if($myData['organizationInvoiceForPayment'] == $itemOrg['id']){
                                                                echo $itemOrg['nameOrganization'];
                                                            }
                                                        }?></td>
                                                    <td><?php foreach ($allContragents as $itemContra){
                                                            if($myData['contragent'] == $itemContra['id']){
                                                                echo $itemContra['name_contragent'];
                                                            }
                                                        }?>
                                                    </td>
                                                    <td><?php
                                                        $moneySum = number_format($myData['summInvoiceForPayment'], 2, '.', '&nbsp;');
                                                        echo $moneySum.'&nbsp;р.';
                                                        ?></td>
                                                    <td><div class="btn-group btn-group" role="group"><?php echo $preview;?>
                                                        <a href="/mngr/staffer/<?php echo $myData['id'];?>"
                                                           class="btn btn-sm btn-outline-brand btn-icon"
                                                           data-toggle="popover" data-trigger="hover"
                                                           data-placement="auto" data-content="Перейти">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                        <?php
                                                        if($myData['signature'] == $_SESSION['mngr']['id']){
                                                            if($lastSignInvoice==$_SESSION['mngr']['id']){

                                                                echo '<button type="button"
                                                    class="btn btn-sm btn-icon btn-success btn-invoiceEnd"
                                                    id="invoiceEnd'.$myData['id'].'"
                                                    data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-dateedit="'.$myData['date_edit'].'" data-invoiceid="'.$myData['id'].'" data-needpay="'.$myData['needPay'].'"
                                                    data-mngrtable="invoice" data-idtable="'.$tableId.'" data-mngrid="'.$myData['mngrId'].'" data-currency="'.$myData['currency'].'"
                                                    data-toggle="popover" data-trigger="hover"
                                                    data-placement="auto" title="оплачено" data-content="Нажмите для подтверждения оплаты">
                                                    <i class="fas fa-check"></i></button>
                                                        <button type="button"
                                                    class="btn btn-sm btn-danger btn-icon btn-failure"
                                                    id="failure'.$myData['id'].'"
                                                    data-initiatirrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$myData['id'].'"
                                                    data-mngrtable="invoice" data-idtable="'.$tableId.'" data-mngrid="'.$myData['mngrId'].'"
                                                    data-toggle="popover" data-trigger="hover"
                                                    data-placement="auto" data-content="Отказать">
                                                    <i class="far fa-thumbs-down"></i></button>';
                                                            }else{
                                                                echo '<button type="button"
                                                    class="btn btn-sm btn-outline-success btn-icon btn-successInvoice"
                                                    id="success'.$myData['id'].'" data-dateedit="'.$myData['date_edit'].'"
                                                    data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$myData['id'].'"
                                                    data-mngrtable="invoice" data-idtable="'.$tableId.'" data-mngrid="'.$myData['mngrId'].'"
                                                    data-toggle="popover" data-trigger="hover"
                                                    data-placement="auto" data-content="Cогласовать">
                                                    <i class="far fa-thumbs-up"></i></button>
                                                        <button type="button"
                                                    class="btn btn-sm btn-outline-danger btn-icon btn-failure"
                                                    id="failure'.$myData['id'].'"
                                                    data-initiatirrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$myData['id'].'"
                                                    data-mngrtable="invoice" data-idtable="'.$tableId.'" data-mngrid="'.$myData['mngrId'].'"
                                                    data-toggle="popover" data-trigger="hover"
                                                    data-placement="auto" data-content="Отказать">
                                                    <i class="far fa-thumbs-down"></i></button>';
                                                            }
                                                        }
                                                        ?></div>
                                                    </td>
                                                    <td><?php echo $myData['noticeInvoiceForPayment']; ?></td>
                                                </tr>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
    <!-- Платежки -->
                    <div class="tab-pane" role="tabpanel" id="table2">
                        <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                            <div class="mt-bootstrap-tables" id="divNeedPay">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box purple">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-list"></i>Счета ожидающие платежку
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" data-original-title="свернуть" class="iconTableCookie collapse" data-tablename="<?php echo $tableId;?>"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body" data-tablename="<?php echo $tableNeedPay;?>">
                                                <table id="<?php echo $tableNeedPay;?>" class="table-sm"
                                                       data-mobile-responsive="true"
                                                       data-show-columns="true" data-search="true">
                                                    <thead>
                                                    <tr>
                                                        <th data-visible="false" data-field="id" data-switchable="false"></th>
                                                        <th data-field="date_success" data-align="center">Дата</th>
                                                        <th data-field="numberInvoice" data-align="center">Счет №</th>
                                                        <th data-field="initiatorSurname" data-align="center">Инициатор</th>
                                                        <th data-field="organization" data-align="center">Организация</th>
                                                        <th data-field="contragent" data-align="center">Поставщик</th>
                                                        <th data-field="summ" data-align="center">Сумма</th>
                                                        <th data-field="action" data-align="center">Действия</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
    <!-- Наличка -->
                    <div class="tab-pane" role="tabpanel" id="table3">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                                        <h3 class="kt-portlet__head-title">
                                            Служебки требующие действий <span id="<?php echo 'summHeader-'.$tableIdPay;?>"></span>
                                        </h3>
                                    </div>
                                    <!--<div class="tools">
                                        <a href="javascript:;" data-original-title="свернуть" class="iconTableCookie collapse" data-tablename="<?php /*echo $tableId;*/?>"> </a>
                                    </div>-->
                                </div>
                                <div id="js-grid-juicy-projects"></div> <!-- id для вывода превью документа -->
                                <div class="portlet-body" data-tablename="<?php echo $tableIdPay;?>">
                                    <div id="<?php echo $tableIdPay;?>Toolbar" class="btn-group">
                                        <div class="form-group form-md-checkboxes">
                                            <div class="md-checkbox-inline">
                                                <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                                                    <div class="md-checkbox has-success">
                                                        <button type="button" id="printPDF" name="printPDF" class="btn btn-default"
                                                                data-toggle="popover" data-trigger="hover" data-placement="auto"
                                                                data-content="Скачать выбранные"><i class="fa fa-download"></i>Скачать</button>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="<?php echo $tableIdPay;?>" data-toggle="table" data-toolbar="#<?php echo $tableIdPay;?>Toolbar"
                                           data-sort-name="<?php echo $tableIdPay;?>-date" data-sort-order="desc"
                                           data-select-item-name="selectItemName" data-mobile-responsive="true"
                                           data-show-columns="true" data-search="true" class="table-sm"
                                           data-pagination="true" data-page-size="25" data-page-list="[5, 10, 15, 20, 25, 30]"
                                           data-show-export="true" data-export-types="['xlsx','excel']"
                                           data-filter-control="true" data-filter-show-clear="true" data-hide-unused-select-options="true"
                                           data-striped="true" data-unique-id="<?php echo $tableIdPay;?>-id"
                                           data-cookie="true" data-cookie-id-table="<?php echo $tableIdPay;?>">
                                        <thead>
                                        <tr>
                                            <th data-visible="false" data-field="<?php echo $tableIdPay;?>-id"></th>
                                            <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                                                <th data-visible="false" data-field="<?php echo $tableIdPay;?>-download"></th>
                                                <th data-field="state" data-checkbox="true"></th>
                                            <?php endif;?>
                                            <th data-field="<?php echo $tableIdPay;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                            <th data-field="<?php echo $tableIdPay;?>-report" data-filter-control="select" data-align="center" data-sortable="true">Тип служебки</th>
                                            <th data-field="<?php echo $tableIdPay;?>-contractNumber" data-align="center" data-sortable="true">Проект</th>
                                            <th data-field="<?php echo $tableIdPay;?>-department" data-filter-control="select" data-align="center" data-sortable="true" data-visible="false">Отдел</th>
                                            <th data-field="<?php echo $tableIdPay;?>-initiator" data-filter-control="select" data-align="center" data-sortable="true">Инициатор</th>
                                            <th data-field="<?php echo $tableIdPay;?>-summ" data-align="center" data-sortable="true" data-sorter="priceSorter">Сумма</th>
                                            <th data-field="<?php echo $tableIdPay;?>-actions" data-align="center">Действия</th>
                                            <th data-field="<?php echo $tableIdPay;?>-notice" data-align="center">Примечания</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($allPay as $myData): ?>
                                            <?php if($myData['signature'] == $_SESSION['mngr']['id']):?>
                                                <?php
                                                $userName = $myData['initiatorSurname'] . ' ' . $myData['initiatorFirstName'];
                                                $underReport = getUnderReport($myData['under_report']);
                                                ?>
                                                <tr class="success">
                                                    <td><?php echo 'forPay-'.$myData['id'];?></td>
                                                    <?php if($lastSignInvoice==$_SESSION['mngr']['id']):?>
                                                        <td><?php echo '/assets/images/ava/nophoto.jpg';?></td>
                                                        <td></td>
                                                    <?php endif;?>
                                                    <td><?php echo $myData['dateCreate'];?></td>
                                                    <td><?php echo $underReport;?></td>
                                                    <td><?php
                                                        if(!empty($myData['contract'])){
                                                            foreach ($allProjects as $allProject) {
                                                                if($myData['contract'] == $allProject['id']){
                                                                    foreach ($allContragents as $itemContr){
                                                                        if(!empty($allProject['idContragent'])){
                                                                            if($allProject['idContragent'] == $itemContr['id']){
                                                                                $nameContragent = $itemContr['name_contragent'];
                                                                            }
                                                                        }else{
                                                                            $nameContragent = "<b style='color:red;'>нет привязки к покупателю!</b>";
                                                                        }
                                                                    }
                                                                    echo '<a href="javascript:;" class="linkContract"
                                                                data-numcont="'.$myData['contract'].'" data-toggle="popover" data-trigger="hover"
                                                                data-placement="auto" data-html="true" title="Покупатель" data-content="'.$nameContragent.'">'.$allProject['nameProject'].'</a>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php $count = count($allUsers)-1;
                                                        for($i=0;$i<=$count;$i++){
                                                            if($myData['user_id']==$allUsers[$i]['id']){
                                                                foreach ($allDepartments as $allDepartment){
                                                                    if($allUsers[$i]['userDepartment'] == $allDepartment['id']){
                                                                        echo $allDepartment['nameDepartment'];
                                                                    }
                                                                }
                                                            }
                                                        }?></td>
                                                    <td><?php echo $userName;?></td>
                                                    <td><?php
                                                        $moneySum = number_format($myData['money'], 2, '.', '&nbsp;');
                                                        echo $moneySum.'&nbsp;р.';
                                                        ?></td>
                                                    <td><div class="btn-group btn-group" role="group">
                                                        <?php
                                                            if(!empty($myData['paths_pay'])){
                                                                echo getImageFolderPay($myData['paths_pay']);
                                                            }
                                                        ?>
                                                        <a href="/mngr/onepay/<?php echo $myData['id'];?>"
                                                           class="btn btn-sm btn-outline-brand btn-icon"
                                                           data-toggle="popover" data-trigger="hover"
                                                           data-placement="auto" data-content="Перейти">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                        <?php
                                                        if($myData['signature'] == $_SESSION['mngr']['id']){
                                                            if($lastSignPay==$_SESSION['mngr']['id']){
                                                                echo '<button type="button"
                                                        class="btn btn-sm btn-outline-success btn-icon btn-invoiceEnd"
                                                        id="invoiceEnd'.$myData['id'].'" data-dateedit="'.$myData['date_edit'].'"
                                                        data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$myData['id'].'"
                                                        data-mngrtable="forPay" data-idtable="'.$tableIdPay.'" data-mngrid="'.$myData['user_id'].'"
                                                        data-toggle="popover" data-trigger="hover"
                                                        data-placement="auto" title="оплачено" data-content="Нажмите для подтверждения оплаты">
                                                        <i class="fas fa-check"></i></button>';
                                                            }else{
                                                                echo '<button type="button"
                                                        class="btn btn-sm btn-icon btn-outline-success btn-successInvoice"
                                                        id="success'.$myData['id'].'" data-dateedit="'.$myData['date_edit'].'"
                                                        data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$myData['id'].'"
                                                        data-mngrtable="forPay" data-idtable="'.$tableIdPay.'" data-mngrid="'.$myData['user_id'].'"
                                                        data-toggle="popover" data-trigger="hover"
                                                        data-placement="auto" data-content="Cогласовать">
                                                        <i class="far fa-thumbs-up"></i></button>
                                                            <button type="button"
                                                        class="btn btn-sm btn-outline-danger btn-icon btn-failure"
                                                        id="failure'.$myData['id'].'"
                                                        data-initiatirrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$myData['id'].'"
                                                        data-mngrtable="forPay" data-idtable="'.$tableIdPay.'" data-mngrid="'.$myData['user_id'].'"
                                                        data-toggle="popover" data-trigger="hover"
                                                        data-placement="auto" data-content="Отказать">
                                                        <i class="fas fa-thumbs-down"></i></button>';
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $myData['notice_pay']; ?></td>
                                                </tr>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
    <!-- Подотчет -->
                    <div class="tab-pane" role="tabpanel" id="table4">

                            <div class="mt-bootstrap-tables">
                                <div class="col-md-12">
                                    <div class="portlet box grey-cascade">
                                        <div class="portlet-title">
                                            <div class="caption" style="line-height: 18px;">
                                                <i class="fa fa-list"></i>Подотчеты требующие действий
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" data-original-title="свернуть" class="iconTableCookie collapse" data-tablename="<?php echo $tableExpencePay;?>"> </a>
                                            </div>
                                        </div>
                                        <div id="js-grid-juicy-projects"></div> <!-- id для вывода превью документа -->
                                        <div class="portlet-body" data-tablename="<?php echo $tableExpencePay;?>">
                                            <table id="<?php echo $tableExpencePay;?>" data-toggle="table"
                                                   data-sort-name="<?php echo $tableExpencePay;?>-date" data-sort-order="desc"
                                                   data-mobile-responsive="true"
                                                   data-show-columns="true" data-search="true"
                                                   data-pagination="true" data-page-size="25" data-page-list="[5, 10, 15, 20, 25, 30]"
                                                   data-show-export="true" data-export-types="['xlsx','excel']"
                                                   data-filter-control="true" data-filter-show-clear="true" data-hide-unused-select-options="true"
                                                   data-striped="true" data-unique-id="<?php echo $tableExpencePay;?>-id"
                                                   data-cookie="true" data-cookie-id-table="<?php echo $tableExpencePay;?>">
                                                <thead>
                                                <tr>
                                                    <th data-visible="false" data-field="<?php echo $tableExpencePay;?>-id"></th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-invoiceNumber" data-align="center" data-sortable="true">Счет №</th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-contractNumber" data-align="center" data-sortable="true">Проект</th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-department" data-filter-control="select" data-align="center" data-sortable="true">Отдел</th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-initiator" data-filter-control="select" data-align="center" data-sortable="true">Инициатор</th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-summ" data-align="center" data-sortable="true" data-sorter="priceSorter">Сумма</th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-actions" data-align="center">Действия</th>
                                                    <th data-field="<?php echo $tableExpencePay;?>-notice" data-align="center">Примечания</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($allPay as $myData): ?>
                                                    <?php if($myData['report_sign'] == $_SESSION['mngr']['id']):?>
                                                        <?php
                                                        $userName = $myData['initiatorSurname'] . ' ' . $myData['initiatorFirstName'];
                                                        ?>
                                                        <tr class="success">
                                                            <td><?php echo 'forPay-'.$myData['id'];?></td>
                                                            <td><?php echo $myData['dateCreate'];?></td>
                                                            <td><?php echo $myData['id'];?></td>
                                                            <td><?php
                                                                if(!empty($myData['contract'])){
                                                                    foreach ($allProjects as $allProject) {
                                                                        if($myData['contract'] == $allProject['id']){
                                                                            foreach ($allContragents as $itemContr){
                                                                                if(!empty($allProject['idContragent'])){
                                                                                    if($allProject['idContragent'] == $itemContr['id']){
                                                                                        $nameContragent = $itemContr['name_contragent'];
                                                                                    }
                                                                                }else{
                                                                                    $nameContragent = "<b style='color:red;'>нет привязки к покупателю!</b>";
                                                                                }
                                                                            }
                                                                            echo '<a href="javascript:;" class="linkContract"
                                                                        data-numcont="'.$myData['contract'].'" data-toggle="popover" data-trigger="hover"
                                                                        data-placement="auto" data-html="true" title="Покупатель" data-content="'.$nameContragent.'">'.$allProject['nameProject'].'</a>';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php $count = count($allUsers)-1;
                                                                for($i=0;$i<=$count;$i++){
                                                                    if($myData['user_id']==$allUsers[$i]['id']){
                                                                        foreach ($allDepartments as $allDepartment){
                                                                            if($allUsers[$i]['userDepartment'] == $allDepartment['id']){
                                                                                echo $allDepartment['nameDepartment'];
                                                                            }
                                                                        }
                                                                    }
                                                                }?></td>
                                                            <td><?php echo $userName;?></td>
                                                            <td><?php
                                                                $moneySum = number_format($myData['money'], 2, '.', '&nbsp;');
                                                                echo $moneySum.'&nbsp;р.';
                                                                ?></td>
                                                            <td>
                                                                <a href="/mngr/reportpay/<?php echo $myData['id'];?>"
                                                                   class="btn btn-xs btn-outline blue"
                                                                   data-toggle="popover" data-trigger="hover"
                                                                   data-placement="auto" data-content="Перейти">
                                                                    <i class="fa fa-arrows-alt"></i>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $myData['notice_pay']; ?></td>
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
    <!-- Документы -->
                    <div class="tab-pane" role="tabpanel" id="table5">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                                    <h3 class="kt-portlet__head-title"> Документы ожидающие согласования</h3>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="documentsToolbar" class="btn-group">
                                    <!--<div class="form-group form-md-checkboxes">
                                        <div class="md-checkbox-inline">
                                            <?php /*if($lastSignInvoice==$_SESSION['mngr']['id']):*/?>
                                                <div class="md-checkbox has-success">
                                                    <button type="button" id="printPDF" name="printPDF" class="btn btn-default"
                                                            data-toggle="popover" data-trigger="hover" data-placement="auto"
                                                            data-content="Скачать выбранные"><i class="fa fa-download"></i>Скачать</button>
                                                </div>
                                            <?php /*endif;*/?>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="table-responsive">
                                    <table id="documents" data-toggle="table" data-toolbar="#documentsToolbar"
                                           class="table-sm"
                                           data-sort-name="documents-date" data-sort-order="desc"
                                           data-select-item-name="selectItemName"
                                           data-show-columns="true" data-search="true"
                                           data-pagination="true" data-page-size="25" data-page-list="[5, 10, 15, 20, 25, 30]"
                                           data-show-export="true" data-export-types="['xlsx','excel']"
                                           data-filter-control="true" data-filter-show-clear="true" data-hide-unused-select-options="true"
                                           data-striped="true" data-unique-id="documents-id"
                                           data-cookie="true" data-cookie-id-table="documents">
                                        <thead>
                                        <tr>
                                            <th data-field="documents-id" data-visible="false" data-switchable="false"></th>
                                            <th data-field="documents-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                            <th data-field="documents-idNumber" data-align="center">№</th>
                                            <th data-field="documents-depUser" data-align="center">Отдел</th>
                                            <th data-field="documents-fromTo" data-align="center">От кого</th>
                                            <!--<th data-field="documents-chargUser" data-align="center">Ответственный</th>-->
                                            <th data-field="documents-theme" data-align="center">Тематика</th>
                                            <th data-field="documents-preview" data-align="center">Документы</th>
                                            <th data-field="documents-actions" data-align="center">Действия</th>
                                            <th data-field="documents-notice" data-align="center">Примечания</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($allDoc as $myData): ?>
                                            <?php if($myData['signature'] == $_SESSION['mngr']['id']):?>
                                                <?php
                                                    //$userName = $myData['initiatorSurname'] . ' ' . $myData['initiatorFirstName'];
                                                    $preview = getImageFolderDoc($myData['fileAddDoc']);
                                                    foreach ($allUsers as $userIn){
                                                        if($myData['signature']==$userIn['id']){
                                                            $userSignDoc = $userIn['userSurname'].' '.$userIn['userFirstName'];
                                                            $userDep = $userIn['userDepartment'];
                                                        }
                                                    }
                                                ?>

                                                <tr>
                                                    <td><?php echo $myData['id'];?></td>
                                                    <td><?php echo $myData['dateCreate'];?></td>
                                                    <td><?php echo $myData['id'];?></td>
                                                    <td><?php
                                                            foreach ($allDepartments as $allDepartment){
                                                                if($userDep == $allDepartment['id']){
                                                                    echo $allDepartment['nameDepartment'];
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <!--<td><?php /*echo $userSignDoc;*/?></td>-->
                                                    <td><?php
                                                            foreach ($allContragents as $itemContr){
                                                                if($myData['fromTo']==$itemContr['id']) {
                                                                    echo $itemContr['name_contragent'];
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                            foreach ($themeDocs as $themeD) {
                                                                if($myData['themeAddDoc'] == $themeD['id']){
                                                                    echo $themeD['themeDoc'];
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $preview;?></td>
                                                    <td>
                                                        <div class="btn-group btn-group" role="group">
                                                            <a href="/mngr/onedoc/<?php echo $myData['id'];?>"
                                                               class="btn btn-sm btn-outline-brand btn-icon" target="_blank"
                                                               data-toggle="popover" data-trigger="hover"
                                                               data-placement="auto" data-content="Перейти">
                                                                <i class="fa fa-arrows-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $myData['noticeAddDoc']; ?></td>
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
                <?php endif;?>
            </div>
        </div>
        <!-- Статистка работы -->
        <?php if(!empty($defaultDownload['allowedListUsers'][0]['from_Statistic'])):?>
            <div class="row">
                <div class="col-md-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="flaticon2-graphic"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Статистика работы
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row kt-margin-b-20">
                                <div class="input-group date floatdate">
                                    <input type="text" class="form-control" readonly name="order_date_from" placeholder="от" id="dateFrom" />
                                    <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                    </div>
                                </div>
                                <div class="input-group date floatdate">
                                    <input type="text" class="form-control" id="dateTo" readonly name="order_date_to" placeholder="до">
                                    <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                    </div>
                                </div>
                                <div class="btn-group btn-group" role="group">
                                    <button type="button" class="btn btn-secondary" id="inputTime">Искать</button>
                                    <button type="button" class="btn btn-secondary" id="allTime">Все время</button>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                            <table class="table table-striped table-bordered responsive table-hover tableMemberStatistic">
                                <thead>
                                <tr>
                                    <th> Пользователь </th>
                                    <th> Всего счетов </th>
                                    <th> Сумма </th>
                                    <th> Оплачено </th>
                                    <th> Отказы </th>
                                    <th> Качество </th>
                                    <th> Подписание </th>
                                    <th> Оплата </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>

    <div class="modal fade" id="modalNeedPay" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Отправление платежки</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="file-loading">
                        <input id="imgInvoice" name="imgInvoice" type="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mailInitiator" name="mailInitiator">
                    <input type="hidden" id="idInvoiceNeedPay" name="idInvoiceNeedPay">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveNeedPay">Отправить</button>
                </div>
            </div>
        </div>
    </div>
    <div id="divLink" style="display: none;"></div>
</div>
<!-- END CONTENT -->
<?php
    $arrDep = json_encode($arrDep);
    $arrInit = json_encode($arrInit);
    $arrOrg = json_encode($arrOrg);
    $arrContr = json_encode($arrContr);
?>
<script>
    $(document).ready(function() {


        $('#dateFrom,#dateTo').datepicker({
            rtl: KTUtil.isRTL(),
            language: "ru",
            todayHighlight: true,
            orientation: "bottom left",
            //templates: arrows
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        var urlOne = '/ajax/ajaxpost';
        var tableId = '<?php echo $tableId;?>'; //таблица счетов
        var tableNeedPay = '<?php echo $tableNeedPay;?>'; //таблица платежки
        var tableIdPay = '<?php echo $tableIdPay;?>'; //таблица наличка
        var tableExpencePay = '<?php echo $tableExpencePay;?>'; //таблица подотчет
        var currencyGeneral = '<?php echo $defaultDownload['currencyGeneral'];?>';
//select2 в фильтре
        function selext2table() {
            let arrDep = <?php echo $arrDep;?>;
            let arrInit = <?php echo $arrInit;?>;
            let arrOrg = <?php echo $arrOrg;?>;
            let arrContr = <?php echo $arrContr;?>;
            /*$('#'+tableId).bootstrapTable("setSelect2Data", ""+tableId+"-department", arrDep);
            $('#'+tableId).bootstrapTable("setSelect2Data", ""+tableId+"-initiator", arrInit);
            $('#'+tableId).bootstrapTable("setSelect2Data", ""+tableId+"-organization", arrOrg);
            $('#'+tableId).bootstrapTable("setSelect2Data", ""+tableId+"-kontragent", arrContr);

            $('#'+tableIdPay).bootstrapTable("setSelect2Data", ""+tableIdPay+"-department", arrDep);
            $('#'+tableIdPay).bootstrapTable("setSelect2Data", ""+tableIdPay+"-initiator", arrInit);*/
        }
        selext2table();
//платежка
        var result = null;
        $('body').on('click','.needPayID',function () {
            $('#mailInitiator').val($(this).data('mail'));
            $('#idInvoiceNeedPay').val($(this).data('id'));
            $('#modalNeedPay').modal('show');
        });
        $('#saveNeedPay').on('click',function () {
            var formData = new FormData();
            formData.append('idInvoice', $('#idInvoiceNeedPay').val());
            formData.append('file', $('#imgInvoice')[0].files[0]);
            formData.append('mainAjax','saveNeedPay');
            formData.append('mailInitiator',$('#mailInitiator').val());

            $.ajax({
                url: urlOne, type: "POST", dataType: "json",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $('#modalNeedPay').modal('hide');
                    //console.log(data);
                    if(data.error==='noImage'){
                        Swal.fire({
                            title: "Ошибка!",
                            text: "Нет прикрепленного файла!",
                            type: "warning"
                        });
                    }
                    if(data.info===false){
                        Swal.fire({
                            title: "Ошибка!",
                            text: "Отправка по почте отключена! Обратитесь к администратору.",
                            type: "warning"
                        });
                    }
                    if(data.info===true){
                        Swal.fire({
                            title: "Отправлено успешно!",
                            type: "success"
                        });
                        refreshTableNeedPay();
                    }
                }
            });
        });
        $.ajax({
            url: urlOne, type: "POST", dataType: "text",
            data: "mainAjax=updateTableNeedPay",
            success: function (data) {
                result = $.parseJSON(data);
                $('#'+tableNeedPay).bootstrapTable({
                    data: result
                });
                countAndActive();
            }
        });
        function refreshTableNeedPay() {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=updateTableNeedPay",
                success: function (data) {
                    result = $.parseJSON(data);
                    if(result.length>0){
                        $('body #tableNeedPay').bootstrapTable('refreshOptions', {
                            data: result
                        });
                        if($('body #liNav-2').length === 0){
                            $('.nav-pills').append('<li id="liNav-2"><a data-toggle="tab" href="#table2" id="linkNav-2">Платежки<span class="badge badge-default blinkInform"></span></a></li>');
                        }
                    }else{
                        //$.cookie('activeTabHome', null, {path: '/'});
                        Cookies.remove('activeTabHome');
                        $('body #tableNeedPay').bootstrapTable('refreshOptions', {
                            data: result
                        });
                    }
                    countAndActive();
                }
            });
        }
//установка активного таба
        //countAndActive();
        //Получить название активной вкладки
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var activeTab = $(e.target).attr('href');
            Cookies.set('activeTabHome', activeTab);
        });
        function countAndActive() {
            let countInvoice = $('#'+tableId).bootstrapTable('getData');
            let countTableNeedPay = $('#'+tableNeedPay).bootstrapTable('getData');
            let countInvoicePay = $('#'+tableIdPay).bootstrapTable('getData');
            let countExpencePay = $('#'+tableExpencePay).bootstrapTable('getData');
            let countDoc = $('#documents').bootstrapTable('getData');

            if(Cookies.get('activeTabHome') != null){
                $('body a[href="'+Cookies.get("activeTabHome")+'"]').tab('show');
            }else {
                if (countInvoice.length > 0) {

                    $('body #liNav-1 a[href="#table1"]').tab('show');
                } else if (countInvoice.length < 1 && countInvoicePay.length > 0) {
                    $('body #liNav-3 a[href="#table3"]').tab('show');
                } else if (countInvoice.length < 1 && countInvoicePay.length < 1 && countTableNeedPay.length > 0) {
                    $('body #liNav-2 a[href="#table2"]').tab('show');
                } else if (countInvoice.length < 1 && countInvoicePay.length < 1 && countTableNeedPay.length < 1 && countExpencePay.length > 0) {
                    $('body #liNav-4 a[href="#table4"]').tab('show');
                } else if(countInvoice.length < 1 && countInvoicePay.length < 1 && countTableNeedPay.length < 1 && countExpencePay.length < 1 && countDoc.length>0){
                    $('body #liNav-5 a[href="#table5"]').tab('show');
                } else {
                    //$('.nav-pills').append('<li id="liDefault"><a data-toggle="tab" href="#table5" id="linkDefault">Какой чудесный день! Ничего не надо делать!!!<span class="badge badge-default blinkInform"></span></a></li>');
                    //$('body #liDefault a[href="#table5"]').tab('show');
                }
            }

            insertTabInvoice(countInvoice.length,'#linkNav-1','#liNav-1');
            insertTabInvoice(countTableNeedPay.length,'#linkNav-2','#liNav-2');
            insertTabInvoice(countInvoicePay.length,'#linkNav-3','#liNav-3');
            insertTabInvoice(countExpencePay.length,'#linkNav-4','#liNav-4');
            insertTabInvoice(countDoc.length,'#linkNav-5','#liNav-5');
        }
        function insertTabInvoice(count,linkNav,liNav) {
            if(count>0){
                $('body '+linkNav).find('span').text(count);
            }else{
                $('body '+liNav).remove();
            }
        }
//печать документов
        let zip = new JSZip();
        function downloadFile(){
            zip.generateAsync({type:"blob"})
                .then(function(content) {
                    // see FileSaver.js
                    saveAs(content, "invoices.zip");
                });

            zip = new JSZip(); //создание нового объекта ZIP чтобы затереть старый
        }
        function urlToPromise(url) {
            return new Promise(function(resolve, reject) {
                JSZipUtils.getBinaryContent(url, function (err, data) {
                    if(err) {
                        reject(err);
                    } else {
                        resolve(data);
                    }
                });
            });
        }
        $('#printPDF').on('click',function () {
            var index = [];
            var newPrint = [];
            var selectRow = $('input[name="selectItemName"]:checked');
            if(selectRow.length!==0){
                Swal.fire({
                    title: "Добавление информации",
                    text: "Желаете добавить файл с информацией о выбранных счетах?",
                    type: "info",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    cancelButtonText: "Отмена",
                    confirmButtonText: "Да"
                }).then((isConfirm)=>{
                    if (isConfirm.value) {
                        selectRow.each(function () {
                            index.push($(this).data('index'));
                            newPrint = JSON.stringify($('#'+tableId).bootstrapTable('getAllSelections'));
                        });
                        newPrint = $.parseJSON(newPrint);
                        var output = [];
                        var moneySum = 0;
                        for (var i = 0;i<newPrint.length;i++){
                            var linkParse = $('#contragent-'+newPrint[i][tableId + '-id']);
                            var contragentPrint = linkParse.data('content');
                            var projectPrint = linkParse.text();
                            moneySum = String(newPrint[i][tableId + '-summ']);
                            moneySum = moneySum.replace(/&nbsp;/g, ' ');
                            output += '<h4>Информация о счете '+newPrint[i][tableId + '-invoiceNumber']+'</h4><table border="1" style="border-collapse: collapse;">' +
                                '<tr><td>№ счета</td><td>'+newPrint[i][tableId + '-invoiceNumber']+'</td></tr>' +
                                '<tr><td>Проект</td><td>'+projectPrint+'</td></tr>' +
                                '<tr><td>Контрагент</td><td>'+contragentPrint+'</td></tr>' +
                                '<tr><td>Сумма к оплате</td><td>'+moneySum+'</td></tr>' +
                                '<tr><td>Поставщик</td><td>'+newPrint[i][tableId + '-kontragent']+'</td></tr>' +
                                '<tr><td>Инициатор</td><td>'+newPrint[i][tableId + '-initiator']+'</td></tr>' +
                                '<tr><td>Примечание</td><td>'+newPrint[i][tableId + '-notice']+'</td></tr></table><hr>';
                        }
                        $.each(newPrint,function (col,val) {
                            var pdfFile = newPrint[col][tableId+'-download'].split('invoice/');
                            zip.file(pdfFile[1], urlToPromise('/file/invoice/'+pdfFile[1]), {binary:true});
                        });
                        $.ajax({
                            url: urlOne, type: "POST", dataType: 'html',
                            data: "mainAjax=addInfoForPrint&html="+output,
                            success: function (data) {
                                var result = $.parseJSON(data);
                                var infoFile = result.resultPath;
                                zip.file('infoFile.pdf', urlToPromise('/file/'+infoFile), {binary:true});
                                downloadFile();
                            }
                        });
                    }else{
                        selectRow.each(function () {
                            index.push($(this).data('index'));
                            newPrint = JSON.stringify($('#'+tableId).bootstrapTable('getAllSelections'));
                        });
                        newPrint = $.parseJSON(newPrint);
                        for(var i=0;i<newPrint.length;i++){
                            var pdfFile = newPrint[i][tableId+'-download'].split('invoice/');
                            zip.file(pdfFile[1], urlToPromise('/file/invoice/'+pdfFile[1]), {binary:true});
                        }
                        downloadFile();
                    }
                });

            }else{
                Swal.fire({
                    title: "Ой",
                    text: "Ну... Как бы не выбрано же ничего",
                    type: "info"
                });
            }
        });
//расчет итоговой цены
        insertTotal(tableId);
        insertTotal(tableIdPay);
        function insertTotal(tabLE) {
            var getDataTable = $('#'+tabLE).bootstrapTable('getData');
            var countLength = getDataTable.length;
            var sumArrTD=0;
            //console.log(getDataTable);
            for(var i = 0;i<countLength;i++){
                var parseSummInTable = String(getDataTable[i][tabLE+'-summ']).replace(/&nbsp;/g, '');
                sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
            }
            sumArrTD = sumArrTD.toFixed(2);
            sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
            var appArrTD = ' на сумму: <span id="totalTable" class="summToTotal">'+sumArrTD+'&nbspр.</span>';
            //if($('body #summFooter-'+tabLE).length === 0){
            //    $('.pagination-detail').after('<div class="pull-right pagination" id="summFooter-'+tabLE+'"><span class="pagination-info summToTotal">'+sumArrTD+'&nbspр.</span></div>');
            //}
            if($('[data-tablename="'+tabLE+'"]').find('#summFooter-'+tabLE).length === 0){
                $('[data-tablename="'+tabLE+'"]').find('.pagination-detail').after('<div class="pull-right pagination" id="summFooter-'+tabLE+'"><span class="pagination-info summToTotal">'+sumArrTD+'&nbspр.</span></div>');
            }
            //$('th[data-field="tableAll-summ"]').find('.no-filter-control').append(appArrTD);
            $('#summHeader-'+tabLE).html(appArrTD);
        }

        Cookies.set('userMail','<?php echo $_SESSION['mngr']['userMail'];?>', { path: '/' });
        Cookies.set('userAvatar','<?php echo $_SESSION['mngr']['userAvatar'];?>', { path: '/' });
        Cookies.set('userSurname','<?php echo $_SESSION['mngr']['userSurname'];?>', { path: '/' });
        Cookies.set('userFirstName','<?php echo $_SESSION['mngr']['userFirstName'];?>', { path: '/' });

        $('input[data-field="'+tableId+'-id"]').css('display','none'); //убрать этот столбик из сетки таблицы
        $('input[data-field="'+tableIdPay+'-id"]').css('display','none'); //убрать этот столбик из сетки таблицы

        $('table').on('all.bs.table', function () { //popover при фильтрации таблицы
            $('[data-toggle="popover"]').popover();
            $('.btn-circle-filter').find(':first').text('Все');
            $('#totalTable').remove();
            insertTotal(tableId);
            //selext2table();
        });
        $('.btn-circle-filter').find(':first').text('Все'); //найти все селекты и поставить в первый option text ВСЕ
//Функция получения текущей даты и времени
        function datetimeToday() {
            return moment().format('DD.MM.YYYY HH:mm');
        }

        function dateToday() {
            return moment().format('DD.MM.YYYY');
        }
//кнопка согласования
        function btnSuccessPre(invoiceId,mngrtable,mngrID,initiatorRole,idTable) {
            var tableFromProjectID = 'invoicePay';
            if(idTable==='tableInvoiceHome'){
                tableFromProjectID = 'invoice';
            }
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testProfit&idInvoice="+invoiceId+"&tableFromProjectID="+tableFromProjectID,
                success: function (data){
                    //console.log(data);
                    var result = $.parseJSON(data);
                    if(result.testProfit['typeProject']==='inside'){
                        btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole,idTable);
                    }else{
                        if(!result.testProfit['profitExit']){
                            Swal.fire({
                                title: "Внимание!!!",
                                //html: true,
                                html: '<h4 style="color: red;">Проект в критической рентабельности</h4>',
                                type: "warning",
                                allowOutsideClick: true,
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                cancelButtonText: "Продолжить работу",
                                confirmButtonText: "Перейти в счет",
                                closeModal: true
                            }).then((isConfirm)=>{
                                if (isConfirm.value){
                                    window.location = ('/mngr/staffer/'+invoiceId);
                                }else{
                                    setTimeout(function(){
                                        btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole,idTable);
                                    },500);
                                }
                            });
                        }else{
                            btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole,idTable);
                        }
                    }
                }
            });
        }
        $('body').on('click', '.btn-successInvoice', function(){
            let dateEdit = $(this).data('dateedit');
            let invoiceId = $(this).data('invoiceid');
            let mngrtable = $(this).data('mngrtable');
            let mngrID = $(this).data('mngrid');
            let initiatorRole = $(this).data('initiatorrole');
            let idTable = $(this).data('idtable');
            /*console.log(invoiceId);
            console.log(mngrtable);
            console.log(dateEdit);*/
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testEdit&idInvoice="+invoiceId+"&typeAdd="+mngrtable+"&dateEdit="+dateEdit,
                success: function (data) {
                    console.log(data);
                    let result = $.parseJSON(data);
                    console.log(result);
                    if(result.resultTest===false){
                        Swal.fire({
                            title: "Внимание!",
                            text: "Документ был отредактирован, обновите страницу.",
                            type: "warning",
                            allowOutsideClick: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Понятно"
                        });
                    }else{
                        btnSuccessPre(invoiceId,mngrtable,mngrID,initiatorRole,idTable);
                    }
                }
            });
        });
        function btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole,idTable) {
            var dateToday = datetimeToday();
            Swal.fire({
                title: "Подписать?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    if(mngrtable==='forPay'){
                        $('#' + idTable).bootstrapTable('removeByUniqueId', 'forPay-'+invoiceId);
                    }else{
                        $('#' + idTable).bootstrapTable('removeByUniqueId', invoiceId);
                    }
                    setTimeout(function () {
                        Swal.fire({
                            title: "Документ подписан!",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }, 200);
                    countAndActive();
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=success&dateToday="+dateToday,
                        success: function (data) {}
                    });

                    //тестирование POST запросов
                    /*$.ajax({
                        url: urlServer, type: "POST", dataType: "text",
                        data: "initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=success&dateToday="+dateToday,
                        success: function (data) {
                            console.log(data);
                            var result = $.parseJSON(data);
                            console.log(result.getStatusPost);
                            console.log('Данные о Покупателе');
                            console.log('ID покупателя (idContragent) - '+result.getStatusPost['idContragent']);
                            console.log('ИНН (inn_contragent) - '+result.getStatusPost['inn_contragent']);
                            console.log('КПП (kpp_contragent) - '+result.getStatusPost['kpp_contragent']);
                            console.log('Наименование (name_contragent) - '+result.getStatusPost['name_contragent']);
                            console.log('Проект покупателя');
                            console.log('ID проекта (idProject) - '+result.getStatusPost['idProject']);
                            console.log('Название проекта (nameProject) - '+result.getStatusPost['nameProject']);
                            console.log('Данные о поставщике');
                            console.log('ID поставщика (idContragentSale) - '+result.getStatusPost['idContragentSale']);
                            console.log('ИНН (inn_contragentSale) - '+result.getStatusPost['inn_contragentSale']);
                            console.log('КПП (kpp_contragentSale) - '+result.getStatusPost['kpp_contragentSale']);
                            console.log('Наименование (name_contragentSale) - '+result.getStatusPost['name_contragentSale']);
                            console.log('Общие данные');
                            console.log('ID счета (invoiceId) - '+result.getStatusPost['invoiceId']);
                            console.log('№ счета на оплату (numberInvoice) - '+result.getStatusPost['numberInvoice']);
                            console.log('Сумма к оплате (money) - '+result.getStatusPost['money']);
                            console.log('Организация (organization) - '+result.getStatusPost['organization']);
                            console.log('Примечание (notice) - '+result.getStatusPost['notice']);
                            console.log('Файл (pathScanInvoice) - '+result.getStatusPost['pathScanInvoice']);
                        }
                    });*/
                    var oneC = '<?php echo $oneC;?>';
                    var oneCLast = '<?php echo $oneCLast;?>';
                    var userID = '<?php echo $_SESSION['mngr']['id'];?>';
                    if(oneC==='true'){
                        if(userID===oneCLast){
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "mainAjax=postPost&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=success&dateToday="+dateToday,
                                success: function (data) {
                                    var result = $.parseJSON(data);

                                    /*console.log('Данные о Покупателе');
                                    console.log('ID покупателя (idContragent) - '+result.getStatusPost['idContragent']);
                                    console.log('ИНН (inn_contragent) - '+result.getStatusPost['inn_contragent']);
                                    console.log('КПП (kpp_contragent) - '+result.getStatusPost['kpp_contragent']);
                                    console.log('Наименование (name_contragent) - '+result.getStatusPost['name_contragent']);
                                    console.log('Проект покупателя');
                                    console.log('ID проекта (idProject) - '+result.getStatusPost['idProject']);
                                    console.log('Название проекта (nameProject) - '+result.getStatusPost['nameProject']);
                                    console.log('Данные о поставщике');
                                    console.log('ID поставщика (idContragentSale) - '+result.getStatusPost['idContragentSale']);
                                    console.log('ИНН (inn_contragentSale) - '+result.getStatusPost['inn_contragentSale']);
                                    console.log('КПП (kpp_contragentSale) - '+result.getStatusPost['kpp_contragentSale']);
                                    console.log('Наименование (name_contragentSale) - '+result.getStatusPost['name_contragentSale']);
                                    console.log('Общие данные');
                                    console.log('ID счета (invoiceId) - '+result.getStatusPost['invoiceId']);
                                    console.log('№ счета на оплату (numberInvoice) - '+result.getStatusPost['numberInvoice']);
                                    console.log('Сумма к оплате (money) - '+result.getStatusPost['money']);
                                    console.log('Организация (organization) - '+result.getStatusPost['organization']);
                                    console.log('ИНН Организации (inn_organization) - '+result.getStatusPost['inn_organization']);
                                    console.log('Примечание (notice) - '+result.getStatusPost['notice']);
                                    console.log('Ссылка (pathScanInvoice) - '+result.getStatusPost['pathScanInvoice']);
                                    console.log('Файл (pathFileInvoice) - '+result.getStatusPost['pathFileInvoice']);*/
                                    postServer1C(result.getStatusPost);
                                }
                            });
                        }
                    }
                }
            });
        }
        function postServer1C(getStatusPost) {
            var urlServer = '<?php echo $oneCServer;?>';
            var dataJSON = {
                'idContragent':getStatusPost['idContragent'],
                'inn_contragent':getStatusPost['inn_contragent'],
                'kpp_contragent':getStatusPost['kpp_contragent'],
                'name_contragent':getStatusPost['name_contragent'],
                'idProject':getStatusPost['idProject'],
                'nameProject':getStatusPost['nameProject'],
                'idContragentSale':getStatusPost['idContragentSale'],
                'inn_contragentSale':getStatusPost['inn_contragentSale'],
                'kpp_contragentSale':getStatusPost['kpp_contragentSale'],
                'name_contragentSale':getStatusPost['name_contragentSale'],
                'invoiceId':getStatusPost['invoiceId'],
                'numberInvoice':getStatusPost['numberInvoice'],
                'money':getStatusPost['money'],
                'organization':getStatusPost['organization'],
                'inn_organization':getStatusPost['inn_organization'],
                'notice':getStatusPost['notice'],
                'pathScanInvoice':getStatusPost['pathScanInvoice']
            };
            $.ajax({
                url: urlServer, type: "POST", dataType: "json",
                data: dataJSON,
                contentType: 'multipart/form-data',
                success: function (data) {
                    //console.log(data);
                }
            });
        }
        $('body').on('click', '.btn-failure', function() {
            var invoiceId = $(this).data('invoiceid');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var initiatorRole = $(this).data('initiatorrole');
            var idTable = $(this).data('idtable');
            var uniqueId = invoiceId;

            var dateToday = datetimeToday();
            Swal.fire({
                title: "Отказ в подписании",
                text: "Укажите причину отказа:",
                input: 'text',
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                preConfirm: (isText) => {
                    if (`${isText}` === "") {
                        Swal.showValidationMessage(
                            "Вы не указали причину отказа!"
                        )
                    }
                }
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    Swal.fire({
                        title: "Отказ зарегистрирован",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    let inputValueFailure = isConfirm.value;
                    if(mngrtable==='forPay'){
                        $('#' + idTable).bootstrapTable('removeByUniqueId', 'forPay-'+invoiceId);
                    }else{
                        $('#' + idTable).bootstrapTable('removeByUniqueId', invoiceId);
                    }
                    countAndActive();
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=failure&dateToday="+dateToday+"&inputValueFailure="+inputValueFailure,
                        success: function (data) {}
                    });
                }
            });
        });
        $('body').on('click', '.btn-invoiceEnd', function(){
            let dateEdit = $(this).data('dateedit');
            let invoiceId = $(this).data('invoiceid');
            let mngrtable = $(this).data('mngrtable');
            let needPay = $(this).data('needpay');
            let mngrID = $(this).data('mngrid');
            let initiatorRole = $(this).data('initiatorrole');
            let idTable = $(this).data('idtable');
            let currency = $(this).data('currency');
            if(needPay===true){
                needPay = '<p style="color: red;"><b>Инициатор запросил платежку!</b></p>';
            }else{
                needPay = '';
            }
            let dateToday = datetimeToday();
            let textNotice = "Данная служебка была отредактирована, обновите окно браузера";
            if(mngrtable==='invoice'){
                textNotice = "Данный счет был отредактирован, обновите окно браузера";
            }
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testEdit&idInvoice="+invoiceId+"&typeAdd="+mngrtable+"&dateEdit="+dateEdit,
                success: function (data) {
                    let result = $.parseJSON(data);
                    if(result.resultTest===false){
                        Swal.fire({
                            title: "Внимание!",
                            text: textNotice,
                            type: "warning",
                            allowOutsideClick: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Понятно"
                        });
                    }
                }
            });


            if(mngrtable!=='forPay' && parseInt(currencyGeneral)!==currency){
                Swal.fire({
                    title: "Внимание!"+needPay,
                    text: "Необходимо указать сумму фактической оплаты",
                    input: 'text',
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Отмена",
                    confirmButtonText: "Подтвердить",
                    preConfirm: (isText) => {
                        if (`${isText}` === "") {
                            Swal.showValidationMessage(
                                "Вы не указали сумму оплаты!"
                            )
                        }else if (!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(`${isText}`)) {
                            Swal.showValidationMessage("Возможно есть пробелы. Точка или запятая разделитель копеек!");
                            //return false
                        }
                    }
                }).then((isConfirm)=>{
                    if (isConfirm.value) {
                        if(mngrtable==='forPay'){
                            $('#' + idTable).bootstrapTable('removeByUniqueId', 'forPay-'+invoiceId);
                        }else{
                            $('#' + idTable).bootstrapTable('removeByUniqueId', invoiceId);
                        }
                        let inputValueMoney = isConfirm.value;
                        setTimeout(function () {
                            Swal.fire({
                                title: "Счет оплачен!",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }, 200);
                        $.ajax({
                            url: urlOne, type: "POST", dataType: "text",
                            data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday+"&inputValueMoney="+inputValueMoney,
                            success: function (data) {
                                refreshTableNeedPay();
                            }
                        });
                    }
                });
            }else{
                let titleWarning = 'Вы оплатили счет?';
                let titleSuccess = 'Счет оплачен!';
                if(mngrtable==='forPay'){
                    titleWarning = 'Инициатор получил средства?';
                    titleSuccess = 'Cредства перечислены';
                }
                Swal.fire({
                    title: titleWarning,
                    html: needPay,
                    type: "warning",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Нет",
                    confirmButtonText: "Да"
                }).then((isConfirm)=>{
                    if (isConfirm.value) {
                        if (mngrtable === 'forPay') {
                            $('#' + idTable).bootstrapTable('removeByUniqueId', 'forPay-' + invoiceId);
                        } else {
                            $('#' + idTable).bootstrapTable('removeByUniqueId', invoiceId);
                        }
                        setTimeout(function () {
                            Swal.fire({
                                title: titleSuccess,
                                type: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }, 200); // время в мс

                        $.ajax({
                            url: urlOne, type: "POST", dataType: "text",
                            data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday,
                            success: function (data) {
                                refreshTableNeedPay();
                            }
                        });
                    }
                });
            }
        });

//Таблица статистики отделов
        function tableDepartmentStatic() {
            let userID = '<?php echo $_SESSION['mngr']['id'];?>';
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=loadDepartmentStatistic&userID="+userID,
                success: function (data) {
                    //console.log(data);
                    let result = $.parseJSON(data);
                    //console.log(result.test);
                    $('.tableDepartmentStatistic').DataTable({
                        //scrollY: '70vh',
                        //scrollX: true,
                        //scrollCollapse: true,
                        "paging":   false, //пагинация
                        "info":     false, //инфо о общем кол-ве страниц
                        "ordering": false, //отключение сортировки
                        "searching": false, //убрать поиск,
                        "data":result.arrDepStat,
                        "deferRender": true,
                        "columns": [
                            /*{ "data": "department" },
                            { "data": "userChargeData" },*/
                            { "data": "totalInvoice" },
                            { "data": "totalPay" },
                            { "data": "totalDoc" }
                        ],
                        "language": {
                            "emptyTable": "Нет данных"
                        }
                    });
                }
            });
        }
        tableDepartmentStatic();
//Таблица статистики пользователей
        function tableStatic() {
            let dateFrom = $('#dateFrom').val();
            if(dateFrom==='' || dateFrom==null){dateFrom='01.01.2018';}
            let dateTo = $('#dateTo').val();
            if(dateTo==='' || dateTo==null){dateTo='01.01.2030';}
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=loadAllInvoiceMngr&dateFrom="+dateFrom+"&dateTo="+dateTo+"&forUserID=all",
                success: function (data) {
                    let result = $.parseJSON(data);
                    $('.tableMemberStatistic').DataTable({
                        scrollY: '70vh',
                        scrollX: true,
                        //scrollCollapse: true,
                        "paging":   false, //пагинация
                        "info":     false, //инфо о общем кол-ве страниц
                        "ordering": false, //отключение сортировки
                        "searching": false, //убрать поиск,
                        "data":result.arrStatMngr,
                        "deferRender": true,
                        "columns": [
                            { "data": "userName" },
                            { "data": "invoiceCount" },
                            { "data": "totalInvoice" },
                            { "data": "statusSuccess" },
                            { "data": "statusFailure" },
                            { "data": "percent" },
                            { "data": "signature" },
                            { "data": "payment" }
                        ],
                        "language": {
                            "emptyTable": "Нет данных по выбранным критериям"
                        }
                    });
                }
            });
        }
        tableStatic();
        $('#inputTime').on('click', function () {
            $('.tableMemberStatistic').DataTable().destroy();
            tableStatic();
        });
        $('#allTime').on('click', function () {
            $('#dateFrom,#dateTo').val('');
            $('.tableMemberStatistic').DataTable().destroy();
            tableStatic();
        });

//замена функции Date.parse для SAFARI и IE
        function datetimeToTimestamp(datetime)
        {
            var regDatetime = /^[0-9]{4}-(?:[0]?[0-9]{1}|10|11|12)-(?:[012]?[0-9]{1}|30|31)(?: (?:[01]?[0-9]{1}|20|21|22|23)(?::[0-5]?[0-9]{1})?(?::[0-5]?[0-9]{1})?)?$/;
            if(regDatetime.test(datetime) === false)
                throw("Wrong format for the param. `Y-m-d H:i:s` expected.");

            var a=datetime.split(" ");
            var d=a[0].split("-");
            var t=a[1].split(":");

            var date = new Date();
            date.setUTCFullYear(d[0],(d[1]-1),d[2]);
            date.setUTCHours(t[0],t[1],t[2], 0);

            return date.getTime();
        }

        $('body').on('click','.targetUserName',function () {
            let userID = $(this).data('userid');
            window.location = ('/mngr/document?useridstat='+userID);
        });

        $('body').on('click','.targetLink',function () {
            let navbar = $(this).data('link');
            window.location = ('/mngr/document?navbar='+navbar);
        });


        $('body').on('click','.linkContract',function () {
            var idProject = $(this).data('numcont');
            window.open ('/mngr/analitics/project'+idProject);
        });

        $('#ofHoliday').on('click',function () {
            var userOfHolidayID = '<?php echo $_SESSION['mngr']['id'];?>';
            Swal.fire({
                title: "Вы выходите из отпуска?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    var dateTodays = dateToday();
                    $.ajax({
                        url: urlOne, type: 'POST', dataType: "text",
                        data: "mainAjax=holiday&userID="+userOfHolidayID+"&typeHoliday=false&dateToday="+dateTodays+"&autoDelegate=true",
                        success: function(data) {
                            window.location = "/mngr/dashboard";
                        }
                    });
                }
            });

        });

        $('.clickWhereInvoice').on('click',function () {
            window.location = "/mngr/staffer/"+$(this).data('idinvoice')+"";
        });

        //проверка адреса сайта
        var addressSite = '<?php echo $addressSite;?>';
        var origin = window.location.origin;
        if(addressSite!==origin){
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=editOptions&option=addressSite&params="+origin,
                success: function (data) {}
            });
        }
    });
</script>