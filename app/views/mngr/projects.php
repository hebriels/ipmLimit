<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Список проектов </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                    <h3 class="kt-portlet__head-title"> Все проекты <span id="summHeader"></span></h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions" id="addProjectBtn">
                        <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addProject" data-idcontra="">
                            <i class="flaticon2-add-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                $tableId = 'tableProject';

                $addEditContragent = explode(",",$addEditContragent);
                $editContragent = false;
                foreach ($addEditContragent as $itemContragent) {
                    if ($itemContragent == $_SESSION['mngr']['id']) {
                        $editContragent = true;
                    }
                }
                //символ валюты по умолчанию
                foreach ($defaultDownload['currency'] as $currenc){
                    if($defaultDownload['currencyGeneral']==$currenc['id']){
                        $thisCurrent = $currenc['simbolCurrency'];
                    }
                }
            ?>
            <div class="kt-portlet__body" data-tablename="tableProject">
                <div id="tableProjectToolbar" class="btn-group">
                    <div class="form-group form-md-checkboxes">
                        <div class="md-checkbox-inline">
                            <?php if($editContragent==true):?>
                                <div class="md-checkbox has-success">
                                    <button type="button" id="mergeProject" name="mergeProject" class="btn btn-default"
                                        data-toggle="popover" data-trigger="hover" data-placement="auto"
                                        data-content="Объединить выбранные">
                                        <i class="fas fa-code-branch"></i>Объединить
                                    </button>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tableProject" data-toggle="table" data-toolbar="#tableProjectToolbar"
                           class="table table-bordered table-hover table-striped table-sm"
                           data-sort-name="tableProject-date" data-sort-order="desc"
                           data-show-columns="true" data-search="true"
                           data-filter-control="true" data-filter-show-clear="true"
                           data-show-export="true" data-export-types="['xlsx','excel']"
                           data-pagination="true" data-page-size="25" data-page-list="[5, 25, 50, 100]"
                           data-select-item-name="selectItemName" data-hide-unused-select-options="true"
                           data-unique-id="tableProject-id"
                           data-cookie="true" data-cookie-id-table="tableProject">
                        <thead>
                        <tr>
                            <?php if($editContragent==true):?>
                                <th data-field="state" data-checkbox="true"></th>
                            <?php endif;?>
                            <th data-visible="false" data-field="tableProject-id" data-switchable="false"></th>
                            <th data-field="tableProject-date" data-align="center" data-sortable="true" data-sorter="dateSorter">Дата</th>
                            <th data-field="tableProject-nameProject" data-filter-control="input" data-align="center" data-sortable="true">Проект</th>
                            <th data-field="tableProject-contragent" data-filter-control="select" data-align="center">Покупатель</th>
                            <th data-field="tableProject-moneyProject" data-align="center" data-visible="false"><?php echo $thisCurrent;?> проект</th>
                            <th data-field="tableProject-money" data-align="center"><?php echo $thisCurrent;?> с допами</th>
                            <th data-field="tableProject-summ" data-align="center" data-sortable="true" data-sorter="priceSorter"><?php echo $thisCurrent;?> текущие</th>
                            <th data-field="tableProject-notice" data-align="center">Примечания</th>
                            <th data-field="tableProject-actions" data-align="center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($allProjects as $myData): ?>
                            <tr>
                                <?php if($editContragent==true):?>
                                    <td></td>
                                <?php endif;?>
                                <td><?php echo $myData['id'];?></td>
                                <td><?php echo $myData['dateCreate'];?></td>
                                <td>
                                    <?php
                                        if(!empty($allowedListUsers[0]['from_Statistic'])) {
                                        echo '<a href="javascript:void(0)" class="linkProject" data-idproject="'.$myData['id'].'" data-name="1" data-value="1">'.$myData['nameProject'].'</a>';
                                    }else{
                                        echo $myData['nameProject'];
                                    }?>
                                </td>
                                <td>
                                    <?php foreach ($allContragents as $contra){
                                        if ($contra['id'] == $myData['idContragent']) {
                                            if(!empty($allowedListUsers[0]['from_Statistic'])) {
                                                echo '<a href="javascript:;" class="linkContragent" data-idcontra="' . $contra['id'] . '">' . $contra['name_contragent'] . '</a>';
                                            }else{
                                                echo $contra['name_contragent'];
                                            }
                                        }
                                    }?>
                                    <?php $arrContr = ['']; foreach ($allContragents as $item){
                                        $arrContr[] = htmlspecialchars_decode ($item['name_contragent']);
                                    }?>
                                </td>
                                <td><?php

                                    if($myData['moneyProject']==''){
                                        $myData['moneyProject'] = 0;
                                    }

                                    $moneyPro = number_format($myData['moneyProject'], 2, '.', '&nbsp;');
                                    echo $moneyPro.'&nbsp;р.';?>
                                </td>
                                <td>
                                    <?php
                                        $moneySupp = 0;
                                    foreach ($allSuppProjects as $allSupp){
                                        if($allSupp['project_id']==$myData['id']){
                                            $moneySupp = $moneySupp+$allSupp['money_supp'];
                                        }
                                    }
                                    if($myData['moneyProject']==''){
                                        $myData['moneyProject'] = 0;
                                    }
                                    $moneySupp = $moneySupp+$myData['moneyProject'];
                                    $moneySupp = number_format($moneySupp, 2, '.', '&nbsp;');
                                    echo $moneySupp.'&nbsp;р.';?>
                                </td>
                                <td>
                                    <?php $summPlus = 0; $allSumPlus = []; foreach ($getAllInvoiceSuccess as $summProject){
                                        if($summProject['numberContract']==$myData['id']){
                                            $allSumPlus = $summPlus+$summProject['summInvoiceForPayment'];
                                            $summPlus = $summPlus+$summProject['summInvoiceForPayment'];
                                        }
                                    }
                                    if(!empty($allSumPlus)){
                                        $moneySum = number_format($allSumPlus, 2, '.', '&nbsp;');
                                        echo $moneySum.'&nbsp;р.';
                                    }else{
                                        echo '0&nbsp;р.';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $myData['notice_project']; ?></td>
                                <td>
                                    <div class="btn-group btn-group" role="group">
                                    <?php
                                        echo '<button type="button"
                                    class="btn btn-sm btn-outline-success btn-icon btn-editProject"
                                    id="editProject-'.$myData['id'].'" data-nameproject="'.htmlspecialchars($myData['nameProject']).'"
                                    data-noticeproject="'.$myData['notice_project'].'" data-contragent="'.$myData['idContragent'].'"
                                    data-moneyproject="'.$myData['moneyProject'].'" data-expenseproject="'.$myData['expenseProject'].'"
                                    data-selectedproject="'.$myData['selectedProject'].'" data-profitproject="'.$myData['profitProject'].'"
                                    data-idtable="'.$tableId.'" data-idproject="'.$myData['id'].'"
                                    data-toggle="popover" data-trigger="hover"
                                    data-placement="auto" title="Редактировать" data-content="Нажмите для редактирования проекта">
                                    <i class="fas fa-edit"></i></button>
                                        <button type="button"
                                    class="btn btn-sm btn-outline-primary btn-icon btn-suppProject"
                                    id="suppProject-'.$myData['id'].'" data-nameproject="'.htmlspecialchars($myData['nameProject']).'"
                                    data-idtable="'.$tableId.'" data-idproject="'.$myData['id'].'"
                                    data-toggle="popover" data-trigger="hover"
                                    data-placement="auto" title="Допы" data-content="Дополнение проекта">
                                    <i class="far fa-calendar-plus"></i></button>';
                                    $addFavor = ''; $deleteFavor = 'd-none';
                                    foreach ($getAllFavorites as $favor){
                                        if($favor['project_id']==$myData['id']){
                                            $addFavor = 'd-none';
                                            $deleteFavor = '';
                                        }
                                    }
                                    //if($deleteFavor!=''){
                                        echo '<button type="button"
                                        class="btn btn-sm btn-outline-success btn-icon btn-favorite '.$addFavor.'"
                                        id="favorite-'.$myData['id'].'" data-userid="'.$_SESSION['mngr']['id'].'"
                                        data-idtable="'.$tableId.'" data-idproject="'.$myData['id'].'"
                                        data-toggle="popover" data-trigger="hover"
                                        data-placement="auto" title="Избранное" data-content="Добавить в избранное">
                                        <i class="la la-eye"></i></button>';
                                    //}else{
                                        echo '<button type="button"
                                        class="btn btn-sm btn-outline-danger btn-icon btn-delFavorite '.$deleteFavor.'"
                                        id="delFavorite-'.$myData['id'].'" data-userid="'.$_SESSION['mngr']['id'].'"
                                        data-idtable="'.$tableId.'" data-idproject="'.$myData['id'].'"
                                        data-toggle="popover" data-trigger="hover"
                                        data-placement="auto" title="Избранное" data-content="Удалить из избранного">
                                        <i class="la la-eye-slash"></i></button>';
                                    //}
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
<!-- модальное окно редактирования проекта -->
    <div class="modal fade" id="modalEditProject" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактирование проекта</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if($editContragent==true):?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nameContragent" class="control-label">Покупатель
                                                <span class="required"> * </span>
                                            </label>
                                            <select id="nameContragent" style="width: 100% !important;" class="form-control kt-select2">
                                            </select>
                                        </div>
                                    </div>
                                <?php endif;?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nameProject" class="col-form-label">Наименование
                                            <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" id="nameProject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editMoneyProject" class="col-form-label">Сумма проекта
                                            <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" autocomplete="off" id="editMoneyProject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group divExpenseProject">
                                        <label for="editExpenseProject" class="col-form-label">Фиксированные траты</label>
                                        <input type="text" class="form-control" id="editExpenseProject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group divSelectedProject">
                                        <label for="editSelectedProject" class="control-label">Рентабельность</label>
                                        <select id="editSelectedProject" class="form-control">
                                            <option value="1">По умолчанию</option>
                                            <option value="2">Процент прибыли</option>
                                            <option value="3">Сумма прибыли</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group divProfitProject">
                                        <label for="editProfitProject" class="col-form-label">Значение рентабельности</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="editProfitProject" readonly value="<?php echo $profitInProject;?>">
                                            <span class="input-group-addon">
                                                <i id="editFaProfitProject" class="fas fa-percent"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="hiddenVisible col-md-12" id="profitChangeEdit">
                                    <p style="color: green;text-align: left; margin: 0px;">Значение рентабельности будет автоматически преобразовано в проценты.</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="noticeProject" class="col-form-label">Примечание:</label>
                                        <input type="text" class="form-control" id="noticeProject">
                                    </div>
                                </div>
                                <div class="hiddenVisible" id="validateDivProjectEdit">
                                    <p style="color: red;text-align: center;">Проверьте заполнение полей</p>
                                </div>
                                <div class="hiddenVisible" id="validateMoneyEdit">
                                    <p style="color: red;text-align: center;">Не корректная сумма проекта</p>
                                </div>
                                <div class="hiddenVisible" id="validateMoneyFixEdit">
                                    <p style="color: red;text-align: center;">Не корректная сумма фикс.траты</p>
                                </div>
                                <div class="hiddenVisible" id="validateProfitEdit">
                                    <p style="color: red;text-align: center;">Не корректное значение рентабельности</p>
                                </div>
                                <div class="hiddenVisible" id="validatePercentEdit">
                                    <p style="color: red;text-align: center;">Процент рентабельности должен быть от 0 до 100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idProject" id="idProject">
                    <input type="hidden" name="userID" id="userID" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveEditProject">Применить</button>
                </div>
            </div>
        </div>
    </div>
<!-- модальное окно дополнения проекта -->
    <div class="modal fade" id="modalSuppProject" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Дополнение проекта</h4>
                    <h5 class="modal-title" id="suppNameProject" style="color:blue;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered hiddenVisible" id="tableDops">
                                    <thead>
                                        <tr>
                                            <th> Дата </th>
                                            <th> Наименование </th>
                                            <th> Сумма </th>
                                            <th> Действие </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nameSupp" class="col-form-label">* Наименование</label>
                                        <input type="text" class="form-control" id="nameSupp">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="moneySupp" class="col-form-label">* Сумма проекта</label>
                                        <input type="text" class="form-control" autocomplete="off" id="moneySupp">
                                        <span id="errorMoney" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="hiddenVisible" id="validateSupp">
                                    <p style="color: red;text-align: center;">Проверьте заполнение полей</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idProjectSupp" id="idProjectSupp">
                    <input type="hidden" name="userIDSupp" id="userIDSupp" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveSuppProject">Применить</button>
                </div>
            </div>
        </div>
    </div>
<!-- модальное окно редактирования дополнения проекта -->
    <div class="modal fade" id="modalEditSupp" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование дополнения проекта</h4>
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
                                        <label for="nameSuppEdit" class="col-form-label">* Наименование</label>
                                        <input type="text" class="form-control" id="nameSuppEdit">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="moneySuppEdit" class="col-form-label">* Сумма проекта</label>
                                        <input type="text" class="form-control" autocomplete="off" id="moneySuppEdit">
                                        <span id="errorMoneyEdit" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="hiddenVisible" id="validateEditSupp">
                                    <p style="color: red;text-align: center;">Проверьте заполнение полей</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idEditSupp" id="idEditSupp">
                    <input type="hidden" name="userIDEditSupp" id="userIDEditSupp" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveEditSupp">Применить</button>
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
                                    <div class="form-group">
                                        <label for="nameContragentAdd" class="control-label">Покупатель
                                            <span style="color: red;"> * </span>
                                        </label>
                                        <select id="nameContragentAdd" style="width: 100% !important;" class="form-control kt-select2">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newNameProject" class="col-form-label">Наименование
                                            <span style="color: red;"> * </span>
                                        </label>
                                        <input type="text" class="form-control" id="newNameProject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="moneyProject" class="col-form-label">Сумма проекта
                                            <span style="color: red;"> * </span>
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
                                        <label for="profitProject">Значение рентабельности</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="profitProject" readonly value="<?php echo $profitInProject;?>">
                                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-percent" id="faProfitProject"></i></span></div>
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
                <div class="modal-footer">
                    <input type="hidden" name="idInitProject" id="idInitProject" value="<?php echo $_SESSION['mngr']['id'];?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddProject">Применить</button>
                </div>
            </div>
        </div>
    </div>
<!-- Окно объединения проектов -->
    <div class="modal fade" id="modalMergeProject" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Объединение проектов</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Выберите ключевой проект.</h5>
                    <table id="merge" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Выбор</th>
                            <th>Проект</th>
                            <th>Покупатель</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <h4>Управление допами проектов.</h4>
                    <h5><span style="color: red;">ВНИМАНИЕ!</span> Выбранные допы будут привязаны к проекту, остальные будут удалены.</h5>
                    <table id="mergeSupp" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Выбор</th>
                            <th>Наименование</th>
                            <th>Проект</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <p id="errorMerge" class="hiddenVisible" style="color: red;">Вы не выбрали основной проект</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="arrMergeProjectID" id="arrMergeProjectID" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveMergeProject">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $arrContr = json_encode($arrContr);
    $allContragents = json_encode($allContragents);
    $allSuppProjects = json_encode($allSuppProjects);
?>

<script>
    $(document).ready(function() {

        /*$('#tableProject3').DataTable( {
            scrollY:        200,
            scrollX:        true,
            scrollCollapse: true,
            scroller:       true,
            dom: 'Bfrtip',
            buttons: [
                'colvis',
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [  { text: 'High priority',   action: function () {} },
                        { text: 'Medium priority', action: function () {} },
                        { text: 'Low priority',    action: function () {} } ]
                }
            ]
        } );*/

        var tableIdAll = '<?php echo $tableId;?>';
        var allContragents = <?php echo $allContragents;?>;
        let arrContr = <?php echo $arrContr;?>;
        var allSuppProjects = <?php echo $allSuppProjects;?>;
        var urlOne = '/ajax/ajaxpost';
        //$('#'+tableIdAll).bootstrapTable("setSelect2Data", "tableProject-contragent", ['item 1', 'item 2', 'item 3']);
        $('#'+tableIdAll).bootstrapTable("setSelect2Data", "tableProject-contragent", arrContr);

//объединение
        $('#mergeProject').on('click',function () {
            $('#merge tbody').empty();
            $('#mergeSupp tbody').empty();
            var index = [];
            var arrayProject = [];
            var selectRow = $('input[name="selectItemName"]:checked');
            if(selectRow.length!==0 && selectRow.length!==1){
                Swal.fire({
                    title: "Перейти к объединению?",
                    text: "Желаете объединить выбранные проекты?",
                    type: "info",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    cancelButtonText: "Отмена",
                    confirmButtonText: "Да"
                }).then((isConfirm)=>{
                    if (isConfirm.value) {
                        selectRow.each(function () {
                            index.push($(this).data('index'));
                            arrayProject = JSON.stringify($('#'+tableIdAll).bootstrapTable('getAllSelections'));
                        });
                        arrayProject = $.parseJSON(arrayProject);
                        //console.log(arrayProject);

                        var output = [];
                        var output2 = [];
                        var allMergeID = [];
                        var moneySum = 0;
                        for (var i = 0;i<arrayProject.length;i++){
                            moneySum = String(arrayProject[i][tableIdAll + '-summ']);
                            moneySum = moneySum.replace(/&nbsp;/g, ' ');
                            allMergeID.push({"id": arrayProject[i][tableIdAll + '-id']});
                            output +=
                                '<tr>'+
                                '<td><input type="checkbox" class="checkMerge" value="'+arrayProject[i][tableIdAll + '-id']+'"></td>'+
                                '<td>'+arrayProject[i][tableIdAll + '-nameProject']+'</td>'+
                                '<td>'+arrayProject[i][tableIdAll + '-contragent']+'</td>'+
                                '<td>'+arrayProject[i][tableIdAll + '-moneyProject']+'</td>'+
                                '</tr>';
                            for(var x = 0;x<allSuppProjects.length;x++){
                                //console.log(allSuppProjects);
                                if(allSuppProjects[x]['project_id']===arrayProject[i][tableIdAll + '-id']){
                                    output2 +=
                                        '<tr>'+
                                        '<td><input type="checkbox" data-index="'+allSuppProjects[x]['id']+'" class="checkMergeSupp" value="'+allSuppProjects[x]['id']+'"></td>'+
                                        '<td>'+allSuppProjects[x]['name_supp']+'</td>'+
                                        '<td>'+arrayProject[i][tableIdAll + '-nameProject']+'</td>'+
                                        '<td>'+allSuppProjects[x]['money_supp']+'</td>'+
                                        '</tr>';
                                }

                            }
                        }
                        $('#merge').find('tbody').append(output);
                        $('#mergeSupp').find('tbody').append(output2);
                        //allMergeID = $.parseJSON(allMergeID);
                        //console.log(JSON.stringify(allMergeID));
                        $('#arrMergeProjectID').val(JSON.stringify(allMergeID));
                        $('#modalMergeProject').modal('show');
                    }
                });

            }else{
                Swal.fire({
                    title: "Ой",
                    text: "Не выбраны проекты для объединения",
                    type: "info"
                });
            }
        });
//закрыть все чекбоксы кроме текущего
        $('body').on('click','.checkMerge',function () {
            $('.checkMerge').not(this).attr('checked', false);
        });
//сохранить объединение проектов
        $('#saveMergeProject').on('click',function () {
            if ($('.checkMerge').is(':checked')) {
                $('#modalMergeProject').modal('hide');
                Swal.fire({
                    title: "При объединении проектов допы, которые не были выбраны будут безвозвратно удалены. Продолжить?",
                    //text: "Желаете объединить выбранные проекты?",
                    type: "info",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    cancelButtonText: "Отмена",
                    confirmButtonText: "Да"
                }).then((isConfirm)=>{
                    if (isConfirm.value) {
                        var idMerge = $('.checkMerge:checkbox:checked').val();
                        var idMergeSupp = [];
                        var i = 0;
                        $('.checkMergeSupp:checkbox:checked').each(function(){
                            idMergeSupp[i] = $(this).val();
                            i++;
                        });
                        var arrMergeID = $('#arrMergeProjectID').val();
                        //console.log(idMerge);
                        //console.log(idMergeSupp);
                        $.ajax({
                            url: urlOne, type: "POST", dataType: "text",
                            data: "mainAjax=mergeProjects&idMerge=" + idMerge + "&arrMergeID=" + arrMergeID+"&idMergeSupp="+idMergeSupp,
                            success: function (data) {
                                //var result = $.parseJSON(data);
                                //console.log(result);
                                window.location = ('/mngr/projects');
                            }
                        });
                    }else{
                        $('#modalMergeProject').modal('show');
                    }
                })
            } else {
                $('#errorMerge').removeClass('hiddenVisible');
            }
        });
//расчет итого:

        function insertTotal() {
            var getDataTable = $('#'+tableIdAll).bootstrapTable('getData');
            var countLength = getDataTable.length;
            var sumArrTD=0;
            //console.log(getDataTable);
            for(var i = 0;i<countLength;i++){
                var parseSummInTable = String(getDataTable[i]['tableProject-summ']).replace(/&nbsp;/g, '');
                sumArrTD = sumArrTD + + (parseFloat(parseSummInTable));
            }
            sumArrTD = sumArrTD.toFixed(2);
            sumArrTD = String(sumArrTD).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');
            var appArrTD = ' на сумму: <span id="totalTable" class="summToTotal">'+sumArrTD+'&nbspр.</span>';
            //$('th[data-field="tableProject-summ"]').find('.no-filter-control').append(appArrTD);
            if($('body #summFooter').length === 0){
                $('.pagination-detail').after('<div class="pull-right pagination" id="summFooter"><span class="pagination-info summToTotal">'+sumArrTD+'&nbspр.</span></div>');
            }
            $('#summHeader').html(appArrTD);
        }
        insertTotal('tableProject');

        $('table').on('all.bs.table', function () { //popover при фильтрации таблицы
            $('[data-toggle="popover"]').popover();
            $('#totalTable').remove();
            insertTotal();
        });

        $('.btn-circle-filter').find(':first').text('Все'); //найти все селекты и поставить в первый option text ВСЕ
        $('.keep-open').find('input').on('click', function () { //перезагрузка при сокрытии полей
            $('.btn-circle-filter').find(':first').text('Все');
        });
//модальное окно добавления проекта
        $('#nameContragentAdd').select2({
            placeholder: "Выбрать контрагента"
        });
        $('body').on('click','.addProject', function () {
            $.each(allContragents,function(col,val) {
                var selectContragents = '\
                    <option value="'+val.id+'">'+val.name_contragent+'</option>';
                $('#nameContragentAdd').append(selectContragents);
            });
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
//Проверяем свою организацию
        $('#nameContragent').change(function () {
            var idContragent = $('#nameContragent').val();
            ajaxContragent(idContragent);
        });
        $('#nameContragentAdd').change(function () {
            var idContragent = $('#nameContragentAdd').val();
            ajaxContragent(idContragent);
        });
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

        $('#editSelectedProject').change(function () {
            var valSelectedProject = $('#editSelectedProject').val();
            if(valSelectedProject==='1'){ //по умолчанию
                $('#editFaProfitProject').removeClass('fa-ruble-sign').addClass('fa-percent');
                $('#editProfitProject').val('<?php echo $profitInProject;?>').prop('readonly',true);
                $('#profitChangeEdit').addClass('hiddenVisible');
            }else if(valSelectedProject==='2'){ //проценты
                $('#editFaProfitProject').removeClass('fa-ruble-sign').addClass('fa-percent');
                $('#editProfitProject').val('').prop('readonly',false);
                $('#profitChangeEdit').addClass('hiddenVisible');
            }else if(valSelectedProject==='3'){ //сумма
                $('#editFaProfitProject').removeClass('fa-percent').addClass('fa-ruble-sign');
                $('#editProfitProject').val('').prop('readonly',false);
                $('#profitChangeEdit').removeClass('hiddenVisible');
            }
        });
        function datetimeStamp() {
            var timezone = '<?php echo $defaultDownload['timezone'];?>';
            return moment().utcOffset(timezone).format('YYYY-MM-DD HH:mm:ss');
        }
//сохраняем проект
        $('#saveAddProject').on('click',function () {
            var profitInProject = parseInt('<?php echo $profitInProject;?>');
            var newNameProject = $('#newNameProject').val();
            var newNoticeProject = $('#newNoticeProject').val();
            var idContragent = $('#nameContragentAdd').val();
            var idInitProject = $('#idInitProject').val();
            var moneyProject = $('#moneyProject').val();
            var expenseProject = $('#expenseProject').val();
            var selectedProject = $('#selectedProject').val();
            var profitProject = $('#profitProject').val();
            var dateTime = datetimeStamp();
            //2.3.
            var notPercent = true;
            var notValidProfit = true;
            switch (selectedProject){
                case '2':
                    if(profitProject>100 || profitProject<0){notPercent = false;}
                    if(profitProject<profitInProject){notValidProfit = false;}
                    break;
                case '3':
                    let minSumm = (moneyProject/100)*profitInProject; //минимальная сумма прибыли проекта
                    if(profitProject<minSumm){notValidProfit = false;}
                    profitProject = (profitProject/moneyProject)*100;
                    profitProject = profitProject.toFixed(2);
                    break;
            }
            //console.log(profitProject);
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
                                    window.location = ('/mngr/projects');
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
                        data: "mainAjax=insertProject&newNameProject="+newNameProject+"&newNoticeProject="+newNoticeProject+"&idContragent="+idContragent+"&idInitProject="+idInitProject+"&moneyProject="+moneyProject+"&expenseProject="+expenseProject+"&selectedProject="+selectedProject+"&profitProject="+profitProject+"&dateTime="+dateTime,
                        success: function (data) {
                            window.location = ('/mngr/projects');
                        }
                    });
                }
            }
        });
//модальное окно редактирования проекта
        $('#nameContragent').select2({
            placeholder: "Выбрать контрагента"
        });
        $('body').on('click','.btn-editProject', function () {
            $('#nameProject').val($(this).data('nameproject'));
            var idContra = $(this).data('contragent');
            ajaxContragent(idContra);
            var selectedContra = '';
            $.each(allContragents,function(col,val) {
                if(val.id == idContra){selectedContra = 'selected="selected"';}else{selectedContra = '';}
                var selectContragents = '\
                    <option value="'+val.id+'" '+selectedContra+'>'+val.name_contragent+'</option>';
                $('#nameContragent').append(selectContragents);
            });
            $('#noticeProject').val($(this).data('noticeproject'));
            $('#editMoneyProject').val($(this).data('moneyproject'));
            $('#editExpenseProject').val($(this).data('expenseproject'));
            var editSelected = $(this).data('selectedproject');
            $('#editSelectedProject').val(editSelected);
            $('#idProject').val($(this).data('idproject'));

            if(editSelected===1){ //по умолчанию
                $('#editFaProfitProject').removeClass('fa-ruble-sign').addClass('fa-percent');
                $('#editProfitProject').val('<?php echo $profitInProject;?>').prop('readonly',true);
            }else if(editSelected===2){ //проценты
                $('#editFaProfitProject').removeClass('fa-ruble-sign').addClass('fa-percent');
                $('#editProfitProject').val('').prop('readonly',false);
            }else if(editSelected===3){ //сумма
                $('#editFaProfitProject').removeClass('fa-percent').addClass('fa-ruble-sign');
                $('#editProfitProject').val('').prop('readonly',false);
            }
            $('#editProfitProject').val($(this).data('profitproject'));
            $('#modalEditProject').modal('show');
        });
//модальное окно дополнения проекта
        $('body').on('click','.btn-suppProject', function () {
            $('#suppNameProject').text($(this).data('nameproject'));
            var idproject = $(this).data('idproject');
            $('#idProjectSupp').val(idproject);
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=dataTableDops&idProject="+idproject,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if(result.getSuppProject.length>0){
                        $('#tableDops tbody').empty();
                        $('#tableDops').removeClass('hiddenVisible');
                        var userID = '<?php echo $_SESSION['mngr']['id'];?>';
                        var btnEdit = '';
                        var btnDelet = '';
                        $.each(result.getSuppProject,function(col,val) {
                            //console.log(val.dateCreate);
                            var money = String(val.money_supp).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ') + ' р.';
                            if(val.initiator_supp===userID){
                                btnEdit = '<button type="button" class="btn btn-xs btn-outline green-jungle btn-editProjectSupp" '+
                                    'data-namesupp="'+val.name_supp+'" data-moneysupp="'+val.money_supp+'" '+
                                    'data-idsupp="'+val.id+'" data-toggle="popover" data-trigger="hover"\n' +
                                    'data-placement="auto" title="Редактировать" data-content="Нажмите для редактирования допа">\n' +
                                    '<i class="fas fa-edit"></i></button>';
                                btnDelet = '<button type="button" class="btn btn-xs btn-outline red btn-deleteProjectSupp" '+
                                    'data-idsupp="'+val.id+'" data-toggle="popover" data-trigger="hover"\n' +
                                    'data-placement="auto" title="Удалить" data-content="Нажмите для удаления допа">\n' +
                                    '<i class="fas fa-trash-alt"></i></button>';
                            }else{
                                btnEdit = '';
                                btnDelet = '';
                            }
                            var output = '<tr>'+
                                '<td>'+val.dateCreate+'</td>'+
                                '<td>'+val.name_supp+'</td>'+
                                '<td>'+money+'</td>'+
                                '<td>'+btnEdit+btnDelet+'</td>'+
                                '</tr>';
                            $('#tableDops tbody').append(output);
                        });
                    }else{
                        $('#tableDops tbody').empty();
                        $('#tableDops').addClass('hiddenVisible');
                    }
                }
            });
            $('#modalSuppProject').modal('show');
        });

        $('body').on('click','.btn-editProjectSupp',function () {
            $('#modalSuppProject').modal('hide');
            $('#idEditSupp').val($(this).data('idsupp'));
            $('#nameSuppEdit').val($(this).data('namesupp'));
            $('#moneySuppEdit').val($(this).data('moneysupp'));
            $('#modalEditSupp').modal('show');
        });

        $('body').on('click','.btn-deleteProjectSupp',function () {
            var idSupp = $(this).data('idsupp');
            $('#modalSuppProject').modal('hide');
            Swal.fire({
                title: "Вы желаете удалить доп?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: true
            }).then((isConfirm)=>{
                if (isConfirm.value) {
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=deletSuppProject&idSupp="+idSupp,
                        success: function (data) {
                            window.location = ('/mngr/projects');
                        }
                    });
                }else{
                    $('#modalSuppProject').modal('show');
                }
            })
        });
