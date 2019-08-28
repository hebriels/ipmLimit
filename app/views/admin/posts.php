<?php //bugs($allDepartments);?>

<div class="page-content-wrapper">
    <div class="page-content">
        <h2 class="page-title">Список должностей</h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="portlet box green-haze">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-list"></i>Должности</div>
                    </div>
                    <div class="portlet-body">
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
                                        <td style="width:40%">
                                            <a href="javascript:;" class="posts" data-type="text" data-pk="<?php echo $item['id'];?>">
                                                <?php echo $item['postDepartment'];?>
                                            </a>
                                        </td>
                                        <td style="width:10%">
                                            <button type="button" class="btn btn-xs btn-outline red btn-delete"
                                                    data-id="<?php echo $item['id'];?>">
                                                <i class="fa fa-trash-o"></i>
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
        var urlOne = '/ajax/ajaxpost';
        $.fn.editable.defaults.mode = 'inline';
        function ajaxDep() {
            $.ajax({
                url: urlOne, type: 'POST', dataType: "text",
                data: "adminAjax=getDepartments",
                success: function(data) {
                    var result = $.parseJSON(data);
                    $('.department').editable({
                        showbuttons: false,
                        //value: 1,
                        source : result,
                        success: function(response, newValue) {
                            var id = $(this).data('pk');
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
                    window.location = ('/admin/posts');
                }
            });
        });
        $('.btn-delete').on('click',function () {
            var deleteID = $(this).data('id');
            swal({
                title: "Удалить должность?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Отмена"
            }, function () {
                $.ajax({
                    url: urlOne, type: "POST",
                    dataType: "text",
                    data: "adminAjax=deletePosts&deleteID="+deleteID,
                    success: function (data) {
                        var result = jQuery.parseJSON(data);
                        $('.tr-'+deleteID).remove();
                    }
                });
            });
        })
        /*function addPayAgain() {
            var dataNumber = $('#tableReport tr:last').find('td').data('number')+1;
            if(isNaN(dataNumber)){dataNumber = 1};
            var output = '\
                <tr>\
                    <td class="success" data-number="'+dataNumber+'" data-savepay="save">'+dataNumber+'</td>\
                    <td class="success"><input type="text" class="form-control" data-expense="expense" name="expense"></td>\
                    <td class="success"><input type="text" class="form-control" data-expense="money" name="money"></td>\
                    <td class="success"><input type="text" data-provide="datepicker" data-expense="dateExpense" class="input-group form-control date date-picker" name="dateExpense"></td>\
                </tr>';
            $('#tableReport tbody').append(output);
            blankSum();
        }
        function blankSum() {
            $.ajax({
                url: "/app/view/mngr/chat.php", type: "POST", dataType: "text",
                data: "mngrAjax=blankSum&idPay="+idPay+"&money="+money,
                success: function (data) {
                    var result = jQuery.parseJSON(data);
                    console.log(result);
                    if(result.moneySum['moneySum']>'0'){
                        result.moneySum['moneySum']=result.moneySum['moneySum'];
                    }else{
                        result.moneySum['moneySum']=0;
                    }
                    $('.sumExpense').find('span').text(result.moneySum['moneySum']);
                    $('.sumExpenseNew').find('span').text(result.money);
                }
            });
        }
        $('.addPay').on('click',function() {
            if($('[data-expense="expense"]').length>0){
                var expense = $('[data-expense="expense"]').val();
                var money = $('[data-expense="money"]').val();
                var dateExpense = $('[data-expense="dateExpense"]').val();
                if(expense==='' || money==='' || dateExpense===''){
                    swal({
                        title: "Заполните все поля!",
                        type: "info"
                    });
                }else{
                    //console.log('dataNumber');
                    $.ajax({
                        url: "/app/view/mngr/chat.php", type: "POST", dataType: "text",
                        data: "mngrAjax=reportExpenseSave&expense="+expense+"&money="+money+"&dateExpense="+dateExpense+"&idPay="+idPay,
                        success: function (data) {
                            var result = jQuery.parseJSON(data);
                            console.log(result);
                            $('#tableReport tr:last').remove();
                            var dataNumber = $('#tableReport tr:last').find('td').data('number')+1;
                            var output = '\
                                <tr>\
                                    <td class="success" data-number="'+dataNumber+'" data-savepay="save">'+dataNumber+'</td>\
                                    <td class="success">'+result.expense+'</td>\
                                    <td class="success">'+result.money+'</td>\
                                    <td class="success">'+result.dateExpense+'</td>\
                                </tr>';
                            $('#tableReport tbody').append(output);
                            blankSum();
                            addPayAgain();
                        }
                    });
                }
            }else{
                addPayAgain();
            }


        });

        $('.savePay').on('click',function() {
            var expense = $('[data-expense="expense"]').val();
            var money = $('[data-expense="money"]').val();
            var dateExpense = $('[data-expense="dateExpense"]').val();
            console.log(idPay+'-'+expense+'-'+money+'-'+dateExpense);

            if(expense==='' || money==='' || dateExpense===''){
                swal({
                    title: "Заполните все поля!",
                    type: "info"
                });
            }else{
                if($('[data-expense="expense"]').length>0){
                    $.ajax({
                        url: "/app/view/mngr/chat.php", type: "POST", dataType: "text",
                        data: "mngrAjax=reportExpenseSave&expense="+expense+"&money="+money+"&dateExpense="+dateExpense+"&idPay="+idPay,
                        success: function (data) {
                            var result = jQuery.parseJSON(data);
                            console.log(result);
                            $('#tableReport tr:last').remove();
                            var dataNumber = $('#tableReport tr:last').find('td').data('number')+1;
                            if(isNaN(dataNumber)){dataNumber = 1};
                            var output = '\
                                <tr>\
                                    <td class="success" data-number="'+dataNumber+'" data-savepay="save">'+dataNumber+'</td>\
                                    <td class="success">'+result.expense+'</td>\
                                    <td class="success">'+result.money+'</td>\
                                    <td class="success">'+result.dateExpense+'</td>\
                                    <td><a href="javascript:;" class="btn btn-xs btn-outline blue editExpense"\
                                            data-idedit="'+result.idExpense+'" data-expenseedit="'+result.expense+'"\
                                            data-moneyedit="'+result.money+'" data-dateedit="'+result.dateExpense+'">\
                                            <i class="fa fa-edit"></i></a>\
                                    </td>\
                                </tr>';
                            $('#tableReport tbody').append(output);
                            blankSum();
                        }
                    });
                }else{
                    swal({
                        title: "Нечего сохранять!",
                        type: "info"
                    });
                }
            }
        });
        $('body').on('click','.editExpense', function () {
            var idEdit = $(this).data('idedit');
            var expenseedit = $(this).data('expenseedit');
            var moneyedit = $(this).data('moneyedit');
            var dateedit = $(this).data('dateedit');
            $('#expenseEditTable').val(expenseedit);
            $('#moneyEditTable').val(moneyedit);
            $('#dataEditTable').val(dateedit);
            $('#idEditSave').val(idEdit);
            $('#exampleModal').modal('show');
        });
        $('#saveEdit').on('click',function () {
            var id = $('#idEditSave').val();
            var expense = $('#expenseEditTable').val();
            var money = $('#moneyEditTable').val();
            var dateExpense = $('#dataEditTable').val();
            $.ajax({
                url: "/app/view/mngr/chat.php", type: "POST", dataType: "text",
                data: "mngrAjax=expenseSaveEdit&expense="+expense+"&money="+money+"&dateExpense="+dateExpense+"&id="+id+"&idPay="+idPay,
                success: function (data) {
                    var result = jQuery.parseJSON(data);
                    window.location = "/mngr/reportpay/"+idPay;
                }
            });
        });
        $('.goPay').on('click',function () {
            swal({
                title: "Отправить отчет в бухгалтерию?",
                type: "info"
            });
        });*/
    });
</script>
