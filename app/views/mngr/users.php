<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Управление пользователями </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                            <h3 class="kt-portlet__head-title"> Список пользователей </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div id="tableUserToolbar" class="btn-group">
                            <div class="form-group form-md-checkboxes">
                                <div class="md-checkbox-inline">
                                    <div class="md-checkbox has-success">
                                        <button type="button" id="addUser" name="addUser" class="btn btn-default">
                                            <i class="fas fa-user-plus"></i> Добавить пользователя</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="tableUser" data-toolbar="#tableUserToolbar"
                                data-sort-name="fio" data-sort-order="asc"
                                data-toggle="table" data-mobile-responsive="true"
                                data-pagination="true" data-page-size="25" data-page-list="[5, 10, 15, 20, 25, 30]"
                                data-show-columns="true" data-search="true"
                                data-cookie="true" data-cookie-id-table="tableUser">
                            <thead>
                            <tr>
                                <th data-field="fio" data-align="center" data-sortable="true">Пользователь</th>
                                <th data-field="statusjob" data-align="center" data-sortable="true">Статус</th>
                                <th data-field="department" data-align="center" data-sortable="true">Отдел</th>
                                <th data-field="initiator" data-align="center" data-sortable="true">Должность</th>
                                <th data-field="phonejob" data-align="center">Тел. рабочий</th>
                                <th data-field="phonehome" data-align="center">Тел. личный</th>
                                <th data-field="email" data-align="center">Email</th>
                                <th data-field="skype" data-align="center">Скайп</th>
                                <th data-field="pass" data-align="center">Пароль</th>
                                <th data-field="datareg" data-align="center" data-sortable="true">Дата рег.</th>
                                <th data-field="actions" data-align="center">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($managers as $manager): ?>
                                <?php
                                    if($manager['adminUser']!='delete'){
                                        $jobUser = 'Работает';
                                        $classTR = '';
                                    }else{
                                        $jobUser = 'Уволен';
                                        $classTR = 'warning text-danger';
                                    }
                                ?>
                                <tr class="<?php echo $classTR;?>">
                                    <td><?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName']; ?></td>
                                    <td><?php echo $jobUser;?></td>
                                    <td>
                                        <?php foreach ($allDepartments as $depart){
                                            if($manager['userDepartment'] == $depart['id']){
                                                echo $depart['nameDepartment'];
                                            }
                                        };?>
                                    </td>
                                    <td>
                                        <?php foreach ($allPosts as $posts){
                                            if($manager['userRole'] == $posts['id']){
                                                echo $posts['postDepartment'];
                                            }
                                        };?>
                                    </td>
                                    <td><?php echo $manager['userWorkPhone']; ?></td>
                                    <td><?php echo $manager['userPersonalPhone']; ?></td>
                                    <td><?php echo $manager['userMail']; ?></td>
                                    <td><?php echo $manager['userSkype']; ?></td>
                                    <td><?php echo $manager['userPwd']; ?></td>
                                    <td><?php echo $manager['timeReg']; ?></td>
                                    <td>
                                        <a href="<?php echo '/mngr/edit/'.$manager['id']; ?>" class="btn btn-xs btn-outline-brand btn-icon" title="Редактировать данные пользователя">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!--<button type="button" class="btn btn-xs btn-outline red sweetAlertAdminDelete" data-delete="<?php //echo '/admin/del/'.$manager['id']; ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </button>-->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- модальное окно добавления пользователя -->
    <div class="modal fade" id="modalAddUser" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавление пользователя</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userSurname">Фамилия
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="" id="userSurname" name="userSurname" required>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Введите фамилию</span>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userFirstName">Имя
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="" id="userFirstName" name="userFirstName" required>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Введите имя</span>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userLastName">Отчество
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="" id="userLastName" name="userLastName">
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Введите отчество</span>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userDepartment">Отдел
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control" id="userDepartment" name="userDepartment">
                                    <option value="0">Не установлено</option>
                                    <?php foreach ($allDepartments as $iteam):?>
                                        <option value="<?php echo $iteam['id'];?>"><?php echo $iteam['nameDepartment'];?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userRole">Должность
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control" id="userRole" name="userRole">
                                    <option value="0">Не установлено</option>
                                    <?php foreach ($allPosts as $iteam):?>
                                        <option value="<?php echo $iteam['id'];?>"><?php echo $iteam['postDepartment'];?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>


                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="mask_phone_work">Телефон рабочий
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="mask_phone_work" name="userWorkPhone" placeholder="">
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Введите номер телефона</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="mask_phone_private">Телефон личный
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="mask_phone_private" name="userPersonalPhone" placeholder="">
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Введите номер телефона</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userMail">Email
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" autocomplete="off" id="userMail" name="userMail" placeholder="" required>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Введите email</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userSkype">Skype
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="userSkype" name="userSkype" placeholder="">
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Введите Skype</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="userPwd">Пароль
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="" id="userPwd" name="userPwd" required>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">Придумайте пароль пользователя для входа в систему</span>
                            </div>
                        </div>
                    </div>
                    <p id="errorName" class="hidden" style="color: red;">Проверьте имя и фамилию</p>
                    <p id="errorRole" class="hidden" style="color: red;">Проверьте установку должности или отдела</p>
                    <p id="errorMail" class="hidden" style="color: red;">Проверьте заполнение email</p>
                    <p id="errorPwd" class="hidden" style="color: red;">Проверьте заполнение пароля</p>
                    <p id="repeatEmail" class="hidden" style="color: red;">Такой email есть в системе</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="arrMergeProjectID" id="arrMergeProjectID" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddUsers">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var urlOne = '/ajax/ajaxpost';

        var table = $('#tableUser');
        table.bootstrapTable('hideColumn','phonehome');
        table.bootstrapTable('hideColumn','skype');
        table.bootstrapTable('hideColumn','pass');

        $('.sweetAlertAdminDelete').on('click', function(){
            var urlDelete = $(this).data('delete');
            Swal.fire({
                title: "Удалить пользователя?",
                type: "warning",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    $(location).attr('href',urlDelete);
                }
            });
        });

        $("#mask_phone_work").inputmask("mask", {
            "mask": "+7(999)999-9999"
        });
        $("#mask_phone_private").inputmask("mask", {
            "mask": "+7(999)999-9999"
        });

        $('#addUser').on('click',function () {
            $('#modalAddUser').modal('show');
        });
        function datetimeStamp() {
            var timezone = '<?php echo $timezone;?>';
            return moment().utcOffset(timezone).format('YYYY-MM-DD HH:mm:ss');
        }
        $('#saveAddUsers').on('click',function () {
            var userSurname = $('#userSurname').val();
            var userFirstName = $('#userFirstName').val();
            var userLastName = $('#userLastName').val();
            var userDepartment = $('#userDepartment').val();
            var userRole = $('#userRole').val();
            var userWorkPhone = $('#mask_phone_work').val();
            var userPersonalPhone = $('#mask_phone_private').val();
            var userMail = $('#userMail').val();
            var userSkype = $('#userSkype').val();
            var userPwd = $('#userPwd').val();
            var dateTime = datetimeStamp();

            $('#errorName').addClass('hidden');
            $('#errorRole').addClass('hidden');
            $('#errorMail').addClass('hidden');
            $('#errorPwd').addClass('hidden');
            $('#repeatEmail').addClass('hidden');

            if(userSurname.length<1 || userFirstName.length<1){
                $('#errorName').removeClass('hidden');
            }else if(userDepartment==='0' || userRole==='0'){
                $('#errorRole').removeClass('hidden');
            }else if(userMail.length<1){
                $('#errorMail').removeClass('hidden');
            }else if(userPwd.length<1){
                $('#errorPwd').removeClass('hidden');
            }else{
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=checkUserMail&userMail="+userMail,
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if(result.checkUserMail==='false'){
                            $('#repeatEmail').removeClass('hidden');
                        }else{
                            saveAddUsers(userSurname,userFirstName,userLastName,userDepartment,userRole,userWorkPhone,userPersonalPhone,userMail,userSkype,userPwd,dateTime);
                        }
                    }
                });
            }
        });
        function saveAddUsers(userSurname,userFirstName,userLastName,userDepartment,userRole,userWorkPhone,userPersonalPhone,userMail,userSkype,userPwd,dateTime) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=addUser&userSurname="+userSurname+"&userFirstName="+userFirstName+"&userLastName="+userLastName+
                "&userDepartment="+userDepartment+"&userRole="+userRole+"&userWorkPhone="+userWorkPhone+"&userPersonalPhone="+userPersonalPhone+
                "&userMail="+userMail+"&userSkype="+userSkype+"&userPwd="+userPwd+"&dateTime="+dateTime,
                success: function (data) {
                    window.location = ('/mngr/users');
                }
            });
        }
    });
</script>