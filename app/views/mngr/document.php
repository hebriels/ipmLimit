<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Документы </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <ul class="nav nav-tabs" style="margin-bottom: 0;">
                    <li class="nav-item" id="liNav-1">
                        <a data-toggle="tab" href="#table1" id="linkNav-1" class="nav-link active">Счета
                            <span class="badge badge-default blinkInform"></span>
                        </a>
                    </li>
                    <li class="nav-item" id="liNav-3">
                        <a data-toggle="tab" href="#table3" id="linkNav-3" class="nav-link">Служебки
                            <span class="badge badge-default blinkInform"></span>
                        </a>
                    </li>
                    <li class="nav-item" id="liNav-4">
                        <a data-toggle="tab" href="#table4" id="linkNav-4" class="nav-link">Документы
                            <span class="badge badge-default blinkInform"></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
        <!-- Счета -->
                    <div class="tab-pane active" id="table1">
                        <?php $tableDocumentInvoice = 'tableInvoice'; ?>
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                                    <h3 class="kt-portlet__head-title"> Все счета <span id="summHeader-tableInvoice"></span></h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-tablename="<?php echo $tableDocumentInvoice;?>">
                                <div class="table-responsive">
                                    <table class="table table-scrolable- responsive table-bordered" id="dataAjax1">
                                        <thead>
                                            <tr>
                                                <th width="10%"> Статус </th>
                                                <th width="15%"> Дата </th>
                                                <th width="15%"> Проект </th>
                                                <th width="15%"> Отдел </th>
                                                <th width="15%"> Инициатор </th>
                                                <th width="15%"> Организация </th>
                                                <th width="15%"> Поставщик </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <select id="orderStatus" class="form-control form-filter input-sm">
                                                    <option value="all">Все</option>
                                                    <option value="success">Оплачено</option>
                                                    <option value="inwork">В работе</option>
                                                    <option value="danger">Отказ</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group" id="defaultrange_modal">
                                                    <input type="text" class="form-control" readonly id="dateStartEnd">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select id="nameProject" class="form-control kt-select2">
                                                    <option></option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="nameDepartment" class="form-control kt-select2">
                                                    <option></option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="nameInitiator" class="form-control kt-select2">
                                                    <option></option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="nameOrganization" class="form-control kt-select2">
                                                    <option></option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="nameContragent" class="form-control kt-select2">
                                                    <option></option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="<?php echo $tableDocumentInvoice.'Toolbar';?>" class="btn-group">
                                    <div class="btn-group btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-primary btnFilter" data-type="invoice"><i class="fa fa-search"></i> Применить </button>
                                        <button type="button" class="btn btn-warning cancelBtn" data-type="invoice"><i class="fa fa-times"></i> Сбросить </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="<?php echo $tableDocumentInvoice;?>" data-toolbar="#<?php echo $tableDocumentInvoice;?>Toolbar"
                                           data-sort-name="<?php echo $tableDocumentInvoice;?>-date" data-sort-order="desc"
                                           data-show-columns="true" data-search="true"
                                           data-pagination="true" data-page-size="25" data-page-list="[5, 25, 50, 100, 500]"
                                           data-show-export="true" data-export-types="['xlsx','excel']"
                                           data-hide-unused-select-options="true"
                                           data-striped="true" data-unique-id="<?php echo $tableDocumentInvoice;?>-id"
                                           data-cookie="true" data-cookie-id-table="<?php echo $tableDocumentInvoice;?>">
                                        <thead>
                                        <tr>
                                            <th data-visible="false" data-field="<?php echo $tableDocumentInvoice;?>-id" data-switchable="false"></th>
                                            <th data-visible="false" data-field="<?php echo $tableDocumentInvoice;?>-statusNumber" data-switchable="false"></th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-statusInvoice" data-align="center">Статус</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-contractNumber" data-filter-control="input" data-align="center" data-sortable="true">Проект</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-invoiceNumber" data-align="center" data-visible="false">Счет №</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-department" data-filter-control="select" data-align="center" data-sortable="true" data-visible="false">Отдел</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-initiator" data-filter-control="select" data-align="center" data-sortable="true">Инициатор</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-organization" data-filter-control="select" data-align="center" data-sortable="true" data-visible="false">Организация</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-kontragent" data-filter-control="select" data-align="center" data-sortable="true">Поставщик</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-summ" data-align="center" data-sortable="true" data-sorter="priceSorter">Сумма</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-actions" data-align="center">Действия</th>
                                            <th data-field="<?php echo $tableDocumentInvoice;?>-notice" data-align="center">Примечания</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- Служебки -->
                    <div class="tab-pane" id="table3">
                        <?php $tableDocumentPay = 'tablePay'; ?>
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                                    <h3 class="kt-portlet__head-title"> Все служебки <span id="summHeader-tablePay"></span></h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-tablename="tablePay">
                                <div class="table-responsive">
                                    <table class="table table-scrolable- responsive table-bordered" id="dataAjax2">
                                        <thead>
                                            <tr>
                                                <th width="10%"> Статус </th>
                                                <th width="18%"> Дата </th>
                                                <th width="15%"> Тип служебки </th>
                                                <th width="15%"> Проект </th>
                                                <th width="15%"> Отдел </th>
                                                <th width="15%"> Инициатор </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select id="orderStatusPay" class="form-control form-filter input-sm">
                                                        <option value="all">Все</option>
                                                        <option value="success">Оплачено</option>
                                                        <option value="inwork">В работе</option>
                                                        <option value="danger">Отказ</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group" id="defaultrange_modalPay">
                                                        <input type="text" class="form-control" readonly id="dateStartEndPay">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select id="typePay" class="form-control form-filter input-sm">
                                                        <option value="all">Все</option>
                                                        <option value="cash">Наличка</option>
                                                        <option value="report">Подотчет</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="nameProjectPay" style="width:100%;" class="form-control select2">
                                                        <option></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="nameDepartmentPay" style="width:100%;" class="form-control select2">
                                                        <option></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="nameInitiatorPay" style="width:100%;" class="form-control select2">
                                                        <option></option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="<?php echo $tableDocumentPay.'Toolbar';?>" class="btn-group">
                                    <div class="btn-group btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-primary btnFilter" data-type="pay"><i class="fa fa-search"></i> Применить </button>
                                        <button type="button" class="btn btn-warning cancelBtn" data-type="pay"><i class="fa fa-times"></i> Сбросить </button>
                                    </div>
                                </div>
                                <table id="<?php echo $tableDocumentPay;?>" data-toggle="table" data-toolbar="<?php echo '#'.$tableDocumentPay.'Toolbar';?>"
                                       data-sort-name="<?php echo $tableDocumentPay;?>-date" data-sort-order="desc"
                                       data-mobile-responsive="true" data-width="100%"
                                       data-show-columns="true" data-search="true"
                                       data-pagination="true" data-page-size="25" data-page-list="[5, 25, 50, 100, 500]"
                                       data-show-export="true" data-export-types="['xlsx','excel']"
                                       data-hide-unused-select-options="true"
                                       data-striped="true" data-unique-id="<?php echo $tableDocumentPay.'-id';?>"
                                       data-cookie="true" data-cookie-id-table="<?php echo $tableDocumentPay;?>">
                                    <thead>
                                    <tr>
                                        <th data-visible="false" data-field="<?php echo $tableDocumentPay.'-id';?>" data-switchable="false"></th>
                                        <th data-visible="false" data-field="<?php echo $tableDocumentPay;?>-statusNumber" data-switchable="false"></th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-statusInvoice" data-align="center">Статус</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-report" data-filter-control="select" data-align="center" data-sortable="true">Тип служебки</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-reportPay" data-align="center">Выдано</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-contractNumber" data-filter-control="input" data-align="center" data-sortable="true">Проект</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-department" data-filter-control="select" data-align="center" data-sortable="true" data-visible="false">Отдел</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-initiator" data-filter-control="select" data-align="center" data-sortable="true">Инициатор</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-summ" data-align="center" data-sortable="true" data-sorter="priceSorter">Сумма</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-actions" data-align="center">Действия</th>
                                        <th data-field="<?php echo $tableDocumentPay;?>-notice" data-align="center" data-visible="false">Примечания</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
        <!-- Документы -->
                    <div class="tab-pane" id="table4">
                        <?php $tableDocumentDoc = 'tableDoc'; ?>
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                                    <h3 class="kt-portlet__head-title"> Все документы </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-tablename="tableDoc">
                                <div class="table-responsive">
                                    <table class="table table-scrolable- responsive table-bordered" id="dataAjax3">
                                        <thead>
                                            <tr>
                                                <th width="10%"> Статус </th>
                                                <th width="18%"> Дата </th>
                                                <th width="15%"> Тематика </th>
                                                <th width="15%"> От кого </th>
                                                <th width="15%"> Отдел </th>
                                                <th width="15%"> Ответчик </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select id="statusDoc" class="form-control form-filter input-sm">
                                                        <option value="all">Все</option>
                                                        <option value="success">Согласован</option>
                                                        <option value="inwork">В работе</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group" id="defaultrange_modalDoc">
                                                        <input type="text" class="form-control" readonly id="dateStartEndDoc">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select id="themeDoc" style="width:100%;" class="form-control select2">
                                                        <option></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="fromToDoc" style="width:100%;" class="form-control select2">
                                                        <option></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="nameDepartmentDoc" style="width:100%;" class="form-control select2">
                                                        <option></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="nameChargeDoc" style="width:100%;" class="form-control select2">
                                                        <option></option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="<?php echo $tableDocumentDoc.'Toolbar';?>" class="btn-group">
                                    <div class="btn-group btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-primary btnFilter" data-type="doc"><i class="fa fa-search"></i> Применить </button>
                                        <button type="button" class="btn btn-warning cancelBtn" data-type="doc"><i class="fa fa-times"></i> Сбросить </button>
                                    </div>
                                </div>
                                <table id="<?php echo $tableDocumentDoc;?>" data-toggle="table" data-toolbar="<?php echo '#'.$tableDocumentDoc.'Toolbar';?>"
                                       data-sort-name="<?php echo $tableDocumentDoc;?>-date" data-sort-order="desc"
                                       data-mobile-responsive="true" data-width="100%"
                                       data-show-columns="true" data-search="true"
                                       data-pagination="true" data-page-size="25" data-page-list="[5, 25, 50, 100, 500]"
                                       data-show-export="true" data-export-types="['xlsx','excel']"
                                       data-hide-unused-select-options="true"
                                       data-striped="true" data-unique-id="<?php echo $tableDocumentDoc.'-id';?>"
                                       data-cookie="true" data-cookie-id-table="<?php echo $tableDocumentDoc;?>">
                                    <thead>
                                    <tr>
                                        <th data-visible="false" data-field="<?php echo $tableDocumentDoc.'-id';?>" data-switchable="false"></th>
                                        <th data-visible="false" data-field="<?php echo $tableDocumentDoc;?>-statusNumber" data-switchable="false"></th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-status" data-align="center">Статус</th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-themeDoc" data-align="center">Тематика</th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-fromTo" data-filter-control="input" data-align="center" data-sortable="true">От кого</th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-department" data-filter-control="select" data-align="center" data-sortable="true" data-visible="false">Отдел</th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-chargeUser" data-filter-control="select" data-align="center" data-sortable="true">Ответчик</th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-actions" data-align="center">Действия</th>
                                        <th data-field="<?php echo $tableDocumentDoc;?>-notice" data-align="center" data-visible="false">Примечания</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
        $allProjects = json_encode($allProjects);
        $allDepartments = json_encode($allDepartments);
        $allInitiators = json_encode($usersFromSelectInvoice);
        $allInitiatorsPay = json_encode($usersFromSelectPay);
        $themeDoc = json_encode($themeDoc);
        $allOrganizations = json_encode($allOrganization);
        $allContragents = json_encode($allContragents);
    ?>
