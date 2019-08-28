<?php //bugs($allDepartments);?>

<div class="page-content-wrapper">
    <div class="page-content">
        <h2 class="page-title">Список организаций</h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="portlet box green-haze">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-arrows-alt"></i>Организации</div>
                    </div>
                    <div class="portlet-body">
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
                                            <button type="button" class="btn btn-xs btn-outline btn-info"
                                                    data-id="<?php echo $item['id'];?>" data-name="<?php echo $item['nameOrganization'];?>"
                                                    data-inn="<?php echo $item['innOrganization'];?>" data-kpp="<?php echo $item['kppOrganization'];?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-outline red btn-delete"
                                                    data-id="<?php echo $item['id'];?>">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
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
        <!-- END CONTENT BODY -->
    </div>
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
                        <label for="newOrganization" class="col-form-label">* Название организации:</label>
                        <input type="text" class="form-control" id="newOrganization">
                    </div>
                    <div class="form-group">
                        <label for="innOrganization" class="col-form-label">* ИНН организации:</label>
                        <input type="text" class="form-control" id="innOrganization">
                    </div>
                    <div class="form-group">
                        <label for="kppOrganization" class="col-form-label">* КПП организации:</label>
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
                        <label for="nameEdit" class="col-form-label">* Название организации:</label>
                        <input type="text" class="form-control" id="nameEdit" value="">
                    </div>
                    <div class="form-group">
                        <label for="innEdit" class="col-form-label">* ИНН организации:</label>
                        <input type="text" class="form-control" id="innEdit" value="">
                    </div>
                    <div class="form-group">
                        <label for="kppEdit" class="col-form-label">* КПП организации:</label>
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
<!-- END CONTENT -->
<script>
    $(document).ready(function() {
        var urlOne = '/ajax/ajaxpost';
        $.fn.editable.defaults.mode = 'inline';
        $('.btn-info').on('click',function () {
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
                        window.location = ('/admin/organization');
                    }
                });
            } else {
                swal({
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
                        window.location = ('/admin/organization');
                    }
                });
            } else {
                swal({
                    title: "Ошибка!",
                    text: "Проверьте заполнение полей!",
                    type: "warning"
                });
            }
        });
        $('.btn-delete').on('click',function () {
            var deleteID = $(this).data('id');
            swal({
                title: "Удалить организацию?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Отмена"
            }, function () {
                $.ajax({
                    url: urlOne, type: "POST",
                    dataType: "text",
                    data: "adminAjax=deleteOrganization&deleteID="+deleteID,
                    success: function (data) {
                        var result = $.parseJSON(data);
                        $('.tr-'+deleteID).remove();
                    }
                });
            });
        })
    });
</script>
