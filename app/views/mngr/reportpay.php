<?php //bugs($_SESSION['mngr']);?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h2 class="page-title"> Служебка №
            <?php echo $onePay[0]['id'];?>, дата создания
            <?php echo $onePay[0]['dateCreate'];?>, инициатор
            <?php echo $onePay[0]['initiatorSurname'].' '.$onePay[0]['initiatorFirstName'];?>
        </h2>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2" style="padding-bottom: 0px;">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-purple-soft">
                                <span id="totalSumm"></span>
                            </h3>
                            <small>Общая сумма</small>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2" style="padding-bottom: 0px;">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-jungle sumExpense">
                                <span id="inList"></span>
                            </h3>
                            <small>В отчете</small>
                        </div>
                        <div class="icon">
                            <i class="icon-doc"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2" style="padding-bottom: 0px;">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-soft sumExpenseNew">
                                <span id="endList"></span>
                            </h3>
                            <small>Остаток</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2" style="padding-bottom: 0px;">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-soft">
                                <span id="notList"></span>
                            </h3>
                            <small>Неподтверждено</small>
                        </div>
                        <div class="icon">
                            <i class="icon-list"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet box green-haze">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-comments"></i>Расходы</div>
                    </div>
                    <div class="portlet-body">
                        <?php if($onePay[0]['check_pay']=='true' && $onePay[0]['user_id']!=$_SESSION['mngr']['id'] && $lastSignPay != $_SESSION['mngr']['id']):?>
                            <div id="toolbar" class="btn-group">
                                <div class="form-group form-md-checkboxes">
                                    <div class="md-checkbox-inline">
                                        <div class="md-checkbox has-success">
                                            <button type="button" id="allSuccess" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Принять все</button>
                                            <button type="button" id="allDanger" class="btn btn-danger"><i class="fas fa-thumbs-down"></i> Отказать все</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if($lastSignPay == $_SESSION['mngr']['id'] && $visibleBtnFromLastSign=='true'):?>
                            <div id="toolbar" class="btn-group">
                                <div class="form-group form-md-checkboxes">
                                    <div class="md-checkbox-inline">
                                        <div class="md-checkbox has-success">
                                            <button type="button" id="allSuccess" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Принять все</button>
                                            <button type="button" id="allDanger" class="btn btn-danger"><i class="fas fa-thumbs-down"></i> Отказать все</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" id="tableReport">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Описание траты</th>
                                    <th>Проект</th>
                                    <th>Сумма</th>
                                    <th>Чек</th>
                                    <th>Дата</th>
                                    <?php if($lastSignPay != $_SESSION['mngr']['id']):?>
                                    <th>Действия</th>
                                    <?php endif;?>
                                    <?php if($lastSignPay == $_SESSION['mngr']['id'] && $visibleBtnFromLastSign=='true'):?>
                                        <th>Действия</th>
                                    <?php endif;?>
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
                                                        //echo $allProject['nameProject'];
                                                        foreach ($allContragents as $itemContr){
                                                            if(!empty($allProject['idContragent'])){
                                                                if($allProject['idContragent'] == $itemContr['id']){
                                                                    $nameContragent = $itemContr['name_contragent'].' - ИНН: '.$itemContr['inn_contragent'];
                                                                }
                                                            }else{
                                                                $nameContragent = "<b style='color:red;'>нет привязки к покупателю!</b>";
                                                            }
                                                        }
                                                        echo '<a href="javascript:;" class="linkContract" id="contragent-'.$item['id'].'"
                                                                            data-toggle="popover" data-trigger="hover"
                                                                            data-placement="auto" data-html="true" title="Покупатель" data-content="'.$nameContragent.'">'.$allProject['nameProject'].'</a>';
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
                                        <td id="check-<?php echo $item['id'];?>"><?php echo $item['check_pay'];?></td>
                                        <td id="dataExpense-<?php echo $item['id'];?>"<?php //echo $status;?>><?php echo $item['date_expense'];?></td>
                                        <?php if($lastSignPay != $_SESSION['mngr']['id']):?>
                                        <td width="20" id="td-<?php echo $item['id'];?>">
                                            <?php if($item['status']!='true'):?>
                                                <?php if($onePay[0]['check_pay']!='true' && $onePay[0]['user_id']==$_SESSION['mngr']['id']):?>
                                                    <a href="javascript:;" class="btn btn-xs btn-outline blue editExpense"
                                                       data-idedit="<?php echo $item['id'];?>" data-expenseedit="<?php echo $item['text_expense'];?>"
                                                       data-idproject="<?php echo $item['id_project'];?>" data-moneyedit="<?php echo $item['money'];?>" data-checkpay="<?php echo $item['check_pay'];?>" data-dateedit="<?php echo $item['date_expense'];?>">
                                                        <i class="fa fa-edit"></i></a>
                                                    <a href="javascript:;" class="btn btn-xs btn-outline red deleteExpense"
                                                       data-iddelit="<?php echo $item['id'];?>"><i class="far fa-trash-alt"></i></a>
                                                <?php endif;?>
                                            <?php endif;?>
                                            <?php if($onePay[0]['check_pay']=='true' && $onePay[0]['user_id']!=$_SESSION['mngr']['id']) {
                                                if($item['report_class']=='default'){
                                                    $successBtnClass = $dangerBtnClass = '';
                                                }elseif($item['report_class']=='success'){
                                                    $successBtnClass = 'hiddenVisible';
                                                    $dangerBtnClass = '';
                                                }elseif($item['report_class']=='danger'){
                                                    $successBtnClass = '';
                                                    $dangerBtnClass = 'hiddenVisible';
                                                }
                                                echo '<button type="button" class="btn btn-xs btn-outline green-jungle btn-success-report '.$successBtnClass.'"
                                                    data-expid="'.$item['id'].'" data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$onePay[0]['id'].'"
                                                    data-idtable="tableReport" data-mngrid="'.$onePay[0]['user_id'].'"
                                                    data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="Принять">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-outline red btn-failure-report '.$dangerBtnClass.'"
                                                    data-expid="' . $item['id'] . '" data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $onePay[0]['id'] . '"
                                                    data-idtable="tableReport" data-mngrid="' . $onePay[0]['user_id'] . '"
                                                    data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="Отказать">
                                                    <i class="fas fa-thumbs-down"></i>
                                                </button>';
                                            }?>
                                            <?php if($onePay[0]['check_pay']=='true' && $onePay[0]['user_id']!=$_SESSION['mngr']['id'] && $lastSignPay == $_SESSION['mngr']['id'] && $visibleBtnFromLastSign=='true') {
                                                if($item['report_class']=='default'){
                                                    $successBtnClass = $dangerBtnClass = '';
                                                }elseif($item['report_class']=='success'){
                                                    $successBtnClass = 'hiddenVisible';
                                                    $dangerBtnClass = '';
                                                }elseif($item['report_class']=='danger'){
                                                    $successBtnClass = '';
                                                    $dangerBtnClass = 'hiddenVisible';
                                                }
                                                echo '<button type="button" class="btn btn-xs btn-outline green-jungle btn-success-report '.$successBtnClass.'"
                                                    data-expid="'.$item['id'].'" data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$onePay[0]['id'].'"
                                                    data-idtable="tableReport" data-mngrid="'.$onePay[0]['user_id'].'"
                                                    data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="Принять">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-outline red btn-failure-report '.$dangerBtnClass.'"
                                                    data-expid="' . $item['id'] . '" data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $onePay[0]['id'] . '"
                                                    data-idtable="tableReport" data-mngrid="' . $onePay[0]['user_id'] . '"
                                                    data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="Отказать">
                                                    <i class="fas fa-thumbs-down"></i>
                                                </button>';
                                            }?>
                                        </td>
                                        <?php endif;?>
                                        <?php if($lastSignPay == $_SESSION['mngr']['id'] && $visibleBtnFromLastSign=='true'):?>
                                            <td width="20" id="td-<?php echo $item['id'];?>">
                                                <?php if($onePay[0]['check_pay']=='true' && $onePay[0]['user_id']!=$_SESSION['mngr']['id']) {
                                                    if($item['report_class']=='default'){
                                                        $successBtnClass = $dangerBtnClass = '';
                                                    }elseif($item['report_class']=='success'){
                                                        $successBtnClass = 'hiddenVisible';
                                                        $dangerBtnClass = '';
                                                    }elseif($item['report_class']=='danger'){
                                                        $successBtnClass = '';
                                                        $dangerBtnClass = 'hiddenVisible';
                                                    }
                                                    echo '<button type="button" class="btn btn-xs btn-outline green-jungle btn-success-report '.$successBtnClass.'"
                                                    data-expid="'.$item['id'].'" data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$onePay[0]['id'].'"
                                                    data-idtable="tableReport" data-mngrid="'.$onePay[0]['user_id'].'"
                                                    data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="Принять">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-outline red btn-failure-report '.$dangerBtnClass.'"
                                                    data-expid="' . $item['id'] . '" data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $onePay[0]['id'] . '"
                                                    data-idtable="tableReport" data-mngrid="' . $onePay[0]['user_id'] . '"
                                                    data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="Отказать">
                                                    <i class="fas fa-thumbs-down"></i>
                                                </button>';
                                                }?>
                                            </td>
                                        <?php endif;?>
                                    </tr>
                                <?php $col++; endforeach;?>
                                </tbody>
                            </table>
                            <?php if($onePay[0]['check_pay']=='true' && $onePay[0]['user_id']!=$_SESSION['mngr']['id']) {
                                echo '<div class="col-xs-12" id="infoReport"></div>';
                            }?>
                        </div>
                        <?php if($onePay[0]['user_id']==$_SESSION['mngr']['id']):?>
                        <div class="form-group col-md-12">
                            <label class="col-md-2 control-label" for="moneyBack" style="font-weight: bold;font-size: 16px;">Возврат наличных</label>
                            <div class="col-md-4">
                                <div class="input-group has-success">
                                    <span class="input-group-addon">
                                        <i style="color: #0a001f;" class="fas fa-ruble-sign fa-lg"></i>
                                    </span>
                                    <input class="form-control" placeholder="Введите сумму" type="text" id="moneyBack" name="moneyBack">
                                </div>
                            </div>
                            <div class="col-md-6 hiddenVisible" id="errorMoneyBack">
                                <span style="color: red;">"Возможно есть пробелы. Точка или запятая разделитель копеек!"</span>
                            </div>
                        </div>
                        <?php endif;?>

                        <?php if($onePay[0]['check_pay']!='true') {
                            echo '<div class="form-actions" >
                                <a href = "javascript:;" class="btn btn-success addPay" ><i class="fa fa-plus" ></i > Добавить расход </a >
                                <a href = "javascript:;" class="btn btn-success savePay" > Применить</a >
                                <a href = "javascript:;" class="btn btn-primary goPay" > Отправить отчет </a >
                            </div >';
                        }elseif($lastSignPay == $_SESSION['mngr']['id']){
                            echo '<div class="form-actions" id="lastSignBtn"></div >';
                        }else{
                            echo '<div class="form-actions" id="buttonsAction"></div >';
                        }?>
                    </div>

                </div>
            </div>
        </div>
    <!-- END CONTENT BODY -->
        <div class="row">
            <!-- TASK COMMENTS -->
            <div class="form-group">
                <div class="col-md-12">
                    <ul class="media-list commentList">
                    </ul>
                </div>
            </div>
            <!-- END TASK COMMENTS -->
            <!-- TASK COMMENT FORM -->
            <div class="form-group">
                <div class="col-md-12" id="commentBan">
                    <ul class="media-list">
                        <li class="media">
                            <a class="pull-left" href="javascript:;">
                                <img class="todo-userpic" style="border-radius: 50px" src="/public/images/ava/<?php echo $userPathAvatar;?>" width="50px" height="50px"> </a>
                            <div class="media-body">
                                <textarea class="form-control todo-taskbody-taskdesc" id="idTextareaComment" rows="4" placeholder="Комментарий ..."></textarea>
                            </div>
                        </li>
                    </ul>
                    <button type="button" class="pull-right btn btn-sm btn-circle green btn-button" id="btn-button"> Отправить </button>
                </div>
            </div>
            <!-- END TASK COMMENT FORM -->
        </div>
    </div>
    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактор</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="expenseEditTable" class="col-form-label">Статья расхода:</label>
                        <input type="text" class="form-control" id="expenseEditTable">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="idProjectEdit" class="col-form-label">Проект:</label>
                        <select id="idProjectEdit" class="form-control select2">
                        <?php foreach ($allProjectsCon as $allProject){
                            echo '<option value="'.$allProject['id'].'">'.$allProject['nameProject'].'</option>';
                        }?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="moneyEditTable" class="col-form-label">Сумма:</label>
                        <input type="text" class="form-control" id="moneyEditTable">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dataEditTable" class="col-form-label">Дата:</label>
                        <input type="text" data-provide="datepicker" class="form-control" id="dataEditTable">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="checkPayEditTable" class="col-form-label"> Наличие чека: </label>
                        <input type="text" class="form-control" id="checkPayEditTable">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idEditSave">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveEdit">Применить</button>
                </div>
            </div>
        </div>
    </div>
    <?php $allProjectsCon = json_encode($allProjectsCon);?>