<?php
    $useridstat = '';
    if(isset($_GET['useridstat'])){
        $useridstat = $_GET['useridstat'];
    }
?>
    <input type="hidden" value="<?php echo $useridstat;?>" id="getUserID">
<?php if(isset($_GET['navbar'])):?>
    <input type="hidden" value="<?php echo $_GET['navbar'];?>" id="getNavbar">
<script>
    $(document).ready(function() {
        let getNavbar = $('#getNavbar').val();
        $('.nav-tabs a[href="#'+getNavbar+'"]').tab('show') // Select tab by name
    });
</script>
<?php endif;?>
<script>
    $(document).ready(function() {
        let urlOne = '/ajax/ajaxpost';
        let tableDocumentInvoice = '<?php echo $tableDocumentInvoice;?>';
        let tableDocumentPay = '<?php echo $tableDocumentPay;?>';
        let tableDocumentDoc = '<?php echo $tableDocumentDoc;?>';

        var allProjects = <?php echo $allProjects;?>;
        var allDepartments = <?php echo $allDepartments;?>;
        var allInitiators = <?php echo $allInitiators;?>;
        var allInitiatorsPay = <?php echo $allInitiatorsPay;?>;
        let themeDoc = <?php echo $themeDoc;?>;
        var allOrganizations = <?php echo $allOrganizations;?>;
        var allContragents = <?php echo $allContragents;?>;

        $('#defaultrange_modal').daterangepicker({
                autoApply: true,
                locale: {
                    format: 'DD.MM.YYYY',
                    "daysOfWeek": ["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],
                    "monthNames": ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
                    "firstDay": 1
                }
                //opens: (App.isRTL() ? 'left' : 'right')
            },
            function (start, end) {
                $('#defaultrange_modal input').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
            }
        );
        $('#defaultrange_modalPay').daterangepicker({
                autoApply: true,
                locale: {
                    format: 'DD.MM.YYYY',
                    "daysOfWeek": [
                        "Вс",
                        "Пн",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    "monthNames": [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                    "firstDay": 1
                }
                //opens: (App.isRTL() ? 'left' : 'right')
            },
            function (start, end) {
                $('#defaultrange_modalPay input').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
            }
        );
        $('#defaultrange_modalDoc').daterangepicker({
                autoApply: true,
                locale: {
                    format: 'DD.MM.YYYY',
                    "daysOfWeek": [
                        "Вс",
                        "Пн",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    "monthNames": [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                    "firstDay": 1
                }
                //opens: (App.isRTL() ? 'left' : 'right')
            },
            function (start, end) {
                $('#defaultrange_modalDoc input').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
            }
        );
//счета
        $('#nameProject').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameDepartment').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameInitiator').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameOrganization').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameContragent').select2({
            allowClear: true,
            placeholder: "Искать"
        });
//служебки
        $('#nameProjectPay').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameDepartmentPay').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameInitiatorPay').select2({
            allowClear: true,
            placeholder: "Искать"
        });
//документы
        $('#themeDoc').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#fromToDoc').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameDepartmentDoc').select2({
            allowClear: true,
            placeholder: "Искать"
        });
        $('#nameChargeDoc').select2({
            allowClear: true,
            placeholder: "Искать"
        });

        $.each(allProjects,function(col,val) {
            var selectProjects = '\
                    <option value="'+val.id+'">'+val.nameProject+'</option>';
            $('#nameProject,#nameProjectPay').append(selectProjects);
        });
        $.each(allDepartments,function(col,val) {
            var selectDepartments = '\
                    <option value="'+val.id+'">'+val.nameDepartment+'</option>';
            $('#nameDepartment,#nameDepartmentPay,#nameDepartmentDoc').append(selectDepartments);
        });
        $.each(allInitiators,function(col,val) {
            var selectInitiators = '\
                    <option value="'+val.id+'">'+val.userName+'</option>';
            $('#nameInitiator,#nameChargeDoc').append(selectInitiators);
        });
        $.each(allInitiatorsPay,function(col,val) {
            var selectInitiatorsPay = '\
                    <option value="'+val.id+'">'+val.userName+'</option>';
            $('#nameInitiatorPay').append(selectInitiatorsPay);
        });
        $.each(allOrganizations,function(col,val) {
            var selectOrganizations = '\
                    <option value="'+val.id+'">'+val.nameOrganization+'</option>';
            $('#nameOrganization').append(selectOrganizations);
        });
        $.each(allContragents,function(col,val) {
            var selectContragents = '\
                    <option value="'+val.id+'">'+val.name_contragent+'</option>';
            $('#nameContragent,#fromToDoc').append(selectContragents);
        });
        $.each(themeDoc,function(col,val) {
            var selectThemeDoc = '\
                    <option value="'+val.id+'">'+val.themeDoc+'</option>';
            $('#themeDoc').append(selectThemeDoc);
        });

        $('.cancelBtn').on('click',function () {
            let typeTable = $(this).data('type');

            if(typeTable==='invoice'){
                $('#orderStatus').val('all');
                $('#dateFrom,#dateTo').val('');
                $('#nameProject,#nameDepartment,#nameInitiator,#nameOrganization,#nameContragent').val(null).trigger('change');
            }else if(typeTable==='pay'){
                $('#orderStatusPay,#typePay').val('all');
                $('#dateFromPay,#dateToPay').val('');
                $('#nameProjectPay,#nameDepartmentPay,#nameInitiatorPay').val(null).trigger('change');
            }else{
                $('#statusDoc').val('all');
                $('#dateFromDoc,#dateToDoc').val('');
                $('#themeDoc,#fromToDoc,#nameDepartmentDoc,#nameChargeDoc').val(null).trigger('change');
            }

        });
//функция при загрузке страницы для таблицы счетов
        tableDefault('invoice','inwork');
        tableDefault('pay','inwork');
        tableDefault('doc','inwork');
        function tableDefault(type,status) {
            if(type==='invoice'){
                let getUserID = $('#getUserID').val();
                $('#nameInitiator').val(getUserID).trigger('change');
                console.log($('#nameInitiator').val());
                let idInitiator = $('#nameInitiator').val();
                var dateFrom = '';//$('#dateFrom').val();
                var dateTo = '';//$('#dateTo').val();
                var idProject = $('#nameProject').val();
                var idDepartment = $('#nameDepartment').val();
                var idOrganization = $('#nameOrganization').val();
                var idContragent = $('#nameContragent').val();

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=dataTableAjax&status="+status+"&dateFrom="+dateFrom+"&dateTo="+dateTo+"&idProject="+idProject+"&idDepartment="+idDepartment+"&idInitiator="+idInitiator+"&idOrganization="+idOrganization+"&idContragent="+idContragent,
                    success: function (data){
                        //console.log('invoice');
                        var result = $.parseJSON(data);
                        var arrData = $.parseJSON(result.arrData);

                        var sumArrTD = result.summMoney.toFixed(2);
                        sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
                        var appArrTD = ' на сумму: <b class="summToTotal">'+sumArrTD+'&nbspр.</b>';
                        $('#summHeader-tableInvoice').html(appArrTD);

                        $('#'+tableDocumentInvoice).bootstrapTable("destroy");
                        dataTableAjax(arrData,'invoice');
                    }
                });
            }else if(type==='pay'){
                var dateFromPay = '';//$('#dateFromPay').val();
                var dateToPay = '';//$('#dateToPay').val();
                var typePay = $('#typePay').val();
                var idProjectPay = $('#nameProjectPay').val();
                var idDepartmentPay = $('#nameDepartmentPay').val();
                var idInitiatorPay = $('#nameInitiatorPay').val();

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=dataTableAjaxPay&status="+status+"&dateFrom="+dateFromPay+"&dateTo="+dateToPay+"&typePay="+typePay+"&idProject="+idProjectPay+"&idDepartment="+idDepartmentPay+"&idInitiator="+idInitiatorPay,
                    success: function (data){
                        //console.log('pay');
                        var result = $.parseJSON(data);
                        var arrData = $.parseJSON(result.arrData);

                        var sumArrTD = result.summMoney.toFixed(2);
                        sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
                        var appArrTD = ' на сумму: <b class="summToTotal">'+sumArrTD+'&nbspр.</b>';
                        $('#summHeader-tablePay').html(appArrTD);
                        $('#'+tableDocumentPay).bootstrapTable("destroy");
                        dataTableAjax(arrData,'pay');
                    }
                });
            }else{
                let dateFromDoc = '';
                let dateToDoc = '';
                let themeDoc = $('#themeDoc').val();
                let fromToDoc = $('#fromToDoc').val();
                let idDepartmentDoc= $('#nameDepartmentDoc').val();
                let idChargeDoc = $('#nameChargeDoc').val();

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=dataTableAjaxDoc&status="+status+"&dateFrom="+dateFromDoc+"&dateTo="+dateToDoc+"&themeDoc="+themeDoc+"&fromToDoc="+fromToDoc+"&idDepartment="+idDepartmentDoc+"&idChargeDoc="+idChargeDoc,
                    success: function (data){
                        let result = $.parseJSON(data);
                        let arrData = $.parseJSON(result.arrData);
                        $('#'+tableDocumentDoc).bootstrapTable("destroy");
                        dataTableAjax(arrData,'doc');
                    }
                });
            }

        }
