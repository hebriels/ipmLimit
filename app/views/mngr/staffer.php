<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Счет №
                <?php
                    echo $oneStafferInvoice[0]['numberInvoice'].', дата создания ';
                    echo $oneStafferInvoice[0]['dateCreate'];
                    if($testProfit['typeProject']=='outside'){
                        if(!$testProfit['profitExit']){
                            echo ' <b style="background-color: red; padding: 0 5px;color: white;font-size: 22px;">проект в критической прибыли.</b>';
                        }
                    }
                ?>
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <input type="hidden" id="idDoc" value="<?php echo $oneStafferInvoice[0]['id'];?>">
            <input type="hidden" id="userAvatar" value="<?php echo $defaultDownload['userPathAvatar'];?>">
            <input type="hidden" id="userName" value="<?php echo $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'];?>">
            <input type="hidden" id="getStatus" value="<?php echo $oneStafferInvoice[0]['statusInvoice'];?>">
            <input type="hidden" id="userID" value="<?php echo $_SESSION['mngr']['id'];?>">
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <table id="tableStaffer" data-toggle="table" data-unique-id="tableStaffer-id">
                            <thead>
                            <tr>
                                <th data-visible="false" data-field="tableStaffer-id"></th>
                                <th data-field="tableStaffer-status" data-align="center">Статус</th>
                                <th data-field="tableStaffer-departments" data-align="center">Организация</th>
                                <th data-field="tableStaffer-contragent" data-align="center">Поставщик</th>
                                <th data-field="tableStaffer-money" data-align="center">Сумма</th>
                                <th data-field="tableStaffer-notice" data-align="center">Примечания</th>
                                <th data-field="tableStaffer-initiator" data-align="center">Инициатор</th>
                                <th data-field="tableStaffer-actions" data-align="center">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $oneStafferInvoice[0]['id'];?></td>
                                <td><?php echo getLabelStatus($oneStafferInvoice[0]['statusInvoice']);?></td>
                                <td><?php foreach ($allOrganization as $itemOrg){
                                        if($oneStafferInvoice[0]['organizationInvoiceForPayment'] == $itemOrg['id']){
                                            echo $itemOrg['nameOrganization'];
                                        }
                                    }?></td>
                                <td><?php foreach ($allContragents as $itemContra){
                                        if($oneStafferInvoice[0]['contragent'] == $itemContra['id']){
                                            echo $itemContra['name_contragent'];
                                        }
                                    }?></td>
                                <td><?php
                                    $moneySum = number_format($oneStafferInvoice[0]['summInvoiceForPayment'], 2, '.', '&nbsp;');
                                    echo $moneySum.'&nbsp;р.';
                                    ?></td>
                                <td><?php echo $oneStafferInvoice[0]['noticeInvoiceForPayment'];?></td>
                                <td>
                                    <div class="mt-author">
                                        <div class="mt-avatar">
                                            <span><?php echo $oneStafferInvoice[0]['initiatorSurname'].' '.$oneStafferInvoice[0]['initiatorFirstName'];?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group">
                                    <?php
                                    echo getImageFolder($oneStafferInvoice[0]['pathScanInvoice']);
                                    if($oneStafferInvoice[0]['signature'] == $_SESSION['mngr']['id']){
                                        if($lastSignInvoice==$_SESSION['mngr']['id']){
                                            echo '<button type="button"
                                            class="btn btn-sm btn-outline-success btn-icon btn-invoiceEnd"
                                            id="invoiceEnd'.$oneStafferInvoice[0]['id'].'" data-dateedit="'.$oneStafferInvoice[0]['date_edit'].'"
                                            data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$oneStafferInvoice[0]['id'].'"
                                            data-mngrtable="invoice" data-mngrid="'.$oneStafferInvoice[0]['mngrId'].'" data-currency="'.$oneStafferInvoice[0]['currency'].'"
                                            data-toggle="popover" data-trigger="hover"
                                            data-placement="auto" data-content="Оплачено">
                                            <i class="fa fa-check"></i></button>
                                                <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-icon btn-failure"
                                            id="failure' . $oneStafferInvoice[0]['id'] . '"
                                            data-initiatirrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $oneStafferInvoice[0]['id'] . '"
                                            data-mngrtable="invoice" data-mngrid="' . $oneStafferInvoice[0]['mngrId'] . '"
                                            data-toggle="popover" data-trigger="hover"
                                            data-placement="auto" data-content="Отказать">
                                            <i class="fas fa-thumbs-down"></i></button>';
                                        }else {
                                            echo '<button type="button"
                                            class="btn btn-sm btn-outline-success btn-icon btnSuccess"
                                            id="success' . $oneStafferInvoice[0]['id'] . '" data-dateedit="'.$oneStafferInvoice[0]['date_edit'].'"
                                            data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $oneStafferInvoice[0]['id'] . '"
                                            data-mngrtable="invoice" data-mngrid="' . $oneStafferInvoice[0]['mngrId'] . '"
                                            data-toggle="popover" data-trigger="hover"
                                            data-placement="auto" data-content="Согласовать">
                                            <i class="fas fa-thumbs-up"></i></button>
                                                <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-icon btn-failure"
                                            id="failure' . $oneStafferInvoice[0]['id'] . '"
                                            data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-dateedit="'.$oneStafferInvoice[0]['date_edit'].'" data-invoiceid="' . $oneStafferInvoice[0]['id'] . '"
                                            data-mngrtable="invoice" data-mngrid="' . $oneStafferInvoice[0]['mngrId'] . '"
                                            data-toggle="popover" data-trigger="hover"
                                            data-placement="auto" data-content="Отказать">
                                            <i class="fas fa-thumbs-down"></i></button>';
                                        }
                                    }
                                    if($oneStafferInvoice[0]['mngrId'] == $_SESSION['mngr']['id'] && $oneStafferInvoice[0]['statusInvoice'] == '1'){
                                        echo '<a href="/mngr/editinvoice/'.$oneStafferInvoice[0]['id'].'" id="editInvoice"
                                            class="btn btn-sm btn-outline-brand btn-icon" data-toggle="popover" data-trigger="hover" data-placement="auto"
                                             data-content="Редактировать">
                                                    <i class="fa fa-edit"></i></a>';
                                        echo '<button type="button"
                                        class="btn btn-sm btn-outline-danger btn-icon btn-failure-user"
                                        id="failure'.$oneStafferInvoice[0]['id'].'"
                                        data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$oneStafferInvoice[0]['id'].'"
                                        data-mngrtable="invoice" data-mngrid="'.$oneStafferInvoice[0]['mngrId'].'"
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
                            'numberContract' => $oneStafferInvoice[0]['numberContract'], //ID контракта
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
                                        <a class="nav-link" href="#tab_3" data-toggle="tab"> Участники </a>
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
                                                                    <button type="button" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply btnEnterComment" data-typedoc="invoice">Отправить</button>
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
                                                <span class="kt-timeline-v2__item-time"><?php echo $oneStafferInvoice[0]['dateCreate'];?></span>
                                                <div class="kt-timeline-v2__item-cricle">
                                                    <i class="fa fa-genderless kt-font-warning"></i>
                                                </div>
                                                <div class="kt-timeline-v2__item-text  kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                    Инициатор
                                                    <?php echo $oneStafferInvoice[0]['initiatorSurname'].' '.$oneStafferInvoice[0]['initiatorFirstName'];?>
                                                </div>
                                            </div>
                                            <?php if($oneStafferInvoice[0]['date_signature'] != ''):?>
                                                <?php $signature = json_decode($oneStafferInvoice[0]['date_signature']);
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
                                            <?php if($oneStafferInvoice[0]['date_success'] != ''):?>
                                                <div class="kt-timeline-v2__item">
                                                    <span class="kt-timeline-v2__item-time"><?php echo $oneStafferInvoice[0]['date_success'];?></span>
                                                    <div class="kt-timeline-v2__item-cricle">
                                                        <i class="fa fa-genderless kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-timeline-v2__item-text kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                        Оплачен
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                            <?php if($oneStafferInvoice[0]['date_false'] != ''):?>
                                                <div class="kt-timeline-v2__item">
                                                    <span class="kt-timeline-v2__item-time"><?php echo $oneStafferInvoice[0]['date_false'];?></span>
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
    <!-- Modal добавление партнера -->
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
                    <input type="hidden" name="idInvoice" id="idInvoice" value="<?php echo $oneStafferInvoice[0]['id'];?>">
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
        let idInvoice = $('#idDoc').val();
        let allUsers = <?php echo $allUsers;?>;
        var currencyGeneral = '<?php echo $defaultDownload['currencyGeneral'];?>';
        var profitExit = '<?php echo $testProfit['profitExit'];?>';
        var projectID = '<?php echo $testProfit['projectID'];?>';
        //console.log(profitExit);
        //$('input[data-field="tableStaffer-id"]').css('display','none'); //убрать этот столбик из сетки таблицы
//проверка если нет ID в таблице partner, то добавляем
        /*$.ajax({
            url: urlOne, type: "POST", dataType: "text",
            data: "mainAjax=testPartner&idInvoice="+idInvoice+"&typeAdd=invoice",
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
                data: "mainAjax=addPartner&idInvoice="+idInvoice+"&selectUser="+selectUser+"&typeAdd=invoice",
                success: function (data) {
                    let result = $.parseJSON(data);
                    $('#commentPartners').append('<li><div class="todo-task-history-desc"> Участник - '+result.userName+'</div></li>');
                    $('.commentPartners').append('<span class="kt-userpic kt-userpic--sm kt-userpic--circle" data-toggle="kt-tooltip" data-placement="top" title="'+result.userName+'" data-original-title="Tooltip title"><img src="/assets/images/ava/'+result.userAvatar+'" alt="image"></span>');
                }
            });
        });

        /*$('#saveAddPartners').on('click',function () {
            var arr = $('#selectUser').val().split('-');
            console.log(arr);
            var idInvoice = $('#idInvoice').val();
            var selectUser = arr[0];
            var selectNameUser = arr[1];
            var userName = $('#userName').val();
            $('#modalAddPartner').modal('hide');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=addPartner&idInvoice="+idInvoice+"&selectUser="+selectUser+"&typeAdd=invoice",
                success: function (data) {
                    $('#commentPartners').append('<li><div class="todo-task-history-desc"> Участник - '+selectNameUser+'</div></li>')
                }
            });
        });*/

        function btnSuccessPre(invoiceId,mngrtable,mngrID,initiatorRole) {
            if(!profitExit){
                Swal.fire({
                    title: "Внимание!!!",
                    html: true,
                    text: '<h4 style="color: red;">Проект в критической рентабельности</h4>',
                    type: "warning",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Продолжить работу",
                    confirmButtonText: "Перейти в счет"
                }).then((isConfirm)=>{
                    if (isConfirm.value){
                        window.location = ('/mngr/staffer/'+projectID);
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
            let dateToday = datetimeToday();
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
                        title: "Счет подписан!",
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

        function btnFailure(invoiceId,mngrtable,mngrID,initiatorRole) {
            let dateToday = datetimeToday();
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
                    $('#success'+invoiceId).remove(); //удаляем кнопку success
                    $('#failure'+invoiceId).remove(); //удаляем кнопку failure
                    $('body').find('.label-warning').removeClass('label-warning').addClass('label-danger').attr('data-content','отказ');
                    $('body').find('.label-default').removeClass('label-default').addClass('label-danger').attr('data-content','отказ');
                    $('body').find('.label-info').removeClass('label-info').addClass('label-danger').attr('data-content','отказ');
                    $('body').find('.glyphicon-time').removeClass('glyphicon-time').addClass('glyphicon-remove');
                    $('#commentBan').remove();
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=failure&dateToday="+dateToday+"&inputValueFailure="+inputValueFailure,
                        success: function (data) {}
                    });
                }
            });
        }

        function btnFailureUser(invoiceId,mngrtable,mngrID,initiatorRole) {
            let dateToday = datetimeToday();
            Swal.fire({
                title: "Отменить подписание счета",
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
                    $('#editInvoice').remove(); //удаляем кнопку редактирование
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
        }

        function btnInvoiceEnd(invoiceId,mngrtable,mngrID,initiatorRole,currency) {
            let dateToday = datetimeToday();
            if(mngrtable!=='forPay' && parseInt(currencyGeneral)!==currency){
                Swal.fire({
                    title: "Внимание!",
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
                        }
                    }
                }).then((isConfirm)=>{
                    if (isConfirm.value) {
                        let money = String(isConfirm.value).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
                        //money = money;
                        $('#tableStaffer').bootstrapTable('updateByUniqueId', {
                            id: invoiceId,
                            row: {
                                'tableStaffer-money': money
                            }
                        });
                        let inputValueMoney = isConfirm.value;

                        $('#invoiceEnd'+invoiceId).remove(); //удаляем кнопку invoiceEnd
                        $('#failure'+invoiceId).remove(); //удаляем кнопку failure
                        $(document).find('.btn-label-warning').removeClass('btn-label-warning').addClass('btn-label-success').attr('data-content','оплачен');
                        $(document).find('.flaticon-stopwatch').removeClass('flaticon-stopwatch').addClass('la la-star');


                        setTimeout(function () {
                            Swal.fire({
                                title: "Счет оплачен!",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }, 200); // время в мс
                        $('.btn-invoiceEnd').remove('button'); //удаляем кнопку invoiceEnd
                        $.ajax({
                            url: urlOne, type: "POST", dataType: "text",
                            data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday+"&inputValueMoney="+inputValueMoney,
                            success: function (data) {}
                        });
                    }
                });
            }else{
                Swal.fire({
                    title: "Вы оплатили счет?",
                    type: "warning",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Нет",
                    confirmButtonText: "Да"
                }).then((isConfirm)=>{
                    if (isConfirm.value) {
                        $('#invoiceEnd'+invoiceId).remove(); //удаляем кнопку invoiceEnd
                        $('#failure'+invoiceId).remove(); //удаляем кнопку failure
                        $(document).find('.btn-label-warning').removeClass('btn-label-warning').addClass('btn-label-success').attr('data-content','оплачен');
                        $(document).find('.flaticon-stopwatch').removeClass('flaticon-stopwatch').addClass('la la-star');

                        setTimeout(function () {
                            Swal.fire({
                                title: "Счет оплачен!",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }, 200); // время в мс

                        $.ajax({
                            url: urlOne, type: "POST", dataType: "text",
                            data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday,
                            success: function (data) {}
                        });
                    }
                });
            }
        }
        $('body').on('click', '.btnSuccess', function(){
            var dateEdit = $(this).data('dateedit');
            var invoiceId = $(this).data('invoiceid');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var initiatorRole = $(this).data('initiatorrole');

            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testEdit&idInvoice="+invoiceId+"&typeAdd=invoice&dateEdit="+dateEdit,
                success: function (data) {
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
                        btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole);
                    }
                }
            });
        });

        $('body').on('click', '.btn-failure', function(){
            var dateEdit = $(this).data('dateedit');
            let invoiceId = $(this).data('invoiceid');
            let initiatorRole = $(this).data('initiatorrole');
            let mngrtable = $(this).data('mngrtable');
            let mngrID = $(this).data('mngrid');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testEdit&idInvoice="+idInvoice+"&typeAdd=invoice&dateEdit="+dateEdit,
                success: function (data){
                    let result = $.parseJSON(data);
                    if(result.resultTest===false){
                        Swal.fire({
                            title: "ВНИМАНИЕ!",
                            text: "счет редактируется",
                            type: "warning",
                            allowOutsideClick: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Понятно"
                        });
                    }else{
                        btnFailure(invoiceId,mngrtable,mngrID,initiatorRole);
                    }
                }
            });
        });

        $(document).on('click', '.btn-failure-user', function(){
            let invoiceId = $(this).data('invoiceid');
            let initiatorRole = $(this).data('initiatorrole');
            let mngrtable = $(this).data('mngrtable');
            let mngrID = $(this).data('mngrid');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testSignature&idInvoice="+idInvoice+"&typeAdd=invoice",
                success: function (data){
                    let result = $.parseJSON(data);
                    if(result.resultTest[0]['date_signature'].length>0){
                        Swal.fire({
                            title: "ВНИМАНИЕ!",
                            text: "счет уже подписан",
                            type: "warning",
                            allowOutsideClick: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Понятно"
                        });
                    }else{
                        btnFailureUser(invoiceId,mngrtable,mngrID,initiatorRole);
                    }
                }
            });
        });

        $('body').on('click', '.btn-invoiceEnd', function(){
            let dateEdit = $(this).data('dateedit');
            let invoiceId = $(this).data('invoiceid');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var initiatorRole = $(this).data('initiatorrole');
            var currency = $(this).data('currency');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testEdit&idInvoice="+invoiceId+"&typeAdd=invoice&dateEdit="+dateEdit,
                success: function (data){
                    console.log(data);
                    var result = $.parseJSON(data);
                    if(result.resultTest===false){
                        Swal.fire({
                            title: "ВНИМАНИЕ!",
                            text: "счет редактируется",
                            type: "warning",
                            allowOutsideClick: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Понятно"
                        });
                    }else{
                        btnInvoiceEnd(invoiceId,mngrtable,mngrID,initiatorRole,currency);
                    }
                }
            });
        });

        $('body').on('click','.linkContract',function () {
            var idProject = $(this).data('numcont');
            window.open ('/mngr/analitics/project'+idProject);
        });
    });
</script>

