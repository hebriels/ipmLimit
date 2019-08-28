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
                        <form action="#" method="post" enctype='multipart/form-data' id="formAddInvoicePay">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Опции</label>
                                    <div class="kt-checkbox-inline">
                                        <div class="kt-checkbox has-error">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--danger" for="underReportPay">
                                                <input type="checkbox" disabled="disabled" <?php if($onePayInvoice[0]['under_report']=='true'){echo 'checked';}?> id="underReportPay" name="underReportPay"> Под отчет
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox has-success">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success" for="contractCheckPay">
                                                <input type="checkbox" <?php if(!empty($onePayInvoice[0]['contract'])){echo 'checked';}?> id="contractCheckPay" name="contractCheckPay" class="contractCheck"> К проекту
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row d-none" id="divContractCheckPay">
                                    <label class="col-3 col-form-label" for="numberContract">Проект <span style="color: red;">*</span></label>
                                    <div class="col-9">
                                        <input type="text" class="form-control searchProject" placeholder="Имя проекта или (ИНН или название покупателя)" value="<?php
                                        foreach ($allProjects as $idProject){
                                            if($idProject['id']==$onePayInvoice[0]['contract']){
                                                echo $idProject['nameProject'];
                                            }
                                        }?>" autocomplete="off" id="numberContractPay" name="numberContractPay">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label" for="summForPayment">Сумма <span style="color: red;">*</span></label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="summForPayment" placeholder="Сумма к выдаче" value="<?php echo $onePayInvoice[0]['money'];?>" autocomplete="off" name="summForPayment" required>
                                    </div>
                                </div>
                                <div class="form-group form-group-last">
                                    <label for="noticeForPay">Примечание</label>
                                    <textarea class="form-control" name="noticeForPay" id="noticeForPay" rows="3"><?php echo $onePayInvoice[0]['notice_pay'];?></textarea>
                                </div>
                                <?php if(!empty($onePayInvoice[0]['paths_pay'])):?>
                                <?php
                                    $info = new SplFileInfo($onePayInvoice[0]['paths_pay']);
                                    $fileInfo = $info->getExtension();
                                    if($fileInfo == 'pdf' || $fileInfo == 'PDF' || $fileInfo == 'Pdf'):?>
                                        <div class="kt-section mt-2" id="divPDFRepPay">
                                            <span class="kt-section__info">Загруженный файл</span>
                                            <div class="kt-section__content kt-section__content--solid">
                                                <object data="<?php echo '/file/invoicePay/'.$onePayInvoice[0]['paths_pay'];?>" type="application/pdf" width="370px" height="200px">
                                                    <embed src="<?php echo '/file/invoicePay/'.$onePayInvoice[0]['paths_pay'];?>" type="application/pdf">
                                                    <p>Этот браузер не может отобразить содержимое: <a href="<?php echo '/file/invoicePay/'.$onePayInvoice[0]['paths_pay'];?>" download="download">Скачать PDF</a>.</p>
                                                    </embed>
                                                </object>
                                                <button type="button" id="deleteFileRepPay" class="btn btn btn-outline-danger">Удалить документ</button>
                                                <button type="button" id="newFileRepPay" class="btn btn-outline-brand">Загрузить новый</button>
                                            </div>
                                        </div>
                                    <?php else:?>
                                        <div class="kt-section mt-2" id="divOtherRepPay">
                                            <span class="kt-section__info">Загруженный файл</span>
                                            <div class="kt-section__content kt-section__content--solid">
                                                <img src="<?php echo '/file/invoicePay/'.$onePayInvoice[0]['paths_pay'];?>" width="370px">
                                                <button type="button" id="deleteFileRepPay" class="btn btn-outline-danger">Удалить документ</button>
                                                <button type="button" id="newFileRepPay" class="btn btn-outline-brand">Загрузить новый</button>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                <?php endif;?>
                                <div class="form-group" id="divDownloadFile">
                                    <label class="col-form-label">Прикрепить файл</label>
                                    <p id="downloadFile" class="hiddenVisible" style="color: red;">Добавьте файл</p>
                                    <div class="file-loading">
                                        <input id="imgInvoicePay" name="imgInvoicePay[]" type="file" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot kt-portlet__foot--solid">
                                <div class="kt-form__actions kt-form__actions--center">
                                    <input type="hidden" name="idProjectHiddenPay" id="idProjectHiddenPay" value="<?php echo $onePayInvoice[0]['contract'];?>">
                                    <input type="hidden" name="oldFile" id="oldFile" value="<?php echo '/file/invoicePay/'.$onePayInvoice[0]['paths_pay'];?>">
                                    <button type="button" id="submitPay" class="btn btn-primary">Отправить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ПОКУПАТЕЛИ -->
                <div class="col-md-6" id="visibleDivContragentList">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-shopping-cart"></i>Покупатели</div>
                            <div class="tools">
                                <a href="javascript:;" data-original-title="свернуть" class="expand" id="collapse1"></a>
                            </div>
                            <div class="actions">
                                <a href="javascript:;" class="btn btn-default btn-sm addContragent" data-type="contra">
                                    <i class="fa fa-plus"></i> Добавить </a>
                            </div>
                        </div>
                        <div class="portlet-body" id="bodyCollapse1" style="display: none;">
                            <div class="scroller selectContragent" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                                <table class="table table-striped table-advance table-hover removeUl">
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
                <!-- ПРОЕКТЫ -->
                <div class="col-md-6" id="visibleDivContract">
                    <div class="portlet box green-jungle">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Проекты</div>
                            <div class="tools">
                                <a href="javascript:;" data-original-title="свернуть" class="expand" id="collapse2"></a>
                            </div>
                            <div class="actions hiddenVisible" id="addProjectBtn">
                                <a href="javascript:;" class="btn btn-default btn-sm addProject" data-idcontra="">
                                    <i class="fa fa-plus"></i> Добавить </a>
                            </div>
                        </div>
                        <div class="portlet-body" id="bodyCollapse2" style="display: none;">
                            <div class="scroller selectProject" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                                <table class="table table-striped table-advance table-hover removeUl">
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
        </div>
    </div>
    <!--Модальное окно добавления контрагента-->
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
    <!-- модальное окно добавления проекта -->
    <div class="modal fade" id="modalAddProject" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавление проекта</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newNameProject" class="col-form-label">Наименование
                                            <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" id="newNameProject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="moneyProject" class="col-form-label">Сумма проекта
                                            <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" autocomplete="off" id="moneyProject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group divExpenseProject">
                                        <label for="expenseProject" class="col-form-label">Фиксированные траты</label>
                                        <input type="text" class="form-control" id="expenseProject">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group divSelectedProject">
                                        <label for="selectedProject" class="control-label">Рентабельность</label>
                                        <select id="selectedProject" class="form-control">
                                            <option value="1">По умолчанию</option>
                                            <option value="2">Процент прибыли</option>
                                            <option value="3">Сумма прибыли</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group divProfitProject">
                                        <label for="profitProject" class="col-form-label">Значение рентабельности</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="profitProject" readonly value="<?php echo $profitInProject;?>">
                                            <span class="input-group-addon">
                                                <i id="faProfitProject" class="fas fa-percent"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="hiddenVisible col-md-12" id="profitChange">
                                    <p style="color: green;text-align: left; margin: 0px;">Значение рентабельности будет автоматически преобразовано в проценты.</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newNoticeProject" class="col-form-label">Примечание:</label>
                                        <input type="text" class="form-control" id="newNoticeProject">
                                    </div>
                                </div>
                                <div class="hiddenVisible" id="validateDivProject">
                                    <p style="color: red;text-align: center;">Проверьте заполнение полей</p>
                                </div>
                                <div class="hiddenVisible" id="validateMoney">
                                    <p style="color: red;text-align: center;">Не корректная сумма проекта</p>
                                </div>
                                <div class="hiddenVisible" id="validateProfit">
                                    <p style="color: red;text-align: center;">Не корректное значение рентабельности</p>
                                </div>
                                <div class="hiddenVisible" id="validatePercent">
                                    <p style="color: red;text-align: center;">Процент рентабельности должен быть от 0 до 100</p>
                                </div>
                            </div>
                        </div>
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

