<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Редактирование счета</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-6">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <form action="/mngr/editinvoice/<?php echo $oneInvoice[0]['id'];?>" method="post" enctype="multipart/form-data" id="formEditInvoice">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Опции</label>
                                    <div class="kt-checkbox-inline">
                                        <div class="kt-checkbox has-error">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--danger" for="urgentPayment">
                                                <input type="checkbox" id="urgentPayment" name="urgentPayment"> Срочно!
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox has-info">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand" for="needPay">
                                                <input type="checkbox" <?php if($oneInvoice[0]['needPay']=='true'){echo 'checked';}?> id="needPay" name="needPay" class="needPay"> Нужна платежка
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox has-success">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success" for="contractCheck">
                                                <input type="checkbox" checked id="contractCheck" name="contractCheck" class="contractCheck"> К проекту
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="divContractCheck">
                                    <label class="col-3 col-form-label" for="numberContract">Проект <span style="color: red;">*</span></label>
                                    <div class="col-9">
                                        <input type="hidden" id="idProjectHidden" name="idProjectHidden" value="<?php echo $oneInvoice[0]['numberContract'];?>">
                                        <input type="text" class="form-control searchProject" placeholder="Имя проекта или (ИНН или название покупателя)" value="<?php
                                        foreach ($allProjects as $idProject){
                                            if($idProject['id']==$oneInvoice[0]['numberContract']){
                                                echo $idProject['nameProject'];
                                            }
                                        }?>" autocomplete="off" id="numberContract" name="numberContract">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label" for="numberInvoice">Номер счета<span style="color: red;">*</span></label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" placeholder="Номер счета без даты" value="<?php echo $oneInvoice[0]['numberInvoice'];?>" id="numberInvoice" name="numberInvoice" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label" for="summInvoiceForPayment">Сумма <span style="color: red;">*</span></label>
                                    <div class="col-5">
                                        <input type="text" class="form-control" id="summInvoiceForPayment" placeholder="Сумма к оплате" value="<?php echo $oneInvoice[0]['summInvoiceForPayment'];?>" autocomplete="off" name="summInvoiceForPayment" required>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-control" id="selectCurrency" name="selectCurrency">
                                            <?php foreach ($defaultDownload['currency'] as $curr){
                                                echo '<option value="'.$curr['codeCurrency'].'">'.$curr['nameCurrency'].'</option>';
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row hiddenVisible" id="divCurrency">
                                    <label class="col-3 col-form-label kt-font-success" for="currencyTransform">По курсу ЦБ</label>
                                    <div class="col-5">
                                        <input type="text" readonly="readonly" class="form-control" id="currencyTransform" name="currencyTransform">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" readonly="readonly" class="form-control" id="currencyCourse" name="currencyCourse">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label" for="organizationInvoiceForPayment">Организация</label>
                                    <div class="col-9">
                                        <select class="form-control" id="organizationInvoiceForPayment" name="organizationInvoiceForPayment">
                                            <?php foreach ($allOrganization as $iteam):?>
                                                <?php if($oneInvoice[0]['organizationInvoiceForPayment']==$iteam['id']){$checkOrg = 'selected="selected"';}else{$checkOrg = '';}?>
                                                <option value="<?php echo $iteam['id'];?>" <?php echo $checkOrg;?>><?php echo $iteam['nameOrganization'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label" for="innContragent">Поставщик <span style="color: red;">*</span></label>
                                    <div class="col-9">
                                        <input type="hidden" id="idHiddenContragent" name="idHiddenContragent" value="<?php echo $oneInvoice[0]['contragent'];?>">
                                        <input type="text" class="form-control" id="innContragent" placeholder="ИНН или наименование поставщика" value="<?php
                                        foreach ($allContragents as $idContragent){
                                            if($idContragent['id']==$oneInvoice[0]['contragent']){
                                                echo $idContragent['name_contragent'];
                                            }
                                        }?>" name="innContragent" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group form-group-last">
                                    <label for="noticeInvoiceForPayment">Примечание</label>
                                    <textarea class="form-control" name="noticeInvoiceForPayment" id="noticeInvoiceForPayment" rows="3"><?php echo $oneInvoice[0]['noticeInvoiceForPayment'];?></textarea>
                                </div>
                                <?php //bugs(phpinfo());?>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Загруженный счет</label>
                                    <div class="col-md-9">
                                        <div class="cbp-item graphic">
                                            <div class="cbp-caption">
                                                <div id="js-grid-juicy-projects"></div> <!-- id для вывода превью документа -->
                                                <object data="<?php echo '/file/invoice/'.$oneInvoice[0]['pathScanInvoice'];?>" type="application/pdf" width="370px" height="200px">
                                                    <embed src="<?php echo '/file/invoice/'.$oneInvoice[0]['pathScanInvoice'];?>" type="application/pdf">
                                                    <p>Этот браузер не может отобразить содержимое: <a href="<?php echo '/file/invoice/'.$oneInvoice[0]['pathScanInvoice'];?>">Скачать PDF</a>.</p>
                                                    </embed>
                                                </object>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-last">
                                    <label class="col-form-label">Загрузить новый счет <span style="color: red;">*</span></label>
                                    <p id="downloadFile" class="hiddenVisible" style="color: red;">Добавьте файл</p>
                                    <div class="file-loading">
                                        <input id="imgInvoice" name="imgInvoice[]" type="file" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot kt-portlet__foot--solid">
                                <div class="kt-form__actions kt-form__actions--center">
                                    <input type="hidden" name="idInvoice" id="idInvoice" value="<?php echo $oneInvoice[0]['id'];?>">
                                    <input type="hidden" name="oldFile" id="oldFile" value="<?php echo '/file/invoice/'.$oneInvoice[0]['pathScanInvoice'];?>">
                                    <button type="button" id="submitInvoiceEdit" class="btn btn-primary">Отправить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END VALIDATION STATES -->
            </div>
            <div class="col-lg-6">
                <!-- ПОКУПАТЕЛИ -->
                <div class="col-12 kt-portlet" id="visibleDivContragentList">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="fa fa-shopping-cart"></i></span>
                            <h3 class="kt-portlet__head-title">Покупатели</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addContragent" data-type="contra"><i class="flaticon2-add-1"></i></a>
                        </div>
                    </div>
                    <div class="kt-portlet__body" id="bodyCollapse1" style="display: none;">
                        <div class="kt-scroll selectContragent" style="height:200px" data-scroll="true">
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table table-bordered table-hover table-striped removeUl">
                                        <thead>
                                        <tr>
                                            <td style="text-align: center;"><b>ИНН</b></td>
                                            <td style="text-align: center;"><b>Наименование</b></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ПРОЕКТЫ -->
                <div class="col-12 kt-portlet" id="visibleDivContract">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                            <h3 class="kt-portlet__head-title">Проекты</h3>
                        </div>
                        <div class="actions hiddenVisible" id="addProjectBtn">
                            <a href="javascript:;" class="btn btn-default btn-sm addProject" data-idcontra="">
                                <i class="fa fa-plus"></i> Добавить </a>
                        </div>
                    </div>
                    <div class="kt-portlet__body" id="bodyCollapse2" style="display: none;">
                        <div class="kt-scroll selectProject" style="height:200px" data-scroll="true">
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table table-bordered table-striped table-hover removeUl">
                                        <thead>
                                        <tr>
                                            <td style="text-align: center;"><b>Дата</b></td>
                                            <td style="text-align: center;"><b>Название</b></td>
                                            <td style="text-align: center;">Контрагент</td>
                                            <td style="text-align: center;">Стоимость</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ПОСТАВЩИКИ -->
                <div class="col-12 kt-portlet" id="visibleDivContrgent">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="fa fa-truck"></i></span>
                            <h3 class="kt-portlet__head-title">Поставщики</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar" id="addProjectBtn">
                            <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addContragent" data-type="postav"><i class="flaticon2-add-1"></i></a>
                        </div>
                    </div>
                    <div class="kt-portlet__body" id="bodyCollapse3" style="display: none;">
                        <div class="kt-scroll selectPostav" style="height:200px" data-scroll="true">
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table table-bordered table-striped table-hover removeContragent">
                                        <thead>
                                        <tr>
                                            <td style="text-align: center;"><b>ИНН</b></td>
                                            <td style="text-align: center;"><b>Наименование</b></td>
                                        </tr>
                                        </thead>
                                        <tbody>
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
    <!-- Модальное окно добавления контрагента -->
    <div class="modal fade" id="modalAddContragent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление контрагента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inn_contragent" class="col-form-label">ИНН:</label>
                        <input type="text" class="form-control" id="inn_contragent">
                    </div>
                    <div class="form-group">
                        <label for="name_contragent" class="col-form-label">Наименование:</label>
                        <input type="text" class="form-control" id="name_contragent">
                    </div>
                    <div class="form-group">
                        <label for="kpp_contragent" class="col-form-label">КПП:</label>
                        <input type="text" class="form-control" id="kpp_contragent">
                    </div>
                    <div class="form-group">
                        <label for="notice_contragent" class="col-form-label">Примечание:</label>
                        <input type="text" class="form-control" id="notice_contragent">
                    </div>
                    <div class="hiddenVisible" id="validateDiv">
                        <p style="color: red;text-align: center;">Проверьте ИНН или наименование</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idInitiator" id="idInitiator" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <input type="hidden" name="typeAdd" id="typeAdd">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddContragent">Применить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно добавления проекта -->
    <div class="modal fade" id="modalAddProject" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление проекта</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newNameProject" class="col-form-label">Наименование:</label>
                        <input type="text" class="form-control" id="newNameProject">
                    </div>
                    <div class="form-group">
                        <label for="newNoticeProject" class="col-form-label">Примечание:</label>
                        <input type="text" class="form-control" id="newNoticeProject">
                    </div>
                    <div class="hiddenVisible" id="validateDivProject">
                        <p style="color: red;text-align: center;">Проверьте наименование</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idContragent" id="idContragent">
                    <input type="hidden" name="idInitProject" id="idInitProject" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddProject">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<script>
    $(document).ready(function()
    {
        var urlOne = '/ajax/ajaxpost';

//устанавливаем отметку о том, что документ редактируется
        var idInvoice = "<?php echo $oneInvoice[0]['id'];?>"

        //$.cookie('editInvoice','true',{expires: 1,path: '/'});
        //$.cookie('targetInvoice','/mngr/editinvoice/'+idInvoice,{expires: 1,path: '/'});
        /*$.ajax({
            url: urlOne, type: "POST", dataType: "text",
            data: "mainAjax=labelEdit&idInvoice="+idInvoice+"&typeAdd=invoice&label=true",
            success: function (data){}
        });*/

        $('#numberContract').change(function () {
            $('#idProjectHidden').val('');
        });
        $('#innContragent').change(function () {
            $('#idHiddenContragent').val('');
        });
//проверяем select валюты
        $('#selectCurrency').change(function () {
            var optionCode = $(this).val();
            var divCurrency = $('#divCurrency');
            switch (optionCode){
                case 'RUR':
                    divCurrency.addClass('hiddenVisible');
                    $('#currencyTransform').val('');
                    break;
                case 'EUR':
                case 'USD':
                    divCurrency.removeClass('hiddenVisible');
                    dataCurrencyCB($('#summInvoiceForPayment').val());
                    break;
            }
        });
        $('#summInvoiceForPayment').on('keyup',function () {
            var keyMoney = $(this).val();
            delay(function(){
                dataCurrencyCB(keyMoney);
            }, 700 );
        });
        function dataCurrencyCB(keyMoney) {
            var selectCurrency = $('#selectCurrency').val();
            var simbolCurrency = '';
            switch (selectCurrency){
                case 'EUR':
                    simbolCurrency = '1€';
                    break;
                case 'USD':
                    simbolCurrency = '$1';
                    break;
            }
            if(selectCurrency!=='RUR'){
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=getCurrency&selectCurrency=" + selectCurrency,
                    beforeSend: function (data) { // запустится до вызова запроса
                        $('#currencyTransform').val('');
                    },
                    success: function (data) {
                        var result = $.parseJSON(data);
                        var currentCB = result.currencyCB[selectCurrency]*keyMoney;
                        currentCB = currentCB.toFixed(2);
                        $('#currencyTransform').val(currentCB+' р.');
                        $('#currencyCourse').val(simbolCurrency+' = '+result.currencyCB[selectCurrency]+'р.');
                    }
                });
            }
        }
//открываем модальное окно добавления контрагента
        $('body').on('click','.addContragent', function () {
            $('#typeAdd').val($(this).data('type'));
            $('#modalAddContragent').modal('show');
        });
//открываем модальное окно добавления проекта
        $('body').on('click','.addProject', function () {
            $('#idContragent').val($(this).data('idcontra'));
            $('#modalAddProject').modal('show');
        });
//сохраняем контрагента
        $('#saveAddContragent').on('click',function () {
            var newInnContragent = $('#inn_contragent').val();
            var newNameContragent = $('#name_contragent').val();
            var newKppContragent = $('#kpp_contragent').val();
            var newNoticeContragent = $('#notice_contragent').val();
            var idInitiator = $('#idInitiator').val();
            var typeAdd = $('#typeAdd').val();
            if(newInnContragent==='' || newNameContragent==='') {
                $('#validateDiv').removeClass('hiddenVisible');
            }else{
                $('#modalAddContragent').modal('hide');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=insertContragent&newInnContragent=" + newInnContragent + "&newNameContragent=" + newNameContragent + "&newKppContragent=" + newKppContragent + "&newNoticeContragent=" + newNoticeContragent + "&idInitiator=" + idInitiator,
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if(typeAdd==='contra'){
                            if (result.idContragent === 'false') {
                                Swal.fire({
                                    title: "Данный ИНН существует",
                                    type: "info",
                                    allowOutsideClick: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Понятно"
                                });
                            }else{
                                $('#idContragent').val(result.idContragent);
                                $('#modalAddProject').modal('show');
                            }
                        }else{
                            $('#innContragent').val(newNameContragent);
                            $('#idHiddenContragent').val(result.idContragent);
                        }
                    }
                });
            }
        });
