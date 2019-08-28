<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Настройка </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
        <div class="col-md-3">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-infobox">
                        <div class="kt-infobox__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav kt-nav kt-nav--bold kt-nav--md-space kt-nav--v4" role="tablist">
                                        <li class="kt-nav__item nav-item testClassActive">
                                            <a class="kt-nav__link nav-link linkTabCategory" data-toggle="tab" href="#tab-dataInvoice" role="tab">
                                                <span class="kt-nav__link-text">Данные в счетах</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item nav-item testClassActive">
                                            <a class="kt-nav__link nav-link linkTabCategory" data-toggle="tab" href="#tab-dataPay" role="tab">
                                                <span class="kt-nav__link-text">Данные в служебках</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item nav-item testClassActive">
                                            <a class="kt-nav__link nav-link linkTabCategory" data-toggle="tab" href="#tab-dataDoc" role="tab">
                                                <span class="kt-nav__link-text">Данные в документах</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item nav-item testClassActive">
                                            <a class="kt-nav__link nav-link linkTabCategory" data-toggle="tab" href="#tab-dataContragents" role="tab">
                                                <span class="kt-nav__link-text">Данные в контрагентах</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item nav-item testClassActive">
                                            <a class="kt-nav__link nav-link linkTabCategory" data-toggle="tab" href="#tab-dataProject" role="tab">
                                                <span class="kt-nav__link-text">Данные в проектах</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-infobox">
                        <div class="kt-infobox__body">
                            <div class="row">
                                <div class="tab-content col-12">
                                    <div class="kt-section__content">
                                        <div class="progress"></div>
                                        <div class="kt-space-10"></div>
                                    </div>
                                    <div class="tab-pane" id="tab-dataInvoice" role="tabpanel">
                                        <button type="button" class="btn btn-outline-brand enterTest" data-group="testinvoice" data-test="dataall">Запустить проверку заполенения счетов</button>
                                        <table class="table table-striped- table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Проект</th>
                                                    <th>Сумма</th>
                                                    <th>Контрагент</th>
                                                    <th>Счет</th>
                                                    <th>Оплачен но завис</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color: red;"><span id="errorProject"></span></td>
                                                    <td style="color: red;"><span id="errorMoney"></span></td>
                                                    <td style="color: red;"><span id="errorContragent"></span></td>
                                                    <td style="color: red;"><span id="errorPaths"></span></td>
                                                    <td style="color: red;"><span id="errorSuccess"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="kt-section">
                                            <div class="kt-section__content kt-section__content--solid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6 id="projectsID">Проект - </h6>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 id="moneysID">Сумма - </h6>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 id="contragentsID">Контрагент - </h6>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 id="invoicesID">Счет - </h6>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 id="payErrID">Оплачен но завис - </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-dataPay" role="tabpanel">
                                        <button type="button" class="btn btn-outline-brand enterTest" data-group="testpay" data-test="dataall">Запустить проверку заполенения служебок</button>
                                        <table class="table table-striped- table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Сумма</th>
                                                    <th>Оплачен но завис</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color: red;"><span id="errorMoneyPay"></span></td>
                                                    <td style="color: red;"><span id="errorSuccessPay"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="kt-section">
                                            <div class="kt-section__content kt-section__content--solid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6 id="moneysPayID">Сумма - </h6>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 id="payErrPayID">Оплачен но завис - </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-dataDoc" role="tabpanel">
                                        <button type="button" class="btn btn-outline-brand enterTest" data-group="testdoc" data-test="dataall">Запустить проверку заполенения документов</button>
                                    </div>
                                    <div class="tab-pane" id="tab-dataContragents" role="tabpanel">
                                        <button type="button" class="btn btn-outline-brand enterTest" data-group="testcontragents" data-test="dataall">Запустить проверку заполенения контрагентов</button>
                                    </div>
                                    <div class="tab-pane" id="tab-dataProject" role="tabpanel">
                                        <button type="button" class="btn btn-outline-brand enterTest" data-group="testproject" data-test="dataall">Запустить проверку заполенения проектов</button>
                                        <table class="table table-striped- table-bordered responsive">
                                            <thead>
                                            <tr>
                                                <th>Фикс траты</th>
                                                <th>Сумма проекта</th>
                                                <th>Контрагент</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td style="color: red;"><span id="errorFixProject"></span></td>
                                                <td style="color: red;"><span id="errorMoneyProject"></span></td>
                                                <td style="color: red;"><span id="errorContragentProject"></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="kt-section">
                                            <div class="kt-section__content kt-section__content--solid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6 id="fixProjectID">Фикс траты - </h6>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 id="moneysProjectID">Сумма проекта - </h6>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6 id="contragentsProjectID">Контрагент - </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- модальное окно добавления тематики УВД -->