//сохранение дополнения проекта
        $('#saveSuppProject').on('click',function () {
            var nameSupp = $('#nameSupp').val();
            var dateTime = datetimeStamp();
            var moneySupp = $('#moneySupp').val();
            var idProjectSupp = $('#idProjectSupp').val();
            var userIDSupp = $('#userIDSupp').val();
            if(nameSupp.length<1 || moneySupp.length<1){
                $('body #errorMoney').text('Заполните все поля!');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(moneySupp)) {
                $('body #errorMoney').text('Не корректная сумма!');
            }else{
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=insertSuppProject&userID="+userIDSupp+"&idProject="+idProjectSupp+"&nameSupp="+nameSupp+"&moneySupp="+moneySupp+"&dateTime="+dateTime,
                    success: function (data) {
                        window.location = ('/mngr/projects');
                    }
                });
            }
        });
//сохранение редактирования дополнения проекта
        $('#saveEditSupp').on('click',function () {
            var nameSuppEdit = $('#nameSuppEdit').val()
            var moneySuppEdit = $('#moneySuppEdit').val();
            var idEditSupp = $('#idEditSupp').val();
            var userIDEditSupp = $('#userIDEditSupp').val();
            if(nameSuppEdit.length<1 || moneySuppEdit.length<1){
                $('body #errorMoneyEdit').text('Заполните все поля!');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(moneySuppEdit)) {
                $('body #errorMoneyEdit').text('Не корректная сумма!');
            }else{
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=editSuppProject&userID="+userIDEditSupp+"&idEditSupp="+idEditSupp+"&nameSupp="+nameSuppEdit+"&moneySupp="+moneySuppEdit,
                    success: function (data) {
                        window.location = ('/mngr/projects');
                    }
                });
            }
        });

        $('body').on('click','.btn-favorite', function () {
            var userID = $(this).data('userid');
            var idProject = $(this).data('idproject');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=insertFavorite&userID="+userID+"&idProject="+idProject,
                success: function (data) {
                    //var result = $.parseJSON(data);
                    //console.log(result);

                    //$('#favorite-'+idProject).addClass('hiddenVisible');
                    $('#favorite-'+idProject).addClass('d-none');
                    //$('#delFavorite-'+idProject).removeClass('hiddenVisible');
                    $('#delFavorite-'+idProject).removeClass('d-none');
                }
            });
        });

        $('body').on('click','.btn-delFavorite', function () {
            var userID = $(this).data('userid');
            var idProject = $(this).data('idproject');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=deleteFavorite&userID="+userID+"&idProject="+idProject,
                success: function (data) {
                    //$('#favorite-'+idProject).removeClass('hiddenVisible');
                    //$('#delFavorite-'+idProject).addClass('hiddenVisible');
                    $('#favorite-'+idProject).removeClass('d-none');
                    $('#delFavorite-'+idProject).addClass('d-none');
                }
            });
        });
