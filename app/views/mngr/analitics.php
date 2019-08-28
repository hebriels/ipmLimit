<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Информация по проектам </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="kt-portlet">
                <form action="/mngr/analitics" method="post">
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <input type="hidden" id="idProjectHidden" name="idProjectHidden">
                            <input type="text" class="form-control numberProject" id="numberProject" name="numberProject" autocomplete="off" placeholder="Проект...">
                        </div>
                        <div class="col-lg-3 input-group date floatdate">
                            <input type="text" class="form-control" readonly name="dateFrom" placeholder="Дата от:" id="dateFrom" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-3 input-group date floatdate">
                            <input type="text" class="form-control" readonly name="dateTo" placeholder="Дата до:" id="dateTo" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-success" id="searchContract" type="button">Искать</button>
                            </span>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 hiddenVisible" id="divSearchContract">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                            <h3 class="kt-portlet__head-title searchP"> Найденные контрагенты: </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-striped table-hover removeContragent">
                            <thead>
                            <tr>
                                <th style="text-align: center;">ИНН</th>
                                <th style="text-align: center;">Наименование</th>
                            </tr>
                            </thead>
                            <tbody class="searchContragent">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 hiddenVisible" id="divSearchProject">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                            <h3 class="kt-portlet__head-title searchP"> Найденные проекты: </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-striped table-hover removeContragent">
                            <thead>
                            <tr>
                                <th style="text-align: center;">Дата</th>
                                <th style="text-align: center;">Наименование</th>
                                <th style="text-align: center;">Примечание</th>
                            </tr>
                            </thead>
                            <tbody class="searchProject">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="kt-portlet">
                <div class="kt-portlet__body" style="padding-top: 0;">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__bottom" style="border-top:0;margin-top: 0;">
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-pie-chart"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Общая сумма</span>
                                    <span class="kt-widget__value" id="summInvoiceForPay"></span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-file-1"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Сумма со счетов</span>
                                    <span class="kt-widget__value" id="summMoneyInvoice"></span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-coins"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Сумма с налички</span>
                                    <span class="kt-widget__value" id="summMoneyPay"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                    <h3 class="kt-portlet__head-title">
                        <?php
                            $titleTable = 'Документы';
                            if(!empty($getSearchProject)){
                                $titleTable = 'Документы по проекту';
                            }
                            if(!empty($getSearchContragents)){
                                $titleTable = 'Документы по контрагенту';
                            }
                            echo $titleTable.' <span style="color: #333;"><b>'.$nameFromTable.'</b></span>';
                        ?>
                        <span id="summHeader"></span></h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-tablename="tablePay">
                <div id="tablePayToolbar" class="btn-group">
                    <div class="form-group">
                        <div class="kt-checkbox-inline">
                            <div class="kt-checkbox has-error">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--danger" for="checkboxRefusing">
                                    <input type="checkbox" checked id="checkboxRefusing" name="checkboxRefusing" class="checkboxRefusing"> Отказы
                                    <span></span>
                                </label>
                            </div>
                            <div class="kt-checkbox has-info">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand" for="checkboxWork">
                                    <input type="checkbox" checked id="checkboxWork" name="checkboxWork" class="checkboxWork"> В работе
                                    <span></span>
                                </label>
                            </div>
                            <div class="kt-checkbox has-success">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success" for="checkboxSuccess">
                                    <input type="checkbox" checked id="checkboxSuccess" name="checkboxSuccess" class="checkboxSuccess"> Оплаченные
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tablePay" data-toggle="table" data-toolbar="#tablePayToolbar"
                           data-sort-name="tablePay-date" data-sort-order="desc"
                           data-mobile-responsive="true"
                           data-show-columns="true" data-search="true"
                           data-pagination="true" data-page-size="25" data-page-list="[5, 10, 15, 20, 25, 30]"
                           data-show-export="true" data-export-types="['excel']"
                           data-filter-control="true" data-filter-show-clear="true" data-hide-unused-select-options="true"
                           data-striped="true" data-unique-id="tablePay-id"
                           data-cookie="true" data-cookie-id-table="tablePay">
                        <thead>
                        <tr>
                            <th data-visible="false" data-field="tablePay-id" data-switchable="false"></th>
                            <th data-visible="false" data-field="tablePay-type" data-switchable="false"></th>
                            <th data-visible="false" data-field="tablePay-statusNumber" data-switchable="false"></th>
                            <th data-field="tablePay-statusInvoice" data-align="center" data-sortable="true">Статус</th>
                            <th data-field="tablePay-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                            <th data-field="tablePay-project" data-filter-control="input" data-align="center" data-sortable="true">Проект</th>
                            <th data-field="tablePay-contragent" data-filter-control="input" data-align="center" data-sortable="true">Поставщик</th>
                            <th data-field="tablePay-department" data-filter-control="select" data-align="center" data-sortable="true">Отдел</th>
                            <th data-field="tablePay-initiator" data-filter-control="select" data-align="center" data-sortable="true">Инициатор</th>
                            <th data-field="tablePay-summ" data-align="center" data-sortable="true" data-sorter="priceSorter">Сумма</th>
                            <th data-field="tablePay-actions" data-align="center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($getSearchProject!='' || $getSearchContragents!=''):?>
                        <?php
                            if(!empty($getSearchProject)){
                                $arrayForeach = $getSearchProject;
                            }
                            if(!empty($getSearchContragents)){
                                $arrayForeach = $getSearchContragents;
                            }
                            foreach ($arrayForeach as $myDatas): ?>
                            <?php foreach ($myDatas as $myData): ?>
                                <?php
                                if(isset($myData['numberContract'])){
                                    $numberContract = $myData['numberContract'];
                                    $linkUrl = 'staffer/'.$myData['id'];
                                    $status = $myData['statusInvoice'];
                                    $idTableTD = 'invoice-'.$myData['id'];
                                    $tableType = 'invoice';
                                }else{
                                    $numberContract = $myData['contract'];
                                    $linkUrl = 'onepay/'.$myData['id'];
                                    $status = $myData['status_pay'];
                                    $idTableTD = 'forPay-'.$myData['id'];
                                    $tableType = 'forPay';
                                }
                                $userName = $myData['initiatorSurname'].' '.$myData['initiatorFirstName'];
                                if(isset($myData['money'])){$money = $myData['money'];}else{$money = $myData['summInvoiceForPayment'];}

                                $labelStatus = getLabelStatus($status);
                                if(isset($myData['urgentPayment'])){
                                    if($myData['urgentPayment']=='on'){$infoTR = 'danger';}else{$infoTR = '';}
                                }else{
                                    $infoTR = 'success';
                                }

                                ?>
                                <tr class="<?php echo $infoTR;?>">
                                    <td><?php echo $idTableTD;?></td>
                                    <td><?php echo $tableType;?></td>
                                    <td><?php echo $status;?></td>
                                    <td><?php echo $labelStatus;?></td>
                                    <td><?php echo $myData['dateCreate'];?></td>
                                    <td><?php foreach ($allProjects as $allProject) {
                                        if($numberContract == $allProject['id']){
                                            echo $allProject['nameProject'];
                                        }
                                    }?></td>
                                    <td><?php if(isset($myData['contragent'])){
                                            foreach ($allContragents as $itemContra){
                                                if($myData['contragent'] == $itemContra['id']){
                                                    echo $itemContra['name_contragent'];
                                                }
                                            }
                                        }
                                        ?></td>
                                    <td><?php if(isset($myData['mngrId'])){$userID = $myData['mngrId'];}else{$userID = $myData['user_id'];}
                                            $count = count($allUsers) - 1;
                                            for ($i = 0; $i <= $count; $i++) {
                                                if ($userID == $allUsers[$i]['id']) {
                                                    foreach ($allDepartments as $allDepartment) {
                                                        if ($allUsers[$i]['userDepartment'] == $allDepartment['id']) {
                                                            echo $allDepartment['nameDepartment'];
                                                        }
                                                    }
                                                }
                                            }
                                        ?></td>
                                    <td><?php echo $userName;?></td>
                                    <td><?php
                                        $moneySum = number_format($money, 2, '.', '&nbsp;');
                                        echo $moneySum.'&nbsp;р.';
                                        ?></td>
                                    <td>
                                        <a href="/mngr/<?php echo $linkUrl;?>" target="_blank"
                                           class="btn btn-xs btn-outline blue"
                                           data-toggle="popover" data-trigger="hover"
                                           data-placement="auto" title="отслеживание" data-content="Нажмите для перехода в счет">
                                            <i class="fa fa-arrows-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script>
    $(document).ready(function() {
        var urlOne = '/ajax/ajaxpost';
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
        insertTotal();
        function insertTotal() {
            var getDataTable = $('#tablePay').bootstrapTable('getData');
            var countLength = getDataTable.length;
            var sumArrTD=0;
            var sumArrForPay=0;
            var sumArrInvoice=0;
            //var refusingForSum = $('#checkboxRefusing').prop('checked');
            //var refusingForSum = checkboxToolbar('checkboxRefusing');
            //var workForSum = checkboxToolbar('checkboxWork');
            //var successForSum = checkboxToolbar('checkboxSuccess');
            var parseSummInTable = 0;
            for(var i = 0;i<countLength;i++){
                var statusNum = getDataTable[i]['tablePay-statusNumber'];
                //console.log(statusNum);
                /*if(refusingForSum === 'on'){
                    if(statusNum === '5'){
                        parseSummInTable = String(getDataTable[i]['tablePay-summ']).replace(/&nbsp;/g, '');
                        sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
                    }
                }
                if(workForSum === 'on'){
                    if(statusNum === '1' || statusNum === '2'){
                        parseSummInTable = String(getDataTable[i]['tablePay-summ']).replace(/&nbsp;/g, '');
                        sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
                    }
                }
                if(successForSum === 'on'){
                    if(statusNum === '7'){
                        parseSummInTable = String(getDataTable[i]['tablePay-summ']).replace(/&nbsp;/g, '');
                        sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
                    }
                }
                console.log(parseSummInTable);*/
                //console.log(sumArrTD);
                //console.log(successForSum);
                parseSummInTable = String(getDataTable[i]['tablePay-summ']).replace(/&nbsp;/g, '');
                sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
                if(getDataTable[i]['tablePay-type']=='forPay'){
                    sumArrForPay = sumArrForPay + + (parseFloat(parseSummInTable));
                }
                if(getDataTable[i]['tablePay-type']=='invoice'){
                    sumArrInvoice = sumArrInvoice + + (parseFloat(parseSummInTable));

                    //console.log(sumArrInvoice);
                }
            }
            //console.log(sumArrForPay);
            //console.log(sumArrInvoice);
            sumArrTD = sumArrTD.toFixed(2);
            sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
            var appArrTD = ' на сумму: <span id="totalTable" class="summToTotal">'+sumArrTD+'&nbspр.</span>';
            //$('th[data-field="tablePay-summ"]').find('.no-filter-control').append(appArrTD);
            if($('body #summFooter').length === 0){
                $('.pagination-detail').after('<div class="pull-right pagination" id="summFooter"><span class="pagination-info summToTotal">'+sumArrTD+'&nbspр.</span></div>');
            }
            $('#summHeader').html(appArrTD);

            sumArrInvoice = Math.floor(sumArrInvoice);
            sumArrForPay = Math.floor(sumArrForPay);
            var summInvoiceForPay = sumArrForPay + + sumArrInvoice;
            summInvoiceForPay = String(summInvoiceForPay).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ');
            sumArrForPay = String(sumArrForPay).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ');
            sumArrInvoice = String(sumArrInvoice).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ');

            $('#summInvoiceForPay').text(summInvoiceForPay);
            $('#summMoneyPay').text(sumArrForPay);
            $('#summMoneyInvoice').text(sumArrInvoice);
        }

        //$('input[data-field="tablePay-id"]').css('display','none'); //убрать этот столбик из сетки таблицы
        //$('input[data-field="tablePay-type"]').css('display','none'); //убрать этот столбик из сетки таблицы
        //$('input[data-field="tablePay-statusNumber"]').css('display','none'); //убрать этот столбик из сетки таблицы

        $('table').on('all.bs.table', function () { //popover при фильтрации таблицы
            $('[data-toggle="popover"]').popover();
            $('#totalTable').remove();
            insertTotal();
        });

        $('.btn-circle-filter').find(':first').text('Все'); //найти все селекты и поставить в первый option text ВСЕ
        $('.keep-open').find('input').on('click', function () { //перезагрузка при сокрытии полей
            $('.btn-circle-filter').find(':first').text('Все');
        });
//определение куки для кнопок страницы analitics
        var cookieRefusing = 'checkboxAnaliticsRefusing';
        var cookieWork = 'checkboxAnaliticsWork';
        var cookieSuccess = 'checkboxAnaliticsSuccess';
        var visibleSuccess = '';
        var visibleRefusing = '';
        var visibleWork1 = '';
        var visibleWork2 = '';
        $('.checkboxRefusing').on('click', function () { //чекбокс отказов
            Cookies.set(cookieRefusing, $('.checkboxRefusing').prop('checked'));
            if(Cookies.get(cookieSuccess)==='true'){visibleSuccess='7';}else{visibleSuccess='';}
            if(Cookies.get(cookieWork)==='true'){visibleWork1='1';visibleWork2='2';}else{visibleWork1='';visibleWork2='';}
            if(this.checked){
                $('#tablePay').bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, '5', visibleSuccess]});
            }else{
                $('#tablePay').bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleSuccess]});
            }
        });
        $('.checkboxWork').on('click', function () { //чекбокс в работе
            Cookies.set(cookieWork, $('.checkboxWork').prop('checked'));
            if(Cookies.get(cookieRefusing)==='true'){visibleRefusing='5';}else{visibleRefusing='';}
            if(Cookies.get(cookieSuccess)==='true'){visibleSuccess='7';}else{visibleSuccess='';}
            if(this.checked){
                $('#tablePay').bootstrapTable('filterBy',{'tablePay-statusNumber': ['1', '2', visibleRefusing, visibleSuccess]});
            }else{
                $('#tablePay').bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleRefusing, visibleSuccess]});
            }
        });
        $('.checkboxSuccess').on('click', function () { //чекбокс оплачено
            Cookies.set(cookieSuccess, $('.checkboxSuccess').prop('checked'));
            if(Cookies.get(cookieRefusing)==='true'){visibleRefusing='5';}else{visibleRefusing='';}
            if(Cookies.get(cookieWork)==='true'){visibleWork1='1';visibleWork2='2';}else{visibleWork1='';visibleWork2='';}
            if(this.checked){
                $('#tablePay').bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing, '7']});
            }else{
                $('#tablePay').bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing]});
            }
        });

        if(Cookies.get(cookieRefusing) == null){Cookies.set(cookieRefusing,'true');}
        if(Cookies.get(cookieWork) == null){Cookies.set(cookieWork,'true');}
        if(Cookies.get(cookieSuccess) == null){Cookies.set(cookieSuccess,'true');}

        if(Cookies.get(cookieRefusing) === 'true'){ //cookie чекбокс отказов
            if(Cookies.get(cookieSuccess)==='true'){visibleSuccess='7';}
            if(Cookies.get(cookieWork)==='true'){visibleWork1='1';visibleWork2='2';}
            $('#tablePay').bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, '5', visibleSuccess]});
        }else{
            if(Cookies.get(cookieSuccess)==='true'){visibleSuccess='7';}
            if(Cookies.get(cookieWork)==='true'){visibleWork1='1';visibleWork2='2';}
            $('#tablePay').bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleSuccess]});
            $('.checkboxRefusing').removeAttr('checked');
        }

        if(Cookies.get(cookieWork)==='true'){ //cookie чекбокс в работе
            if(Cookies.get(cookieRefusing)==='true'){visibleRefusing='5';}
            if(Cookies.get(cookieSuccess)==='true'){visibleSuccess='7';}
            $('#tablePay').bootstrapTable('filterBy',{'tablePay-statusNumber': ['1', '2', visibleRefusing, visibleSuccess]});
        }else{
            if(Cookies.get(cookieRefusing)==='true'){visibleRefusing='5';}
            if(Cookies.get(cookieSuccess)==='true'){visibleSuccess='7';}
            $('#tablePay').bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleRefusing, visibleSuccess]});
            $('.checkboxWork').removeAttr('checked');
        }

        if(Cookies.get(cookieSuccess)==='true'){ //cookie чекбокс оплачено
            if(Cookies.get(cookieRefusing)==='true'){visibleRefusing='5';}
            if(Cookies.get(cookieWork)==='true'){visibleWork1='1';visibleWork2='2';}
            $('#tablePay').bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing, '7']});
        }else{
            if(Cookies.get(cookieRefusing)==='true'){visibleRefusing='5';}
            if(Cookies.get(cookieWork)==='true'){visibleWork1='1';visibleWork2='2';}
            $('#tablePay').bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing]});
            $('.checkboxSuccess').removeAttr('checked');
        }

        $('#searchContract').on('click',function () {
            var form = $(this).parents('form');
            var idProject = $('#idProjectHidden').val();
            var dateFrom = $('#dateFrom').val();
            var dateTo = $('#dateTo').val();
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=searchOneProject&idProject="+idProject+"&dateFrom="+dateFrom+"&dateTo="+dateTo,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if(result.testContract===false){
                        Swal.fire({
                            title: "Такой проект не найден!",
                            type: "info"
                        });
                    }else{
                        form.submit();
                    }
                }
            });
        });

        $('.numberProject').on('keyup',function () {
            var numberContract = $(this).val();
            delay(function(){
                dataProject(numberContract);
            }, 700 );
        });

        var delay = (function(){
            var timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();

        function dataProject(numberContract) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=checkProject&numberContract="+numberContract,
                beforeSend: function(data) { // запустится до вызова запроса
                    $('.searchContragent').html('');
                    $('.searchProject').html('');
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    $('#divSearchContract').removeClass('hiddenVisible');
                    $('#divSearchProject').removeClass('hiddenVisible');
                    $.each(result.dataContragent,function(col,val){
                        var output2 = '\
                        <tr>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" data-idcontra="'+val.id+'" class="primary-link enterContragent">'+val.inn_contragent+'</a>\
                            </td>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" data-idcontra="'+val.id+'" class="primary-link enterContragent">'+val.name_contragent+'</a>\
                            </td>\
                        </tr>';
                        $('.searchContragent').append(output2);
                    });
                    $.each(result.dataProject,function(col,val){
                        var output3 = '\
                        <tr>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.dateCreate+'</a>\
                            </td>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.nameProject+'</a>\
                            </td>\
                            <td style="text-align: center;"><span>'+val.notice+'</span>\
                            </td>\
                        </tr>';
                        $('.searchProject').append(output3);
                    });
                }
            });
        }
        $('body').on('click','.enterContragent', function () {
            var idContra = $(this).data('idcontra');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=getProject&idContra="+idContra,
                beforeSend: function(data) { // запустится до вызова запроса
                    $('.searchProject').html('');
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    console.log(result.oneProject);
                        $.each(result.oneProject,function(col,val){
                            var output3 = '\
                                <tr>\
                                    <td style="text-align: center;">\
                                        <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.dateCreate+'</a>\
                                    </td>\
                                    <td style="text-align: center;">\
                                        <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.nameProject+'</a>\
                                    </td>\
                                    <td style="text-align: center;">\
                                        <span>'+val.notice_project+'</span>\
                                    </td>\
                                </tr>';
                            //$('.addProject').data('idcontra',idContra);
                            $('.searchProject').append(output3);
                        });
                }
            });
        });

        $('body').on('click','.enterProject', function () {
            $('#numberProject').val($(this).data('nameproject'));
            $('#idProjectHidden').val($(this).data('idproject'));
        });
        function checkboxToolbar(str) {
            //var resultCheck = $('#'+str).prop('checked');
            var resultCheck = $.cookie(str);
            return resultCheck;
        }

    });
</script>