</div>
<!-- END CONTENT -->
<script>
    $(document).ready(function() {
        var urlOne = '/ajax/ajaxpost';
        var allProjects = <?php echo $allProjectsCon;?>;
        var totalSumm = <?php echo $onePay[0]['money']; ?>;
        var inList = <?php if(empty($expenseSum[0]['moneySum'])){$expenseSum[0]['moneySum']='0';}echo $expenseSum[0]['moneySum']; ?>;
        var endList = <?php echo $onePay[0]['money']-$expenseSum[0]['moneySum']; ?>;
        var notList = <?php echo $onePay[0]['money']-$expenseNoSum[0]['moneyNoSum']; ?>;

//отправка комментария при нажатии enter
        $('#idTextareaComment').keypress(function(e) {
            if(e.which == 13) {
                $('.btn-button').click();
            }
        });
//комментарии
        var idInvoice = '<?php echo $onePay[0]['id'];?>';
        var initiatorTable = 'forPay';
        var userAvatar = '<?php echo $userPathAvatar;?>';

        var nameUserComment = '<?php echo $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'];?>';

        $.ajax({
            url: urlOne, type: "POST", dataType: "text",
            data: "mainAjax=firstLoadCommentDB&idInvoice="+idInvoice+"&type=forPay",
            success: function (data) {
                var result = $.parseJSON(data);
                $.each(result.allComment,function(col,val){
                    var colorComment = '#4c87b9';
                    if(val.autorComment===nameUserComment){
                        colorComment = '#26C281';
                    }
                    var output = "\
                            <li class='media' id='"+val.id+"'>\
                                <a class='pull-left' href='javascript:;'>\
                                <img class='media-object' style='border-radius: 50px;' src='/public/images/ava/"+val.folderAutorAvatar+"' width='50px' height='50px'></a>\
                                <div class='media-body'>\
                                    <h4 class='media-heading'>\
                                        <span class='todo-comment-username' style='font-weight: 600;color: "+colorComment+";'>"+val.autorComment+"</span> &nbsp;\
                                        <span class='c-date' style='font-weight: 300;font-size: 14px;'>"+val.dateCreate+"</span>\
                                    </h4>\
                                    <p class='todo-text-color'>"+val.textComment+"</p>\
                                </div>\
                            </li>";
                    $('.commentList').append(output);
                });
            }
        });

        $('.btn-button').on('click', function() { //клик по кнопке "отправить" комментарий
            var textComment = $('textarea').val();
            var dateToday = datetimeToday();
            var lastIdComment = parseInt($('.commentList li:last').attr('id'))+1;
            $('textarea').val('');
            var output = "\
                        <li class='media' id='"+lastIdComment+"'>\
                            <a class='pull-left' href='javascript:;'>\
                            <img class='media-object' style='border-radius: 50px;' src='/public/images/ava/"+userAvatar+"' width='50px' height='50px'></a>\
                            <div class='media-body'>\
                                <h4 class='media-heading'>\
                                    <span class='todo-comment-username' style='font-weight: 600;color: #26C281;'>"+nameUserComment+"</span> &nbsp;\
                                    <span class='c-date' style='font-weight: 300;font-size: 14px;'>"+dateToday+"</span>\
                                </h4>\
                                <p class='todo-text-color'>"+textComment+"</p>\
                            </div>\
                        </li>";
            $('.commentList').append(output);
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=insertCommentDB&textComment="+textComment+"&idInvoice="+idInvoice+"&typeAdd=forPay",
                success: function (data){}
            });
        });
        window.setInterval(function(){
            var lastIdComment = $('.commentList li:last').attr('id');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=loadCommentDB&lastIdComment="+lastIdComment+"&idInvoice="+idInvoice+"&typeAdd=forPay",
                success: function (data) {
                    var result = $.parseJSON(data);
                    $.each(result.allComment,function(col,val){
                        var colorComment = '#4c87b9';
                        if(val.autorComment===nameUserComment){
                            //colorComment = '#26C281';
                        }else{
                            var output = "\
                        <li class='media' id='"+val.id+"'>\
                            <a class='pull-left' href='javascript:;'>\
                            <img class='media-object' style='border-radius: 50px;' src='/public/images/ava/"+val.folderAutorAvatar+"' width='50px' height='50px'></a>\
                            <div class='media-body'>\
                                <h4 class='media-heading'>\
                                    <span class='todo-comment-username' style='font-weight: 600;color: "+colorComment+";'>"+val.autorComment+"</span> &nbsp;\
                                    <span class='c-date' style='font-weight: 300;font-size: 14px;'>"+val.dateCreate+"</span>\
                                </h4>\
                                <p class='todo-text-color'>"+val.textComment+"</p>\
                            </div>\
                        </li>";
                            $('.commentList').append(output);
                        }
                    });
                }
            });
        },5000);