//сохранение редактирования проекта
        $('#saveEditProject').on('click',function () {
            var profitInProject = parseInt('<?php echo $profitInProject;?>');
            var nameContragent = $('#nameContragent').val();
            var nameProject = $('#nameProject').val();
            var editMoneyProject = $('#editMoneyProject').val();
            var editExpenseProject = $('#editExpenseProject').val();
            var editSelectedProject = $('#editSelectedProject').val();
            var editProfitProject = $('#editProfitProject').val();
            var noticeProject = $('#noticeProject').val();
            var idProject = $('#idProject').val();
            var userID = $('#userID').val();
            var dateTime = datetimeStamp();

            var notPercent = true;
            var notValidProfit = true;
            switch (editSelectedProject){
                case '2':
                    if(editProfitProject>100 || editProfitProject<0){notPercent = false;}
                    if(editProfitProject<profitInProject){notValidProfit = false;}
                    break;
                case '3':
                    var minSumm = (editMoneyProject/100)*profitInProject; //минимальная сумма прибыли проекта
                    if(editProfitProject<minSumm){notValidProfit = false;}
                    editProfitProject = (editProfitProject/editMoneyProject)*100;
                    editProfitProject = editProfitProject.toFixed(2);
                    break;
            }

            if(nameProject.length<1 || editMoneyProject.length<1) {
                $('#validateDivProjectEdit').removeClass('hiddenVisible');
                $('#validateMoneyEdit,#validateProfitEdit,#validatePercentEdit,#validateMoneyFixEdit').addClass('hiddenVisible');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(editMoneyProject)) {
                $('#validateDivProjectEdit,#validateProfitEdit,#validatePercentEdit,#validateMoneyFixEdit').addClass('hiddenVisible');
                $('#validateMoneyEdit').removeClass('hiddenVisible');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(editProfitProject)) {
                $('#validateDivProjectEdit,#validateMoneyEdit,#validatePercentEdit,#validateMoneyFixEdit').addClass('hiddenVisible');
                $('#validateProfitEdit').removeClass('hiddenVisible');
            }else if(!/^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(editExpenseProject)){
                $('#validateDivProjectEdit,#validateMoneyEdit,#validatePercentEdit,#validateProfitEdit').addClass('hiddenVisible');
                $('#validateMoneyFixEdit').removeClass('hiddenVisible');
            }else if(notPercent===false){
                $('#validateDivProjectEdit,#validateMoneyEdit,#validateProfitEdit,#validateMoneyFixEdit').addClass('hiddenVisible');
                $('#validatePercentEdit').removeClass('hiddenVisible');
            }else{
                if(editSelectedProject==='3'){
                    editSelectedProject='2';
                }
                if(notValidProfit===false){
                    $('#modalEditProject').modal('hide');
                    Swal.fire({
                        title: "Внимание! Значение рентабельности по умолчанию "+profitInProject+"%, установленное вами значение может быть убыточным.",
                        type: "warning",
                        allowOutsideClick: true,
                        showCancelButton: true,
                        cancelButtonText: "Отмена",
                        confirmButtonText: "Принять"
                    }).then((isConfirm)=>{
                        if (isConfirm.value) {
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "mainAjax=updateProject&nameProject="+nameProject+"&nameContragent="+nameContragent+"&noticeProject="+noticeProject+
                                "&idProject="+idProject+"&userID="+userID+"&editMoneyProject="+editMoneyProject+"&editExpenseProject="+editExpenseProject+
                                "&editSelectedProject="+editSelectedProject+"&editProfitProject="+editProfitProject+"&dateTime="+dateTime,
                                success: function (data) {
                                    window.location = ('/mngr/projects');
                                }
                            });
                        }else{
                            $('#modalEditProject').modal('show');
                        }
                    })
                }else{
                    $('#modalEditProject').modal('hide');
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=updateProject&nameProject="+nameProject+"&nameContragent="+nameContragent+"&noticeProject="+noticeProject+
                        "&idProject="+idProject+"&userID="+userID+"&editMoneyProject="+editMoneyProject+"&editExpenseProject="+editExpenseProject+
                        "&editSelectedProject="+editSelectedProject+"&editProfitProject="+editProfitProject+"&dateTime="+dateTime,
                        success: function (data) {
                            window.location = ('/mngr/projects');
                        }
                    });
                }
            }


        });

//переход в аналитику
        $('body').on('click','.linkProject',function () {
            var idProject = $(this).data('idproject');
            window.open ('/mngr/analitics/project'+idProject);
        });
        $('body').on('click','.linkContragent',function () {
            var idContra = $(this).data('idcontra');
            window.open ('/mngr/analitics/contragent'+idContra);
        });
    });
</script>