<script>
    $(document).ready(function()
    {
        let urlOne = '/ajax/ajaxpost';

        if($('#contractCheckPay').prop('checked')){
            $('#divContractCheckPay').removeClass('d-none');
        }else{
            $('divContractCheckPay,#visibleDivContragentList,#visibleDivContract').addClass('d-none');
        }
        $('#contractCheckPay').on('click',function () {
            if(this.checked){
                $('#divContractCheckPay,#visibleDivContragentList,#visibleDivContract').removeClass('d-none');
                $('#underReportPay').prop('checked', false);
            }else{
                $('#divContractCheckPay,#visibleDivContragentList,#visibleDivContract').addClass('d-none');
            }
        });
//открываем модальное окно добавления контрагента
        $('body').on('click','.addContragent', function () {
            $('#typeAdd').val($(this).data('type'));
            $('#modalAddContragent').modal('show');
        });
//открываем модальное окно добавления проекта
        $('body').on('click','.addProject', function () {
            var idContragent = $(this).data('idcontra');
            $('#idContragent').val(idContragent);
            ajaxContragent(idContragent);
            $('#modalAddProject').modal('show');
        });
        function ajaxContragent(idContragent) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testOrgProject&idContragent="+idContragent,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if(result.resultTestOrg===true){
                        $('.divExpenseProject,.divSelectedProject,.divProfitProject').addClass('hiddenVisible');
                    }else{
                        $('.divExpenseProject,.divSelectedProject,.divProfitProject').removeClass('hiddenVisible');
                    }
                }
            });
        }
        let deletePathRepPay = '<?php if(empty($onePayInvoice[0]['paths_pay'])){echo 'false';}else{echo 'true';}?>';
        if(deletePathRepPay!=='false'){
            $('#divDownloadFile').addClass('d-none');
        }
        $('#deleteFileRepPay, #newFileRepPay').on('click', function () {
            $('#divPDFRepPay, #divOtherRepPay, #newFileRepPay, #deleteFileRepPay').addClass('d-none');
            $('#divDownloadFile').removeClass('d-none');
        });
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
                                        <span>'+val.idContragent+'</span>\
                                    </td>\
                                    <td style="text-align: center;">\
                                        <span>'+val.moneyProject+'</span>\
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
                                swal({
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
            var profitInProject = parseInt('<?php echo $profitInProject;?>');
            var newNameProject = $('#newNameProject').val();
            var newNoticeProject = $('#newNoticeProject').val();
            var idContragent = $('#idContragent').val();
            var idInitProject = $('#idInitProject').val();

            var moneyProject = $('#moneyProject').val();
            var expenseProject = $('#expenseProject').val();
            var selectedProject = $('#selectedProject').val();
            var profitProject = $('#profitProject').val();

            var notPercent = true;
            var notValidProfit = true;
            switch (selectedProject){
                case '2':
                    if(profitProject>100 || profitProject<0){notPercent = false;}
                    if(profitProject<profitInProject){notValidProfit = false;}
                    break;
                case '3':
                    var minSumm = (moneyProject/100)*profitInProject; //минимальная сумма прибыли проекта
                    if(profitProject<minSumm){notValidProfit = false;}
                    profitProject = (profitProject/moneyProject)*100;
                    profitProject = profitProject.toFixed(2);
                    break;
            }

            if(newNameProject.length<1 || moneyProject.length<1) {
                $('#validateDivProject').removeClass('hiddenVisible');
                $('#validateMoney,#validateProfit,#validatePercent').addClass('hiddenVisible');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(moneyProject)) {
                $('#validateDivProject,#validateProfit,#validatePercent').addClass('hiddenVisible');
                $('#validateMoney').removeClass('hiddenVisible');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(profitProject)) {
                $('#validateDivProject,#validateMoney,#validatePercent').addClass('hiddenVisible');
                $('#validateProfit').removeClass('hiddenVisible');
            }else if(notPercent===false){
                $('#validateDivProject,#validateMoney,#validateProfit').addClass('hiddenVisible');
                $('#validatePercent').removeClass('hiddenVisible');
            }else{
                if(selectedProject==='3'){
                    selectedProject='2';
                }
                if(notValidProfit===false){
                    $('#modalAddProject').modal('hide');
                    Swal.fire({
                        title: "Внимание! Значение рентабельности по умолчанию "+profitInProject+"%, установленное вами значение может быть убыточным.",
                        type: "warning",
                        allowOutsideClick: true,
                        showCancelButton: true,
                        cancelButtonText: "Отмена",
                        confirmButtonText: "Принять",
                        closeOnConfirm: true
                    }).then((isConfirm)=>{
                        if (isConfirm.value) {
                            console.log('кранты');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "mainAjax=insertProject&newNameProject="+newNameProject+"&newNoticeProject="+newNoticeProject+"&idContragent="+idContragent+"&idInitProject="+idInitProject+"&moneyProject="+moneyProject+"&expenseProject="+expenseProject+"&selectedProject="+selectedProject+"&profitProject="+profitProject,
                                success: function (data) {
                                    var result = $.parseJSON(data);
                                    //console.log(result);
                                    $('#numberContract').val(newNameProject);
                                    $('#idProjectHidden').val(result.idProject);
                                    $('#numberContract').valid();
                                    $('#numberContractPay').valid();
                                }
                            });
                        }else{
                            $('#modalAddProject').modal('show');
                        }
                    })
                }else{
                    $('#modalAddProject').modal('hide');
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=insertProject&newNameProject="+newNameProject+"&newNoticeProject="+newNoticeProject+"&idContragent="+idContragent+"&idInitProject="+idInitProject+"&moneyProject="+moneyProject+"&expenseProject="+expenseProject+"&selectedProject="+selectedProject+"&profitProject="+profitProject,
                        success: function (data) {
                            var result = $.parseJSON(data);
                            //console.log(result);
                            $('#numberContract').val(newNameProject);
                            $('#idProjectHidden').val(result.idProject);
                            $('#numberContract').valid();
                            $('#numberContractPay').valid();
                        }
                    });
                }
            }
        });
        $('body').on('click','.enterProject', function () {
            $('#numberContractPay').val($(this).data('nameproject'));
            $('#idProjectHiddenPay').val($(this).data('idproject'));
            $('#numberContractPay').valid();
        });

