<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Редактор </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                            <h3 class="kt-portlet__head-title"> Редактировать пользователя </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form action="<?php echo '/mngr/edit/'.$this->route['id']; ?>" class="form-horizontal" method="post" id="form_sample_1">
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userSurname">Фамилия
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userSurname" value="<?php echo $data['userSurname']; ?>" name="userSurname">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Введите фамилию</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userFirstName">Имя
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userFirstName" value="<?php echo $data['userFirstName']; ?>" name="userFirstName">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Введите имя</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userLastName">Отчество</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userLastName" value="<?php echo $data['userLastName']; ?>" name="userLastName">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Введите отчество</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userDepartment">Отдел</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="userDepartment" name="userDepartment">
                                            <option value="0">Не установлено</option>
                                            <?php foreach ($allDepartments as $iteam):?>
                                                 <option value="<?php echo $iteam['id'];?>"
                                                     <?php if($data['userDepartment']==$iteam['id']){echo 'selected';}?>>
                                                     <?php echo $iteam['nameDepartment'];?>
                                                 </option>
                                            <?php endforeach;?>
                                        </select>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userRole">Должность</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="userRole" name="userRole">
                                            <option value="0">Не установлено</option>
                                            <?php foreach ($allPosts as $iteam):?>
                                                <option value="<?php echo $iteam['id'];?>"
                                                    <?php if($data['userRole']==$iteam['id']){echo 'selected';}?>>
                                                    <?php echo $iteam['postDepartment'];?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userWorkPhone">Телефон рабочий
                                        <!--<span class="required">*</span>-->
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userWorkPhone" name="userWorkPhone" value="<?php echo $data['userWorkPhone']; ?>">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Введите рабочий телефон сотрудника</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userPersonalPhone">Телефон личный
                                        <!--<span class="required">*</span>-->
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userPersonalPhone" name="userPersonalPhone" value="<?php echo $data['userPersonalPhone']; ?>">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Введите личный телефон сотрудника</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userMail">Email
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userMail" name="userMail" value="<?php echo $data['userMail']; ?>" placeholder="">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Введите email</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userSkype">Skype
                                        <!--<span class="required">*</span>-->
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userSkype" name="userSkype" value="<?php echo $data['userSkype']; ?>" placeholder="">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Введите Skype</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="userPwd">Пароль
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userPwd" name="userPwd" value="<?php echo $data['userPwd']; ?>">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Придумайте пароль пользователя для входа в систему</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Статус</label>
                                    <div class="kt-checkbox-inline">
                                        <div class="kt-checkbox has-error">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--danger" for="userAdmin">
                                                <input type="checkbox" <?php if($data['adminUser']=='true'){echo 'checked';}?> id="userAdmin" name="userAdmin" class="md-check">
                                                <span></span> Администратор
                                            </label>
                                        </div>
                                        <div class="kt-checkbox has-info">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--info" for="userDelete">
                                                <input type="checkbox" <?php if($data['adminUser']=='delete'){echo 'checked';}?> id="userDelete" name="userDelete" class="md-check">
                                                <span></span> Уволен
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <input type="hidden" id="userID" name="userID" value="<?php echo $data['id']; ?>">
                                        <button id="sweetAlertAdminAdd" class="btn btn-outline-success" type="button">Отправить</button>
                                        <!--<button type="reset" class="btn btn-outline-brand">Сбросить</button>-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script>
    $(document).ready(function() {
        $('#sweetAlertAdminAdd').on('click', function(){
            var urlOne = '/ajax/ajaxpost';
            var form = $(this).parents('form');

            Swal.fire({
                title: "Вы готовы принять изменения?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Принять",
                closeOnConfirm: false
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    var userID = $('#userID').val();
                    var userSurname = $('#userSurname').val();
                    var userFirstName = $('#userFirstName').val();
                    var userLastName = $('#userLastName').val();
                    var userDepartment = $('#userDepartment').val();
                    var userRole = $('#userRole').val();
                    var userWorkPhone = $('#userWorkPhone').val();
                    var userPersonalPhone = $('#userPersonalPhone').val();
                    var userMail = $('#userMail').val();
                    var userSkype = $('#userSkype').val();
                    var userPwd = $('#userPwd').val();
                    var userAdmin = $('#userAdmin').prop('checked');
                    var userDelete = $('#userDelete').prop('checked');
                    if(userDelete===true){
                        userAdmin = 'delete';
                        Swal.fire({
                            title: "Не забудьте проверить цепочку согласующих!",
                            text: "Все счета которые данный пользователь должен был подписать будут переданы следующему согласующему",
                            type: "info",
                            confirmButtonText: "Понятно"
                        }).then((isConfirm)=>{
                            if (isConfirm.value){
                                $.ajax({
                                    url: urlOne, type: "POST", dataType: "text",
                                    data: "mainAjax=editUser&delete=true&userID="+userID+"&userSurname="+userSurname+"&userFirstName="+userFirstName+"&userLastName="+userLastName+
                                    "&userDepartment="+userDepartment+"&userRole="+userRole+"&userWorkPhone="+userWorkPhone+"&userPersonalPhone="+userPersonalPhone+"&userMail="+userMail+
                                    "&userSkype="+userSkype+"&userPwd="+userPwd+"&userAdmin="+userAdmin,
                                    success: function (data) {
                                        //console.log(data);
                                        window.location = ('/mngr/edit/'+userID);
                                    }
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            url: urlOne, type: "POST", dataType: "text",
                            data: "mainAjax=editUser&delete=false&userID="+userID+"&userSurname="+userSurname+"&userFirstName="+userFirstName+"&userLastName="+userLastName+
                            "&userDepartment="+userDepartment+"&userRole="+userRole+"&userWorkPhone="+userWorkPhone+"&userPersonalPhone="+userPersonalPhone+"&userMail="+userMail+
                            "&userSkype="+userSkype+"&userPwd="+userPwd+"&userAdmin="+userAdmin,
                            success: function (data) {
                                //console.log(data);
                                window.location = ('/mngr/edit/'+userID);
                            }
                        });
                    }
                }
            });
        });
    });
</script>