<div class="modal fade" id="modalAddTheme" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление темы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="addThemeNew" class="col-form-label"><span style="color: red;">*</span> Тема:</label>
                    <input type="text" class="form-control" id="addThemeNew">
                </div>
                <div class="form-group">
                    <label for="addChargUserNew"><span style="color: red;">*</span> Ответственный:</label>
                    <select class="form-control" style="width: 100% !important;" id="addChargUserNew">
                        <option></option>
                    </select>
                </div>
                <div class="d-none" id="validateTheme">
                    <p style="color: red;text-align: center;">Проверьте поле темы</p>
                </div>
                <div class="d-none" id="validateChargUser">
                    <p style="color: red;text-align: center;">Пользователь не выбран</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="saveAddTheme">Применить</button>
            </div>
        </div>
    </div>
</div>
<!-- модальное окно редактирования тематики УВД -->
<div class="modal fade" id="modalEditTheme" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление темы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="editThemeDoc" class="col-form-label"><span style="color: red;">*</span> Тема:</label>
                    <input type="text" class="form-control" id="editThemeDoc">
                </div>
                <div class="form-group">
                    <label for="editThemeChargUser"><span style="color: red;">*</span> Ответственный:</label>
                    <select class="form-control" style="width: 100% !important;" id="editThemeChargUser">
                        <option></option>
                    </select>
                </div>
                <div class="d-none" id="validateThemeEdit">
                    <p style="color: red;text-align: center;">Проверьте поле темы</p>
                </div>
                <div class="d-none" id="validateChargUserEdit">
                    <p style="color: red;text-align: center;">Пользователь не выбран</p>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="editThemeID" id="editThemeID">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="saveEditTheme">Применить</button>
            </div>
        </div>
    </div>
