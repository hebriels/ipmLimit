<?php
    $tabsActive = '[href="#tab_1"]';
    $contractCheck = $contractCheckPay = 'true';
    if(!empty($typeInvoice)){
        if($typeInvoice=='invoice'){
            $tabsActive = '[href="#tab_1"]';
            //bugs($invoiceDataID);
            $contractRep = $invoiceDataID[0]['numberContract']; //id проекта
            if(empty($contractRep)){
                $contractCheck = 'false';
            }
            $urgentPaymentRep = $invoiceDataID[0]['urgentPayment']; //срочный счет
            $needPayRep = $invoiceDataID[0]['needPay']; //нужна платежка
            $numberInvoiceRep = $invoiceDataID[0]['numberInvoice']; //номер счета
            $moneyRep = $invoiceDataID[0]['summInvoiceForPayment']; //сумма
            $contragentRep = $invoiceDataID[0]['contragent']; //поставщик
            $organizationRep = $invoiceDataID[0]['organizationInvoiceForPayment']; //организация
            $noticeRep = $invoiceDataID[0]['noticeInvoiceForPayment']; //примечание
            $pathsRep = $invoiceDataID[0]['pathScanInvoice']; //файл
            $currencyRep = $invoiceDataID[0]['currency']; //валюта

        }else{
            $tabsActive = '[href="#tab_2"]';
            //bugs($invoicePayDataID);
            $contractPayRep = $invoicePayDataID[0]['contract']; //id проекта
            //bugs($contractPayRep);
            if(empty($contractPayRep)){
                $contractCheckPay = 'false';
            }

            $moneyPayRep = $invoicePayDataID[0]['money']; //сумма
            $noticePayRep = $invoicePayDataID[0]['notice_pay']; //примечание
            $pathsPayRep = $invoicePayDataID[0]['paths_pay']; //файл
            if(empty($pathsPayRep)){
                $pathsPayRep = 'false';
            }
        }
    };
