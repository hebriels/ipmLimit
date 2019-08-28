<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Список контрагентов </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                    <h3 class="kt-portlet__head-title"> Все контрагенты <span id="summHeader"></span></h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addContragent">
                            <i class="flaticon2-add-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php $tableId = 'tableContragents'; ?>
            <div class="kt-portlet__body" data-tablename="<?php echo $tableId;?>">
                <div class="table-responsive">
                    <table id="<?php echo $tableId;?>" data-toggle="table"
                           data-sort-name="<?php echo $tableId;?>-date" data-sort-order="desc"
                           class="table table-bordered table-hover table-striped table-sm"
                           data-show-columns="true" data-search="true"
                           data-pagination="true" data-page-size="25" data-page-list="[5, 25, 50, 100, 500]"
                           data-show-export="true" data-export-types="['excel']"
                           data-filter-control="true" data-filter-show-clear="true" data-hide-unused-select-options="true"
                           data-unique-id="<?php echo $tableId;?>-id"
                           data-cookie="true" data-cookie-id-table="<?php echo $tableId;?>">
                        <thead>
                        <tr>
                            <th data-visible="false" data-field="<?php echo $tableId;?>-id"></th>
                            <th data-field="<?php echo $tableId;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                            <th data-field="<?php echo $tableId;?>-contragent" data-filter-control="input" data-align="center" data-sortable="true">Контрагент</th>
                            <th data-field="<?php echo $tableId;?>-inn" data-align="center" data-sortable="true">ИНН</th>
                            <th data-field="<?php echo $tableId;?>-kpp" data-align="center" data-sortable="true">КПП</th>
                            <th data-field="<?php echo $tableId;?>-notice" data-align="center">Примечания</th>
                            <th data-field="<?php echo $tableId;?>-actions" data-align="center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($allContragents as $myData): ?>
                            <tr>
                                <td><?php echo $myData['id'];?></td>
                                <td><?php echo $myData['dateCreate'];?></td>
                                <td><?php echo $myData['name_contragent']; ?></td>
                                <td><?php echo $myData['inn_contragent']; ?></td>
                                <td><?php echo $myData['kpp_contragent']; ?></td>
                                <td><?php echo $myData['notice_contragent']; ?></td>
                                <td>
                                    <div class="btn-group btn-group">
                                    <?php
                                        echo '<button type="button"
                                        class="btn btn-sm btn-outline-success btn-icon btn-editContragent"
                                        id="'.$myData['id'].'" data-namecont="'.$myData['name_contragent'].'"
                                        data-inncont="'.$myData['inn_contragent'].'" data-kppcont="'.$myData['kpp_contragent'].'"
                                        data-userid="'.$_SESSION['mngr']['id'].'" data-noticecont="'.$myData['notice_contragent'].'" 
                                        data-idtable="'.$tableId.'" data-idcont="'.$myData['id'].'" data-mineorg="'.$myData['mineOrg'].'"
                                        data-toggle="popover" data-trigger="hover"
                                        data-placement="auto" title="редактировать" data-content="Нажмите для редактирования контрагента">
                                        <i class="fa fa-edit"></i></button>';
                                    ?>
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

    <div class="modal fade" id="modalAddContragent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавление контрагента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="newNameContragent" class="col-form-label">Наименование:</label>
                                    <input type="text" class="form-control" id="newNameContragent">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="newInnContragent" class="col-form-label">ИНН:</label>
                                    <input type="text" class="form-control" id="newInnContragent">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="newKppContragent" class="col-form-label">КПП:</label>
                                    <input type="text" class="form-control" id="newKppContragent">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="newNoticeContragent" class="col-form-label">Примечание:</label>
                                    <input type="text" class="form-control" id="newNoticeContragent">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Отметить в случае если это ваша организация</label>
                                    <div class="kt-checkbox-list">
                                        <label class="kt-checkbox" for="mineOrg"> Своя организация
                                            <input type="checkbox" value="1" name="mineOrg" id="mineOrg">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="hiddenVisible" id="validateDiv">
                                <p style="color: red;text-align: center;">Проверьте ИНН или наименование</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idInitiator" id="idInitiator" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddContragent">Применить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditContragent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление контрагента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name_contragent" class="col-form-label">Наименование:</label>
                                    <input type="text" class="form-control" id="name_contragent">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inn_contragent" class="col-form-label">ИНН:</label>
                                    <input type="text" class="form-control" id="inn_contragent">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kpp_contragent" class="col-form-label">КПП:</label>
                                    <input type="text" class="form-control" id="kpp_contragent">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notice_contragent" class="col-form-label">Примечание:</label>
                                    <input type="text" class="form-control" id="notice_contragent">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Отметить в случае если это ваша организация</label>
                                    <div class="kt-checkbox-list">
                                        <label class="kt-checkbox" for="mine_org"> Своя организация
                                            <input type="checkbox" value="1" name="mine_org" id="mine_org">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="hiddenVisible" id="validateDiv">
                                <p style="color: red;text-align: center;">Проверьте ИНН или наименование</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idCont" id="idCont">
                    <input type="hidden" name="idUserEdit" id="idUserEdit" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveEditContragent">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var tableIdAll = '<?php echo $tableId;?>';
        var urlOne = '/ajax/ajaxpost';

        function datetimeStamp() {
            var timezone = '<?php echo $defaultDownload['timezone'];?>';
            return moment().utcOffset(timezone).format('YYYY-MM-DD HH:mm:ss');
        }

