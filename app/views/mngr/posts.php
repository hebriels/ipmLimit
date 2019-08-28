<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Список должностей </h3>
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
                            <h3 class="kt-portlet__head-title"> Должности </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" id="tableReport">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Должность</th>
                                    <th>Отдел</th>
                                    <th>Удаление</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $colPosts=1; foreach ($allPosts as $item):?>
                                    <tr class="tr-<?php echo $item['id'];?>">
                                        <td style="width:10%"><?php echo $colPosts;?></td>
                                        <td style="width:40%">
                                            <a href="javascript:;" class="posts" data-type="text" data-pk="<?php echo $item['id'];?>">
                                                <?php echo $item['postDepartment'];?>
                                            </a>
                                        </td>
                                        <td style="width:40%">
                                            <a href="javascript:;" class="department" data-type="select" data-pk="<?php echo $item['id'];?>">
                                                <?php foreach ($allDepartments as $item2){
                                                    if($item['nameDepartment'] == $item2['id']){
                                                        echo $item2['nameDepartment'];
                                                    }else{
                                                        $item['nameDepartment'];
                                                    }
                                                };?>
                                            </a>
                                        </td>
                                        <td style="width:10%">
                                            <button type="button" class="btn btn-xs btn-outline-danger btn-icon btn-delete"
                                                    data-id="<?php echo $item['id'];?>">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php $colPosts++; endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <a href="javascript:;" class="btn btn-success addPosts"><i class="fa fa-plus"></i>Добавить должность</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <div class="modal fade" id="postsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление должности</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="postDepartment" class="col-form-label">Отдел:</label>
                        <select class="form-control" name="postDepartment" id="postDepartment">
                            <?php foreach ($allDepartments as $iteam):?>
                                <option value="<?php echo $iteam['id'];?>"><?php echo $iteam['nameDepartment'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newPosts" class="col-form-label">Должность:</label>
                        <input type="text" class="form-control" id="newPosts">
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
<script>
    $(document).ready(function() {
        let urlOne = '/ajax/ajaxpost';
        $.fn.editable.defaults.mode = 'inline';
        function ajaxDep() {
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "adminAjax=getDepartments",
                success: function(data) {
                    let result = $.parseJSON(data);
                    $('.department').editable({
                        showbuttons: false,
                        //value: 1,
                        source : result,
                        success: function(response, newValue) {
                            let id = $(this).data('pk');
                            $.ajax({
                                url: urlOne, type: "POST", dataType: "text",
                                data: "adminAjax=editPostsDepartment&id="+id+"&name="+newValue,
                                success: function (data) {}
                            });
                        }
                    });
                }
            });
        }
        ajaxDep();

        $('.posts').editable({
            type: 'text',
            success: function(response, newValue) {
                var id = $(this).data('pk');
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "adminAjax=editPosts&id="+id+"&name="+newValue,
                    success: function (data) {}
                });
            }
        });

        $('body').on('click','.addPosts', function () {
            $('#postsModal').modal('show');
        });
        $('#saveAdd').on('click',function () {
            var postDepartment = $('#postDepartment').val();
            var newPosts = $('#newPosts').val();
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "adminAjax=addPosts&postDepartment="+postDepartment+"&newPosts="+newPosts,
                success: function (data) {
                    window.location = ('/mngr/posts');
                }
            });
        });
        $('.btn-delete').on('click',function () {
            let deleteID = $(this).data('id');
            Swal.fire({
                title: "Удалить должность?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Отмена"
            }).then((isConfirm)=>{
                if(isConfirm.value) {
                    $.ajax({
                        url: urlOne, type: "POST",
                        dataType: "text",
                        data: "adminAjax=deletePosts&deleteID=" + deleteID,
                        success: function (data) {
                            let result = jQuery.parseJSON(data);
                            $('.tr-' + deleteID).remove();
                        }
                    });
                }
            });
        })
    });
</script>
