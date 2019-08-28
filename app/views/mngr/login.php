<!-- BEGIN LOGO -->
<div class="logo">
    <a href="/">
        <img src="/public/images/logos/logo.png" alt="" /> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form action="/mngr/login" method="post" id="formLogin">
        <h3 class="form-title">Войдите в свой аккаунт</h3>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="email" placeholder="Email" id="mngrMail" name="mngrMail"/></div>
        </div>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" placeholder="Пароль" id="mngrPwd" name="mngrPwd"/></div>
        </div>
        <div class="form-actions">
            <button type="button" class="btn green pull-right" id="submitLogin"> Войти </button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/localization/messages_ru.js" type="text/javascript"></script>

<script src="/public/scripts/validation/formLogin.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        var urlOne = '/ajax/ajaxpost';
        $('#submitLogin').on('click',function () {
            var mngrMail = $('#mngrMail').val();
            var mngrPwd = $('#mngrPwd').val();
            if(mngrMail.length<1 || mngrPwd.length<1){
                swal({
                    title: "Внимание!",
                    text: "Проверьте поля формы!",
                    type: "info",
                    confirmButtonText: "Хорошо"
                });
            }else{
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=loginValidate&mngrMail="+mngrMail+"&mngrPwd="+mngrPwd,
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if(result === 'incorrect'){
                            swal({
                                title: "Ошибка!",
                                text: "Неверный логин или пароль!",
                                type: "warning",
                                confirmButtonText: "Понятно"
                            });
                        }else if(result === 'correct'){
                            window.location = ('/mngr/dashboard');
                        }
                    }
                });
            }
        });
    });
</script>