<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Система оповещения пользователей </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="flaticon2-mail-1"></i></span>
                    <h3 class="kt-portlet__head-title"> Настройка сообщения </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label for="themeAlertUsers"><span style="color: red;">*</span> Тема</label>
                    <input type="text" class="form-control" id="themeAlertUsers" name="themeAlertUsers">
                </div>
                <div class="form-group">
                    <label for="messageAlertUsers"><span style="color: red;">*</span> Сообщение</label>
                    <textarea type="text" class="form-control" id="messageAlertUsers" name="messageAlertUsers" placeholder="Ваше сообщение ..."></textarea>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="flaticon2-gear"></i></span>
                    <h3 class="kt-portlet__head-title"> Фильтр получателей </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="selectDep">Выбор по отделам</label>
                            <select class="form-control" id="selectDep" multiple data-live-search="true"></select>
                        </div>
                        <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectDep">Все отделы</button>
                        <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectDep">Очистить отделы</button>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="selectUsers">Выбор по пользователям</label>
                            <select class="form-control" id="selectUsers" multiple data-live-search="true"></select>
                        </div>
                        <button type="button" class="btn btn-success kt-btn allSelect" data-selectid="selectUsers">Все пользователи</button>
                        <button type="button" class="btn btn-danger kt-btn allDeselect" data-selectid="selectUsers">Очистить пользователей</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="kt-section">
                        <span class="kt-section__info"><span style="color: red;">*</span> Список рассылки:</span>
                        <div class="kt-section__content kt-section__content--solid">
                            <p><span id="listEmails"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <input type="hidden" id="sendMessageList">
                <button type="button" class="btn btn-outline-brand kt-btn" id="sendMessage">Отправить письмо</button>
            </div>
        </div>
    </div>
</div>
<?php
    $managers = json_encode($managers);
    $allDepartments = json_encode($allDepartments);
?>
<script>
    $(document).ready(function() {
        let urlOne = '/ajax/ajaxpost';

        let allDepartments = <?php echo $allDepartments;?>;
        $.each(allDepartments,function(col,val) {
            let selectDep = '<option value="'+val.id+'">'+val.nameDepartment+'</option>';
            $('#selectDep').append(selectDep);
        });
        $('#selectDep').selectpicker('refresh');

        $('.allSelect').on('click',function () {
            let selectID = $(this).data('selectid');
            $('#'+selectID).selectpicker('selectAll');
        });
        $('.allDeselect').on('click',function () {
            let selectID = $(this).data('selectid');
            $('#'+selectID).selectpicker('deselectAll');
        });

        let allUsers = <?php echo $managers;?>;
        selectedUsers();
        function selectedUsers() {
            $.each(allUsers,function(col,val) {
                let selectUsers = '<option value="'+val.id+'">'+val.userFirstName+' '+val.userSurname+'</option>';
                $('#selectUsers').append(selectUsers);
            });
            $('#selectUsers').selectpicker('refresh');
        }


        //console.log(allDepartments);
        //console.log(allUsers);
        $('.dropdown-menu').css('z-index','100');

        $('#selectDep').on('change', function(value){
            let selectedID = $(this).val();
            $('#selectUsers').empty();
            if(selectedID.length<1){
                selectedUsers();
            }else {
                for (let o of selectedID) {
                    $.each(allUsers, function (col, val) {
                        if (val.userDepartment === o) {
                            let selectUsers = '<option value="' + val.id + '" selected="selected">' + val.userFirstName + ' ' + val.userSurname + '</option>';
                            $('#selectUsers').append(selectUsers);
                        }
                    });
                }
                $('#selectUsers').selectpicker('refresh');
            }
            listUsersSendDep();
        });

        $('#selectUsers').on('change', function(value){
            let selectedID = $(this).val();
            listUsersSendDep();
        });
        
        function listUsersSendDep() {
            let selectedUsersID = $('#selectUsers').val();
            //console.log(selectedUsersID);
            $('#sendMessageList').val('');
            $('#listEmails').empty();

            for (let userID of selectedUsersID) {
                $.each(allUsers, function (col, val) {
                    if (userID === val.id) {
                        let emailUsersSend = [val.userMail];
                        $('#sendMessageList').val(function() {
                            return this.value + emailUsersSend+',';
                        });
                        let emailUsers = '<span class="col-md-3">(' + val.userFirstName + ' ' + val.userSurname + ' - '+val.userMail+')</span>';
                        $('#listEmails').append(emailUsers);
                    }
                });
            }

        }

        $('#sendMessage').on('click',function () {
            let themeAlertUsers = $('#themeAlertUsers').val();
            let messageAlertUsers = $('#messageAlertUsers').val();
            let selectedUsersID = $('#sendMessageList').val().replace(/,\s*$/, "");
            console.log(messageAlertUsers);
            if(themeAlertUsers.length<1 || messageAlertUsers.length<1){
                Swal.fire({
                    title: "Необходимо заполнить тему и сообщение!",
                    type: "info"
                });
            }else if(selectedUsersID.length<1){
                Swal.fire({
                    title: "Список рассылки пуст!",
                    type: "info"
                });
            }else{
                Swal.fire({
                    title: "Отправить письмо?",
                    type: "info",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Отмена",
                    confirmButtonText: "Да"
                }).then((isConfirm) => {
                    if(isConfirm.value){
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
                            url: urlOne, type: 'POST', dataType: "text",
                            data: "mainAjax=listUsersSend&themeAlertUsers="+themeAlertUsers+"&messageAlertUsers="+messageAlertUsers+"&selectedUsersID="+selectedUsersID,
                            success: function(data) {
                                console.log(data);
                                let result = $.parseJSON(data);
                                if(result.resultSend){
                                    Swal.close();
                                    $.unblockUI();
                                    Swal.fire({
                                        title: "Успешная отправка!",
                                        type: "success",
                                        showConfirmButton: false
                                    });
                                }else{
                                    Swal.close();
                                    $.unblockUI();
                                    Swal.fire({
                                        title: "Ошибка!",
                                        text: "Свяжитесь с администратором!",
                                        type: "warning",
                                        showConfirmButton: false
                                    });
                                }

                            }
                        });
                    }
                })
            }
        });
//Функция получения текущей даты и времени
        function datetimeToday() {
            return moment().format('DD.MM.YYYY');
        }


    });
</script>