//нажали фильтр
        $('.btnFilter').on('click',function () {
            let typeTable = $(this).data('type');
            if(typeTable==='invoice'){
                var dateStartEnd = $('#dateStartEnd').val();
                var dateFrom = '';
                var dateTo = '';
                if(dateStartEnd.length>0){
                    var replaced = dateStartEnd.split(/[\s\-]+/g);
                    dateFrom = replaced[0];
                    dateTo = replaced[1];
                }
                var status = $('#orderStatus').val();
                var idProject = $('#nameProject').val();
                var idDepartment = $('#nameDepartment').val();
                var idInitiator = $('#nameInitiator').val();
                var idOrganization = $('#nameOrganization').val();
                var idContragent = $('#nameContragent').val();

                /*console.log(status);
                console.log(dateFrom);
                console.log(dateTo);
                console.log(idProject);
                console.log(idInitiator);
                console.log(idOrganization);
                console.log(idContragent);*/

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=dataTableAjax&status="+status+"&dateFrom="+dateFrom+"&dateTo="+dateTo+"&idProject="+idProject+"&idDepartment="+idDepartment+"&idInitiator="+idInitiator+"&idOrganization="+idOrganization+"&idContragent="+idContragent,
                    success: function (data){
                        console.log(data);
                        var result = $.parseJSON(data);
                        var arrData = $.parseJSON(result.arrData);

                        var sumArrTD = result.summMoney.toFixed(2);
                        sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
                        var appArrTD = ' на сумму: <b class="summToTotal">'+sumArrTD+'&nbspр.</b>';
                        $('#summHeader-tableInvoice').html(appArrTD);
                        $('#'+tableDocumentInvoice).bootstrapTable("destroy");
                        dataTableAjax(arrData,'invoice');
                    }
                });
            }else if(typeTable==='pay'){
                var dateStartEndPay = $('#dateStartEndPay').val();
                var dateFromPay = '';
                var dateToPay = '';
                if(dateStartEndPay.length>0){
                    var replacedPay = dateStartEndPay.split(/[\s\-]+/g);
                    dateFromPay = replacedPay[0];
                    dateToPay = replacedPay[1];
                }
                var statusPay = $('#orderStatusPay').val();
                var typePay = $('#typePay').val();
                var idProjectPay = $('#nameProjectPay').val();
                var idDepartmentPay = $('#nameDepartmentPay').val();
                var idInitiatorPay = $('#nameInitiatorPay').val();

                /*console.log(statusPay);
                console.log(dateFromPay);
                console.log(dateToPay);
                console.log(typePay);
                console.log(idProjectPay);
                console.log(idDepartmentPay);
                console.log(idInitiatorPay);*/

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=dataTableAjaxPay&status="+statusPay+"&dateFrom="+dateFromPay+"&dateTo="+dateToPay+"&typePay="+typePay+"&idProject="+idProjectPay+"&idDepartment="+idDepartmentPay+"&idInitiator="+idInitiatorPay,
                    success: function (data){
                        //console.log(data);
                        var result = $.parseJSON(data);
                        var arrData = $.parseJSON(result.arrData);

                        var sumArrTD = result.summMoney.toFixed(2);
                        sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
                        var appArrTD = ' на сумму: <b class="summToTotal">'+sumArrTD+'&nbspр.</b>';
                        $('#summHeader-tablePay').html(appArrTD);
                        $('#'+tableDocumentPay).bootstrapTable("destroy");
                        dataTableAjax(arrData,'pay');
                    }
                });
            }else{
                let dateStartEndDoc = $('#dateStartEndDoc').val();
                let dateFromDoc = '';
                let dateToDoc = '';
                if(dateStartEndDoc.length>0){
                    let replacedDoc = dateStartEndDoc.split(/[\s\-]+/g);
                    dateFromDoc = replacedDoc[0];
                    dateToDoc = replacedDoc[1];
                }
                let statusDoc = $('#statusDoc').val();
                let themeDoc = $('#themeDoc').val();
                let fromToDoc = $('#fromToDoc').val();
                let idDepartmentDoc= $('#nameDepartmentDoc').val();
                let idChargeDoc = $('#nameChargeDoc').val();

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=dataTableAjaxDoc&status="+statusDoc+"&dateFrom="+dateFromDoc+"&dateTo="+dateToDoc+"&themeDoc="+themeDoc+"&fromToDoc="+fromToDoc+"&idDepartment="+idDepartmentDoc+"&idChargeDoc="+idChargeDoc,
                    success: function (data){
                        let result = $.parseJSON(data);
                        let arrData = $.parseJSON(result.arrData);
                        $('#'+tableDocumentDoc).bootstrapTable("destroy");
                        dataTableAjax(arrData,'doc');
                    }
                });
            }
        });

        function dataTableAjax(arrData,type) {
            if(type==='invoice'){
                $('#'+tableDocumentInvoice).bootstrapTable({
                    data: arrData
                });
            }else if(type==='pay'){
                $('#'+tableDocumentPay).bootstrapTable({
                    data: arrData
                });
            }else{
                $('#'+tableDocumentDoc).bootstrapTable({
                    data: arrData
                });
            }
        }



        $('table').on('all.bs.table', function () { //popover при фильтрации таблицы
            $('[data-toggle="popover"]').popover();
            $('.btn-circle-filter').find(':first').text('Все');
            $('#totalTable').remove();
            insertTotal(tableDocumentInvoice);
            insertTotal(tableDocumentPay);
            insertTotal(tableDocumentDoc);
        });
        //$('.btn-circle-filter').find(':first').text('Все'); //найти все селекты и поставить в первый option text ВСЕ
