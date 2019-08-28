<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Список организаций </h3>
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
                            <h3 class="kt-portlet__head-title"> Организации </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" id="tableReport">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Организация</th>
                                    <th>ИНН</th>
                                    <th>КПП</th>
                                    <th>Удаление</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $colOrg=1; foreach ($allOrganization as $item):?>
                                    <tr class="tr-<?php echo $item['id'];?>">
                                        <td style="width:10%;"><?php echo $colOrg;?></td>
                                        <td style="width:25%;"><?php echo $item['nameOrganization'];?></td>
                                        <td style="width:25%;"><?php echo $item['innOrganization'];?></td>
                                        <td style="width:25%;"><?php echo $item['kppOrganization'];?></td>
                                        <td style="width:15%;">
                                            <div class="btn-group btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-brand btn-icon editBtn"
                                                        data-id="<?php echo $item['id'];?>" data-name="<?php echo $item['nameOrganization'];?>"
                                                        data-inn="<?php echo $item['innOrganization'];?>" data-kpp="<?php echo $item['kppOrganization'];?>">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-icon btn-delete"
                                                        data-id="<?php echo $item['id'];?>">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $colOrg++; endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <a href="javascript:;" class="btn btn-success addOrganization"><i class="fa fa-plus"></i>Добавить организацию</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Добавление организации-->
    <div class="modal fade" id="orgModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление организации</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newOrganization" class="col-form-label"><span class="required">*</span> Название организации:</label>
                        <input type="text" class="form-control" id="newOrganization">
                    </div>
                    <div class="form-group">
                        <label for="innOrganization" class="col-form-label"><span class="required">*</span> ИНН организации:</label>
                        <input type="text" class="form-control" id="innOrganization">
                    </div>
                    <div class="form-group">
                        <label for="kppOrganization" class="col-form-label"><span class="required">*</span> КПП организации:</label>
                        <input type="text" class="form-control" id="kppOrganization">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveAdd">Применить</button>
                </div>
            </div>
        </div>
    </div>
    <!--Редактирование организации-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Редактирование организации</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameEdit" class="col-form-label"><span class="required">*</span> Название организации:</label>
                        <input type="text" class="form-control" id="nameEdit" value="">
                    </div>
                    <div class="form-group">
                        <label for="innEdit" class="col-form-label"><span class="required">*</span> ИНН организации:</label>
                        <input type="text" class="form-control" id="innEdit" value="">
                    </div>
                    <div class="form-group">
                        <label for="kppEdit" class="col-form-label"><span class="required">*</span> КПП организации:</label>
                        <input type="text" class="form-control" id="kppEdit" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idEdit" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="editAdd">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var urlOne = '/ajax/ajaxpost';
        $.fn.editable.defaults.mode = 'inline';
        $('.editBtn').on('click',function () {
            $('#editModal').modal('show');
            $('#idEdit').val($(this).data('id'));
            $('#nameEdit').val($(this).data('name'));
            $('#innEdit').val($(this).data('inn'));
            $('#kppEdit').val($(this).data('kpp'));
        });
        $('#editAdd').on('click',function(){
            var idOrganization = $('#idEdit').val();
            var nameOrganization = $('#nameEdit').val();
            var innOrganization = $('#innEdit').val();
            var kppOrganization = $('#kppEdit').val();
            if (nameOrganization.length > 0 && innOrganization.length > 0 && kppOrganization.length > 0) {
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "adminAjax=editOrganization&id="+idOrganization+"&nameOrganization="+nameOrganization + "&innOrganization=" + innOrganization + "&kppOrganization=" + kppOrganization,
                    success: function (data) {
                        window.location = ('/mngr/organization');
                    }
                });
            } else {
                Swal.fire({
                    title: "Ошибка!",
                    text: "Проверьте заполнение полей!",
                    type: "warning"
                });
            }
        });
        $('body').on('click','.addOrganization', function () {
            $('#orgModal').modal('show');
        });
        $('#saveAdd').on('click',function () {
            var newOrganization = $('#newOrganization').val();
            var innOrganization = $('#innOrganization').val();
            var kppOrganization = $('#kppOrganization').val();
            if (newOrganization.length > 0 && innOrganization.length > 0 && kppOrganization.length > 0) {
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "adminAjax=addOrganization&newOrganization=" + newOrganization + "&innOrganization=" + innOrganization + "&kppOrganization=" + kppOrganization,
                    success: function (data) {
                        window.location = ('/mngr/organization');
                    }
                });
            } else {
                Swal.fire({
                    title: "Ошибка!",
                    text: "Проверьте заполнение полей!",
                    type: "warning"
                });
            }
        });
        $('.btn-delete').on('click',function () {
            var deleteID = $(this).data('id');
            Swal.fire({
                title: "Удалить организацию?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Отмена"
            }).then((isConfirm)=>{
                if(isConfirm.value) {
                    $.ajax({
                        url: urlOne, type: "POST",
                        dataType: "text",
                        data: "adminAjax=deleteOrganization&deleteID=" + deleteID,
                        success: function (data) {
                            var result = $.parseJSON(data);
                            $('.tr-' + deleteID).remove();
                        }
                    });
                }
            });
        })
    });
</script>