//вывод сумм
        headerSummTotal(totalSumm,inList,endList,notList);
        function headerSummTotal(totalSumm,inList,endList,notList) {
            totalSumm = String(totalSumm).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ') + ' р.';
            inList = String(inList).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ') + ' р.';
            endList = String(endList).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ') + ' р.';
            notList = String(notList).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ') + ' р.';
            $('#totalSumm').text(totalSumm);
            $('#inList').text(inList);
            $('#endList').text(endList);
            $('#notList').text(notList);
        }

        function widthSelect() {
            $('.select2').css('width','300px');
        }

        function addPayAgain() {
            var dataNumber = $('#tableReport tr:last').find('td').data('number')+1;
            if(isNaN(dataNumber)){dataNumber = 1}

            var output = '\
                <tr>\
                    <td class="success" data-number="'+dataNumber+'" data-savepay="save">'+dataNumber+'</td>\
                    <td class="success"><input type="text" class="form-control" data-expense="expense" name="expense"></td>\
                    <td class="success"><select id="idProjectSelect" class="form-control select2"><option value="0">Без проекта</option></select></td>\
                    <td class="success"><input type="text" class="form-control" data-expense="money" name="money"><span id="errorMoney" style="color: red;"></span></td>\
                    <td class="success"><input type="text" class="form-control" data-expense="checkPay" name="checkPay"></td>\
                    <td class="success"><input type="text" data-provide="datepicker" data-expense="dateExpense" class="input-group form-control date date-picker" name="dateExpense"></td>\
                </tr>';
            $('#tableReport tbody').append(output);
            widthSelect();
            blankSum();
            initSelect2();
        }
        function initSelect2() {
            $.each(allProjects,function(col,val) {
                var selectProjects = '<option value="'+val.id+'">'+val.nameProject+'</option>';
                $('body #idProjectSelect').append(selectProjects);
                $('body #idProjectSelect').select2();
            });
        }
        function blankSum() {
            var idPay = <?php echo $onePay[0]['id'];?>;
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=blankSum&idPay="+idPay+"&money="+totalSumm,
                success: function (data) {
                    var result = $.parseJSON(data);
                    headerSummTotal(totalSumm,result.moneySum,result.money,result.notList);
                }
            });
        }
        $('.addPay').on('click',function() {
            if($('[data-expense="expense"]').length>0){
                var idPay = <?php echo $onePay[0]['id'];?>;
                var expense = $('[data-expense="expense"]').val();
                var idProject = $('body #idProjectSelect').val();
                console.log(idProject);
                var money = $('[data-expense="money"]').val();
                var checkPay = $('[data-expense="checkPay"]').val();
                var dateExpense = $('[data-expense="dateExpense"]').val();
                if(expense==='' || money==='' || dateExpense===''){
                    swal({
                        title: "Заполните все поля!",
                        type: "info"
                    });
                }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(money)) {
                    $('body #errorMoney').text('Не корректная сумма!');
                }else{
                    //console.log('dataNumber');
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=reportExpenseSave&expense="+expense+"&idProject="+idProject+"&money="+money+"&checkPay="+checkPay+"&dateExpense="+dateExpense+"&idPay="+idPay,
                        success: function (data) {
                            var result = $.parseJSON(data);
                            var moneySum = String(result.money).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;')+'&nbspр.';
                            var lastTr = $('#tableReport tr:last');
                            var dataNumber = lastTr.find('td').data('number');
                            lastTr.remove();
                            var output = '\
                                <tr>\
                                    <td data-number="'+dataNumber+'" data-savepay="save">'+dataNumber+'</td>\
                                    <td>'+result.expense+'</td>\
                                    <td>'+result.nameProject+'</td>\
                                    <td>'+moneySum+'</td>\
                                    <td>'+result.checkPay+'</td>\
                                    <td>'+result.dateExpense+'</td>\
                                    <td><a href="javascript:;" class="btn btn-xs btn-outline blue editExpense"\
                                            data-idedit="'+result.idExpense+'" data-expenseedit="'+result.expense+'"\
                                            data-idproject="'+idProject+'" data-moneyedit="'+result.money+'" data-checkpay="'+result.checkPay+'" data-dateedit="'+result.dateExpense+'">\
                                            <i class="fa fa-edit"></i></a>\
                                        <a href="javascript:;" class="btn btn-xs btn-outline red deleteExpense"\
                                            data-iddelit="'+result.idExpense+'"><i class="far fa-trash-alt"></i></a>\
                                    </td>\
                                </tr>';
                            $('#tableReport tbody').append(output);
                            blankSum();
                            addPayAgain();
                        }
                    });
                }
            }else{
                addPayAgain();
            }


        });

        $('.savePay').on('click',function() {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            var expense = $('[data-expense="expense"]').val();
            var idProject = $('body #idProjectSelect').val();
            var money = $('[data-expense="money"]').val();
            var checkPay = $('[data-expense="checkPay"]').val();
            var dateExpense = $('[data-expense="dateExpense"]').val();
            console.log(idPay+'-'+expense+'-'+idProject+'-'+money+'-'+dateExpense);
            if(expense==='' || money==='' || dateExpense==='') {
                swal({
                    title: "Заполните все поля!",
                    type: "info"
                });
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(money)) {
                $('body #errorMoney').text('Не корректная сумма!');
            }else{
                if($('[data-expense="expense"]').length>0){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=reportExpenseSave&expense="+expense+"&idProject="+idProject+"&money="+money+"&checkPay="+checkPay+"&dateExpense="+dateExpense+"&idPay="+idPay,
                        success: function (data) {
                            var result = $.parseJSON(data);
                            console.log(result);
                            var moneySum = String(result.money).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;')+'&nbspр.';
                            $('#tableReport tr:last').remove();
                            var dataNumber = $('#tableReport tr:last').find('td').data('number')+1;
                            if(isNaN(dataNumber)){dataNumber = 1};
                            var checkChecked = '';
                            if(result.checkPay === 'true'){checkChecked = 'checked';}
                            var output = '\
                                <tr>\
                                    <td class="success" data-number="'+dataNumber+'" data-savepay="save">'+dataNumber+'</td>\
                                    <td class="success">'+result.expense+'</td>\
                                    <td class="success">'+result.nameProject+'</td>\
                                    <td class="success">'+moneySum+'</td>\
                                    <td class="success">'+result.checkPay+'</td>\
                                    <td class="success">'+result.dateExpense+'</td>\
                                    <td><a href="javascript:;" class="btn btn-xs btn-outline blue editExpense"\
                                            data-idedit="'+result.idExpense+'" data-expenseedit="'+result.expense+'"\
                                            data-idproject="'+idProject+'" data-moneyedit="'+result.money+'" data-checkpay="'+result.checkPay+'" data-dateedit="'+result.dateExpense+'">\
                                            <i class="fa fa-edit"></i></a>\
                                        <a href="javascript:;" class="btn btn-xs btn-outline red deleteExpense"\
                                            data-iddelit="'+result.idExpense+'"><i class="far fa-trash-alt"></i></a>\
                                    </td>\
                                </tr>';
                            $('#tableReport tbody').append(output);
                            blankSum();
                        }
                    });
                }else{
                    swal({
                        title: "Нечего сохранять!",
                        type: "info"
                    });
                }
            }
        });
        $('body').on('click','.editExpense', function () {
            var idEdit = $(this).data('idedit');
            var expenseedit = $(this).data('expenseedit');
            var idProject = $(this).data('idproject');
            var moneyedit = $(this).data('moneyedit');
            var dateedit = $(this).data('dateedit');
            var checkpay = $(this).data('checkpay');
            $('#expenseEditTable').val(expenseedit);
            $('#moneyEditTable').val(moneyedit);
            $('#dataEditTable').val(dateedit);
            $('#idEditSave').val(idEdit);
            $('#idProjectEdit').val(idProject).trigger('change');
            $('#checkPayEditTable').val(checkpay);
            $('#exampleModal').modal('show');
        });
        $('body').on('click','.deleteExpense', function () {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            var idDelit = $(this).data('iddelit');
            swal({
                title: "Желаете удалить этот расход?",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=expenseDelete&idDelit="+idDelit+"&idPay="+idPay,
                    success: function (data) {
                        window.location = "/mngr/reportpay/"+idPay;
                    }
                });
            });
        });
        $('#saveEdit').on('click',function () {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            var id = $('#idEditSave').val();
            var expense = $('#expenseEditTable').val();
            var idProject = $('#idProjectEdit').val();
            var money = $('#moneyEditTable').val();
            var dateExpense = $('#dataEditTable').val();
            var checkPay = $('#checkPayEditTable').val();
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=expenseSaveEdit&expense="+expense+"&idProject="+idProject+"&money="+money+"&checkPay="+checkPay+"&dateExpense="+dateExpense+"&id="+id+"&idPay="+idPay,
                success: function (data) {
                    window.location = "/mngr/reportpay/"+idPay;
                }
            });
        });
        function maxMoney(totalResultMoney,idPay) {
            setTimeout(function () {
                swal({
                    title: "Внимание!!!",
                    text: "В отчете средств больше на <b>"+totalResultMoney+" р.</b> Затраченные средства будут возвращены после согласования вашим руководителем.",
                    type: "warning",
                    html: "true",
                    showCancelButton: true,
                    cancelButtonText: "Отмена"
                }, function () {
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=reportSend&idPay="+idPay,
                        success: function (data) {
                            window.location = "/mngr/underreport";
                        }
                    });
                });
            }, 200);
        }
        $('.goPay').on('click',function () {
            swal({
                title: "Отправить отчет руководителю?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Отмена"
            }, function () {
                //var endList = String($('#endList').text()).replace(/[^\d]/g, '');
                var endList = $('#endList').text().split('р');//String($('#endList').text()).replace(/[^\d]/g, '');
                endList = String(endList[0]).replace(/\s/g, '');
                var moneyBack = $('#moneyBack').val();
                var idPay = '<?php echo $onePay[0]['id'];?>';
                if(moneyBack.length<1){moneyBack=0;}
                var totalResultMoney = endList - moneyBack;
                if (!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(moneyBack)) {
                    $('#errorMoneyBack').removeClass('hiddenVisible');
                }else if(totalResultMoney>0){
                    setTimeout(function () {
                        swal({
                            title: "Недостаточно для отправки отчета!",
                            text: "Шутите? Вы же взяли больше!",
                            type: "warning",
                            timer: 10000
                        });
                    }, 200);
                    return false;
                }else if(totalResultMoney<0){
                    totalResultMoney = Math.abs(totalResultMoney);
                    totalResultMoney = String(totalResultMoney).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
                    //console.log(totalResultMoney);
                    maxMoney(totalResultMoney,idPay);
                }else{
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=reportSend&idPay="+idPay,
                        success: function (data) {
                            window.location = "/mngr/underreport";
                        }
                    });
                }
            });
        });

        //var listEnd = String($('#endList').text()).replace(/[^\d]/g, ''); //остаток
        var listEnd = String($('#endList').text()).replace(/[^-\d]/g, ''); //остаток
        //listEnd = names.split(re);
        var totalSumm = String($('#totalSumm').text()).replace(/[^\d]/g, '');
        var inList = String($('#inList').text()).replace(/[^\d]/g, '');
        var plusMoney = inList-totalSumm;
        if(listEnd>0){
            listEnd = String(listEnd).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
            var output = '<h3>Инициатор делает возврат на сумму '+listEnd+' р.</h3>';
            $('#infoReport').html(output);
            var outputLastSign = '<a href = "javascript:;" class="btn btn-primary reportLastBack" > Принять возврат наличных</a >';
            $('#lastSignBtn').html(outputLastSign);
        }else if(Number(inList)>Number(totalSumm)){
            plusMoney = String(plusMoney).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
            var output = '<h3>Необходимо выдать наличные в сумме '+plusMoney+' р.</h3>';
            $('#infoReport').html(output);
            var outputLastSign = '<a href = "javascript:;" class="btn btn-primary reportLastPay" > Выдать перерасход наличных</a >';
            $('#lastSignBtn').html(outputLastSign);
        }else{
            var outputLastSign = '<a href = "javascript:;" class="btn btn-success reportLastSuccess" ></i > Подотчет принят </a >';
            $('#lastSignBtn').html(outputLastSign);
        }

        //console.log(totalSumm);
        //console.log(inList);
        /*if(Number(inList)>Number(totalSumm)){
            plusMoney = String(plusMoney).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
            var output = '<h3>Необходимо выдать наличные в сумме '+plusMoney+' р.</h3>';
            //$('#infoReport').html(output);
            var outputLastSign = '<a href = "javascript:;" class="btn btn-primary reportLastPay" > Выдать перерасход наличных</a >';
            $('#lastSignBtn').html(outputLastSign);
        }*/

        $('body').on('click', '.reportLastBack', function () {
            var btnReportLastBack = $(this);
            var dateToday = datetimeToday();
            var idPay = '<?php echo $onePay[0]['id'];?>';
            Swal.fire({
                title: "Инициатор вернул средства?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Нет",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    btnReportLastBack.addClass('hiddenVisible'); //удаляем кнопку
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReportLastBack&idPay="+idPay+"&dateToday="+dateToday,
                        success: function (data) {
                            window.location = "/mngr/reportpay/"+idPay+"";
                        }
                    });
                }
            });
        });

        $('body').on('click', '.reportLastPay', function () {
            var btnReportLastPay = $(this);
            var dateToday = datetimeToday();
            var idPay = '<?php echo $onePay[0]['id'];?>';
            Swal.fire({
                title: "Вы выдали наличные?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Нет",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    btnReportLastPay.addClass('hiddenVisible'); //удаляем кнопку
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReportLastPay&idPay="+idPay+"&dateToday="+dateToday,
                        success: function (data) {
                            window.location = "/mngr/reportpay/"+idPay+"";
                        }
                    });
                }
            });
        });

        $('body').on('click', '.reportLastSuccess', function () {
            var btnReportLastSuccess = $(this);
            var dateToday = datetimeToday();
            var idPay = '<?php echo $onePay[0]['id'];?>';
            Swal.fire({
                title: "Вы принимаете подотчет?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Нет",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    btnReportLastSuccess.addClass('hiddenVisible'); //удаляем кнопку
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReportLastSuccess&idPay="+idPay+"&dateToday="+dateToday,
                        success: function (data) {
                            window.location = "/mngr/dashboard";
                        }
                    });
                }
            });
        });

        function datetimeToday(){
            return moment().format('DD.MM.YYYY HH:mm');
        }
        $('body').on('click', '.btn-success-report', function(){
            var thisButton = $(this);
            var invoiceId = $(this).data('invoiceid');
            var expid = $(this).data('expid');
            var mngrID = $(this).data('mngrid');
            var initiatorRole = $(this).data('initiatorrole');
            var idTable = $(this).data('idtable');

            var dateToday = datetimeToday();
            Swal.fire({
                title: "Принять расход?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    thisButton.addClass('hiddenVisible'); //удаляем кнопки success и failure
                    thisButton.next('button').removeClass('hiddenVisible'); //удаляем кнопки success и failure
                    $('#exp-' + expid).removeClass('danger').addClass('success');
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReport&expid=" + expid + "&reportClass=success",
                        success: function (data) {
                            testClassExp();
                            blankSum();
                        }
                    });
                }
            });
        });
        $('body').on('click', '.btn-failure-report', function() {
            var thisButton = $(this);
            var invoiceId = $(this).data('invoiceid');
            var expid = $(this).data('expid');
            var mngrID = $(this).data('mngrid');
            var initiatorRole = $(this).data('initiatorrole');
            var idTable = $(this).data('idtable');

            var dateToday = datetimeToday();
            Swal.fire({
                title: "Данный расход не будет принят?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    //$('button[data-expid="'+expid+'"]').remove(); //удаляем кнопки success и failure
                    //$('button .btn-success [data-expid="'+expid+'"]').addClass('hiddenVisible'); //удаляем кнопки success и failure
                    thisButton.addClass('hiddenVisible'); //удаляем кнопки success и failure
                    thisButton.prev('button').removeClass('hiddenVisible');
                    $('#exp-'+expid).removeClass('success').addClass('danger');
                    //var output = '<a href="javascript:;" class="btn btn-xs btn-outline blue editReportExpense" data-idedit="'+expid+'"><i class="fa fa-edit"></i></a>';
                    //$('#td-'+expid).html(output);
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReport&expid="+expid+"&reportClass=danger",
                        success: function (data) {
                            testClassExp();
                            blankSum();
                        }
                    });
                }
            });
        });
        testClassExp();
        function testClassExp() {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            //console.log(idPay);
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testReportClass&idPay="+idPay,
                success: function (data) {
                    var result = $.parseJSON(data);
                    var countClass = result.resultClass.length;
                    var switchDanger = '';
                    var switchSuccess = '';
                    var switchDefault = '';
                    var textClass = '';
                    for (var i=0;i<countClass;i++){
                        textClass = result.resultClass[i]['report_class'];
                        switch (textClass){
                            case 'danger':
                                switchDanger = 'true';
                                break;
                            case 'success':
                                switchSuccess = 'true';
                                break;
                            case 'default':
                                switchDefault = 'true';
                                break;
                        }
                    }
                    if(switchDefault !== 'true'){
                        if(switchDanger === 'true'){
                            //console.log('На доработку');
                            var output = '<a href = "javascript:;" class="btn btn-danger returnPay" > На доработку </a >';
                            $('#buttonsAction').html(output);
                        }else if(switchSuccess === 'true'){
                            //console.log('Далее');
                            var output = '<a href = "javascript:;" class="btn btn-success sendPay" > В бухгалтерию </a >';
                            $('#buttonsAction').html(output);
                        }
                    }
                }
            });
        }

        $('body').on('click','.returnPay', function () {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            var initiatorID = '<?php echo $onePay[0]['user_id'];?>';
            Swal.fire({
                title: "Вернуть инициатору на доработку?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if(isConfirm.value){

                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReportReturnSend&idPay="+idPay+"&reportClass=reportFailure&initiatorID="+initiatorID,
                        success: function (data) {
                            window.location = "/mngr/dashboard";
                        }
                    });
                }
            });
        });

        $('body').on('click','.sendPay', function () {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            var initiatorID = '<?php echo $onePay[0]['user_id'];?>';
            var dateToday = datetimeToday();
            Swal.fire({
                title: "Отправить в бухгалтерию?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if(isConfirm.value){

                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReportReturnSend&idPay="+idPay+"&reportClass=reportSuccess&initiatorID="+initiatorID+"&dateToday="+dateToday,
                        success: function (data) {
                            window.location = "/mngr/dashboard";
                        }
                    });
                }
            });
        });

        $('#allSuccess').on('click',function () {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            Swal.fire({
                title: "Принять все расходы?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReportAll&idPay="+idPay+"&report=success",
                        success: function (data) {
                            window.location = "/mngr/reportpay/"+idPay+"";
                        }
                    });
                }
            });
        });

        $('#allDanger').on('click',function () {
            var idPay = '<?php echo $onePay[0]['id'];?>';
            Swal.fire({
                title: "Отказать по всем расходам?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateReportAll&idPay="+idPay+"&report=danger",
                        success: function (data) {
                            window.location = "/mngr/reportpay/"+idPay+"";
                        }
                    });
                }
            });
        });

    });
</script>