//поиск по инициатору с главной страницы
        //if($.cookie('invoiceUserName')!==''){
            //$('#tableInvoice').bootstrapTable('resetSearch',$.cookie('invoiceUserName'));
            //$('.search').find('.form-control').val('');
            //$.cookie('invoiceUserName', '', {path: '/'});
        //}else{
            //$.cookie('tableInvoice.bs.table.searchText', '', {path:'/'});
        //}
//очищаем куки поиска
        //$.cookie('tableInvoice.bs.table.searchText', '', {path:'/'});
//расчет итоговой цены
        insertTotal(tableDocumentInvoice);
        insertTotal(tableDocumentPay);
        function insertTotal(tabLE) {
            var getDataTable = $('#'+tabLE).bootstrapTable('getData');
            var countLength = getDataTable.length;
            var sumArrTD=0;
            for(var i = 0;i<countLength;i++){
                var parseSummInTable = String(getDataTable[i][tabLE+'-summ']).replace(/&nbsp;/g, '');
                sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
            }/*
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
            $('#summHeader-'+tabLE).html(appArrTD);*/
        }
//Куки отказы и оплаченные
        /*var visibleSuccess = ''; var visibleSuccessInvoice = '';
        var visibleRefusing = ''; var visibleRefusingInvoice = '';
        var visibleWork1 = ''; var visibleWork1Invoice = '';
        var visibleWork2 = ''; var visibleWork2Invoice = '';

        $('#checkboxRefusing-'+tableDocumentInvoice).on('click', function () { //чекбокс отказов
            if(Cookies.get('checkboxSuccessInvoice')==='on'){visibleSuccessInvoice='7';}else{visibleSuccessInvoice='';}
            if(Cookies.get('checkboxWorkInvoice')==='on'){visibleWork1Invoice='1';visibleWork2Invoice='2';}else{visibleWork1Invoice='';visibleWork2Invoice='';}

            if(this.checked){
                Cookies.set('checkboxRefusingInvoice', 'on');
                $('#'+tableDocumentInvoice).bootstrapTable('filterBy',{'tableInvoice-statusNumber' : [visibleWork1Invoice, visibleWork2Invoice, '5', visibleSuccessInvoice]});
            }else{
                Cookies.set('checkboxRefusingInvoice', 'off');
                $('#'+tableDocumentInvoice).bootstrapTable('filterBy', {'tableInvoice-statusNumber' : [visibleWork1Invoice, visibleWork2Invoice, visibleSuccessInvoice]});
            }
        });
        $('#checkboxSuccess-'+tableDocumentInvoice).on('click', function () { //чекбокс оплачено
            if(Cookies.get('checkboxRefusingInvoice')==='on'){visibleRefusingInvoice='5';}else{visibleRefusingInvoice='';}
            if(Cookies.get('checkboxWorkInvoice')==='on'){visibleWork1Invoice='1';visibleWork2Invoice='2';}else{visibleWork1Invoice='';visibleWork2Invoice='';}
            if(this.checked){
                Cookies.set('checkboxSuccessInvoice', 'on');
                $('#'+tableDocumentInvoice).bootstrapTable('filterBy',{'tableInvoice-statusNumber': [visibleWork1Invoice, visibleWork2Invoice, visibleRefusingInvoice, '7']});
            }else{
                Cookies.set('checkboxSuccessInvoice', 'off');
                $('#'+tableDocumentInvoice).bootstrapTable('filterBy', {'tableInvoice-statusNumber': [visibleWork1Invoice, visibleWork2Invoice, visibleRefusingInvoice]});
            }
        });
        $('#checkboxWork-'+tableDocumentInvoice).on('click', function () { //чекбокс в работе
            if(Cookies.get('checkboxRefusingInvoice')==='on'){visibleRefusingInvoice='5';}else{visibleRefusingInvoice='';}
            if(Cookies.get('checkboxSuccessInvoice')==='on'){visibleSuccessInvoice='7';}else{visibleSuccessInvoice='';}
            if(this.checked){
                Cookies.set('checkboxWorkInvoice', 'on');
                $('#'+tableDocumentInvoice).bootstrapTable('filterBy',{'tableInvoice-statusNumber': ['1', '2', visibleRefusingInvoice, visibleSuccessInvoice]});
            }else{
                Cookies.set('checkboxWorkInvoice', 'off');
                $('#'+tableDocumentInvoice).bootstrapTable('filterBy', {'tableInvoice-statusNumber': [visibleRefusingInvoice, visibleSuccessInvoice]});
            }
        });

        $('.checkboxRefusing').on('click', function () { //чекбокс отказов
            if(Cookies.get('checkboxSuccess')==='on'){visibleSuccess='7';}else{visibleSuccess='';}
            if(Cookies.get('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}else{visibleWork1='';visibleWork2='';}
            if(this.checked){
                Cookies.set('checkboxRefusing', 'on');
                $('#'+tableDocumentPay).bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, '5', visibleSuccess]});
            }else{
                Cookies.set('checkboxRefusing', 'off');
                $('#'+tableDocumentPay).bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleSuccess]});
            }
        });
        $('.checkboxSuccess').on('click', function () { //чекбокс оплачено
            if(Cookies.get('checkboxRefusing')==='on'){visibleRefusing='5';}else{visibleRefusing='';}
            if(Cookies.get('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}else{visibleWork1='';visibleWork2='';}
            if(this.checked){
                Cookies.set('checkboxSuccess', 'on');
                $('#'+tableDocumentPay).bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing, '7']});
            }else{
                Cookies.set('checkboxSuccess', 'off');
                $('#'+tableDocumentPay).bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing]});
            }
        });

        $('.checkboxWork').on('click', function () { //чекбокс в работе
            if(Cookies.get('checkboxRefusing')==='on'){visibleRefusing='5';}else{visibleRefusing='';}
            if(Cookies.get('checkboxSuccess')==='on'){visibleSuccess='7';}else{visibleSuccess='';}
            if(this.checked){
                Cookies.set('checkboxWork', 'on');
                $('#'+tableDocumentPay).bootstrapTable('filterBy',{'tablePay-statusNumber': ['1', '2', visibleRefusing, visibleSuccess]});
            }else{
                Cookies.set('checkboxWork', 'off');
                $('#'+tableDocumentPay).bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleRefusing, visibleSuccess]});
            }
        });
        if(Cookies.get('checkboxRefusingInvoice') == null){Cookies.set('checkboxRefusingInvoice','on');}
        if(Cookies.get('checkboxWorkInvoice') == null){Cookies.set('checkboxWorkInvoice','on');}
        if(Cookies.get('checkboxSuccessInvoice') == null){Cookies.set('checkboxSuccessInvoice','on');}

        if(Cookies.get('checkboxRefusing') == null){Cookies.set('checkboxRefusing','on');}
        if(Cookies.get('checkboxWork') == null){Cookies.set('checkboxWork','on');}
        if(Cookies.get('checkboxSuccess') == null){Cookies.set('checkboxSuccess','on');}

        if(Cookies.get('checkboxRefusing') === 'on'){ //cookie чекбокс отказов
            if(Cookies.get('checkboxSuccess')==='on'){visibleSuccess='7';}
            if(Cookies.get('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableDocumentPay).bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, '5', visibleSuccess]});
        }else{
            if(Cookies.get('checkboxSuccess')==='on'){visibleSuccess='7';}
            if(Cookies.get('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableDocumentPay).bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleSuccess]});
            $('.checkboxRefusing').removeAttr('checked');
        }

        if(Cookies.get('checkboxSuccess') === 'on'){ //cookie чекбокс оплачено
            if(Cookies.get('checkboxRefusing')==='on'){visibleRefusing='5';}
            if(Cookies.get('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableDocumentPay).bootstrapTable('filterBy',{'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing, '7']});
        }else{
            if(Cookies.get('checkboxRefusing')==='on'){visibleRefusing='5';}
            if(Cookies.get('checkboxWork')==='on'){visibleWork1='1';visibleWork2='2';}
            $('#'+tableDocumentPay).bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleWork1, visibleWork2, visibleRefusing]});
            $('.checkboxSuccess').removeAttr('checked');
        }

        if(Cookies.get('checkboxWork') === 'on'){ //cookie чекбокс в работе
            if(Cookies.get('checkboxRefusing')==='on'){visibleRefusing='5';}
            if(Cookies.get('checkboxSuccess')==='on'){visibleSuccess='7';}
            $('#'+tableDocumentPay).bootstrapTable('filterBy',{'tablePay-statusNumber': ['1', '2', visibleRefusing, visibleSuccess]});
        }else{
            if(Cookies.get('checkboxRefusing')==='on'){visibleRefusing='5';}
            if(Cookies.get('checkboxSuccess')==='on'){visibleSuccess='7';}
            $('#'+tableDocumentPay).bootstrapTable('filterBy', {'tablePay-statusNumber': [visibleRefusing, visibleSuccess]});
            $('.checkboxWork').removeAttr('checked');
        }*/

