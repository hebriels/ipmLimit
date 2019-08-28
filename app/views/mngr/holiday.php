<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Управление отпусками </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                    <h3 class="kt-portlet__head-title"> Список пользователей </h3>
                </div>
            </div>
            <?php $tableId = 'tableProject'; ?>
            <div class="kt-portlet__body" data-tablename="<?php echo $tableId;?>">
                <div class="table-responsive">
                    <table id="<?php echo $tableId;?>" data-toggle="table"
                       class="table table-bordered table-hover table-striped table-sm"
                       data-sort-name="<?php echo $tableId;?>-username" data-sort-order="asc"
                       data-search="true"
                       data-pagination="true" data-page-size="25" data-page-list="[5, 25, 50, 100, 500]"
                       data-hide-unused-select-options="true"
                       data-unique-id="<?php echo $tableId;?>-id">
                        <thead>
                        <tr>
                            <th data-visible="false" data-field="<?php echo $tableId;?>-id" data-switchable="false"></th>
                            <th data-field="<?php echo $tableId;?>-username" data-align="center">Ф.И.О.</th>
                            <th data-field="<?php echo $tableId;?>-actions" data-align="center">Действия</th>
                            <th data-field="<?php echo $tableId;?>-lastholiday" data-align="center">Прошлый отпуск</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($managers as $myData): ?>
                            <?php if($myData['adminUser']!='delete'):?>
                                <tr>
                                    <td><?php echo $myData['id'];?></td>
                                    <td><?php echo $myData['userSurname'].' '.$myData['userFirstName'].' '.$myData['userLastName'];?></td>
                                    <td>
                                        <?php
                                        if($myData['holiday'] == 'false'){
                                            echo '<button type="button" class="btn btn-xs btn-outline btn-success inHoliday" data-userid="'.$myData['id'].'">В отпуск</button>';
                                        }else{
                                            echo '<button type="button" class="btn btn-xs btn-outline btn-danger ofHoliday" data-userid="'.$myData['id'].'">В отпуске</button>';
                                        }
                                        ;?>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <?php foreach ($holidayAll as $holiday){
                                                if($myData['id']==$holiday['user_id']){
                                                    echo '<option>с '.$holiday['date_inHoliday'].' по '.$holiday['date_ofHoliday'].'</option>';
                                                }
                                            }?>
                                        </select>
                                    </td>
                                </tr>
                            <?php endif;?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeligated" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Делегирование полномочий</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="nameUserDelegate">
                        <label for="nameUserAdd" class="form-control-label">Выбор сотрудника для замещения отпускника: </label>
                        <select id="nameUserAdd" class="form-control kt-select2"></select>
                    </div>
                    <div class="form-group">
                        <p class="hiddenVisible" id="hiddenNotice">При автоматическом делегировании функции сотрудника будут переданы следующему за ним согласующему!</p>
                        <label class="kt-checkbox"> Автоматическое делегирование.
                            <input type="checkbox" class="form-control" id="checkAutoDelegate">
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userInHolidayID" id="userInHolidayID" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveAddDelegate">Применить</button>
                </div>
            </div>
        </div>
    </div>
    <?php $allUsers = json_encode($managers);?>
</div>

<script>
    $(document).ready(function() {
        var tableId = '<?php echo $tableId;?>';
        var urlOne = '/ajax/ajaxpost';
        var allUsers = <?php echo $allUsers;?>;
        
        //в отпуск
        $('body').on('click','.inHoliday',function () {
            var userInHolidayID = $(this).data('userid');
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "mainAjax=currentAffairs&userID=" + userInHolidayID,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.resultCurrent === false) {
                        holidayOK(userInHolidayID);
                    } else {
                        Swal.fire({
                            title: "У пользователя есть незавершенные дела!",
                            type: "info"
                        });
                    }
                }
            });
        });
        function holidayOK(userInHolidayID) {
            Swal.fire({
                title: "Отправить в отпуск?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm) => {
                if(isConfirm.value){
                    //var dateToday = datetimeToday();
                    $('#userInHolidayID').val(userInHolidayID);
                    $.each(allUsers,function(col,val) {
                        let selectUsers = '\
                    <option value="'+val.id+'">'+val.userSurname+' '+val.userFirstName+' '+val.userLastName+'</option>';
                        $('#nameUserAdd').append(selectUsers);
                    });
                    $('#modalDeligated').modal('show');
                    /*$.ajax({
                        url: urlOne, type: 'POST', dataType: "text",
                        data: "mainAjax=holiday&userID="+userInHolidayID+"&typeHoliday=true&dateToday="+dateToday,
                        success: function(data) {
                            window.location = "/mngr/holiday";
                        }
                    });*/
                }
            })
        }
        $('#checkAutoDelegate').click(function() {
            if ($(this).is(':checked')) {
                $('#nameUserDelegate').addClass('hiddenVisible');
                $('#hiddenNotice').removeClass('hiddenVisible');
            }else{
                $('#nameUserDelegate').removeClass('hiddenVisible');
                $('#hiddenNotice').addClass('hiddenVisible');
            }
        });
        //сохранение делегирования
        $('#saveAddDelegate').on('click',function () {
            var dateToday = datetimeToday();
            var userInHolidayID = $('#userInHolidayID').val();
            var nameUserAdd = $('#nameUserAdd').val();
            var checkAutoDelegate = $('#checkAutoDelegate').prop('checked');

            if(checkAutoDelegate){
                $.ajax({
                    url: urlOne, type: 'POST', dataType: "text",
                    data: "mainAjax=holiday&userID="+userInHolidayID+"&typeHoliday=true&dateToday="+dateToday+"&autoDelegate=true",
                    success: function(data) {
                        window.location = "/mngr/holiday";
                    }
                });
            }else{
                $.ajax({
                    url: urlOne, type: 'POST', dataType: "text",
                    data: "mainAjax=holiday&userID="+userInHolidayID+"&typeHoliday=true&dateToday="+dateToday+"&autoDelegate="+nameUserAdd,
                    success: function(data) {
                        window.location = "/mngr/holiday";
                    }
                });
            }
        });
//из отпуска
        $('body').on('click','.ofHoliday',function () {
            var userOfHolidayID = $(this).data('userid');
            Swal.fire({
                title: "Вернуть из отпуска?",
                type: "info",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да"
            }).then((isConfirm) => {
                if(isConfirm.value){
                    let dateToday = datetimeToday();
                    $.ajax({
                        url: urlOne, type: 'POST', dataType: "text",
                        data: "mainAjax=holiday&userID="+userOfHolidayID+"&typeHoliday=false&dateToday="+dateToday+"&autoDelegate=true",
                        success: function(data) {
                            window.location = "/mngr/holiday";
                        }
                    });
                }
            })

        });
//Функция получения текущей даты и времени
        function datetimeToday() {
            return moment().format('DD.MM.YYYY');
        }
    });
</script>