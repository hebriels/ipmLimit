<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(/assets/images/bg/bg-2.jpg);">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="/assets/images/logos/logo-mini2.png">
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Войдите в свой аккаунт</h3>
                        </div>
                        <form class="kt-form" action="/mngr/dashboard" id="formLoginFrame" method="post">
                            <div class="form-group">
                                <input style="border-radius: 25px;padding-left: 10px;" class="form-control" type="text" placeholder="Email" id="mngrMail" name="mngrMail" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input style="border-radius: 25px;padding-left: 10px;" class="form-control" type="password" placeholder="Пароль" id="mngrPwd" name="mngrPwd">
                            </div>
                            <div class="kt-login__actions">
                                <button type="button" id="submitOnLogin" class="btn btn-brand btn-pill btn-elevate">Войти</button>
                            </div>
                        </form>
                    </div>
                    <div class="kt-login__account">
								<span class="kt-login__account-msg">
									Не знакомы с программой?
								</span>
                        &nbsp;&nbsp;
                        <a href="https://s-ama.ru/samaipm" target="_blank" id="kt_login_signup" class="kt-login__account-link">Подробнее!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->



<div id="formLoginCookie"></div>
<script>
    $(document).ready(function(){
        var urlOne = '/ajax/ajaxpost';
        //console.log($.cookie('userMail'));
        //console.log($.cookie('userAvatar'));
        //console.log($.cookie('userSurname'));
        //console.log($.cookie('userFirstName'));
        if(Cookies.get('userMail')){
            var userMail = (Cookies.get('userMail'));
            var userAvatar = (Cookies.get('userAvatar'));
            var userSurname = (Cookies.get('userSurname'));
            var userFirstName = (Cookies.get('userFirstName'));
            var output = '\
            <div class="page-lock">\
                <div class="page-logo">\
                    <a class="brand" href="/">\
                        <img src="/public/images/logos/logo.png" alt="logo" />\
                    </a>\
                </div>\
                <div class="page-body">\
                    <img class="page-lock-img" src="'+userAvatar+'" alt="">\
                    <div class="page-lock-info">\
                        <h1>'+userSurname+' '+userFirstName+'</h1>\
                        <span class="email">'+userMail+'</span>\
                        <form action="/mngr/login" method="post">\
                            <div class="input-group input-medium">\
                                <input type="hidden" class="form-control" id="mngrMail" name="mngrMail" value="'+userMail+'">\
                                <input type="password" class="form-control" id="mngrPwd" name="mngrPwd" placeholder="Пароль">\
                                <span class="input-group-btn">\
                                    <button type="button" id="submitLogin" class="btn green icn-only">\
                                        <i class="m-icon-swapright m-icon-white"></i>\
                                    </button>\
                                </span>\
                            </div>\
                            <div class="relogin">\
                                <a href="/mngr/login"> Если это не вы ... </a>\
                            </div>\
                        </form>\
                    </div>\
                </div>\
            </div>';
        }
        $('body').keypress(function(e){
            if(e.which == 13){
                $('#submitOnLogin').click();
            }
        });
        $('#submitOnLogin').on('click',function () {
            let mngrMail = $('body #mngrMail').val().trim();
            console.log(mngrMail);
            let mngrPwd = $('body #mngrPwd').val();
            if(mngrMail.length<1 || mngrPwd.length<1){
                Swal.fire({
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
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Неверный логин или пароль!",
                                type: "warning",
                                confirmButtonText: "Понятно"
                            });
                        }else if(result === 'correct'){
                            $('#formLoginFrame').submit();
                            //window.location = ('/mngr/dashboard');
                        }
                    }
                });
            }
        });

        $('body').on('click','#submitLogin',function () {
            var mngrMail = $('body #mngrMail').val();
            var mngrPwd = $('body #mngrPwd').val();
            if(mngrMail.length<1 || mngrPwd.length<1){
                Swal.fire({
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
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Неверный пароль!",
                                type: "warning",
                                confirmButtonText: "Понятно"
                            });
                        }else if(result === 'correct'){
                            $('#formLoginFrame').submit();
                            //window.location = ('/mngr/dashboard');
                        }
                    }
                });
            }
        });
    });
</script>