//сохраняем проект
        $('#saveAddProject').on('click',function () {
            var newNameProject = $('#newNameProject').val();
            var newNoticeProject = $('#newNoticeProject').val();
            var idContragent = $('#idContragent').val();
            var idInitProject = $('#idInitProject').val();
            if(newNameProject==='') {
                $('#validateDivProject').removeClass('hiddenVisible');
            }else{
                $('#modalAddProject').modal('hide');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=insertProject&newNameProject="+newNameProject+"&newNoticeProject="+newNoticeProject+"&idContragent="+idContragent+"&idInitProject="+idInitProject,
                    success: function (data) {
                        var result = $.parseJSON(data);
                        console.log(result);
                        $('#numberContract').val(newNameProject);
                        $('#idProjectHidden').val(result.idProject);
                        $('#numberContract').valid();
                        $('#numberContractPay').valid();
                    }
                });
            }
        });
//поле ввода проекта
        $('.searchProject').on('keyup',function () {
            var numberContract = $(this).val();

            delay(function(){
                dataProject(numberContract);
            }, 700 );
        });
        function dataProject(numberContract) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=checkProject&numberContract="+numberContract,
                beforeSend: function(data) { // запустится до вызова запроса
                    $('.selectProject').find('.removeUl > tbody > tr').html('');
                    $('.selectContragent').find('.removeUl > tbody > tr').html('');
                    $('.selectPostav').find('.removeContragent > tbody > tr').remove();
                    $('#addProjectBtn').addClass('hiddenVisible');
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    $('#collapse1').removeClass('expand').addClass('collapse');
                    $('#bodyCollapse1').css('display','block');
                    $('#collapse2').removeClass('expand').addClass('collapse');
                    $('#bodyCollapse2').css('display','block');
                    $.each(result.dataContragent,function(col,val){
                        var output2 = '\
                        <tr>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" data-idcontra="'+val.id+'" class="primary-link enterContra">'+val.inn_contragent+'</a>\
                            </td>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" data-idcontra="'+val.id+'" class="primary-link enterContra">'+val.name_contragent+'</a>\
                            </td>\
                        </tr>';
                        $('.selectContragent').find('tbody').append(output2);
                    });
                    $.each(result.dataProject,function(col,val){
                        let moneyProject = String(val.moneyProject).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
                        var output3 = '\
                        <tr>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.dateCreate+'</a>\
                            </td>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.nameProject+'</a>\
                            </td>\
                            <td style="text-align: center;"><span>'+val.idContragent+'</span></td>\
                            <td style="text-align: center;">\
                                <span>'+moneyProject+'&nbspр.</span>\
                            </td>\
                        </tr>';
                        $('.selectProject').find('tbody').append(output3);
                    });
                }
            });
        }