?>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Добавление счета или служебки </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <?php foreach ($getAllFavorites as $favor){
                    foreach ($allProjects as $project){
                        if($project['id']==$favor['project_id']){
                            echo '<button style="margin-left: 10px;" type="button" class="btn kt-subheader__btn-secondary enterProject" data-idproject="'.$project['id'].'" data-nameproject="'.$project['nameProject'].'">'.$project['nameProject'].'</button>';
                        }
                    }
                }?>
            </div>
        </div>
    </div>
    <!-- #Заголовок -->

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-6">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <ul class="nav nav-tabs" role="tablist" id="tabAdd">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab_1" data-toggle="tab" id="tab1"> Добавить счет </a>
                            </li>
                            <?php if($modulePay=='true'):?>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_2" data-toggle="tab" id="tab2"> Получить наличные </a>
                            </li>
                            <?php endif;?>
                            <?php if($moduleAddDoc=='true'):?>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_3" data-toggle="tab" id="tab3"> Входящий документ </a>
                            </li>
                            <?php endif;?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="tab_1">
                                <form class="kt-form" action="/mngr/add" method="post" enctype='multipart/form-data' id="formAddInvoice">
                                    <input type="hidden" name="initiatorSurname" value="<?php echo $mngrData['userSurname']; ?>">
                                    <input type="hidden" name="initiatorFirstName" value="<?php echo $mngrData['userFirstName']; ?>">
                                    <input type="hidden" name="initiatorRole" value="<?php echo $mngrData['userRole']; ?>">
                                    <div class="kt-portlet__body">
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
                                                        <input type="checkbox" id="needPay" name="needPay" class="needPay"> Нужна платежка
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
                                                <input type="text" class="form-control searchProject" placeholder="Имя проекта или (ИНН или название покупателя)" value="<?php if(isset($contractRep)){echo $contractRep;}?>" autocomplete="off" id="numberContract" name="numberContract">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="numberInvoice">Номер счета<span style="color: red;">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" placeholder="Номер счета без даты" value="<?php if(isset($numberInvoiceRep)){echo $numberInvoiceRep;}?>" id="numberInvoice" name="numberInvoice" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="summInvoiceForPayment">Сумма <span style="color: red;">*</span></label>
                                            <div class="col-5">
                                                <input type="text" class="form-control" id="summInvoiceForPayment" placeholder="Сумма к оплате" value="<?php if(isset($moneyRep)){echo $moneyRep;}?>" autocomplete="off" name="summInvoiceForPayment" required>
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
                                                    <?php
                                                    foreach ($allOrganization as $iteam){
                                                        $selectedOrg = '';
                                                        if($iteam['id']==$organizationRep){$selectedOrg = 'selected';}
                                                        echo '<option value="'.$iteam['id'].'" '.$selectedOrg.'>'.$iteam['nameOrganization'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="innContragent">Поставщик <span style="color: red;">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="innContragent" placeholder="ИНН или наименование поставщика" value="<?php if(isset($contragentRep)){echo $contragentRep;}?>" name="innContragent" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last">
                                            <label for="noticeInvoiceForPayment">Примечание</label>
                                            <textarea class="form-control" name="noticeInvoiceForPayment" id="noticeInvoiceForPayment" rows="3"><?php if(isset($noticeRep)){echo $noticeRep;}?></textarea>
                                        </div>
                                        <?php if(!empty($pathsRep)):?>
                                            <div class="kt-section mt-2" id="divPDFRep">
                                                <span class="kt-section__info">Загруженный файл</span>
                                                <div class="kt-section__content kt-section__content--solid">
                                                    <object data="<?php echo '/file/invoice/'.$pathsRep;?>" type="application/pdf" width="370px" height="200px">
                                                        <embed src="<?php echo '/file/invoice/'.$pathsRep;?>" type="application/pdf">
                                                        <p>Этот браузер не может отобразить содержимое: <a href="<?php echo '/file/invoice/'.$pathsRep;?>" download="download">Скачать PDF</a>.</p>
                                                        </embed>
                                                    </object>
                                                    <button type="button" id="newFileRep" class="btn btn btn-outline-brand">Загрузить новый</button>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                        <div class="form-group form-group-last" id="divDownload">
                                            <label class="col-form-label">Загрузите счет <span style="color: red;">*</span></label>
                                            <p id="downloadFile" class="hiddenVisible" style="color: red;">Добавьте файл</p>

                                            <div class="file-loading">
                                                <input id="imgInvoice" name="imgInvoice[]" type="file" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot kt-portlet__foot--solid">
                                        <div class="kt-form__actions kt-form__actions--center">
                                            <button type="button" id="submitInvoiceOne" class="btn btn-primary">Отправить</button>
                                            <!--<button type="reset" class="btn default">Сбросить</button>-->
                                            <input type="hidden" id="idProjectHidden" value="<?php if(isset($contractRep)){echo $contractRep;}?>" name="idProjectHidden">
                                            <input type="hidden" id="idHiddenContragent" value="<?php if(isset($contragentRep)){echo $contragentRep;}?>" name="idHiddenContragent">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab_2">
                                <form class="kt-form" action="#" method="post" enctype='multipart/form-data' id="formAddInvoicePay">
                                    <div class="kt-portlet__body">
                                        <div class="form-group">
                                            <label>Опции</label>
                                            <div class="kt-checkbox-inline">
                                                <div class="kt-checkbox">
                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--danger" for="underReportPay">
                                                        <input type="checkbox" id="underReportPay" disabled="disabled" name="underReportPay"> Под отчет
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-checkbox">
                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success" for="contractCheckPay">
                                                        <input type="checkbox" id="contractCheckPay" name="contractCheckPay"> К проекту
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row hiddenVisible" id="divContractCheckPay">
                                            <label class="col-3 col-form-label" for="numberContractPay">Проект <span style="color: red;">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control searchProject" placeholder="Имя проекта или (ИНН или название покупателя)" value="<?php if(isset($contractPayRep)){echo $contractPayRep;}?>" autocomplete="off" id="numberContractPay" name="numberContractPay">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="summForPayment">Сумма <span style="color: red;">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Сумма к выдаче" value="<?php if(isset($moneyPayRep)){echo $moneyPayRep;}?>" id="summForPayment" name="summForPayment" required>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last">
                                            <label for="noticeForPay">Примечание</label>
                                            <textarea class="form-control" name="noticeForPay" id="noticeForPay" rows="3"><?php if(isset($noticePayRep)){echo $noticePayRep;}?></textarea>
                                        </div>
                                        <?php if(isset($pathsPayRep) && $pathsPayRep!='false'):?>
                                            <?php
                                            $info = new SplFileInfo($pathsPayRep);
                                            $fileInfo = $info->getExtension();
                                            $fileName = $info->getFilename();
                                            if($fileInfo == 'pdf' || $fileInfo == 'PDF' || $fileInfo == 'Pdf'):?>
                                                <div class="kt-section mt-2" id="divPDFRepPay">
                                                    <span class="kt-section__info">Загруженный файл</span>
                                                    <div class="kt-section__content kt-section__content--solid">
                                                        <object data="<?php echo '/file/invoicePay/'.$pathsPayRep;?>" type="application/pdf" width="370px" height="200px">
                                                            <embed src="<?php echo '/file/invoicePay/'.$pathsPayRep;?>" type="application/pdf">
                                                            <p>Этот браузер не может отобразить содержимое: <a href="<?php echo '/file/invoicePay/'.$pathsPayRep;?>" download="download">Скачать PDF</a>.</p>
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
                                                        <img src="<?php echo '/file/invoicePay/'.$pathsPayRep;?>" width="370px">
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
                                                <input type="hidden" id="fileInfoData"
                                                       data-path="<?php if(isset($pathsPayRep)){echo $pathsPayRep;}?>"
                                                       data-name="<?php if(isset($fileName)){echo $fileName;}?>">
                                                <input id="imgInvoicePay" name="imgInvoicePay[]" type="file" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot kt-portlet__foot--solid">
                                        <div class="kt-form__actions kt-form__actions--center">
                                            <button type="button" id="submitPay" class="btn btn-primary">Отправить</button>
                                            <input type="hidden" id="idProjectHiddenPay" name="idProjectHiddenPay">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab_3">
                                <form class="kt-form" action="#" method="post" enctype='multipart/form-data' id="formAddDoc">
                                    <div class="kt-portlet__body">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="depDoc">Отдел <span style="color: red;">*</span></label>
                                            <div class="col-9">
                                                <select class="form-control" id="depDoc" name="depDoc">
                                                    <?php
                                                    foreach ($allDepartments as $iteam){
                                                        if($iteam['bossID']!=0){
                                                            echo '<option value="'.$iteam['id'].'">'.$iteam['nameDepartment'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="typeDoc">Тематика <span style="color: red;">*</span></label>
                                            <div class="col-9">
                                                <select class="form-control" id="typeDoc" name="typeDoc">
                                                    <?php
                                                    foreach ($themeDoc as $iteam){
                                                        echo '<option value="'.$iteam['id'].'">'.$iteam['themeDoc'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="fromToDoc">От кого <span style="color: red;">*</span></label>
                                            <div class="col-9">
                                                <select id="fromToDoc" style="width: 100% !important;" class="form-control kt-select2">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last">
                                            <label for="noticeAddDoc">Примечание</label>
                                            <textarea class="form-control" name="noticeAddDoc" id="noticeAddDoc" rows="3"></textarea>
                                        </div>
                                        <div class="form-group" id="downloadFileDoc">
                                            <label class="col-form-label">Прикрепить файл</label>
                                            <p id="downloadFileDoc" class="d-none" style="color: red;">Добавьте файл</p>
                                            <div class="file-loading">
                                                <input id="imgAddDoc" name="imgAddDoc[]" type="file" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot kt-portlet__foot--solid">
                                        <div class="kt-form__actions kt-form__actions--center">
                                            <button type="button" id="submitAddDoc" class="btn btn-primary">Отправить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

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
                        <div class="kt-portlet__head-toolbar d-none" id="addProjectBtn">
                            <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addProject" data-type="postav"><i class="flaticon2-add-1"></i></a>
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
                        <div class="kt-portlet__head-toolbar" id="addContragent">
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

    <!-- модальное окно добавления контрагента -->
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Отметить в случае если это ваша организация</label>
                            <div class="mt-checkbox-list">
                                <label class="mt-checkbox mt-checkbox-outline" for="mineOrg"> Своя организация
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
                                <!--<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nameContragentAdd" class="control-label">Покупатель
                                            <span class="required"> * </span>
                                        </label>
                                        <select id="nameContragentAdd" class="form-control select2">
                                        </select>
                                    </div>
                                </div>-->
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
                                        <input type="text" class="form-control" id="expenseProject" value="0">
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
                                <div class="d-none" id="validateDivProject">
                                    <p style="color: red;text-align: center;">Проверьте заполнение полей</p>
                                </div>
                                <div class="d-none" id="validateMoney">
                                    <p style="color: red;text-align: center;">Не корректная сумма проекта</p>
                                </div>
                                <div class="d-none" id="validateMoneyFix">
                                    <p style="color: red;text-align: center;">Не корректная сумма фикс.траты</p>
                                </div>
                                <div class="d-none" id="validateProfit">
                                    <p style="color: red;text-align: center;">Не корректное значение рентабельности</p>
                                </div>
                                <div class="d-none" id="validatePercent">
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
<!-- END CONTENT -->
<?php
    $allContragents = json_encode($allContragents);
?>
<script>
    $(document).ready(function()
    {
        let urlOne = '/ajax/ajaxpost';

        $('#fromToDoc').select2({
            placeholder: "Выбрать контрагента"
        });
        let allContragents = <?php echo $allContragents;?>;
        $.each(allContragents,function(col,val) {
            let selectContragents = '\
                <option value="'+val.id+'">'+val.name_contragent+'</option>';
            $('#fromToDoc').append(selectContragents);
        });

        $('#tab1').on('click',function () {
            $('#divContractCheckPay').addClass('hiddenVisible');
            $('#visibleDivContragentList,#visibleDivContract,#visibleDivContrgent,#divContractCheck').removeClass('hiddenVisible');
            $('#contractCheck').prop('checked', true);
            //$('.removeUl').remove();
            $('#numberContractPay').val('');
        });
        $('#tab2').on('click',function () {
            $('#visibleDivContrgent').addClass('hiddenVisible');
            $('#visibleDivContragentList,#visibleDivContract,#divContractCheckPay').removeClass('hiddenVisible');
            //$('.removeUl').remove();
            $('#contractCheckPay').prop('checked', true);
            $('#numberContract').val('');
        });
        $('#tab3').on('click',function () {
            $('#visibleDivContragentList,#visibleDivContrgent,#visibleDivContract').addClass('hiddenVisible');
            //$('#visibleDivContragentList,#visibleDivContract,#divContractCheckPay').removeClass('hiddenVisible');
            //$('.removeUl').remove();
            //$('#contractCheckPay').prop('checked', true);
            //$('#numberContract').val('');
        });
        $('#numberContract').change(function () {
            $('#idProjectHidden').val('');
        });
        $('#numberContractPay').change(function () {
            $('#idProjectHiddenPay').val('');
        });
        $('#innContragent').change(function () {
            $('#idHiddenContragent').val('');
        });

//активный таб
        var tabActiv = '<?php echo $tabsActive;?>';
        $('#tabAdd a'+tabActiv).tab('show');
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
                case 'JPY':
                    divCurrency.removeClass('hiddenVisible');
                    dataCurrencyCB($('#summInvoiceForPayment').val());
                    //console.log($('#summInvoiceForPayment').val());
                    break;
            }
        });
//открываем модальное окно добавления контрагента
        $('body').on('click','.addContragent', function () {
            $('#typeAdd').val($(this).data('type'));
            $('#modalAddContragent').modal('show');
        });
//открываем модальное окно добавления проекта
        $(document).on('click','.addProject', function () {
            let idContragent = $(this).data('idcontra');
            $('#idContragent').val(idContragent);
            ajaxContragent(idContragent);
            $('#modalAddProject').modal('show');
        });
        function ajaxContragent(idContragent) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testOrgProject&idContragent="+idContragent,
                success: function (data) {
                    let result = $.parseJSON(data);
                    if(result.resultTestOrg===true){
                        $('.divExpenseProject,.divSelectedProject,.divProfitProject').addClass('d-none');
                    }else{
                        $('.divExpenseProject,.divSelectedProject,.divProfitProject').removeClass('d-none');
                    }
                }
            });
        }
//изменение рентабельности
        $('#selectedProject').change(function () {
            var valSelectedProject = $('#selectedProject').val();
            $('#validateProfit').addClass('hiddenVisible');
            if(valSelectedProject==='1'){ //по умолчанию
                $('#faProfitProject').removeClass('fa-ruble-sign').addClass('fa-percent');
                $('#profitProject').val('<?php echo $profitInProject;?>').prop('readonly',true);
                $('#profitChange').addClass('hiddenVisible');
            }else if(valSelectedProject==='2'){ //проценты
                $('#faProfitProject').removeClass('fa-ruble-sign').addClass('fa-percent');
                $('#profitProject').val('').prop('readonly',false);
                $('#profitChange').addClass('hiddenVisible');
            }else if(valSelectedProject==='3'){ //сумма
                $('#faProfitProject').removeClass('fa-percent').addClass('fa-ruble-sign');
                $('#profitProject').val('').prop('readonly',false);
                $('#profitChange').removeClass('hiddenVisible');
            }
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
                    if(result.oneProject.length ===0){
                        $('#idContragent').val(idContra);
                        $('#modalAddProject').modal('show');
                    }else{
                        $('#addProjectBtn').removeClass('d-none');
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
                            $('#addProjectBtn').removeClass('d-none');
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
            var dateTime = datetimeStamp();
            var newKppContragent = $('#kpp_contragent').val();
            var newNoticeContragent = $('#notice_contragent').val();
            var mineOrg = $('#mineOrg').prop('checked');
            var idInitiator = $('#idInitiator').val();
            var typeAdd = $('#typeAdd').val();
            if(newInnContragent==='' || newNameContragent==='') {
                $('#validateDiv').removeClass('hiddenVisible');
            }else{
                $('#modalAddContragent').modal('hide');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=insertContragent&newInnContragent=" + newInnContragent + "&newNameContragent=" + newNameContragent + "&newKppContragent=" + newKppContragent + "&newNoticeContragent=" + newNoticeContragent + "&idInitiator=" + idInitiator+"&mineOrg="+mineOrg+"&dateTime="+dateTime,
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
            var profitInProject = parseInt('<?php echo $profitInProject;?>');
            var newNameProject = $('#newNameProject').val();
            var newNoticeProject = $('#newNoticeProject').val();
            var dateTime = datetimeStamp();
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
                $('#validateDivProject').removeClass('d-none');
                $('#validateMoney,#validateProfit,#validatePercent,#validateMoneyFix').addClass('d-none');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(moneyProject)) {
                $('#validateDivProject,#validateProfit,#validatePercent,#validateMoneyFix').addClass('d-none');
                $('#validateMoney').removeClass('d-none');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(profitProject)) {
                $('#validateDivProject,#validateMoney,#validatePercent,#validateMoneyFix').addClass('d-none');
                $('#validateProfit').removeClass('d-none');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(expenseProject)){
                $('#validateDivProject,#validateMoney,#validatePercent,#validateProfit').addClass('d-none');
                $('#validateMoneyFix').removeClass('d-none');
            }else if(notPercent===false){
                $('#validateDivProject,#validateMoney,#validateProfit,#validateMoneyFix').addClass('d-none');
                $('#validatePercent').removeClass('d-none');
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
                            //console.log('кранты');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "mainAjax=insertProject&newNameProject="+newNameProject+"&newNoticeProject="+newNoticeProject+"&idContragent="+idContragent+"&idInitProject="+idInitProject+"&moneyProject="+moneyProject+"&expenseProject="+expenseProject+"&selectedProject="+selectedProject+"&profitProject="+profitProject+"&dateTime="+dateTime,
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
            $('#numberContract').val($(this).data('nameproject'));
            $('#idProjectHidden').val($(this).data('idproject'));
            $('#numberContractPay').val($(this).data('nameproject'));
            $('#idProjectHiddenPay').val($(this).data('idproject'));
            $('#numberContract').valid();
            $('#numberContractPay').valid();
        });
//галочка к проекту в счете
        $('#contractCheck').on('click',function () {
            if(this.checked){
                $('#visibleDivContragentList,#divContractCheck,#visibleDivContract').removeClass('hiddenVisible');
            }else{
                $('#visibleDivContragentList,#divContractCheck,#visibleDivContract').addClass('hiddenVisible');
            }
        });
//галочка к проекту в служебке
        $('#contractCheckPay').on('click',function () {
            if(this.checked){
                $('#visibleDivContragentList,#divContractCheckPay,#visibleDivContract').removeClass('hiddenVisible');
                $('#underReportPay').prop('checked', false);
            }else{
                $('#visibleDivContragentList,#divContractCheckPay,#visibleDivContract').addClass('hiddenVisible');
            }
        });
//управление при повторении
        var typeInvoice = '<?php if(isset($typeInvoice)){echo $typeInvoice;}else{echo '';};?>';
        var contractCheck = '<?php echo $contractCheck;?>';
        var contractCheckPay = '<?php echo $contractCheckPay;?>';
        if(typeInvoice==='invoice'){
            var urgentPaymentRep = '<?php if(isset($urgentPaymentRep)){echo $urgentPaymentRep;}else{echo 'off';};?>';
            var needPayRep = '<?php if(isset($needPayRep)){echo $needPayRep;}else{echo 'false';};?>';
            if(urgentPaymentRep==='on'){
                $('#urgentPayment').prop('checked', true);
            }
            if(needPayRep==='true'){
                $('#needPay').prop('checked', true);
            }
            if (contractCheck === 'false') {
                $('#contractCheck').prop('checked', false);
                $('#divContractCheck, #visibleDivContragentList, #visibleDivContract').addClass('hiddenVisible');
            }else{
                var contractRep = '<?php if(isset($contractRep)){echo $contractRep;}?>';
                getNameProject(contractRep,'invoice')
            }
            var contragentRep = '<?php if(isset($contragentRep)){echo $contragentRep;}?>';
            getNameContragent(contragentRep)
        }else if(typeInvoice==='invoicepay'){
            if (contractCheckPay === 'true') {
                $('#visibleDivContragentList,#divContractCheckPay,#visibleDivContract').removeClass('hiddenVisible');
                $('#underReportPay').prop('checked', false);
                var contractPayRep = '<?php if(isset($contractPayRep)){echo $contractPayRep;}?>';
                getNameProject(contractPayRep,'invoicePay')
            } else {
                $('#contractCheckPay').prop('checked', false);
                $('#visibleDivContragentList,#divContractCheckPay,#visibleDivContract').addClass('hiddenVisible');
            }
        }
        function getNameContragent(idContragent) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=getNameContragent&idContragent="+idContragent,
                success: function (data) {
                    let result = $.parseJSON(data);
                    $('#innContragent').val(result);
                }
            });
        }
        function getNameProject(idProject,typeInvoice) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=getNameProject&idProject="+idProject+"&type="+typeInvoice,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if(typeInvoice==='invoice'){
                        $('#numberContract').val(result);
                    }else{
                        $('#numberContractPay').val(result);
                    }
                }
            });
        }