//галочка подотчет в служебке
        $('#underReportPay').on('click',function () {
            if(this.checked){
                $('#divContractCheckPay,#visibleDivContragentList,#visibleDivContract').addClass('hiddenVisible');
                $('#contractCheckPay').prop('checked', false);
            }else{
                //$('#visibleDivContragentList,#divContractCheckPay,#visibleDivContract').addClass('hiddenVisible');
            }
        });

        var delay = (function(){
            var timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();

//поле ввода проекта
        $('.searchProject').on('keyup',function () {
            var keyProject = $(this).val();

            delay(function(){
                dataProject(keyProject);
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
                    //console.log(result);
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
                    //console.log(result.dataProject);
                    $.each(result.dataProject,function(col,val){
                        var output3 = '\
                        <tr>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.dateCreate+'</a>\
                            </td>\
                            <td style="text-align: center;">\
                                <a href="javascript:;" class="primary-link enterProject" data-idproject="'+val.id+'" data-nameproject="'+val.nameProject+'">'+val.nameProject+'</a>\
                            </td>\
                            <td style="text-align: center;"><span>'+val.idContragent+'</span></td>\
                        </tr>';
                        $('.selectProject').find('tbody').append(output3);
                    });
                }
            });
        }

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

        function datetimeStamp() {
            let timezone = '<?php echo $defaultDownload['timezone'];?>';
            return moment().utcOffset(timezone).format('YYYY-MM-DD HH:mm:ss');
        }

        $('.selectContragent').on('click','.enterContragent',function () {
            var textContragent = $(this).data('namecon');
            var innContragent = $(this).data('inn');
            $('#contragent').val(textContragent);
            $('#innContragent').val(innContragent);
        });

        $('.selectNumber').on('click','.enterContract',function () {
            var textContract = $(this).data('contract');
            $('.numberContract').val(textContract);
        });
        $('#submitPay').on('click',function () {
            if ($('#formAddInvoicePay').valid()) {
                var dateEdit = datetimeStamp();
                var payID = '<?php echo $onePayInvoice[0]['id'];?>';
                var contractCheckPay = $('#contractCheckPay').prop("checked");
                var underReportPay = $('#underReportPay').prop("checked");
                var idProjectHiddenPay = '';
                if(underReportPay===false && contractCheckPay===true){
                    idProjectHiddenPay = $('#idProjectHiddenPay').val();
                }

                var formData = new FormData();
                $.each($('#imgInvoicePay')[0].files, function(key, value) {
                    formData.append('file[]', value);
                });
                formData.append('mainAjax','editPay');
                formData.append('payID',payID);
                formData.append('oldFile',$('#oldFile').val());
                formData.append('dateEdit',dateEdit);
                formData.append('idProjectHiddenPay',idProjectHiddenPay);
                formData.append('contractCheckPay',contractCheckPay);
                formData.append('underReportPay',underReportPay);
                formData.append('numberContractPay',$('#numberContractPay').val());
                formData.append('summForPayment',$('#summForPayment').val());
                formData.append('noticeForPay',$('#noticeForPay').val());

                Swal.fire({
                    title: "Идет отправка!",
                    type: "success",
                    showConfirmButton: false
                });
                $.ajax({
                    url: urlOne, type: "POST", dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        console.log(data);
                        if(data.error===false){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Не удается записать файл в базу!",
                                type: "warning"
                            });
                        }else if(data.error === 'noedit') {
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
                                showConfirmButton: false,
                                timer: 10000
                            });
                            window.location = ('/mngr/document');
                        }
                    }
                });
            }
        });
    });
</script>
