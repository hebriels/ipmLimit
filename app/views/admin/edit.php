<!--<h3>Редактировать пользователя</h3>

<form action="<?php //echo '/admin/edit/'.$this->route['id']; ?>" method="post">
    <p>Фамилия</p>
    <input type="text" name="userSurname" value="<?php //echo $vars['data']['userSurname']; ?>">
    <p>Имя</p>
    <input type="text" name="userFirstName" value="<?php //echo $vars['data']['userFirstName']; ?>">
    <p>Табельный номер</p>
    <input type="text" name="userPersonNumber" value="<?php //echo $vars['data']['userPersonNumber']; ?>">
    <p>Login</p>
    <input type="text" name="userLogin" value="<?php //echo $vars['data']['userLogin']; ?>">
    <p>Role</p>
    <select name="userRole" id="">
        <option value="mngr">Менеджер</option>
        <option value="divisionHead">Руководитель отдела</option>
    </select>
    <p>Password</p>
    <input type="text" name="userPwd" value="<?php //echo $vars['data']['userPwd']; ?>">
    <input type="submit" name="submit">
</form>-->

<?php //bugs($vars); ?>

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="mt-bootstrap-tables">
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet light portlet-fit portlet-form ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Редактировать пользователя</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo '/admin/edit/'.$this->route['id']; ?>" class="form-horizontal" method="post" id="form_sample_1">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Фамилия
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?php echo $data['userSurname']; ?>" name="userSurname">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите фамилию</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Имя
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?php echo $data['userFirstName']; ?>" name="userFirstName">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите имя</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Отчество
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?php echo $data['userLastName']; ?>" name="userLastName">
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
                                        <label class="col-md-3 control-label" for="form_control_1">Должность</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="userRole">
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
                                        <label class="col-md-3 control-label" for="form_control_1">Телефон рабочий
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="userWorkPhone" value="<?php echo $data['userWorkPhone']; ?>">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите рабочий телефон сотрудника</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Телефон личный
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="userPersonalPhone" value="<?php echo $data['userPersonalPhone']; ?>">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите личный телефон сотрудника</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Email
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="userMail" value="<?php echo $data['userMail']; ?>" placeholder="">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите email</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Skype
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="userSkype" value="<?php echo $data['userSkype']; ?>" placeholder="">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите Skype</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Пароль
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="userPwd" value="<?php echo $data['userPwd']; ?>">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Придумайте пароль пользователя для входа в систему</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button id="sweetAlertAdminAdd" class="btn btn green"
                                                    type="button">Отправить</button>
                                            <button type="reset" class="btn default">Сбросить</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
                <!--<div class="col-md-6">
                    <div class="portlet light portlet-fit portlet-form ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-globe font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Отпуск</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form action="#" class="form-horizontal" method="post" id="form_holiday">
                                <div class="form-body">
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn green"
                                                    type="button">Отправить</button>
                                            <button type="reset" class="btn default">Сбросить</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script>
    $(document).ready(function() {
        $('#sweetAlertAdminAdd').on('click', function(){
            var form = $(this).parents('form');
            swal({
                title: "Вы готовы принять изменения?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Принять",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) form.submit();
            });
        });
    });
</script>