//галочка подотчет в служебке
        $('#underReportPay').on('click',function () {
            if(this.checked){
                $('#visibleDivContragentList,#divContractCheckPay,#visibleDivContract').addClass('hiddenVisible');
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

        $('#summInvoiceForPayment').on('keyup',function () {
            var keyMoney = $(this).val();
            delay(function(){
                dataCurrencyCB(keyMoney);
            }, 700 );
        });
        function dataCurrencyCB(keyMoney) {
            var testCurrencyCB = '<?php echo $testCurrencyCB;?>';
            var selectCurrency = $('#selectCurrency').val();
            var simbolCurrency = '';
            switch (selectCurrency){
                case 'EUR':
                    simbolCurrency = '1€';
                    break;
                case 'USD':
                    simbolCurrency = '$1';
                    break;
                case 'JPY':
                    simbolCurrency = '1¥';
                    break;
            }
            if(selectCurrency!=='RUR'){
                var preMoney = '';
                var currentCB = '';
                if(testCurrencyCB==='true'){
                    var dateToday = moment().format('YYYY-MM-DD');
                    //console.log(dateToday);
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=getCurrency&selectCurrency=" + selectCurrency+"&dateToday="+dateToday,
                        beforeSend: function (data) { // запустится до вызова запроса
                            $('#currencyTransform').val('');
                        },
                        success: function (data) {
                            //console.log(data);
                            if(data[0]==='<'){
                                switch (selectCurrency){
                                    case 'EUR':
                                        preMoney = '<?php echo $defaultDownload['currency'][1]['rateCurrencyAuto'];?>';
                                        break;
                                    case 'USD':
                                        preMoney = '<?php echo $defaultDownload['currency'][2]['rateCurrencyAuto'];?>';
                                        break;
                                    case 'JPY':
                                        preMoney = '<?php echo $defaultDownload['currency'][3]['rateCurrencyAuto'];?>';
                                        break;
                                }
                                keyMoney = keyMoney.replace(",",".");
                                currentCB = preMoney*keyMoney;
                                currentCB = currentCB.toFixed(2);
                                $('#currencyTransform').val(currentCB+' р.');
                                $('#currencyCourse').val(simbolCurrency+' = '+preMoney+'р.');
                            }else{
                                var result = $.parseJSON(data);
                                if(result.currencyCB===false){
                                    //console.log(result.currencyCB);
                                    switch (selectCurrency){
                                        case 'EUR':
                                            preMoney = '<?php echo $defaultDownload['currency'][1]['rateCurrencyAuto'];?>';
                                            break;
                                        case 'USD':
                                            preMoney = '<?php echo $defaultDownload['currency'][2]['rateCurrencyAuto'];?>';
                                            break;
                                        case 'JPY':
                                            preMoney = '<?php echo $defaultDownload['currency'][3]['rateCurrencyAuto'];?>';
                                            break;
                                    }
                                    keyMoney = keyMoney.replace(",",".");
                                    currentCB = preMoney*keyMoney;
                                    currentCB = currentCB.toFixed(2);
                                    $('#currencyTransform').val(currentCB+' р.');
                                    $('#currencyCourse').val(simbolCurrency+' = '+preMoney+'р.');
                                }else{
                                    //console.log(result.currencyCB);
                                    preMoney = result.currencyCB[selectCurrency];
                                    keyMoney = keyMoney.replace(",",".");
                                    currentCB = preMoney*keyMoney;
                                    currentCB = currentCB.toFixed(2);
                                    $('#currencyTransform').val(currentCB+' р.');
                                    $('#currencyCourse').val(simbolCurrency+' = '+preMoney+'р.');
                                }
                            }

                        }
                    });
                }else{
                    switch (selectCurrency){
                        case 'EUR':
                            preMoney = '<?php echo $defaultDownload['currency'][1]['rateCurrency'];?>';
                            break;
                        case 'USD':
                            preMoney = '<?php echo $defaultDownload['currency'][2]['rateCurrency'];?>';
                            break;
                        case 'JPY':
                            preMoney = '<?php echo $defaultDownload['currency'][3]['rateCurrency'];?>';
                            break;
                    }
                    keyMoney = keyMoney.replace(",",".");
                    currentCB = preMoney*keyMoney;
                    currentCB = currentCB.toFixed(2);
                    $('#currencyTransform').val(currentCB+' р.');
                    $('#currencyCourse').val(simbolCurrency+' = '+preMoney+'р.');
                }


            }
        }
//поле ввода проекта
        $('.searchProject').on('keyup',function () {
            var keyProject = $(this).val();

            delay(function(){
                dataProject(keyProject);
                dataCurrencyCB(keyProject);
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
                    $('#addProjectBtn').addClass('d-none');
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
                    $('#addProjectBtn').addClass('d-none');


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

        $('#submitInvoiceOne').on('click',function () {
            if ($('#formAddInvoice').valid()) {
                var formData = new FormData();
                if(deletePathRep==='false'){
                    $.each($('#imgInvoice')[0].files, function(key, value) {
                        formData.append('file[]', value);
                    });
                    formData.append('deletePathRep',deletePathRep);
                }else{
                    formData.append('deletePathRep',deletePathRep);
                }
                formData.append('mainAjax','addInvoice');
                formData.append('urgentPayment',$('#urgentPayment').prop('checked'));
                formData.append('datetimeStamp',datetimeStamp());
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
                //console.log(formData.getAll('idHiddenContragent'));
                //console.log(formData.getAll('summInvoiceForPayment'));
                //console.log(formData.getAll('idProjectHidden'));
                $.blockUI({
                    message: null,
                    onBlock: function() {
                        Swal.fire({
                            title: 'Проверка!',
                            text: 'ожидайте',
                            type: 'info',
                            showConfirmButton: false
                        })
                    }
                });
                $.ajax({
                    url: urlOne, type: "POST", dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        Swal.close();
                        $.unblockUI();
                        if(data.error==='noImage'){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Я не могу обработать запрос если нет прикрепленных файлов!",
                                type: "warning"
                            });
                        }else if(data.error==='noJPEGandPDF'){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Я не могу обработать файлы с разными форматами!",
                                type: "warning"
                            });
                        }else if(data.error==='noPDFandPDF'){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Я не могу объединить два файла .PDF!",
                                type: "warning"
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

        let deletePathRep = '<?php if(isset($pathsRep)){echo $pathsRep;}else{echo 'false';}?>';
        let deletePathRepPay = '<?php if(isset($pathsPayRep)){echo $pathsPayRep;}else{echo 'false';}?>';
        if(deletePathRep!=='false'){
            $('#divDownload').addClass('d-none');
        }
        $('#newFileRep').on('click', function () {
            $('#divPDFRep, #divOtherRep, #newFileRep, #deleteFileRep').addClass('d-none');
            $('#divDownload').removeClass('d-none');
            deletePathRep = 'false';
        });
        //console.log(deletePathRepPay);
        if(deletePathRepPay!=='false'){
            $('#divDownloadFile').addClass('d-none');
        }
        $('#deleteFileRepPay, #newFileRepPay').on('click', function () {
            $('#divPDFRepPay, #divOtherRepPay, #newFileRepPay, #deleteFileRepPay').addClass('d-none');
            $('#divDownloadFile').removeClass('d-none');
            deletePathRepPay = 'false';
        });

        $('#submitPay').on('click',function () {
            if ($('#formAddInvoicePay').valid()) {
                var contractCheckPay = $('#contractCheckPay').prop("checked");
                var underReportPay = $('#underReportPay').prop("checked");
                var idProjectHiddenPay = '';
                if(underReportPay===false && contractCheckPay===true){
                    var idProjectHiddenPay = $('#idProjectHiddenPay').val();
                }

                var formData = new FormData();
                if(deletePathRepPay==='false'){
                    $.each($('#imgInvoicePay')[0].files, function(key, value) {
                        formData.append('file[]', value);
                    });
                    formData.append('deletePathRepPay',deletePathRepPay);
                }else{
                    formData.append('deletePathRepPay',deletePathRepPay);
                }
                formData.append('mainAjax','insertPay');
                formData.append('idProjectHiddenPay',idProjectHiddenPay);
                formData.append('datetimeStamp',datetimeStamp());
                formData.append('contractCheckPay',contractCheckPay);
                formData.append('underReportPay',underReportPay);
                formData.append('numberContractPay',$('#numberContractPay').val());
                formData.append('summForPayment',$('#summForPayment').val());
                formData.append('noticeForPay',$('#noticeForPay').val());

                /*for (var pair of formData.entries()) {
                    //console.log(pair[0]+ ', ' + pair[1]);
                    $.each(pair[1], function(key, value){
                        //console.log(key);
                        console.log(value);
                    });
                }*/
                /*console.log(formData.getAll('idProjectHiddenPay'));
                console.log(formData.getAll('datetimeStamp'));
                console.log(formData.getAll('contractCheckPay'));
                console.log(formData.getAll('underReportPay'));
                console.log(formData.getAll('numberContractPay'));
                console.log(formData.getAll('summForPayment'));
                console.log(formData.getAll('noticeForPay'));
                console.log(formData.getAll('file[]'));
                console.log(formData.getAll('deletePathRepPay'));*/
                $.blockUI({
                    message: null,
                    onBlock: function() {
                        Swal.fire({
                            title: "Проверка, ожидайте!",
                            type: "info",
                            showConfirmButton: false
                        });
                    }
                });

                $.ajax({
                    url: urlOne, type: "POST", dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        Swal.close();
                        $.unblockUI();
                        if(data.error===false){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Не удается записать файл в базу!",
                                type: "warning"
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
        $('#submitAddDoc').on('click',function () {
            if ($('#formAddDoc').valid()) {
                let depDoc = $('#depDoc').val();
                let typeDoc = $('#typeDoc').val();
                let noticeAddDoc = $('#noticeAddDoc').val();
                let fromToDoc = $('#fromToDoc').val();

                let formData = new FormData();
                $.each($('#imgAddDoc')[0].files, function(key, value) {
                    formData.append('file[]', value);
                });
                formData.append('mainAjax','addDoc');
                formData.append('depDoc',depDoc);
                formData.append('typeDoc',typeDoc);
                formData.append('fromToDoc',fromToDoc);
                formData.append('datetimeStamp',datetimeStamp());
                formData.append('noticeAddDoc',noticeAddDoc);

                $.blockUI({
                    message: null,
                    onBlock: function() {
                        Swal.fire({
                            title: "Проверка, ожидайте!",
                            type: "info",
                            showConfirmButton: false
                        });
                    }
                });

                $.ajax({
                    url: urlOne, type: "POST", dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        Swal.close();
                        $.unblockUI();
                        console.log(data);
                        if(data.error===false){
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Не удается записать файл в базу!",
                                type: "warning"
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
