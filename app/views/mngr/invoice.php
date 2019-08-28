<?php
//bugs($allInvoice);
?>
<div class="page-content-wrapper">
    <div class="page-content">
        <h1 class="page-title">Список счетов</h1>
        <div class="mt-bootstrap-tables">
            <div class="row">
                <div class="col-md-12">
                    <?php $tableId = 'tableInvoice'; ?>
                    <div class="portlet box green-jungle">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list"></i>Все счета
                                <span id="summHeader"></span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" data-original-title="свернуть" class="iconTableCookie collapse" data-tablename="<?php echo $tableId;?>"> </a>
                            </div>
                        </div>
                        <div id="js-grid-juicy-projects"></div> <!-- id для вывода превью документа -->
                        <div class="portlet-body" data-tablename="<?php echo $tableId;?>">
                            <div id="<?php echo $tableId;?>Toolbar" class="btn-group">
                                <div class="form-group form-md-checkboxes">
                                    <div class="md-checkbox-inline">
                                        <div class="md-checkbox has-error">
                                            <input type="checkbox" checked id="checkboxRefusing" name="checkboxRefusing" class="md-check checkboxRefusing">
                                            <label for="checkboxRefusing" data-content="Показать/Скрыть отказы">
                                                <span></span>
                                                <span class="check" style="top:3px !important;"></span>
                                                <span class="box" style="top:7px;"></span>Отказы</label>
                                        </div>
                                        <div class="md-checkbox has-warning">
                                            <input type="checkbox" checked id="checkboxWork" name="checkboxWork" class="md-check checkboxWork">
                                            <label for="checkboxWork" data-content="Показать/Скрыть в работе">
                                                <span></span>
                                                <span class="check" style="top:3px !important;"></span>
                                                <span class="box" style="top:7px;"></span>В работе</label>
                                        </div>
                                        <div class="md-checkbox has-success">
                                            <input type="checkbox" checked id="checkboxSuccess" name="checkboxSuccess" class="md-check checkboxSuccess">
                                            <label for="checkboxSuccess" data-content="Показать/Скрыть оплаченные">
                                                <span></span>
                                                <span class="check" style="top:3px !important;"></span>
                                                <span class="box" style="top:7px;"></span>Оплаченные</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="<?php echo $tableId;?>" data-toggle="table" data-toolbar="#<?php echo $tableId;?>Toolbar"
                                   data-sort-name="<?php echo $tableId;?>-date" data-sort-order="desc"
                                   data-mobile-responsive="true" data-width="100%"
                                   data-show-columns="true" data-search="true"
                                   data-pagination="true" data-page-size="25" data-page-list="[5, 25, 50, 100, 500]"
                                   data-show-export="true" data-export-types="['xlsx','excel']"
                                   data-filter-control="true" data-filter-show-clear="true" data-hide-unused-select-options="true"
                                   data-striped="true" data-unique-id="<?php echo $tableId;?>-id"
                                   data-cookie="true" data-cookie-id-table="<?php echo $tableId;?>">
                                <thead>
                                <tr>
                                    <th data-visible="false" data-field="<?php echo $tableId;?>-id"></th>
                                    <th data-visible="false" data-field="<?php echo $tableId;?>-statusNumber"></th>
                                    <th data-field="<?php echo $tableId;?>-statusInvoice" data-align="center" data-sortable="true">Статус</th>
                                    <th data-field="<?php echo $tableId;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                    <th data-field="<?php echo $tableId;?>-contractNumber" data-filter-control="input" data-align="center" data-sortable="true">Проект</th>
                                    <th data-field="<?php echo $tableId;?>-invoiceNumber" data-align="center" data-sortable="true">Счет №</th>
                                    <th data-field="<?php echo $tableId;?>-department" data-filter-control="select" data-align="center" data-sortable="true">Отдел</th>
                                    <th data-field="<?php echo $tableId;?>-initiator" data-filter-control="select" data-align="center" data-sortable="true">Инициатор</th>
                                    <th data-field="<?php echo $tableId;?>-organization" data-filter-control="select" data-align="center" data-sortable="true">Организация</th>
                                    <th data-field="<?php echo $tableId;?>-kontragent" data-filter-control="select" data-align="center" data-sortable="true">Поставщик</th>
                                    <th data-field="<?php echo $tableId;?>-summ" data-align="center" data-sortable="true" data-sorter="priceSorter">Сумма</th>
                                    <th data-field="<?php echo $tableId;?>-actions" data-align="center">Действия</th>
                                    <th data-field="<?php echo $tableId;?>-notice" data-align="center">Примечания</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($allInvoice as $myData): ?>
                                        <?php
                                        $userName = $myData['initiatorSurname'].' '.$myData['initiatorFirstName'];
                                        $preview = getImageFolder($myData['pathScanInvoice']);
                                        $labelStatus = getLabelStatus($myData['statusInvoice']);
                                        if($myData['urgentPayment']=='on'){$infoTR = 'danger';}else{$infoTR = '';}
                                        ?>
                                        <tr class="<?php echo $infoTR;?>">
                                            <td><?php echo $myData['id'];?></td>
                                            <td><?php echo $myData['statusInvoice'];?></td>
                                            <td><?php echo $labelStatus;?></td>
                                            <td><?php echo $myData['dateCreate']; ?></td>
                                            <td><?php
                                                if(!empty($myData['numberContract'])){
                                                    foreach ($allProjects as $allProject) {
                                                        if($myData['numberContract'] == $allProject['id']){
                                                            if(!empty($allowedListUsers[0]['from_Statistic'])){
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
                                                                    data-numcont="'.$myData['numberContract'].'" data-toggle="popover" data-trigger="hover"
                                                                data-placement="auto" data-html="true" title="Покупатель" data-content="'.$nameContragent.'">'.$allProject['nameProject'].'</a>';
                                                            }else{
                                                                echo $allProject['nameProject'];
                                                            }
                                                        }
                                                    }
                                                }?>
                                            </td>
                                            <td><?php echo $myData['numberInvoice']; ?></td>
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
                                            <td><?php echo $userName; ?></td>
                                            <td><?php foreach ($allOrganization as $itemOrg){
                                                    if($myData['organizationInvoiceForPayment'] == $itemOrg['id']){
                                                        echo $itemOrg['nameOrganization'];
                                                    }
                                                }?></td>
                                            <td><?php foreach ($allContragents as $itemContra){
                                                    if($myData['contragent'] == $itemContra['id']){
                                                        echo $itemContra['name_contragent'];
                                                    }
                                                }?></td>
                                            <td><?php
                                                $moneySum = number_format($myData['summInvoiceForPayment'], 2, '.', '&nbsp;');
                                                echo $moneySum.'&nbsp;р.';
                                                ?></td>
                                            <td><?php echo $preview;?>
                                                <a href="/mngr/staffer/<?php echo $myData['id'];?>"
                                                   class="btn btn-xs btn-outline blue"
                                                   data-toggle="popover" data-trigger="hover"
                                                   data-placement="auto" data-content="Перейти">
                                                    <i class="fa fa-arrows-alt"></i>
                                                </a>
                                                <?php if($myData['signature'] == $_SESSION['mngr']['id']){
                                                    if($lastSignInvoice==$_SESSION['mngr']['id']){
                                                        echo '<button type="button"
                                                                class="btn btn-xs btn-outline green-jungle btn-invoiceEnd"
                                                                id="invoiceEnd'.$myData['id'].'"
                                                                data-initiatorrole="'.$_SESSION['mngr']['userRole'].'" data-invoiceid="'.$myData['id'].'"
                                                                data-mngrtable="invoice" data-idtable="'.$tableId.'" data-mngrid="'.$myData['mngrId'].'" data-currency="'.$myData['currency'].'"
                                                                data-toggle="popover" data-trigger="hover"
                                                                data-placement="auto" data-content="Оплачено">
                                                                <i class="fa fa-check"></i></button>
                                                                    <button type="button"
                                                                class="btn btn-xs btn-outline red btn-failure"
                                                                id="failure' . $myData['id'] . '"
                                                                data-initiatirrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $myData['id'] . '"
                                                                data-mngrtable="invoice" data-idtable="' . $tableId . '" data-mngrid="' . $myData['mngrId'] . '"
                                                                data-toggle="popover" data-trigger="hover"
                                                                data-placement="auto" data-content="Отказать">
                                                                <i class="fa fa-thumbs-o-down"></i></button>';
                                                    }else {
                                                        echo '<button type="button"
                                                        class="btn btn-xs btn-outline green-jungle btn-success"
                                                        id="success' . $myData['id'] . '"
                                                        data-initiatorrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $myData['id'] . '"
                                                        data-mngrtable="invoice" data-idtable="' . $tableId . '" data-mngrid="' . $myData['mngrId'] . '"
                                                        data-toggle="popover" data-trigger="hover"
                                                        data-placement="auto" data-content="Согласовать">
                                                        <i class="fa fa-thumbs-o-up"></i></button>
                                                            <button type="button"
                                                        class="btn btn-xs btn-outline red btn-failure"
                                                        id="failure' . $myData['id'] . '"
                                                        data-initiatirrole="' . $_SESSION['mngr']['userRole'] . '" data-invoiceid="' . $myData['id'] . '"
                                                        data-mngrtable="invoice" data-idtable="' . $tableId . '" data-mngrid="' . $myData['mngrId'] . '"
                                                        data-toggle="popover" data-trigger="hover"
                                                        data-placement="auto" data-content="Отказать">
                                                        <i class="fa fa-thumbs-o-down"></i></button>';
                                                    }
                                                };?></td>
                                            <td><?php echo $myData['noticeInvoiceForPayment']; ?></td>
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
<script>
    $(document).ready(function() {
        //var invoiceUserName = $.cookie('invoiceUserName');


        var urlOne = '/ajax/ajaxpost';
        var tableIdAll = '<?php echo $tableId;?>';
        var currencyGeneral = '<?php echo $currencyGeneral;?>';

//поиск по инициатору с главной страницы
        if($.cookie('invoiceUserName')!=='null'){
            $('#tableInvoice').bootstrapTable('resetSearch',$.cookie('invoiceUserName'));
            $('.search').find('.form-control').val('');
            $.cookie('invoiceUserName', null, {path: '/'});
        }else{
            $.cookie('tableInvoice.bs.table.searchText', 'null', {path:'/'});
        }
//очищаем куки поиска
        $.cookie('tableInvoice.bs.table.searchText', 'null', {path:'/'});
//подсчет общей суммы
        insertTotal();
        function insertTotal() {
            var getDataTable = $('#'+tableIdAll).bootstrapTable('getData');
            var countLength = getDataTable.length;
            var sumArrTD=0;
            for(var i = 0;i<countLength;i++){
                var parseSummInTable = String(getDataTable[i][tableIdAll+'-summ']).replace(/&nbsp;/g, '');
                sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
            }
            sumArrTD = sumArrTD.toFixed(2);
            sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
            var appArrTD = ' на сумму: <span id="totalTable" class="summToTotal">'+sumArrTD+'&nbspр.</span>';
            //$('th[data-field="tableAll-summ"]').find('.no-filter-control').append(appArrTD);
            if($('body #summFooter').length === 0){
                $('.pagination-detail').after('<div class="pull-right pagination" id="summFooter"><span class="pagination-info summToTotal">'+sumArrTD+'&nbspр.</span></div>');
            }
            $('#summHeader').html(appArrTD);
        }

        $('input[data-field="'+tableIdAll+'-id"]').css('display','none'); //убрать этот столбик из сетки таблицы

        $('table').on('all.bs.table', function () { //popover при фильтрации таблицы
            $('[data-toggle="popover"]').popover();
            $('#totalTable').remove();
            insertTotal();
        });

        $('input[data-field="'+tableIdAll+'-statusNumber"]').css('display','none'); //убрать этот столбик из сетки таблицы
//галочки отказано, в работе, оплачено
        var visibleSuccess = '';
        var visibleRefusing = '';
        var visibleWork1 = '';
        var visibleWork2 = '';
        $('.checkboxRefusing').on('click', function () { //чекбокс отказов
            if($.cookie('checkboxSuccess')==='on'){visibleSuccess='7';}else{visibleSuccess='';}
            if($.cookie('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}else{visibleWork1='';visibleWork2='';}
            if(this.checked){
                $.cookie('checkboxRefusing', 'on');
                $('#'+tableIdAll).bootstrapTable('filterBy',{'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, '5', visibleSuccess]});
            }else{
                $.cookie('checkboxRefusing', 'off');
                $('#'+tableIdAll).bootstrapTable('filterBy', {'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, visibleSuccess]});
            }
        });
        $('.checkboxSuccess').on('click', function () { //чекбокс оплачено
            if($.cookie('checkboxRefusing')==='on'){visibleRefusing='5';}else{visibleRefusing='';}
            if($.cookie('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}else{visibleWork1='';visibleWork2='';}
            if(this.checked){
                $.cookie('checkboxSuccess', 'on');
                $('#'+tableIdAll).bootstrapTable('filterBy',{'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, visibleRefusing, '7']});
            }else{
                $.cookie('checkboxSuccess', 'off');
                $('#'+tableIdAll).bootstrapTable('filterBy', {'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, visibleRefusing]});
            }
        });

        $('.checkboxWork').on('click', function () { //чекбокс в работе
            if($.cookie('checkboxRefusing')==='on'){visibleRefusing='5';}else{visibleRefusing='';}
            if($.cookie('checkboxSuccess')==='on'){visibleSuccess='7';}else{visibleSuccess='';}
            if(this.checked){
                $.cookie('checkboxWork', 'on');
                $('#'+tableIdAll).bootstrapTable('filterBy',{'<?php echo $tableId;?>-statusNumber': ['1', '2', visibleRefusing, visibleSuccess]});
            }else{
                $.cookie('checkboxWork', 'off');
                $('#'+tableIdAll).bootstrapTable('filterBy', {'<?php echo $tableId;?>-statusNumber': [visibleRefusing, visibleSuccess]});
            }
        });
        if($.cookie('checkboxRefusing') == null){$.cookie('checkboxRefusing','on');}
        if($.cookie('checkboxWork') == null){$.cookie('checkboxWork','on');}
        if($.cookie('checkboxSuccess') == null){$.cookie('checkboxSuccess','on');}

        if($.cookie('checkboxRefusing') === 'on'){ //cookie чекбокс отказов
            if($.cookie('checkboxSuccess')==='on'){visibleSuccess='7';}
            if($.cookie('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableIdAll).bootstrapTable('filterBy',{'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, '5', visibleSuccess]});
        }else{
            if($.cookie('checkboxSuccess')==='on'){visibleSuccess='7';}
            if($.cookie('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableIdAll).bootstrapTable('filterBy', {'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, visibleSuccess]});
            $('.checkboxRefusing').removeAttr('checked');
        }

        if($.cookie('checkboxSuccess') === 'on'){ //cookie чекбокс оплачено
            if($.cookie('checkboxRefusing')==='on'){visibleRefusing='5';}
            if($.cookie('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableIdAll).bootstrapTable('filterBy',{'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, visibleRefusing, '7']});
        }else{
            if($.cookie('checkboxRefusing')==='on'){visibleRefusing='5';}
            if($.cookie('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableIdAll).bootstrapTable('filterBy', {'<?php echo $tableId;?>-statusNumber': [visibleWork1, visibleWork2, visibleRefusing]});
            $('.checkboxSuccess').removeAttr('checked');
        }

        if($.cookie('checkboxWork') === 'on'){ //cookie чекбокс в работе
            if($.cookie('checkboxRefusing')==='on'){visibleRefusing='5';}
            if($.cookie('checkboxSuccess')==='on'){visibleSuccess='7';}
            $('#'+tableIdAll).bootstrapTable('filterBy',{'<?php echo $tableId;?>-statusNumber': ['1', '2', visibleRefusing, visibleSuccess]});
        }else{
            if($.cookie('checkboxRefusing')==='on'){visibleRefusing='5';}
            if($.cookie('checkboxSuccess')==='on'){visibleSuccess='7';}
            $('#'+tableIdAll).bootstrapTable('filterBy', {'<?php echo $tableId;?>-statusNumber': [visibleRefusing, visibleSuccess]});
            $('.checkboxWork').removeAttr('checked');
        }

        $('.btn-circle-filter').find(':first').text('Все'); //найти все селекты и поставить в первый option text ВСЕ
        $('.keep-open').find('input').on('click', function () { //перезагрузка при сокрытии полей
            $('.btn-circle-filter').find(':first').text('Все');
        });
//Функция получения текущей даты и времени
        function datetimeToday() {
            return moment().format('DD.MM.YYYY H:m');
        }
        $('body').on('click', '.btn-success', function(){
            var invoiceId = $(this).data('invoiceid');
            var initiatorRole = $(this).data('initiatorrole');
            var tableId = $(this).data('idtable');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var dataImage = $('tr[data-uniqueid="'+invoiceId+'"]').find('a').data('image'); //получаем имя файла счета

            var statusInvoiceSpan = '<span class="label label-sm label-info" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="согласован руководителем"><i class="glyphicon glyphicon-time"></i></span>';
            var numberStatus = '2';
            var output = '\
                <a href="/public/scanInvoice/'+dataImage+'"\
                    class="cbp-lightbox btn dark btn-xs btn-outline sbold uppercase"\
                    data-title="'+dataImage+'" data-toggle="popover" data-trigger="hover" data-placement="auto" title=""\
                    data-content="Нажмите для просмотра счета" data-original-title="просмотр"><i class="fa fa-file-image-o"></i></a>\
                <a href="/mngr/staffer/'+invoiceId+'"\
                    class="btn btn-xs btn-outline blue" data-toggle="popover"\
                    data-trigger="hover" data-placement="auto" title=""\
                    data-content="Нажмите для перехода в счет" data-original-title="отслеживание">\
                    <i class="fa fa-arrows-alt"></i></a>';

            var dateToday = datetimeToday();
            swal({
                title: "Подписать?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }, function(isConfirm){
                if (isConfirm.value){
                    swal({
                        title: "Документ подписан!",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#success'+invoiceId).remove(); //удаляем кнопку success
                    $('#failure'+invoiceId).remove(); //удаляем кнопку failure
                    $('#'+tableId).bootstrapTable('updateByUniqueId', {
                        id: invoiceId,
                        row: {
                            '<?php echo $tableId;?>-statusInvoice': statusInvoiceSpan,
                            '<?php echo $tableId;?>-statusNumber': numberStatus,
                            '<?php echo $tableId;?>-actions': output
                        }
                    });
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=success&dateToday="+dateToday,
                        success: function (data) {}
                    });
                }
            });
        });
        $('body').on('click', '.btn-failure', function(){
            var invoiceId = $(this).data('invoiceid');
            var initiatorRole = $(this).data('initiatorrole');
            var tableId = $(this).data('idtable');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var dataImage = $('tr[data-uniqueid="'+invoiceId+'"]').find('a').data('image'); //получаем имя файла счета

            var dateToday = datetimeToday();
            swal({
                title: "Отказ в подписании",
                text: "Укажите причину отказа:",
                type: "input",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }, function (inputValueFailure) {
                if (inputValueFailure === false) return false;
                if (inputValueFailure === "") {
                    swal.showInputError("Вы не указали причину отказа!");
                    return false
                }
                swal({
                    title: "Отказ зарегистрирован",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1500
                });

                    $('#success'+invoiceId).remove(); //удаляем кнопку success
                    $('#failure'+invoiceId).remove(); //удаляем кнопку failure
                var getSel = $('tr[data-uniqueid="'+invoiceId+'"]').bootstrapTable('getSelections'); //получаем данные объекта
                console.log(getSel[0]['cells']);
                var output = '\
                <a href="/public/scanInvoice/'+dataImage+'"\
                    class="cbp-lightbox btn dark btn-xs btn-outline sbold uppercase"\
                    data-title="'+dataImage+'"\
                    data-toggle="popover" data-trigger="hover" data-placement="auto" title=""\
                    data-content="Нажмите для просмотра счета" data-original-title="просмотр"><i class="fa fa-file-image-o"></i></a>\
                <a href="/mngr/staffer/'+invoiceId+'"\
                    class="btn btn-xs btn-outline blue" data-toggle="popover"\
                    data-trigger="hover" data-placement="auto" title=""\
                    data-content="Нажмите для перехода в счет"\
                    data-original-title="отслеживание">\
                    <i class="fa fa-arrows-alt"></i></a>';
                $('#'+tableId).bootstrapTable('updateByUniqueId', {
                    id: invoiceId,
                    row: {
                        '<?php echo $tableId;?>-statusInvoice': '<span class="label label-sm label-danger" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="отказ"><i class="glyphicon glyphicon-remove"></i></span>',
                        '<?php echo $tableId;?>-statusNumber': '5',
                        '<?php echo $tableId;?>-actions': output
                    }
                });

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=failure&dateToday="+dateToday+"&inputValueFailure="+inputValueFailure,
                    success: function (data) {}
                });
            });
        });
        $('body').on('click', '.btn-invoiceEnd', function(){
            var invoiceId = $(this).data('invoiceid');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var initiatorRole = $(this).data('initiatorrole');
            var tableId = $(this).data('idtable');
            var dataImage = $('tr[data-uniqueid="'+invoiceId+'"]').find('a').data('image'); //получаем имя файла счета
            var currency = $(this).data('currency');

            var dateToday = datetimeToday();
            if(mngrtable!=='forPay' && parseInt(currencyGeneral)!==currency){
                swal({
                    title: "Внимание!",
                    text: "Необходимо указать сумму фактической оплаты",
                    type: "input",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Отмена",
                    confirmButtonText: "Подтвердить",
                    closeOnConfirm: false
                }, function (inputValueMoney) {
                    if (inputValueMoney === false) return false;
                    if (!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(inputValueMoney)) {
                        swal.showInputError("Возможно есть пробелы. Точка или запятая разделитель копеек!");
                        return false
                    }
                    if (inputValueMoney === "") {
                        swal.showInputError("Вы не указали сумму оплаты!");
                        return false
                    }
                    $('#invoiceEnd'+invoiceId).remove(); //удаляем кнопку
                    var statusInvoiceSpan = '<span class="label label-sm label-success" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="оплачено"><i class="glyphicon glyphicon-star"></i></span>';
                    var numberStatus = '7';
                    var output = '\
                        <a href="/public/scanInvoice/'+dataImage+'"\
                            class="cbp-lightbox btn dark btn-xs btn-outline sbold uppercase"\
                            data-title="'+dataImage+'" data-toggle="popover" data-trigger="hover" data-placement="auto" title=""\
                            data-content="Нажмите для просмотра счета" data-original-title="просмотр"><i class="fa fa-file-image-o"></i></a>\
                        <a href="/mngr/staffer/'+invoiceId+'"\
                            class="btn btn-xs btn-outline blue" data-toggle="popover"\
                            data-trigger="hover" data-placement="auto" title=""\
                            data-content="Нажмите для перехода в счет" data-original-title="отслеживание">\
                            <i class="fa fa-arrows-alt"></i></a>';
                    $('#'+tableId).bootstrapTable('updateByUniqueId', {
                        id: invoiceId,
                        row: {
                            '<?php echo $tableId;?>-statusInvoice': statusInvoiceSpan,
                            '<?php echo $tableId;?>-statusNumber': numberStatus,
                            '<?php echo $tableId;?>-actions': output
                        }
                    });
                    setTimeout(function () {
                        swal({
                            title: "Счет оплачен!",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }, 200); // время в мс
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday+"&inputValueMoney="+inputValueMoney,
                        success: function (data) {}
                    });
                });
            }else{
                swal({
                    title: "Вы оплатили счет?",
                    type: "warning",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Нет",
                    confirmButtonText: "Да",
                    closeOnConfirm: false,
                    closeModal: true
                }, function(isConfirm){
                    if (isConfirm.value) {
                        $('#invoiceEnd'+invoiceId).remove(); //удаляем кнопку
                        var statusInvoiceSpan = '<span class="label label-sm label-success" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="оплачено"><i class="glyphicon glyphicon-star"></i></span>';
                        var numberStatus = '7';
                        var output = '\
                        <a href="/public/scanInvoice/'+dataImage+'"\
                            class="cbp-lightbox btn dark btn-xs btn-outline sbold uppercase"\
                            data-title="'+dataImage+'" data-toggle="popover" data-trigger="hover" data-placement="auto" title=""\
                            data-content="Нажмите для просмотра счета" data-original-title="просмотр"><i class="fa fa-file-image-o"></i></a>\
                        <a href="/mngr/staffer/'+invoiceId+'"\
                            class="btn btn-xs btn-outline blue" data-toggle="popover"\
                            data-trigger="hover" data-placement="auto" title=""\
                            data-content="Нажмите для перехода в счет" data-original-title="отслеживание">\
                            <i class="fa fa-arrows-alt"></i></a>';
                        $('#'+tableId).bootstrapTable('updateByUniqueId', {
                            id: invoiceId,
                            row: {
                                '<?php echo $tableId;?>-statusInvoice': statusInvoiceSpan,
                                '<?php echo $tableId;?>-statusNumber': numberStatus,
                                '<?php echo $tableId;?>-actions': output
                            }
                        });
                        setTimeout(function () {
                            swal({
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
        });
//cookieTable
        $('.iconTableCookie').on('click',function () {
            var iconCookie = $(this).data('tablename');
            var classList = $(this).attr('class').split(' ')[1];
            if(classList === 'expand'){
                $(this).find('.portlet-body').removeAttr('style');
                $.cookie(iconCookie, 'on');
            }else{
                $(this).find('.portlet-body').css('display','none');
                $.cookie(iconCookie, 'off');
            }
        });
        if($.cookie('<?php echo $tableId;?>') === 'off'){
            $('.iconTableCookie[data-tablename="<?php echo $tableId;?>"]').removeClass('collapse').addClass('expand');
            $('.portlet-body[data-tablename="<?php echo $tableId;?>"]').css('display','none');
        }
//переход в аналитику
        $('body').on('click','.linkContract',function () {
            var idProject = $(this).data('numcont');
            window.open ('/mngr/analitics/project'+idProject);
        });
    });
</script>