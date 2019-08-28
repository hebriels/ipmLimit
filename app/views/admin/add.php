<?php //bugs($managers[0]); ?>

<div class="page-content-wrapper">
    <div class="page-content">
        <h1 class="page-title">Добавление пользователя</h1>
        <div class="mt-bootstrap-tables">
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet light portlet-fit portlet-form ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Добавление пользователя</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="/admin/add" method="post">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Фамилия
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="userSurname" required>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите фамилию</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Имя
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="userFirstName" required>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите имя</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Отчество
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="userLastName">
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
                                        <label class="col-md-3 control-label" for="form_control_1">Телефон рабочий
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="mask_phone_work" name="userWorkPhone" placeholder="">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите номер телефона</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Телефон личный
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="mask_phone_private" name="userPersonalPhone" placeholder="">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите номер телефона</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Email
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" autocomplete="off" id="userMail" name="userMail" placeholder="" required>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите email</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Skype
                                            <!--<span class="required">*</span>-->
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="userSkype" placeholder="">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Введите Skype</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Пароль
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="userPwd" required>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Придумайте пароль пользователя для входа в систему</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" id="btn-green-submit" class="btn green">Отправить</button>
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
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script>
    $(document).ready(function()
    {
        $("#mask_phone_work").inputmask("mask", {
            "mask": "+7(999)999-9999"
        });
        $("#mask_phone_private").inputmask("mask", {
            "mask": "+7(999)999-9999"
        });
        $('#userMail').keyup(function () {
            var userMail = $(this).val();
            //console.log('userMail-'+userMail);
            $.ajax({
                url: "/app/view/mngr/chat.php", type: "POST", dataType: "text",
                data: "mngrAjax=checkUserMail&userMail=" + userMail,
                success: function (data) {
                    var result = jQuery.parseJSON(data);
                    if(result.checkUserMail===true){
                        swal({
                            title: "Такой email существует!",
                            type: "warning",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ок",
                            closeOnConfirm: false
                        });
                        $('#btn-green-submit').css('display','none');
                    }else{
                        $('#btn-green-submit').css('display','');
                    }

                }
            });
        });

    });
</script>