//Функция получения текущей даты и времени
        function datetimeToday() {
            return moment().format('DD.MM.YYYY HH:mm');
        }
        function btnSuccessPre(invoiceId,mngrtable,mngrID,initiatorRole,tableId,dataImage) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testProfit&idInvoice="+invoiceId+"&tableFromProjectID=invoice",
                success: function (data){
                    var result = $.parseJSON(data);
                    if(!result.testProfit['profitExit']){
                        Swal.fire({
                            title: "Внимание!!!",
                            html: true,
                            text: '<h4 style="color: red;">Проект в критической рентабельности</h4>',
                            type: "warning",
                            allowOutsideClick: true,
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            cancelButtonText: "Продолжить работу",
                            confirmButtonText: "Перейти в счет",
                            closeOnConfirm: false,
                            closeModal: true
                        }).then((isConfirm)=>{
                            if (isConfirm.value){
                                window.location = ('/mngr/staffer/'+invoiceId);
                            }else{
                                setTimeout(function(){
                                    btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole,tableId,dataImage);
                                },500);
                            }
                        });
                    }else{
                        btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole,tableId,dataImage);
                    }
                }
            });
        }
        /*$('body').on('click', '.btn-success', function(){
            var invoiceId = $(this).data('invoiceid');
            var initiatorRole = $(this).data('initiatorrole');
            var tableId = $(this).data('idtable');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var dataImage = $('tr[data-uniqueid="'+invoiceId+'"]').find('a').data('image'); //получаем имя файла счета
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testLabelEdit&idInvoice="+invoiceId+"&typeAdd=invoice",
                success: function (data){
                    var result = $.parseJSON(data);
                    if(result.resultTest[0]['editLabel']==='true'){
                        swal({
                            title: "ВНИМАНИЕ!",
                            text: "счет редактируется",
                            type: "warning",
                            allowOutsideClick: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Понятно",
                            closeOnConfirm: false,
                            closeModal: true
                        });
                    }else{
                        btnSuccessPre(invoiceId,mngrtable,mngrID,initiatorRole,tableId,dataImage);
                    }
                }
            });
        });*/
        function btnSuccess(invoiceId,mngrtable,mngrID,initiatorRole,tableId,dataImage) {
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
            Swal.fire({
                title: "Подписать?",
                type: "info",
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
                    $('#'+tableId).bootstrapTable('updateByUniqueId', {
                        id: invoiceId,
                        row: {
                            '<?php echo $tableDocumentInvoice;?>-statusInvoice': statusInvoiceSpan,
                            '<?php echo $tableDocumentInvoice;?>-statusNumber': numberStatus,
                            '<?php echo $tableDocumentInvoice;?>-actions': output
                        }
                    });
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=success&dateToday="+dateToday,
                        success: function (data) {}
                    });
                }
            });
        }
        $('body').on('click', '.btn-failure', function(){
            var invoiceId = $(this).data('invoiceid');
            var initiatorRole = $(this).data('initiatorrole');
            var tableId = $(this).data('idtable');
            var mngrtable = $(this).data('mngrtable');
            var mngrID = $(this).data('mngrid');
            var dataImage = $('tr[data-uniqueid="'+invoiceId+'"]').find('a').data('image'); //получаем имя файла счета

            var dateToday = datetimeToday();
            Swal.fire({
                title: "Отказ в подписании",
                text: "Укажите причину отказа:",
                type: "input",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((inputValueFailure)=>{
                if (inputValueFailure === false) return false;
                if (inputValueFailure === "") {
                    Swal.showInputError("Вы не указали причину отказа!");
                    return false
                }
                Swal.fire({
                    title: "Отказ зарегистрирован",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#success'+invoiceId).remove(); //удаляем кнопку success
                $('#failure'+invoiceId).remove(); //удаляем кнопку failure
                var getSel = $('tr[data-uniqueid="'+invoiceId+'"]').bootstrapTable('getSelections'); //получаем данные объекта
                //console.log(getSel[0]['cells']);
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
                        '<?php echo $tableDocumentInvoice;?>-statusInvoice': '<span class="label label-sm label-danger" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="отказ"><i class="glyphicon glyphicon-remove"></i></span>',
                        '<?php echo $tableDocumentInvoice;?>-statusNumber': '5',
                        '<?php echo $tableDocumentInvoice;?>-actions': output
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
                Swal.fire({
                    title: "Внимание!",
                    text: "Необходимо указать сумму фактической оплаты",
                    type: "input",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Отмена",
                    confirmButtonText: "Подтвердить"
                }).then((inputValueMoney)=>{
                    if (inputValueMoney === false) return false;
                    if (!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(inputValueMoney)) {
                        Swal.showInputError("Возможно есть пробелы. Точка или запятая разделитель копеек!");
                        return false
                    }
                    if (inputValueMoney === "") {
                        Swal.showInputError("Вы не указали сумму оплаты!");
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
                            '<?php echo $tableDocumentInvoice;?>-statusInvoice': statusInvoiceSpan,
                            '<?php echo $tableDocumentInvoice;?>-statusNumber': numberStatus,
                            '<?php echo $tableDocumentInvoice;?>-actions': output
                        }
                    });
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
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday+"&inputValueMoney="+inputValueMoney,
                        success: function (data) {}
                    });
                });
            }else{
                Swal.fire({
                    title: "Вы оплатили счет?",
                    type: "warning",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Нет",
                    confirmButtonText: "Да",
                    closeOnConfirm: false,
                    closeModal: true
                }).then((isConfirm)=>{
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
                                '<?php echo $tableDocumentInvoice;?>-statusInvoice': statusInvoiceSpan,
                                '<?php echo $tableDocumentInvoice;?>-statusNumber': numberStatus,
                                '<?php echo $tableDocumentInvoice;?>-actions': output
                            }
                        });
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
        });
        function btnSuccessPrePay(invoiceId,mngrtable,mngrID,initiatorRole,idTable) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testProfit&idInvoice="+invoiceId+"&tableFromProjectID=invoicePay",
                success: function (data){
                    var result = $.parseJSON(data);
                    if(!result.testProfit['profitExit']){
                        Swal.fire({
                            title: "Внимание!!!",
                            html: true,
                            text: '<h4 style="color: red;">Проект в критической рентабельности</h4>',
                            type: "warning",
                            allowOutsideClick: true,
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            cancelButtonText: "Продолжить работу",
                            confirmButtonText: "Перейти в служебку",
                            closeModal: true
                        }).then((isConfirm)=>{
                            if (isConfirm.value){
                                window.location = ('/mngr/onepay/'+invoiceId);
                            }else{
                                setTimeout(function(){
                                    btnSuccessPay(invoiceId,mngrtable,mngrID,initiatorRole,idTable);
                                },500);
                            }
                        });
                    }else{
                        btnSuccessPay(invoiceId,mngrtable,mngrID,initiatorRole,idTable);
                    }
                }
            });
        }
        $('body').on('click', '.btn-success-status', function(){
            var invoiceId = $(this).data('invoiceid');
            var mngrtable = $(this).data('mngrtable');
            var initiatorRole = $(this).data('initiatorrole');
            var idTable = $(this).data('idtable');
            var mngrID = $(this).data('mngrid');
            btnSuccessPrePay(invoiceId,mngrtable,mngrID,initiatorRole,idTable);
        });
        function btnSuccessPay(invoiceId,mngrtable,mngrID,initiatorRole,idTable) {
            var statusInvoiceSpan = '<span class="label label-sm label-info" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="согласован руководителем"><i class="glyphicon glyphicon-time"></i></span>';
            var numberStatus = '2';
            var output = '\
                <a href="/mngr/onepay/'+invoiceId+'"\
                    class="btn btn-xs btn-outline blue" data-toggle="popover"\
                    data-trigger="hover" data-placement="auto" title=""\
                    data-content="Перейти">\
                    <i class="fa fa-arrows-alt"></i></a>';

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
                if (isConfirm.value){
                    swal({
                        title: "Документ подписан!",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#successStatus'+invoiceId).remove(); //удаляем кнопку success
                    $('#failureStatus'+invoiceId).remove(); //удаляем кнопку failure
                    $('#'+idTable).bootstrapTable('updateByUniqueId', {
                        id: invoiceId,
                        row: {
                            '<?php echo $tableDocumentPay;?>-statusInvoice': statusInvoiceSpan,
                            '<?php echo $tableDocumentPay;?>-statusNumber': numberStatus,
                            '<?php echo $tableDocumentPay;?>-actions': output
                        }
                    });
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=success&dateToday="+dateToday,
                        success: function (data) {}
                    });
                }
            });
        }
        $('body').on('click', '.btn-failure-status', function(){
            var invoiceId = $(this).data('invoiceid');
            var mngrtable = $(this).data('mngrtable');
            var initiatorRole = $(this).data('initiatorrole');
            var idTable = $(this).data('idtable');
            var mngrID = $(this).data('mngrid');

            var dateToday = datetimeToday();

            Swal.fire({
                title: "Отказ в подписании",
                text: "Укажите причину отказа:",
                type: "input",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((inputValueFailure)=>{
                if (inputValueFailure === false) return false;
                if (inputValueFailure === "") {
                    Swal.showInputError("Вы не указали причину отказа!");
                    return false
                }
                sSwal.fire({
                    title: "Отказ зарегистрирован",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#successStatus'+invoiceId).remove(); //удаляем кнопку success
                $('#failureStatus'+invoiceId).remove(); //удаляем кнопку failure
                var output = '\
                <a href="/mngr/onepay/'+invoiceId+'"\
                    class="btn btn-xs btn-outline blue" data-toggle="popover"\
                    data-trigger="hover" data-placement="auto" title=""\
                    data-content="Нажмите для перехода в служебку"\
                    data-original-title="Перейти">\
                    <i class="fa fa-arrows-alt"></i></a>';
                $('#'+idTable).bootstrapTable('updateByUniqueId', {
                    id: invoiceId,
                    row: {
                        '<?php echo $tableDocumentPay;?>-statusInvoice': '<span class="label label-sm label-danger" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="отказ"><i class="glyphicon glyphicon-remove"></i></span>',
                        '<?php echo $tableDocumentPay;?>-statusNumber': '5',
                        '<?php echo $tableDocumentPay;?>-actions': output
                    }
                });

                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=failure&dateToday="+dateToday+"&inputValueFailure="+inputValueFailure,
                    success: function (data) {}
                });
            });
        });
        $('body').on('click', '.btn-invoiceEnd-status', function(){
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
                    var statusInvoiceSpan = '<span class="label label-sm label-success" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="оплачено"><i class="glyphicon glyphicon-star"></i></span>';
                    var numberStatus = '7';
                    var output = '<a href="/mngr/onepay/'+invoiceId+'"\
                        class="btn btn-xs btn-outline blue" data-toggle="popover"\
                        data-trigger="hover" data-placement="auto" title=""\
                        data-content="Нажмите для перехода в служебку"\
                        data-original-title="Перейти">\
                        <i class="fa fa-arrows-alt"></i></a>';
                    $('#tablePay').bootstrapTable('updateByUniqueId', {
                        id: invoiceId,
                        row: {
                            '<?php echo $tableDocumentPay;?>-statusInvoice': statusInvoiceSpan,
                            '<?php echo $tableDocumentPay;?>-statusNumber': numberStatus,
                            '<?php echo $tableDocumentPay;?>-actions': output
                        }
                    });
                    setTimeout(function () {
                        Swal.fire({
                            title: 'Cредства перечислены',
                            type: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }, 200); // время в мс

                    $('#invoiceEnd'+invoiceId).remove();
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateStatusInvoice&initiatorRole="+initiatorRole+"&invoiceId="+invoiceId+"&mngrtable="+mngrtable+"&mngrID="+mngrID+"&btn=invoiceEnd&dateToday="+dateToday,
                        success: function (data) {}
                    });
                }
            });
        });
    });
</script>
