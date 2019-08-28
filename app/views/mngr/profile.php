<?php
//символ валюты по умолчанию
    foreach ($defaultDownload['currency'] as $currenc){
        if($defaultDownload['currencyGeneral']==$currenc['id']){
            $thisCurrent = $currenc['simbolCurrency'];
        }
    }
?>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Ваш профиль </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__media kt-hidden-">
                                    <img src="/assets/images/ava/<?php echo $defaultDownload['userPathAvatar'];?>" alt="ava">
                                </div>
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="javascript:;" class="kt-widget__username">
                                            <?php echo $_SESSION['mngr']['userSurname'].' '. $_SESSION['mngr']['userFirstName']; ?>
                                            <i class="flaticon2-correct"></i>
                                        </a>
                                        <!--<div class="kt-widget__action">
                                            <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                            <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                                        </div>-->
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="javascript:;"><i class="flaticon2-new-email"></i><?php echo $_SESSION['mngr']['userMail']; ?></a>
                                        <a href="javascript:;"><i class="flaticon-network"></i>
                                            <?php foreach ($allPosts as $posts){
                                                if($_SESSION['mngr']['userRole']==$posts['id']){
                                                    echo $posts['postDepartment'];
                                                }
                                            }?>
                                        </a>
                                        <a href="javascript:;"><i class="flaticon-presentation-1"></i>
                                            <?php foreach ($allDepartments as $deps){
                                                if($_SESSION['mngr']['userDepartment']==$deps['id']){
                                                    echo $deps['nameDepartment'];
                                                }
                                            }?>
                                        </a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <!--<div class="kt-widget__desc">
                                            I distinguish three main text objektive could be merely to inform people.
                                            <br> A second could be persuade people.You want people to bay objective
                                        </div>-->
                                        <div class="kt-widget__progress">
                                            <div class="kt-widget__text">
                                                Качество
                                            </div>
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: 95%;" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="kt-widget__stats"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__bottom">
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-coins"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Сумма счетов</span>
                                        <span class="kt-widget__value"><b id="summInvoice"></b><span><?php echo $thisCurrent;?></span></span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-piggy-bank"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Сейчас в наличке</span>
                                        <span class="kt-widget__value"><span style="color: grey;">В разработке</span> <span><?php echo $thisCurrent;?></span></span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-file-2"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Всего счетов</span>
                                        <span class="kt-widget__value"><a href="javascript:;" class="kt-widget__value allInvoice"></a></span>
                                    </div>
                                </div>
                                <!--<div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-chat-1"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">648 Comments</span>
                                        <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                    </div>
                                </div>-->
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-network"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <div class="kt-section__content kt-section__content--solid">
                                            <div class="kt-badge kt-badge__pics">
                                                <?php
                                                    foreach ($listActionInvoice as $usersInvoice){
                                                        foreach ($allUsers as $users){
                                                            if($users['id']==$usersInvoice){
                                                                echo '<a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="'.$users['userSurname'].' '.$users['userFirstName'].'">
                                                                    <img src="/assets/images/ava/'.$users['userAvatar'].'" alt="image">
                                                                </a>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                            <h3 class="kt-portlet__head-title"> Настройка профиля</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item" id="liNav-1">
                                <a data-toggle="tab" href="#tab_1_2" id="linkNav-2" class="nav-link">Фото
                                    <span class="badge badge-default blinkInform"></span>
                                </a>
                            </li>
                            <li class="nav-item" id="liNav-1">
                                <a data-toggle="tab" href="#tab_1_3" id="linkNav-3" class="nav-link">Смена пароля
                                    <span class="badge badge-default blinkInform"></span>
                                </a>
                            </li>
                            <li class="nav-item" id="liNav-1">
                                <a data-toggle="tab" href="#tab_1_4" id="linkNav-4" class="nav-link active">Уведомления
                                    <span class="badge badge-default blinkInform"></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Аватар -->
                            <div class="tab-pane" id="tab_1_2">
                                    <div class="form-group form-group-last">
                                        <div class="col-md-6 col-center">
                                            <div class="file-loading">
                                                <input id="imgInvoice" name="imgInvoice[]" type="file" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9" style="margin-top: 30px;">
                                                <button type="button" id="submitAvatar" class="btn btn-success">Отправить</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- Смена пароля -->
                            <div class="tab-pane" id="tab_1_3">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <label class="control-label" for="currentPwd">Текущий пароль</label>
                                        <input type="text" class="form-control" id="currentPwd" name="currentPwd"/> </div>
                                    <div class="form-group">
                                        <label class="control-label" for="newPwd">Новый пароль</label>
                                        <input type="password" class="form-control" id="newPwd" name="newPwd"/> </div>
                                    <div class="form-group">
                                        <label class="control-label" for="confirmNewPwd">Повторите новый пароль</label>
                                        <input type="password" class="form-control" id="confirmNewPwd" name="confirmNewPwd"/> </div>
                                    <div class="margin-top-10">
                                        <button type="button" class="btn btn-success changeUserPwdBtn"> Применить </button>
                                    </div>
                                </form>
                            </div>
                            <!-- Настройки -->
                            <div class="tab-pane active" id="tab_1_4">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Наименование уведомления</th>
                                            <th>Почта</th>
                                            <th>Сайт</th>
                                        </tr>
                                    </thead>
                                    <?php if($userToMail==true && $userToMailPay==true):?>
                                    <tr>
                                        <td> Новый счет или служебка созданная подчиненным </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeMailAddInvoice']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeMailAddInvoice" data-noticetab="noticeMailAddInvoice">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeDashAddInvoice']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeDashAddInvoice" data-noticetab="noticeDashAddInvoice">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Счет или служебка подписанная нижестоящим руководителем </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeMailSignInvoice']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeMailSignInvoice" data-noticetab="noticeMailSignInvoice">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeDashSignInvoice']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeDashSignInvoice" data-noticetab="noticeDashSignInvoice">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endif;?>
                                    <tr>
                                        <td> Отказ в подписании счета или служебки </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeMailFailure']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeMailFailure" data-noticetab="noticeMailFailure">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeDashFailure']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeDashFailure" data-noticetab="noticeDashFailure">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Оплата счета или служебки </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeMailSuccess']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeMailSuccess" data-noticetab="noticeMailSuccess">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeDashSuccess']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeDashSuccess" data-noticetab="noticeDashSuccess">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Новый комментарий </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeMailComment']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeMailComment" data-noticetab="noticeMailComment">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <?php if($noticeSettingsUser[0]['noticeDashComment']=='true'){$checkNotice = 'checked';}else{$checkNotice = '';}?>
                                                <label>
                                                    <input class="noticeSettings" type="checkbox" <?php echo $checkNotice;?> name="noticeDashComment" data-noticetab="noticeDashComment">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- END PRIVACY SETTINGS TAB -->
                        </div>
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
        let urlOne = '/ajax/ajaxpost';
        let userIdSess = '<?php echo $_SESSION['mngr']['id'];?>';

        $('#submitAvatar').on('click',function () {
            let formData = new FormData();
            $.each($('#imgInvoice')[0].files, function(key, value) {
                formData.append('file[]', value);
            });
            formData.append('mainAjax','updateAvatar');
            $.ajax({
                url: urlOne, type: "POST", dataType: "json",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.error==='noImage'){
                        Swal.fire({
                            title: "Ошибка!",
                            text: "Я не могу обработать запрос если нет прикрепленных файлов!",
                            type: "warning"
                        });
                    }else{
                        Swal.fire({
                            title: "Идет отправка!",
                            type: "success",
                            showConfirmButton: false,
                            timer: 10000
                        });
                        window.location = ('/mngr/profile');
                    }
                }
            });
        });

        $('.noticeSettings').change(function() {
            ajaxThreeParams($(this).data('noticetab'),$(this).prop('checked'));
        });

        $('.changeUserPwdBtn').on('click',function () {
            var currentPwd = $('#currentPwd').val();
            var newPwd = $('#newPwd').val();
            var confirmNewPwd = $('#confirmNewPwd').val();
            if(newPwd===confirmNewPwd){
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=changeUserPwd&currentPwd="+currentPwd+"&newPwd="+newPwd+"&confirmNewPwd="+confirmNewPwd,
                    success: function (data) {
                        console.log(data);
                        var result = $.parseJSON(data);
                        if(result===true){
                            Swal.fire({
                                title: "Пароль изменен!",
                                type: "success"
                            });
                        }else{
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Произошла ошибка, проверьте правильность введенного пароля!",
                                type: "warning"
                            });
                        }
                    }
                });
            }else{
                Swal.fire({
                    title: "Ошибка!",
                    text: "Пароли не совпадают!",
                    type: "warning"
                });
            }
        });

        function ajaxThreeParams(notice,params) {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=editNotice&userID="+userIdSess+"&notice="+notice+"&params="+params,
                success: function (data) {}
            });
        }

//статистика пользователя

        $.ajax({
            url: urlOne, type: "POST", dataType: "text",
            data: "mainAjax=loadAllInvoiceMngr&forUserID="+userIdSess,
            success: function (data) {
                let result = $.parseJSON(data);
                $.each(result.arrStatMngr,function(col,val){
                    let percent = Math.round((100/(val.statusSuccess+val.statusFailure))*val.statusSuccess);
                    if(isNaN(percent)){percent = '0';}
                    let nameMngr = val.userName;
                    let totalInvoice = '';
                    if(val.totalInvoice === ''){
                        totalInvoice = 0;
                    }else{
                        totalInvoice = val.totalInvoice;
                        //totalInvoice = parseFloat(totalInvoice).toFixed(2);
                    }
                    //totalInvoice = String(totalInvoice).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;');

                    $('.progress-bar').css( 'width', percent+'%' );
                    $('.kt-widget__stats').text(percent+'%');
                    //все счета

                    $('#summInvoice').html(totalInvoice+'&nbsp;');
                    $('.allInvoice').text(val.invoiceCount);
                });
            }
        });
    });

</script>