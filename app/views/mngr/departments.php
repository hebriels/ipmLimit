<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Список отделов </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                            <h3 class="kt-portlet__head-title"> Отделы </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" id="tableReport">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Отдел</th>
                                    <th>Руководитель</th>
                                    <th>Удаление</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $colDep=1; foreach ($allDepartments as $item):?>
                                    <tr class="tr-<?php echo $item['id'];?>">
                                        <td style="width:10%;"><?php echo $colDep;?></td>
                                        <td>
                                            <a href="javascript:;" class="nameDepartment" data-type="text" data-pk="<?php echo $item['id'];?>">
                                                <?php echo $item['nameDepartment'];?>
                                            </a>
                                        </td>
                                        <td>
                                            <select class="form-control departmentBoss" style="width: 100% !important;" data-pk="<?php echo $item['id'];?>" data-value="<?php echo $item['bossID'];?>">
                                                <option value="<?php echo $item['bossID'];?>" selected="selected">
                                                    <?php
                                                        if($item['bossID']=='0'){
                                                            echo 'Выбор пользователя';
                                                        }else{
                                                            foreach ($allUsers as $itemUser){
                                                                if($itemUser['id']==$item['bossID']){
                                                                    echo $itemUser['userSurname'].' '.$itemUser['userFirstName'];
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </option>
                                            </select>
                                        </td>
                                        <td style="width:10%;">
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-icon btnDelete"
                                                data-id="<?php echo $item['id'];?>">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $colDep++; endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <a href="javascript:;" class="btn btn-success addDepartment"><i class="fa fa-plus"></i>Добавить отдел</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление отдела</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newDepartment" class="col-form-label">Название отдела:</label>
                        <input type="text" class="form-control" id="newDepartment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveAdd">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php
    $allUsers = json_encode($allUsers);
?>
<script>
    $(document).ready(function() {
        //var urlOne = '/ajax/ajaxpost';
        $.fn.editable.defaults.mode = 'inline';
        $('.nameDepartment').editable({
            type: 'text',
            success: function(response, newValue) {
                let id = $(this).data('pk');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "adminAjax=editDepartment&id="+id+"&name="+newValue+"&userID=false",
                    success: function (data) {}
                });
            }
        });

        $('.departmentBoss').select2({
            placeholder: "Выбрать пользователя"
        });
        //$('#editThemeChargUser').val($(this).data('charguser')).trigger('change');
        $.each(<?php echo $allUsers;?>,function(col,val) {
            let selectManagers = '<option value="'+val.id+'">'+val.userSurname+' '+val.userFirstName+'</option>';
            $('.departmentBoss').append(selectManagers);
        });

        $('.departmentBoss').change(function () {
            let depID = $(this).data('pk');
            let bossID = $(this).val();
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=editBossDepartment&depID="+depID+"&bossID="+bossID,
                success: function (data) {
                    Swal.fire({
                        title: "Изменения приняты",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    window.location = ('/mngr/departments');
                }
            });
        });


        $('body').on('click','.addDepartment', function () {
            $('#departmentModal').modal('show');
        });
        $('#saveAdd').on('click',function () {
            let newDepartment = $('#newDepartment').val();
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=addDepartment&newDepartment="+newDepartment,
                success: function (data) {
                    window.location = ('/mngr/departments');
                }
            });
        });
        $('.btnDelete').on('click',function () {
            let deleteID = $(this).data('id');
            Swal.fire({
                title: "Удалить отдел?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Отмена"
            }).then((isConfirm)=>{
                if(isConfirm.value){
                    $.ajax({
                        url: urlOne, type: "POST",
                        dataType: "text",
                        data: "adminAjax=deleteDepartment&deleteID=" + deleteID,
                        success: function (data) {
                            let result = $.parseJSON(data);
                            $('.tr-' + deleteID).remove();
                        }
                    });
                }
            });
        })
    });
</script>
