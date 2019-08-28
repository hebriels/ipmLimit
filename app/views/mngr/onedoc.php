<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Документ №
                <?php
                echo $oneDoc[0]['id'].', от <span style="color: #0b94ea;">'.$nameContragent.'</span>';
                echo ' дата '.date('j.m.Y H:i', strtotime($oneDoc[0]['dateAddDoc']));
                ?>
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <input type="hidden" id="idDoc" value="<?php echo $oneDoc[0]['id'];?>">
            <input type="hidden" id="userAvatar" value="<?php echo $defaultDownload['userPathAvatar'];?>">
            <input type="hidden" id="userName" value="<?php echo $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'];?>">
            <input type="hidden" id="getStatus" value="<?php echo $oneDoc[0]['status'];?>">
            <input type="hidden" id="themeAddDoc" value="<?php echo $oneDoc[0]['themeAddDoc'];?>">
            <input type="hidden" id="fileAddDoc" value="<?php echo $oneDoc[0]['fileAddDoc'];?>">
            <input type="hidden" id="userID" value="<?php echo $_SESSION['mngr']['id'];?>">
            <input type="hidden" id="depID" value="<?php echo $depID;?>">
            <input type="hidden" id="chargeUserID" value="<?php echo $oneDoc[0]['chargeUserID'];?>">
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <table data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="status" data-align="center">Статус</th>
                                <th data-field="themeDoc" data-align="center">Тема</th>
                                <th data-field="depDoc" data-align="center">Отдел</th>
                                <th data-field="chargUser" data-align="center">Ответчик</th>
                                <th data-field="notice" data-align="center">Примечание</th>
                                <th data-field="document" data-align="center">Документ</th>
                                <th data-field="access" data-align="center">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo getLabelStatus($oneDoc[0]['status']);?></td>
                            <td>
                                <?php
                                    foreach ($themeDoc as $tDoc) {
                                        if($oneDoc[0]['themeAddDoc']==$tDoc['id']){
                                            echo $tDoc['themeDoc'];
                                            $chargUserID = $tDoc['chargUser'];
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php $bossID = 0;
                                    foreach ($allDepartments as $dDoc) {
                                        if($depID==$dDoc['id']){
                                            echo $dDoc['nameDepartment'];
                                            $bossID = $dDoc['bossID'];
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    foreach ($allUsers as $user){
                                        if($user['id']==$oneDoc[0]['chargeUserID']){
                                            echo $user['userSurname'].' '.$user['userFirstName'];
                                        }
                                    }
                                ?>
                            </td>
                            <td><?php echo $oneDoc[0]['noticeAddDoc'];?></td>
                            <td>
                                <?php
                                    if(!empty($oneDoc[0]['fileAddDoc'])){
                                    echo getImageFolderDoc($oneDoc[0]['fileAddDoc']);
                                };?>
                            </td>
                            <td>
                                <div class="btn-group btn-group">
                                    <?php
                                        if($oneDoc[0]['signature'] == $_SESSION['mngr']['id'] && $oneDoc[0]['status']!='4.1') {
                                            if ($bossID == $_SESSION['mngr']['id'] && $oneDoc[0]['status']=='4') {
                                                echo '<button type="button"
                                                class="btn btn-outline-brand btn-icon btn-editDepOrTheme"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="Изменить отдел и(или) тематику">
                                                <i class="flaticon-share"></i></button>';
                                                echo '<button type="button" class="btn btn-outline-success btn-icon btn-editCharge"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="Назначить ответчика">
                                                <i class="flaticon2-avatar"></i></button>';
                                            }else{
                                                echo '<button type="button" class="btn btn-outline-success btn-icon btn-editCharge"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="Назначить ответчика">
                                                <i class="flaticon2-avatar"></i></button>';
                                            }
                                        }else{
                                            if ($chargeThemeDoc == $_SESSION['mngr']['id'] && $oneDoc[0]['status']=='4.1') {
                                                echo '<button type="button" class="btn btn-sm btn-outline-success btn-icon btn-successDoc"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="Принять документ">
                                                <i class="fas fa-thumbs-up"></i></button>';
                                                echo '<button type="button" class="btn btn-sm btn-outline-brand btn-icon btn-editDoc"
                                                data-toggle="popover" data-trigger="hover"
                                                data-placement="auto" data-content="На доработку">
                                                <i class="flaticon2-circular-arrow"></i></button>';
                                            }
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"> Ответочка </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <textarea id="summernote"><?php echo $oneDoc[0]['answerDoc'];?></textarea>
                </div>
                <?php
                    if($oneDoc[0]['signature'] == $_SESSION['mngr']['id'] && $oneDoc[0]['status']!='4.1') {
                        echo '<div class="kt-portlet__foot">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">
                                            <button type="button" class="btn btn-success" id="saveDocSubmit">Сохранить</button>
                                            <button type="button" class="btn btn-brand" id="docSubmit">Отправить на согласование</button>
                                        </div>
                                    </div>
                                </div>';
                    }else{
                        if ($chargeThemeDoc == $_SESSION['mngr']['id'] && $oneDoc[0]['status']=='4.1') {
                            echo '<div class="kt-portlet__foot">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">
                                            <button type="button" class="btn btn-success btn-successDoc">Принять документ</button>
                                            <button type="button" class="btn btn-brand btn-editDoc">На доработку</button>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                ?>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab_1" data-toggle="tab"> Комментарии </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_2" data-toggle="tab"> История </a>
                            </li>
                            <?php
                            $addCommPartner = explode(",",$addCommPartner);
                            $notPartners = false;
                            foreach ($addCommPartner as $item) {
                                if ($item == $_SESSION['mngr']['id']) {
                                    $notPartners = true;
                                }
                            }
                            if($notPartners==true):?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_4" data-toggle="tab"> Участники </a>
                                </li>
                            <?php endif;?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
                                    <!--<button class="kt-app__aside-close" id="kt_chat_aside_close">
                                        <i class="la la-close"></i>
                                    </button>-->
                                    <!--Begin:: App Content  kt-grid__item--fluid kt-app__content   -->
                                    <div class="kt-grid__item kt-app__aside--fit mr-3" style="min-width: 50%;" id="kt_chat_content">
                                        <div class="kt-chat">
                                            <div class="kt-portlet kt-portlet--head-lg- kt-portlet--last">
                                                <div class="kt-portlet__head">
                                                    <div class="kt-chat__head ">
                                                        <div class="kt-chat__left">
                                                            <span>Комментарии</span>
                                                        </div>
                                                        <div class="kt-chat__center">
                                                            <div class="kt-chat__pic commentPartners">
                                                                <?php
                                                                $arrPartners = explode(",",$getCommPartners[0]['idPartner']);
                                                                foreach ($arrPartners as $idPartner){
                                                                    foreach ($allUsers as $user){
                                                                        if($user['id']==$idPartner){
                                                                            echo '<span class="kt-userpic kt-userpic--sm kt-userpic--circle" data-toggle="kt-tooltip" data-placement="top" title="'.$user['userSurname'].' '.$user['userFirstName'].'" data-original-title="Tooltip title">
                                                                                    <img src="/assets/images/ava/'.$user['userAvatar'].'" alt="image">
                                                                                </span>';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="kt-chat__right">
                                                            <?php if($notPartners==true):?>
                                                            <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addPartner" data-idcontra="">
                                                                <i class="flaticon2-add-1"></i>
                                                            </a>
                                                            <?php endif;?>
                                                            <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addPartners" data-idcontra="">
                                                                <i class="flaticon-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body">
                                                    <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                                                        <div class="kt-chat__messages commentList">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__foot">
                                                    <div class="kt-chat__input" id="commentBan">
                                                        <div class="kt-chat__editor">
                                                            <textarea class="form-control todo-taskbody-taskdesc textTextarea" id="idTextareaComment" rows="4" placeholder="Сообщение ..."></textarea>
                                                        </div>
                                                        <div class="kt-chat__toolbar">
                                                            <!--<div class="kt_chat__tools">
                                                                <a href="#"><i class="flaticon2-link"></i></a>
                                                                <a href="#"><i class="flaticon2-photograph"></i></a>
                                                                <a href="#"><i class="flaticon2-photo-camera"></i></a>
                                                            </div>-->
                                                            <div class="kt_chat__actions">
                                                                <button type="button" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply btnEnterComment" data-typedoc="forDoc">Отправить</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="kt-timeline-v2">
                                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                                        <div class="kt-timeline-v2__item">
                                            <span class="kt-timeline-v2__item-time"><?php echo date('j.m.Y H:i', strtotime($oneDoc[0]['dateAddDoc']));?></span>
                                            <div class="kt-timeline-v2__item-cricle">
                                                <i class="fa fa-genderless kt-font-warning"></i>
                                            </div>
                                            <div class="kt-timeline-v2__item-text  kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                Регистратор
                                                <?php
                                                foreach ($allUsers as $user){
                                                    if($oneDoc[0]['userIDAddDoc']==$user['id']){
                                                        echo $user['userSurname'].' '.$user['userFirstName'];
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php if($oneDoc[0]['date_signature'] != ''):?>
                                            <?php $signature = json_decode($oneDoc[0]['date_signature']);
                                            foreach ($signature as $item):?>
                                                <div class="kt-timeline-v2__item">
                                                    <span class="kt-timeline-v2__item-time"><?php echo $item->date;?></span>
                                                    <div class="kt-timeline-v2__item-cricle">
                                                        <i class="fa fa-genderless kt-font-brand"></i>
                                                    </div>
                                                    <div class="kt-timeline-v2__item-text kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                        Подписан
                                                        <?php echo $item->autor;?>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                        <?php if($oneDoc[0]['date_success'] != ''):?>
                                            <div class="kt-timeline-v2__item">
                                                <span class="kt-timeline-v2__item-time"><?php echo $oneDoc[0]['date_success'];?></span>
                                                <div class="kt-timeline-v2__item-cricle">
                                                    <i class="fa fa-genderless kt-font-success"></i>
                                                </div>
                                                <div class="kt-timeline-v2__item-text kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                    Оплачен
                                                </div>
                                            </div>
                                        <?php endif;?>
                                        <?php if($oneDoc[0]['date_false'] != ''):?>
                                            <div class="kt-timeline-v2__item">
                                                <span class="kt-timeline-v2__item-time"><?php echo $oneDoc[0]['date_false'];?></span>
                                                <div class="kt-timeline-v2__item-cricle">
                                                    <i class="fa fa-genderless kt-font-success"></i>
                                                </div>
                                                <div class="kt-timeline-v2__item-text kt-padding-top-5 kt-timeline-v2__item-text--bold">
                                                    Отказано в подписании
                                                </div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <ul class="todo-task-history" id="commentPartners">
                                    <?php
                                    $arrPartners = explode(",",$getCommPartners[0]['idPartner']);
                                    foreach ($arrPartners as $idPartner){
                                        foreach ($allUsers as $user){
                                            if($user['id']==$idPartner){
                                                echo '<li><div class="todo-task-history-desc"> Участник - '.$user['userSurname'].' '.$user['userFirstName'].'</div></li>';
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                                <button class="btn btn-outline-success addPartner">Добавить участника</button>
                            </div>
                        </div>

                        <!-- .events-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно добавления участника -->
    <div class="modal fade" id="modalAddPartner" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавление участника</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectUser" class="col-form-label">Список работников:</label>
                        <select style="width: 100% !important;" class="form-control kt-select2" name="selectUser" id="selectUser"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddPartners">Применить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно изменения ответчика -->
    <div class="modal fade" id="modalEditCharge" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Изменение ответчика</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectUserForDep" class="col-form-label">Работники отдела:</label>
                        <select style="width: 100% !important;" class="form-control kt-select2" name="selectUserForDep" id="selectUserForDep"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveEditCharge">Применить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно изменения отдела и(или) тематики -->
    <div class="modal fade" id="modalEditDepOrTheme" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Изменение отдела и(или) тематики</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectEditDep" class="col-form-label">Отдел:</label>
                        <select class="form-control" id="selectEditDep">
                            <?php
                                foreach ($allDepartments as $oneDep){
                                    $selecteDep = '';
                                    if($oneDep['id']==$depID){
                                        $selecteDep = 'selected="selected"';
                                    }
                                    echo '<option value="' . $oneDep['id'] . '" '.$selecteDep.'>' . $oneDep['nameDepartment'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectEditTheme" class="col-form-label">Тематика:</label>
                        <select class="form-control" id="selectEditTheme">
                            <?php
                            foreach ($themeDoc as $oneTheme){
                                $selecteTheme = '';
                                if($oneTheme['id']==$oneDoc[0]['themeAddDoc']){
                                    $selecteTheme = 'selected="selected"';
                                }
                                echo '<option value="' . $oneTheme['id'] . '" '.$selecteTheme.'>' . $oneTheme['themeDoc'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveEditDepOrTheme">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php $allUsers = json_encode($allUsers);?>
<script src="/app/scriptPage/comments.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        let urlOne = '/ajax/ajaxpost';
        let idInvoice = $('#idDoc').val();
        let allUsers = <?php echo $allUsers;?>;
//проверка если нет ID в таблице partner, то добавляем
        $.ajax({
            url: urlOne, type: "POST", dataType: "text",
            data: "mainAjax=testPartner&idInvoice="+idInvoice+"&typeAdd=forDoc",
            success: function (data){}
        });
//изменение отдела и(или) тематики
        $('.btn-editDepOrTheme').on('click',function () {
            $('#modalEditDepOrTheme').modal('show');
        });
//принятие изменения отдела или тематики
        $('#saveEditDepOrTheme').on('click',function () {
            let idDoc = $('#idDoc').val();
            let selectEditDep = $('#selectEditDep').val();
            let selectEditTheme = $('#selectEditTheme').val();
            console.log(selectEditDep);
            console.log(selectEditTheme);
            $('#modalEditDepOrTheme').modal('hide');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=saveEditDepOrTheme&idDoc="+idDoc+"&selectEditDep="+selectEditDep+"&selectEditTheme="+selectEditTheme,
                success: function (data) {
                    let result = $.parseJSON(data);
                    Swal.fire({
                        title: "Изменения приняты",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    window.location = ('/mngr/onedoc/'+idDoc);
                }
            });
        });
//текст ответа
        //$('#summernote').summernote('code', '<?php echo $oneDoc[0]['answerDoc'];?>');
        $('#summernote').summernote({
            lang: 'ru-RU',
            placeholder: 'Текст ответа',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline']],
                ['font', ['superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['Insert', ['link']]
            ]
        });
//сохранить ответочку
        $('#saveDocSubmit').on('click',function () {
            saveDocSubmit('swal');
        });
        function saveDocSubmit(swal) {
            let saveDoc = $('#summernote').summernote('code');
            saveDoc = saveDoc.replace(/&nbsp;/gi,'');
            let idDoc = $('#idDoc').val();
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=saveDocAnswer&idDoc="+idDoc+"&saveDoc="+saveDoc,
                success: function (data) {
                    if(swal==='swal'){
                        Swal.fire({
                            title: "Изменения приняты",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                }
            });
        }
//изменить ответчика
        $('#selectUserForDep').select2({
            placeholder: "Выбрать пользователя"
        });
        $.each(allUsers,function(col,val) {
            if($('#depID').val()===val.userDepartment && val.adminUser!=='delete' && val.holiday!=='true'){
                let selectUserForDep = '\
                    <option value="'+val.id+'">'+val.userSurname+' '+val.userFirstName+'</option>';
                $('#selectUserForDep').append(selectUserForDep);
            }
        });
        $('.btn-editCharge').on('click',function () {
            $('#modalEditCharge').modal('show');
        });
//сохраняем смену ответчика
        $('#saveEditCharge').on('click',function () {
            let idDoc = $('#idDoc').val();
            let selectUserForDep = $('#selectUserForDep').val();
            let fileAddDoc = $('#fileAddDoc').val();
            $('#modalEditCharge').modal('hide');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=saveEditCharge&idDoc="+idDoc+"&selectUserForDep="+selectUserForDep+"&fileAddDoc="+fileAddDoc,
                success: function (data) {
                    let result = $.parseJSON(data);
                    Swal.fire({
                        title: "Изменения приняты",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    window.location = ('/mngr/onedoc/'+idDoc);
                }
            });
        });
//вызов модального окна добавления пользователя к комментам
        $('#selectUser').select2({
            placeholder: "Выбрать пользователя"
        });
        $('.addPartner').on('click',function () {
            $.each(allUsers,function(col,val) {
                let selectUsers = '\
                    <option value="'+val.id+'">'+val.userSurname+' '+val.userFirstName+'</option>';
                $('#selectUser').append(selectUsers);
            });
            $('#modalAddPartner').modal('show');
        });
//сохраняем добавленного пользователя
        $('#saveAddPartners').on('click',function () {
            let selectUser = $('#selectUser').val();
            $('#modalAddPartner').modal('hide');
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=addPartner&idInvoice="+idInvoice+"&selectUser="+selectUser+"&typeAdd=forDoc",
                success: function (data) {
                    let result = $.parseJSON(data);
                    $('#commentPartners').append('<li><div class="todo-task-history-desc"> Участник - '+result.userName+'</div></li>');
                    $('.commentPartners').append('<span class="kt-userpic kt-userpic--sm kt-userpic--circle" data-toggle="kt-tooltip" data-placement="top" title="'+result.userName+'" data-original-title="Tooltip title"><img src="/assets/images/ava/'+result.userAvatar+'" alt="image"></span>');
                }
            });
        });
//отправка на согласование
        $('#docSubmit').on('click',function () {
            saveDocSubmit('noswal');

            let idDoc = $('#idDoc').val();
            let themeAddDoc = $('#themeAddDoc').val();
            let fileAddDoc = $('#fileAddDoc').val();
            let status = '4.1';
            Swal.fire({
                title: "Желаете отправить документ на согласование?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=editStatusDoc&idDoc="+idDoc+"&status="+status+"&themeAddDoc="+themeAddDoc+"&fileAddDoc="+fileAddDoc,
                        success: function (data) {
                            window.location = ('/mngr/onedoc/'+idDoc);
                        }
                    });
                }
            });
        });
//принять документ
        $('.btn-successDoc').on('click',function () {
            let dateToday = datetimeToday();
            let idDoc = $('#idDoc').val();
            let fileAddDoc = $('#fileAddDoc').val();
            let chargeUserID = $('#chargeUserID').val();
            let status = '4.2';
            Swal.fire({
                title: "Вы принимаете документ?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=editStatusDoc&idDoc="+idDoc+"&status="+status+"&chargeUserID="+chargeUserID+"&fileAddDoc="+fileAddDoc+"&dateToday="+dateToday,
                        success: function (data) {
                            window.location = ('/mngr/onedoc/'+idDoc);
                        }
                    });
                }
            });
        });
//вернуть документ на доработку
        $('.btn-editDoc').on('click',function () {
            let idDoc = $('#idDoc').val();
            let fileAddDoc = $('#fileAddDoc').val();
            let chargeUserID = $('#chargeUserID').val();
            let status = '4';
            Swal.fire({
                title: "Вернуть документ на доработку?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    $.ajax({
                        url: urlOne, type: "POST", dataType: "text",
                        data: "mainAjax=editStatusDoc&idDoc="+idDoc+"&status="+status+"&chargeUserID="+chargeUserID+"&fileAddDoc="+fileAddDoc,
                        success: function (data) {
                            window.location = ('/mngr/onedoc/'+idDoc);
                        }
                    });
                }
            });
        });
    });
</script>