</div>
<!-- модальное окно настройки пользователя Счета-Наличка-Доки -->
<div class="modal fade" id="modalSettingUser" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headSetUser">Настройка видимости пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <form class="kt-form kt-form--label-right">
                <div class="modal-body">
                    <div class="kt-section">
                        <span class="kt-section__info">
                            Счета каких пользователей видит:
                        </span>
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12" for="selectPickerInvoice">Выбор с поиском</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <select class="form-control" id="selectPickerInvoice" multiple data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Множественный выбор</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectPickerInvoice">Всех в список</button>
                                    <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectPickerInvoice">Всех из списка</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section">
                        <span class="kt-section__info">
                            Служебки каких пользователей видит:
                        </span>
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12" for="selectPickerPay">Выбор с поиском</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <select class="form-control" id="selectPickerPay" multiple data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Множественный выбор</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectPickerPay">Всех в список</button>
                                    <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectPickerPay">Всех из списка</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section">
                        <span class="kt-section__info">
                            Документы каких пользователей видит:
                        </span>
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12" for="selectPickerDoc">Выбор с поиском</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <select class="form-control" id="selectPickerDoc" multiple data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Множественный выбор</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectPickerDoc">Всех в список</button>
                                    <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectPickerDoc">Всех из списка</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-brand kt-btn" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-secondary kt-btn saveSettingsUser">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let urlOne = '/ajax/ajaxpost';
        $('.enterTest').on('click',function () {
            $('div .progress').empty('');
            dataTest($(this).data('group'),$(this).data('test'));
        });
        function dataTest(groupType,testType) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=dataTest&groupType="+groupType+"&testType="+testType,
                success: function (data){
                    console.log(data);
                    let result = $.parseJSON(data);
                    let dataArr = result.testData;
                    switch (groupType){
                        case 'testinvoice':
                            switch (testType){
                                case 'dataall':
                                    dataallInvoice(dataArr);
                                    break;
                            }
                            break;
                        case 'testpay':
                            switch (testType){
                                case 'dataall':
                                    dataallPay(dataArr);
                                    break;
                            }
                            break;
                        case 'testdoc':
                            break;
                        case 'testcontragents':

                            break;
                        case 'testproject':
                            switch (testType){
                                case 'dataall':
                                    dataallProject(dataArr);
                                    break;
                            }
                            break;
                    }
                }
            });
        }
        function appendInvoiceID(strID) {
            return '<a href="/mngr/staffer/'+strID+'" target="_blank">'+strID+'</a> ';
        }
        function appendPayID(strID) {
            return '<a href="/mngr/onepay/'+strID+'" target="_blank">'+strID+'</a> ';
        }
        function appendProjectID(strID) {
            return '<a href="/mngr/analitics/project'+strID+'" target="_blank">'+strID+'</a> ';
        }
        function dataallInvoice(dataArr) {

            let countLength = 100/dataArr.length;

            let time = 0;
            let errorProject = 0;
            let errorMoney = 0;
            let errorContragent = 0;
            let errorPaths = 0;
            let errorSuccess = 0;
            $.each(dataArr,function(col,val){
                setTimeout(function() {
                    //});
                    ++col;
                    let percent = countLength*col;
                    $('div .progress').empty('');
                    let outline = '<div class="progress-bar progress-bar-striped progress-bar-animated  bg-danger" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percent+'%"></div>';
                    $('.progress').delay(1500).html(outline);
                    if(!$.isNumeric(val.numberContract)){
                        ++errorProject;
                        $('#errorProject').text(errorProject);
                        $('#projectsID').append(appendInvoiceID(val.id));
                    }
                    if(!$.isNumeric(val.summInvoiceForPayment )){
                        ++errorMoney;
                        $('#errorMoney').text(errorMoney);
                        $('#moneysID').append(appendInvoiceID(val.id));
                    }
                    if(!$.isNumeric(val.contragent )){
                        ++errorContragent;
                        $('#errorContragent').text(errorContragent);
                        $('#contragentsID').append(appendInvoiceID(val.id));
                    }
                    if(val.pathScanInvoice.length<1){
                        ++errorPaths;
                        $('#errorPaths').text(errorPaths);
                        $('#invoicesID').append(appendInvoiceID(val.id));
                    }
                    if(val.date_success.length>1 && val.signature!=0){
                        ++errorSuccess;
                        $('#errorSuccess').text(errorSuccess);
                        $('#payErrID').append(appendInvoiceID(val.id));
                    }
                    if(percent>99){
                        $('.progress-bar').removeClass('progress-bar-striped , bg-danger');
                        $('.progress-bar').addClass('bg-success');
                    }
                }, time);
                time += 1;
            });
        }
        function dataallPay(dataArr) {

            let countLength = 100/dataArr.length;

            let time = 0;
            let errorMoney = 0;
            let errorSuccess = 0;
            $.each(dataArr,function(col,val){
                setTimeout(function() {
                    //});
                    ++col;
                    let percent = countLength*col;
                    $('div .progress').empty('');
                    let outline = '<div class="progress-bar progress-bar-striped progress-bar-animated  bg-danger" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percent+'%"></div>';
                    $('.progress').delay(1500).html(outline);
                    if(!$.isNumeric(val.money)){
                        ++errorMoney;
                        $('#errorMoneyPay').text(errorMoney);
                        $('#moneysPayID').append(appendPayID(val.id));
                    }
                    if(val.date_success.length>1 && val.signature!=0){
                        ++errorSuccess;
                        $('#errorSuccessPay').text(errorSuccess);
                        $('#payErrPayID').append(appendPayID(val.id));
                    }
                    if(percent>99){
                        $('.progress-bar').removeClass('progress-bar-striped , bg-danger');
                        $('.progress-bar').addClass('bg-success');
                    }
                }, time);
                time += 1;
            });
        }

        function dataallProject(dataArr) {

            let countLength = 100/dataArr.length;

            let time = 0;
            let errorFix = 0;
            let errorMoney = 0;
            let errorContragent = 0;
            $.each(dataArr,function(col,val){
                setTimeout(function() {
                    //});
                    ++col;
                    let percent = countLength*col;
                    $('div .progress').empty('');
                    let outline = '<div class="progress-bar progress-bar-striped progress-bar-animated  bg-danger" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percent+'%"></div>';
                    $('.progress').delay(1500).html(outline);
                    if(!$.isNumeric(val.expenseProject)){
                        ++errorFix;
                        $('#errorFixProject').text(errorFix);
                        $('#fixProjectID').append(appendProjectID(val.id));
                    }
                    if(!$.isNumeric(val.moneyProject)){
                        ++errorMoney;
                        $('#errorMoneyProject').text(errorMoney);
                        $('#moneysProjectID').append(appendProjectID(val.id));
                    }
                    if(!$.isNumeric(val.idContragent) || val.idContragent==0){
                        ++errorContragent;
                        $('#errorContragentProject').text(errorContragent);
                        $('#contragentsProjectID').append(appendProjectID(val.id));
                    }
                    if(percent>99){
                        $('.progress-bar').removeClass('progress-bar-striped , bg-danger');
                        $('.progress-bar').addClass('bg-success');
                    }
                }, time);
                time += 1;
            });
        }
    });
</script>