//открываем модальное окно добавления контрагента
        $('body').on('click','.addContragent', function () {
            $('#modalAddContragent').modal('show');
        });
//сохраняем контрагента
        $('#saveAddContragent').on('click',function () {
            var newInnContragent = $('#newInnContragent').val();
            var newNameContragent = $('#newNameContragent').val();
            var dateTime = datetimeStamp();
            var newKppContragent = $('#newKppContragent').val();
            var newNoticeContragent = $('#newNoticeContragent').val();
            var mineOrg = $('#mineOrg').prop('checked');
            var idInitiator = $('#idInitiator').val();
            if(newInnContragent==='' || newNameContragent==='') {
                $('#validateDiv').removeClass('hiddenVisible');
            }else{
                $('#modalAddContragent').modal('hide');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=insertContragent&newInnContragent=" + newInnContragent + "&newNameContragent=" + newNameContragent + "&newKppContragent=" + newKppContragent + "&newNoticeContragent=" + newNoticeContragent + "&idInitiator=" + idInitiator+"&mineOrg="+mineOrg+"&dateTime="+dateTime,
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if (result.idContragent === 'false') {
                            Swal.fire({
                                title: "Данный ИНН существует",
                                type: "info",
                                allowOutsideClick: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Понятно"
                            });
                        }else{
                            window.location = ('/mngr/contragents');
                        }
                    }
                });
            }
        });
//модальное окно добавления контрагента
        $('body').on('click','.btn-editContragent', function () {
            $('#inn_contragent').val($(this).data('inncont'));
            $('#name_contragent').val($(this).data('namecont'));
            $('#kpp_contragent').val($(this).data('kppcont'));
            $('#notice_contragent').val($(this).data('noticecont'));
            $('#mine_org').prop('checked', $(this).data('mineorg')); //ставим или нет галочку
            $('#idCont').val($(this).data('idcont'));
            $('#modalEditContragent').modal('show');
        });
        $('#saveEditContragent').on('click',function () {
            var newInnContragent = $('#inn_contragent').val();
            var newNameContragent = $('#name_contragent').val();
            var dateTime = datetimeStamp();
            var newKppContragent = $('#kpp_contragent').val();
            var newNoticeContragent = $('#notice_contragent').val();
            var mineOrg = $('#mine_org').prop('checked');
            var idCont = $('#idCont').val();
            var idUserEdit = $('#idUserEdit').val();
            if(newInnContragent==='' || newNameContragent==='') {
                $('#validateDiv').removeClass('hiddenVisible');
            }else{
                $('#modalEditContragent').modal('hide');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=updateContragent&newInnContragent="+newInnContragent+"&newNameContragent="+newNameContragent + "&newKppContragent=" + newKppContragent + "&newNoticeContragent=" + newNoticeContragent +"&mineOrg="+mineOrg+"&idUserEdit=" + idUserEdit + "&idCont=" + idCont+"&dateTime="+dateTime,
                    success: function (data) {
                        window.location = ('/mngr/contragents');
                    }
                });
            }
        });

        $('input[data-field="'+tableIdAll+'-id"]').css('display','none'); //убрать этот столбик из сетки таблицы

        $('table').on('all.bs.table', function () { //popover при фильтрации таблицы
            $('[data-toggle="popover"]').popover();
        });


        $('body').on('click', '.btn-success', function(){
            var invoiceId = $(this).data('invoiceid');
            var initiatorRole = $(this).data('initiatorrole');
            var tableId = $(this).data('idtable');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var dataImage = $('tr[data-uniqueid="'+invoiceId+'"]').find('a').data('image'); //получаем имя файла счета

            var statusInvoiceSpan = '<span class="label label-sm label-info" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="согласован руководителем"><i class="glyphicon glyphicon-time"></i></span>';
            var numberStatus = '3';
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

            var Data = new Date();
            var Day = Data.getDate(); var Month = Data.getMonth(); var Year = Data.getFullYear();
            var Hour = Data.getHours(); var Minutes = Data.getMinutes();
            switch (Month){
                case 0: fMonth="01"; break;
                case 1: fMonth="02"; break;
                case 2: fMonth="03"; break;
                case 3: fMonth="04"; break;
                case 4: fMonth="05"; break;
                case 5: fMonth="06"; break;
                case 6: fMonth="07"; break;
                case 7: fMonth="08"; break;
                case 8: fMonth="09"; break;
                case 9: fMonth="10"; break;
                case 10: fMonth="11"; break;
                case 11: fMonth="12"; break;
            }
            if(Day<10){Day='0'+Day;}
            if(Hour<10){Hour='0'+Hour;}
            if(Minutes<10){Minutes='0'+Minutes;}
            var dateToday = Day+'.'+fMonth+'.'+Year+' '+Hour+':'+Minutes;
            Swal.fire({
                title: "Подписать?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
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
            })
        });

//переход в аналитику
        $('.linkContract').on('click',function () {
            var numberContract = $(this).data('numcont');
            window.location = ('/mngr/analitics/'+numberContract);
        });
    });
</script>