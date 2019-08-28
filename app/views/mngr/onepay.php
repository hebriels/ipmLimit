<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Служебка №
                <?php
                echo $onePay[0]['id'].', дата создания ';
                echo $onePay[0]['dateCreate'];
                if($testProfit['typeProject']=='outside'){
                    if(!$testProfit['profitExit']){
                        echo ' <b style="background-color: red; padding: 0 5px;color: white;font-size: 22px;">проект в критической прибыли.</b>';
                    }
                }
                ?>
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <input type="hidden" id="idDoc" value="<?php echo $onePay[0]['id'];?>">
            <input type="hidden" id="userAvatar" value="<?php echo $defaultDownload['userPathAvatar'];?>">
            <input type="hidden" id="userName" value="<?php echo $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'];?>">
            <input type="hidden" id="getStatus" value="<?php echo $onePay[0]['status_pay'];?>">
            <input type="hidden" id="userID" value="<?php echo $_SESSION['mngr']['id'];?>">
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <table data-toggle="table">
                            <thead>
                            <tr>
                                <th data-field="status" data-align="center">Статус</th>
                                <th data-field="issuedMoney" data-align="center">Выдано</th>
                                <th data-field="money" data-align="center">Сумма</th>
                                <th data-field="notice" data-align="center">Примечания</th>
                                <th data-field="initiator" data-align="center">Инициатор</th>
                                <th data-field="access" data-align="center">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo getLabelStatus($onePay[0]['status_pay']);?></td>
                                <td><?php if(empty($onePay[0]['issuedMoney'])){$onePay[0]['issuedMoney']=$onePay[0]['money'];}
                                    $moneyIssued = number_format($onePay[0]['issuedMoney'], 2, '.', '&nbsp;');
                                    echo $moneyIssued.'&nbsp;р.';
                                    ?></td>
                                <td><?php
                                    $moneySum = number_format($onePay[0]['money'], 2, '.', '&nbsp;');
                                    echo $moneySum.'&nbsp;р.';
                                    ?></td>
                                <td><?php echo $onePay[0]['notice_pay'];?></td>
                                <td>
                                    <div class="mt-author">
                                        <div class="mt-avatar">
                                            <span><?php echo $onePay[0]['initiatorSurname'].' '.$onePay[0]['initiatorFirstName'];?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group">
                                    <?php
                                        if(!empty($onePay[0]['paths_pay'])){
                                            echo getImageFolderPay($onePay[0]['paths_pay']);
                                        }
                                        if($onePay[0]['signature'] == $_SESSION['mngr']['id']) {
                                            if ($lastSignPay == $_SESSION['mngr']['id']) {
                                                echo '<button type="button"
                                                class="btn btn-sm btn-outline-success btn-icon btn-invoiceEnd"
                                                id="invoiceEnd' . $onePay[0]['id'] . '"
                                                data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $onePay[0]['id'] . '"
                                                data-mngrtable="forPay" data-mngrid="' . $onePay[0]['user_id'] . '"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="Оплачено">
                                                <i class="fa fa-check"></i></button>';
                                            } else {
                                                echo '<button type="button"
                                                class="btn btn-sm btn-outline-success btn-icon btnSuccess"
                                                id="success'.$onePay[0]['id'].'" data-dateedit="'.$onePay[0]['date_edit'].'"
                                                data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="' . $onePay[0]['id'] . '"
                                                data-mngrtable="forPay" data-mngrid="'.$onePay[0]['user_id'].'"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="Согласовать">
                                            <i class="fas fa-thumbs-up"></i></button>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger btn-icon btn-failure"
                                                id="failure'.$onePay[0]['id'].'"
                                                data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $onePay[0]['id'] . '"
                                                data-mngrtable="forPay" data-mngrid="'.$onePay[0]['user_id'].'"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="Отказать">
                                            <i class="fas fa-thumbs-down"></i></button>';
                                            }
                                        }
                                        if($onePay[0]['user_id'] == $_SESSION['mngr']['id'] && $onePay[0]['status_pay'] == '1') {
                                            echo '<a href="/mngr/editpay/'.$onePay[0]['id'].'" id="editPay"
                                                class="btn btn-sm btn-outline-brand btn-icon" data-toggle="popover" data-trigger="hover" data-placement="auto"
                                                 data-content="Редактировать">
                                                        <i class="fa fa-edit"></i></a>';
                                            echo '<button type="button"
                                            class="btn btn-sm btn-outline-danger btn-icon btn-failure-user"
                                            id="failure'.$onePay[0]['id'].'"
                                            data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $onePay[0]['id'] . '"
                                            data-mngrtable="forPay" data-mngrid="'.$onePay[0]['user_id'].'"
                                            data-toggle="popover" data-trigger="hover"
                                            data-placement="auto" data-content="Отказать самому себе))">
                                        <i class="fas fa-times"></i></button>';
                                        }
                                    ?>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <?php
                            $optionArgs = array(
                                'typeProject' => $testProfit['typeProject'], //тип проекта (внутренний, внешний,без проекта)
                                'allProjects' => $allProjects, //массив проектов
                                'numberContract' => $onePay[0]['contract'], //ID контракта
                                'from_Statistic' => $defaultDownload['allowedListUsers'][0]['from_Statistic'], //массив пользователей с разрешенной статистикой
                                'allContragents' => $allContragents, //массив контрагентов
                                'moneyProjectSupp' => $testProfit['moneyProjectSupp'], //стоимость проекта
                                'money' => $testProfit['money'], //сумма счетов оплаченных
                                'moneyOther' => $testProfit['moneyOther'], //сумма счетов в работе
                                'perfect' => $testProfit['perfect'], //прибыль с оплаченных
                                'perfectOther' => $testProfit['perfectOther'], //прибыль в работе
                                'perfectPercent' => $testProfit['perfectPercent'], //процент прибыли с оплаченных
                                'perfectPercentOther' => $testProfit['perfectPercentOther'] //процент прибыли в работе
                            );
                        echo profitProject($optionArgs);?>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab_1" data-toggle="tab"> Комментарии </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_2" data-toggle="tab"> История </a>
                                </li>
                                <?php if($onePay[0]['under_report']=='true' || $onePay[0]['under_report']=='trueOff' && $onePay[0]['status_pay']=='7'):?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab_3" data-toggle="tab"> Подотчет </a>
                                    </li>
                                <?php endif;?>
                                <?php
                                $addCommPartner = explode(",",$addCommPartner);
                                $notPartners = false;
                                foreach ($addCommPartner as $item) {
                                    if ($item == $_SESSION['mngr']['id']) {
                                        $notPartners = true;
                                    }
                                }
                                if($notPartners==true):?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab_4" data-toggle="tab"> Участники </a>
                                    </li>
                                <?php endif;?>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
                                        <!--<button class="kt-app__aside-close" id="kt_chat_aside_close">
                                            <i class="la la-close"></i>
                                        </button>-->
                                        <!--Begin:: App Content  kt-grid__item--fluid kt-app__content   -->
                                        <div class="kt-grid__item kt-app__aside--fit mr-3" style="min-width: 50%;" id="kt_chat_content">
                                            <div class="kt-chat">
                                                <div class="kt-portlet kt-portlet--head-lg- kt-portlet--last">
                                                    <div class="kt-portlet__head">
                                                        <div class="kt-chat__head ">
                                                            <div class="kt-chat__left">
                                                                <span>Комментарии</span>
                                                            </div>
                                                            <div class="kt-chat__center">
                                                                <div class="kt-chat__pic commentPartners">
                                                                    <?php
                                                                    $arrPartners = explode(",",$getCommPartners[0]['idPartner']);
                                                                    foreach ($arrPartners as $idPartner){
                                                                        foreach ($allUsers as $user){
                                                                            if($user['id']==$idPartner){
                                                                                echo '<span class="kt-userpic kt-userpic--sm kt-userpic--circle" data-toggle="kt-tooltip" data-placement="top" title="'.$user['userSurname'].' '.$user['userFirstName'].'" data-original-title="Tooltip title">
                                                                                        <img src="/assets/images/ava/'.$user['userAvatar'].'" alt="image">
                                                                                    </span>';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="kt-chat__right">
                                                                <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addPartner" data-idcontra="">
                                                                    <i class="flaticon2-add-1"></i>
                                                                </a>
                                                                <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addPartners" data-idcontra="">
                                                                    <i class="flaticon-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                                                            <div class="kt-chat__messages commentList">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-portlet__foot">
                                                        <div class="kt-chat__input" id="commentBan">
                                                            <div class="kt-chat__editor">
                                                                <textarea class="form-control todo-taskbody-taskdesc textTextarea" id="idTextareaComment" rows="4" placeholder="Сообщение ..."></textarea>
                                                            </div>
                                                            <div class="kt-chat__toolbar">
                                                                <!--<div class="kt_chat__tools">
                                                                    <a href="#"><i class="flaticon2-link"></i></a>
                                                                    <a href="#"><i class="flaticon2-photograph"></i></a>
                                                                    <a href="#"><i class="flaticon2-photo-camera"></i></a>
                                                                </div>-->
                                                                <div class="kt_chat__actions">
                                                                    <button type="button" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply btnEnterComment" data-typedoc="forPay">Отправить</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="kt-timeline-v2">
                                        <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                                            <div class="kt-timeline-v2__item">
                                                <span class="kt-timeline-v2__item-time"><?php echo $onePay[0]['dateCreate'];?></span>
                                                <div class="kt-timeline-v2__item-cricle">
                                                    <i class="fa fa-genderless kt-font-warning"></i>
                                                </div>
                                                <div class="kt-timeline-v2__item-text  kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                    Инициатор
                                                    <?php echo $onePay[0]['initiatorSurname'].' '.$onePay[0]['initiatorFirstName'];?>
                                                </div>
                                            </div>
                                            <?php if($onePay[0]['date_signature'] != ''):?>
                                                <?php $signature = json_decode($onePay[0]['date_signature']);
                                                foreach ($signature as $item):?>
                                                    <div class="kt-timeline-v2__item">
                                                        <span class="kt-timeline-v2__item-time"><?php echo $item->date;?></span>
                                                        <div class="kt-timeline-v2__item-cricle">
                                                            <i class="fa fa-genderless kt-font-brand"></i>
                                                        </div>
                                                        <div class="kt-timeline-v2__item-text kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                            Подписан
                                                            <?php echo $item->autor;?>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                            <?php if($onePay[0]['date_success'] != ''):?>
                                                <div class="kt-timeline-v2__item">
                                                    <span class="kt-timeline-v2__item-time"><?php echo $onePay[0]['date_success'];?></span>
                                                    <div class="kt-timeline-v2__item-cricle">
                                                        <i class="fa fa-genderless kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-timeline-v2__item-text kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                        Оплачен
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                            <?php if($onePay[0]['date_false'] != ''):?>
                                                <div class="kt-timeline-v2__item">
                                                    <span class="kt-timeline-v2__item-time"><?php echo $onePay[0]['date_false'];?></span>
                                                    <div class="kt-timeline-v2__item-cricle">
                                                        <i class="fa fa-genderless kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-timeline-v2__item-text kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                        Отказано в подписании
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_3">
                                    <?php if($onePay[0]['user_id'] == $_SESSION['mngr']['id'] && empty($onePay[0]['date_reportLastSign'])):?>
                                        <button type="button" class="btn green-jungle" style="margin-bottom: 10px;" id="linkToReport">Перейти к сдаче подотчета</button>
                                    <?php endif;?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="portlet box green-haze">
                                                <div class="portlet-title">
                                                    <div class="caption"><i class="fa fa-comments"></i>Расходы</div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-bordered table-hover"
                                                               data-toggle="table" id="tableReport"
                                                               data-show-export="true" data-export-types="['xlsx','excel']">
                                                            <thead>
                                                            <tr>
                                                                <th>№</th>
                                                                <th>Описание траты</th>
                                                                <th>Проект</th>
                                                                <th>Сумма</th>
                                                                <th>Чек</th>
                                                                <th>Дата</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $col='1'; foreach ($expensePay as $item):?>
                                                                <?php if($item['status']=='true'){
                                                                    $status = 'style="background-color:#00EA79;"';
                                                                }else $status = '';?>
                                                                <tr id="exp-<?php echo $item['id'];?>" class="<?php echo $item['report_class'];?>">
                                                                    <td <?php //echo $status;?> data-number="<?php echo $col;?>"><?php echo $col;?></td>
                                                                    <td id="expense-<?php echo $item['id'];?>" <?php //echo $status;?>><?php echo $item['text_expense'];?></td>
                                                                    <td><?php
                                                                        if($item['id_project']!=0){
                                                                            foreach ($allProjects as $allProject) {
                                                                                if($item['id_project'] == $allProject['id']){
                                                                                    echo $allProject['nameProject'];
                                                                                }
                                                                            }
                                                                        }else{
                                                                            echo 'без проекта';
                                                                        }
                                                                        ?></td>
                                                                    <td id="money-<?php echo $item['id'];?>" <?php //echo $status;?>>
                                                                        <?php $moneySum = number_format($item['money'], 2, '.', '&nbsp;');
                                                                        echo $moneySum.'&nbsp;р.';?>
                                                                    </td>
                                                                    <td>
                                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                                            <input type="checkbox" disabled <?php if($item['check_pay']=='true'){echo 'checked';}?> id="check-<?php echo $item['id'];?>">
                                                                            <span></span>
                                                                        </label>
                                                                    </td>
                                                                    <td id="dataExpense-<?php echo $item['id'];?>"<?php //echo $status;?>><?php echo $item['date_expense'];?></td>
                                                                </tr>
                                                                <?php $col++; endforeach;?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <ul class="todo-task-history">
                                        <?php if($onePay[0]['date_reportHeadSign'] != ''):?>
                                            <li>
                                                <div class="todo-task-history-desc"> Принят руководителем </div>
                                                <div class="todo-task-history-date"><?php echo $onePay[0]['date_reportHeadSign'];?></div>
                                            </li>
                                        <?php endif;?>
                                        <?php
                                        $cashBack = $onePay[0]['issuedMoney']-$onePay[0]['money'];
                                        $cashBack = number_format($cashBack, 2, '.', '&nbsp;');
                                        if($onePay[0]['date_reportBackCash'] != ''):?>
                                            <li>
                                                <div class="todo-task-history-desc"> Принят возврат наличных <?php echo '('.$cashBack.' р.)';?></div>
                                                <div class="todo-task-history-date"><?php echo $onePay[0]['date_reportBackCash'];?></div>
                                            </li>
                                        <?php endif;?>
                                        <?php
                                        $addCash = $onePay[0]['money']-$onePay[0]['issuedMoney'];
                                        $addCash = number_format($addCash, 2, '.', '&nbsp;');
                                        if($onePay[0]['date_reportAddCash'] != ''):?>
                                            <li>
                                                <div class="todo-task-history-desc"> Выданы доп.наличные на перерасход <?php echo '('.$addCash.' р.)';?></div>
                                                <div class="todo-task-history-date"><?php echo $onePay[0]['date_reportAddCash'];?></div>
                                            </li>
                                        <?php endif;?>
                                        <?php if($onePay[0]['date_reportLastSign'] != ''):?>
                                            <li>
                                                <div class="todo-task-history-desc"> Принят бухгалтерией </div>
                                                <div class="todo-task-history-date"><?php echo $onePay[0]['date_reportLastSign'];?></div>
                                            </li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="tab_4">
                                    <ul class="todo-task-history" id="commentPartners">
                                        <?php
                                        $arrPartners = explode(",",$getCommPartners[0]['idPartner']);
                                        foreach ($arrPartners as $idPartner){
                                            foreach ($allUsers as $user){
                                                if($user['id']==$idPartner){
                                                    echo '<li><div class="todo-task-history-desc"> Участник - '.$user['userSurname'].' '.$user['userFirstName'].'</div></li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <button class="btn btn-outline-success addPartner">Добавить участника</button>
                                </div>
                            </div>

                            <!-- .events-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно добавления участника -->
    <div class="modal fade" id="modalAddPartner" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление участника</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectUser" class="col-form-label">Список работников:</label>
                        <select style="width: 100% !important;" class="form-control kt-select2" name="selectUser" id="selectUser"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddPartners">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php $allUsers = json_encode($allUsers);?>
<script src="/app/scriptPage/comments.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        //var urlOne = '/ajax/ajaxpost';
        var idInvoice = '<?php echo $onePay[0]["id"];?>';
        let allUsers = <?php echo $allUsers;?>;
        var profitExit = '<?php echo $testProfit['profitExit'];?>';
        var projectID = '<?php echo $testProfit['projectID'];?>';
        $('#linkToReport').on('click',function () {
            window.location = '/mngr/reportpay/'+idInvoice;
        });


//проверка если нет ID в таблице partner, то добавляем
        /*$.ajax({
            url: urlOne, type: "POST", dataType: "text",
            data: "mainAjax=testPartner&idInvoice="+idInvoice+"&typeAdd=forPay",
            success: function (data){}
        });*/
//вызов модального окна добавления пользователя к комментам
        $('#selectUser').select2({
            placeholder: "Выбрать пользователя"
        });
        $('.addPartner').on('click',function () {
            $.each(allUsers,function(col,val) {
                var selectUsers = '\
                    <option value="'+val.id+'">'+val.userSurname+' '+val.userFirstName+'</option>';
                $('#selectUser').append(selectUsers);
            });
            $('#modalAddPartner').modal('show');
        });
//сохраняем добавленного пользователя
        $('#saveAddPartners').on('click',function () {
            let selectUser = $('#selectUser').val();
            $('#modalAddPartner').modal('hide');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=addPartner&idInvoice="+idInvoice+"&selectUser="+selectUser+"&typeAdd=forPay",
                success: function (data) {
                    let result = $.parseJSON(data);
                    $('#commentPartners').append('<li><div class="todo-task-history-desc"> Участник - '+result.userName+'</div></li>');
                    $('.commentPartners').append('<span class="kt-userpic kt-userpic--sm kt-userpic--circle" data-toggle="kt-tooltip" data-placement="top" title="'+result.userName+'" data-original-title="Tooltip title"><img src="/assets/images/ava/'+result.userAvatar+'" alt="image"></span>');
                }
            });
        });

        function btnSuccessPre(invoiceId,mngrtable,mngrID,initiatorRole) {
            if(!profitExit){
                Swal.fire({
                    title: "Внимание!!!",
                    html: '<h4 style="color: red;">Проект в критической рентабельности</h4>',
                    type: "warning",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Продолжить работу",
                    confirmButtonText: "Смотреть проект",
                    closeOnConfirm: false,
                    closeModal: true
                }).then((isConfirm)=>{
                    if (isConfirm.value){
                        window.location = ('/mngr/analitics/project'+projectID);
                    }else{
                        setTimeout(function(){
                            btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole);
                        },500);
                    }
                });
            }else{
                btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole);
            }

        }
        function btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole) {
            var dateToday = datetimeToday();

            Swal.fire({
                title: "Подписать?",
                type: "warning",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    Swal.fire({
                        title: "Документ подписан!",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#success'+invoiceId).remove(); //удаляем кнопку success
                    $('#failure'+invoiceId).remove(); //удаляем кнопку failure
                    $('body').find('.label-warning').removeClass('label-warning').addClass('label-default').attr('data-content','согласован руководителем');

                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=success&dateToday="+dateToday,
                        success: function (data) {}
                    });
                }
            });
        }
        $('body').on('click', '.btnSuccess', function(){
            var dateEdit = $(this).data('dateedit');
            var invoiceId = $(this).data('invoiceid');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var initiatorRole = $(this).data('initiatorrole');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testEdit&idInvoice="+invoiceId+"&typeAdd=forPay&dateEdit="+dateEdit,
                success: function (data) {

                    //console.log(data);
                    var result = $.parseJSON(data);
                    if(result.resultTest===false){
                        Swal.fire({
                            title: "Внимание!",
                            text: "Документ был отредактирован, обновите страницу.",
                            type: "warning",
                            allowOutsideClick: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Понятно",
                            closeOnConfirm: false
                        });
                    }else{
                        //btnSuccessPre(invoiceId,mngrtable,mngrID,initiatorRole);
                        btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole);
                    }
                }
            });
        });

        $('body').on('click', '.btn-failure', function(){
            var invoiceId = $(this).data('invoiceid');
            var initiatorRole = $(this).data('initiatorrole');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');

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
                    //getStatusInvoceFailure();
                    $('#success' + invoiceId).remove(); //удаляем кнопку success
                    $('#failure' + invoiceId).remove(); //удаляем кнопку failure
                    $(document).find('.label-warning').removeClass('label-warning').addClass('label-danger').attr('data-content', 'отказ');
                    $(document).find('.label-default').removeClass('label-default').addClass('label-danger').attr('data-content', 'отказ');
                    $(document).find('.label-info').removeClass('label-info').addClass('label-danger').attr('data-content', 'отказ');
                    $(document).find('.glyphicon-time').removeClass('glyphicon-time').addClass('glyphicon-remove');
                    $('#commentBan').remove();
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole=" + initiatorRole + "&invoiceId=" + invoiceId + "&mngrtable=" + mngrtable + "&mngrID=" + mngrID + "&btn=failure&dateToday=" + dateToday + "&inputValueFailure=" + inputValueFailure,
                        success: function (data) {
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-failure-user', function(){
            let invoiceId = $(this).data('invoiceid');
            let initiatorRole = $(this).data('initiatorrole');
            let mngrtable = $(this).data('mngrtable');
            let mngrID = $(this).data('mngrid');

            let dateToday = datetimeToday();

            Swal.fire({
                title: "Отменить подписание?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    Swal.fire({
                        title: "Отказ зарегистрирован",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    //getStatusInvoceFailure();
                    $('#failure' + invoiceId).remove(); //удаляем кнопку failure
                    $('#editPay').remove(); //удаляем кнопку редактирование
                    $(document).find('.btn-label-warning').removeClass('btn-label-warning').addClass('btn-label-danger').attr('data-content', 'отказ');
                    $(document).find('.flaticon-stopwatch').removeClass('flaticon-stopwatch').addClass('flaticon2-trash');
                    let inputValueFailure = 'Инициатор самостоятельно закрыл подписание документа';
                    $('#commentBan').remove();
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole=" + initiatorRole + "&invoiceId=" + invoiceId + "&mngrtable=" + mngrtable + "&mngrID=" + mngrID + "&btn=failure&dateToday=" + dateToday+"&inputValueFailure="+inputValueFailure,
                        success: function (data) {
                        }
                    });
                }
            });
        });

        $('body').on('click', '.btn-invoiceEnd', function(){
            var invoiceId = $(this).data('invoiceid');
            var initiatorMail = $(this).data('mngrtable');
            var initiatorRole = $(this).data('initiatorrole');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');

            var dateToday = datetimeToday();

            Swal.fire({
                title: "Инициатор получил средства?",
                type: "warning",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Нет",
                confirmButtonText: "Да",
                closeOnConfirm: false,
                closeModal: true
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    setTimeout(function () {
                        Swal.fire({
                            title: 'Cредства перечислены',
                            type: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }, 200); // время в мс
                    $('body').find('.label-success').attr('data-content','Оплачено');
                    $('body').find('.label-default').removeClass('label-default').addClass('label-success').attr('data-content','Оплачено');
                    $('body').find('.label-warning').removeClass('label-warning').addClass('label-success').attr('data-content','Оплачено');
                    $('body').find('.glyphicon-star-empty').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                    $('body').find('.glyphicon-time').removeClass('glyphicon-time').addClass('glyphicon-star');

                    $('#invoiceEnd'+invoiceId).remove();
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday,
                        success: function (data) {}
                    });
                }
            });
        });

        $('.linkContract').on('click',function () {
            var idProject = $(this).data('numcont');
            window.open ('/mngr/analitics/project'+idProject);
        });
    });
</script>