//открываем список проектов при клике на контрагента
        $('body').on('click','.enterContra', function () {
            var idContra = $(this).data('idcontra');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=getProject&idContra="+idContra,
                beforeSend: function(data) { // запустится до вызова запроса
                    $('.selectProject').find('.removeUl > tbody > tr').html('');
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    //console.log(result.oneProject);
                    if(result.oneProject.length ===0){
                        $('#idContragent').val(idContra);
                        $('#modalAddProject').modal('show');
                    }else{
                        $('#addProjectBtn').removeClass('hiddenVisible');
                        $('#collapse2').removeClass('expand').addClass('collapse');
                        $('#bodyCollapse2').css('display','block');
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
                            $('#addProjectBtn').removeClass('hiddenVisible');
                            $('.addProject').data('idcontra',idContra);
                            $('.selectProject').find('tbody').append(output3);
                        });
                    }
                }
            });
            //$('#modalSelectProject').modal('show');
        });

        $('body').on('click','.enterProject', function () {
            $('#numberContract').val($(this).data('nameproject'));
            $('#idProjectHidden').val($(this).data('idproject'));
            $('#numberContractPay').val($(this).data('nameproject'));
            $('#idProjectHiddenPay').val($(this).data('idproject'));
            $('#numberContract').valid();
        });

        $('#contractCheck').on('click',function () {
            if(this.checked){
                $('#divContractCheck,#visibleDivContract').removeClass('hiddenVisible');
                var output = '\
                        <table class="table table-striped table-advance table-hover removeUl">\
                            <thead>\
                                <tr>\
                                    <td style="text-align: center;">Номер контракта</td>\
                                    <td style="text-align: center;">Дата создания</td>\
                                </tr>\
                            </thead>\
                            <tbody>\
                            </tbody>\
                        </table>';
                $('.selectNumber').append(output);
            }else{
                $('.selectNumber').find('.removeUl').remove();
                $('#divContractCheck,#visibleDivContract').addClass('hiddenVisible');
            }
        });

        var delay = (function(){
            var timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();

        function dataContract(numberContract) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=checkContract&numberContract="+numberContract,
                success: function (data) {
                    var result = $.parseJSON(data);

                    $.each(result.dataNumberContract,function(col,val){
                        var output2 = '\
                        <tr>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterContract" data-contract="'+val.numberContract+'">'+val.numberContract+'</a>\
                            </td>\
                            <td style="text-align: center;">\
                                <span>'+val.dateContract+'</span>\
                            </td>\
                        </tr>';
                        $('.selectNumber').find('tbody').append(output2);
                    });
                }
            });
        }
        $('.numberContract').on('keyup',function () {
            var numberContract = $(this).val();
            $('.selectNumber').find('.removeUl > tbody > tr').remove();
            delay(function(){
                dataContract(numberContract);
            }, 700 );
        });

        $('#innContragent').on('keyup',function () {
            var innContragent = $(this).val();
            delay(function(){
                dataContragent(innContragent);
            }, 700 );
        });
        function dataContragent(innContragent) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=checkProject&numberContract=" + innContragent,
                beforeSend: function(data) { // запустится до вызова запроса
                    $('.selectPostav').find('.removeContragent > tbody > tr').remove();
                    $('.selectProject').find('.removeUl > tbody > tr').html('');
                    $('.selectContragent').find('.removeUl > tbody > tr').html('');
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    $('#collapse3').removeClass('expand').addClass('collapse');
                    $('#bodyCollapse3').css('display','block');
                    $('#collapse1,#collapse2').removeClass('collapse').addClass('expand');
                    $('#bodyCollapse1,#bodyCollapse2').css('display','none');
                    $('#addProjectBtn').addClass('hiddenVisible');

                    $.each(result.dataContragent,function(col,val){
                        var output2 = '\
                        <tr>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterContragent" data-idcontragent="'+val.id+'" data-namecon="'+val.name_contragent+'">'+val.inn_contragent+'</a>\
                            </td>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterContragent" data-idcontragent="'+val.id+'" data-namecon="'+val.name_contragent+'">'+val.name_contragent+'</a>\
                            </td>\
                        </tr>';
                        $('.selectPostav').find('tbody').append(output2);
                    });
                }
            });
        }

        $('.selectPostav').on('click','.enterContragent',function () {
            $('#innContragent').val($(this).data('namecon'));
            $('#idHiddenContragent').val($(this).data('idcontragent'));
            $('#innContragent').valid();
        });

        $('.selectNumber').on('click','.enterContract',function () {
            var textContract = $(this).data('contract');
            $('.numberContract').val(textContract);
        });

        function datetimeStamp() {
            let timezone = '<?php echo $defaultDownload['timezone'];?>';
            return moment().utcOffset(timezone).format('YYYY-MM-DD HH:mm:ss');
        }

        $('#submitInvoiceEdit').on('click',function () {
            var dateEdit = datetimeStamp();
            if ($('#formEditInvoice').valid()) {
                var formData = new FormData();
                $.each($('#imgInvoice')[0].files, function(key, value) {
                    formData.append('file[]', value);
                });
                formData.append('mainAjax','editInvoice');
                formData.append('dateEdit',dateEdit);
                formData.append('oldFile',$('#oldFile').val());
                formData.append('idInvoice',$('#idInvoice').val());
                formData.append('urgentPayment',$('#urgentPayment').prop('checked'));
                formData.append('needPay',$('#needPay').prop('checked'));
                formData.append('idProjectHidden',$('#idProjectHidden').val());
                formData.append('numberInvoice',$('#numberInvoice').val());
                formData.append('selectCurrency',$('#selectCurrency').val());
                formData.append('currencyTransform',$('#currencyTransform').val());
                formData.append('summInvoiceForPayment',$('#summInvoiceForPayment').val());
                formData.append('organizationInvoiceForPayment',$('#organizationInvoiceForPayment').val());
                formData.append('idHiddenContragent',$('#idHiddenContragent').val());
                formData.append('noticeInvoiceForPayment',$('#noticeInvoiceForPayment').val());

                /*for (var pair of formData.entries()) {
                    //console.log(pair[0]+ ', ' + pair[1]);
                    $.each(pair[1], function(key, value){
                        //console.log(key);
                        console.log(value);
                    });
                }*/

                $.ajax({
                    url: urlOne, type: "POST", dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        if (data.error === 'noPDFandPDF') {
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Я не могу объединить два файла .PDF!",
                                type: "warning"
                            });
                        }else if(data.error === 'noedit'){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Извините, но редактирование закрыто так как счет уже подписан",
                                type: "warning",
                                confirmButtonText: "Понятно"
                            });
                        }else{
                            Swal.fire({
                                title: "Идет отправка!",
                                type: "success",
                                timer: 2000
                            });
                            window.location = ('/mngr/staffer/'+$('#idInvoice').val());
                        }
                    }
                });
            }
        });
    });
</script>
