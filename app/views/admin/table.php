<?php //bugs($managers[0]); ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <h1 class="page-title">Управление пользователями</h1>
        <div class="mt-bootstrap-tables">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-green hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Список пользователей</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table id="tableUser"
                                    data-sort-name="fio" data-sort-order="asc"
                                    data-toggle="table" data-mobile-responsive="true"
                                    data-pagination="true" data-page-size="25" data-page-list="[5, 10, 15, 20, 25, 30]"
                                    data-show-columns="true" data-search="true"
                                    data-cookie="true" data-cookie-id-table="tableUser">
                                <thead>
                                <tr>
                                    <th data-field="fio" data-align="center" data-sortable="true">Пользователь</th>
                                    <th data-field="department" data-align="center" data-sortable="true">Отдел</th>
                                    <th data-field="initiator" data-align="center" data-sortable="true">Должность</th>
                                    <th data-field="phonejob" data-align="center">Тел. рабочий</th>
                                    <th data-field="phonehome" data-align="center">Тел. личный</th>
                                    <th data-field="email" data-align="center">Email</th>
                                    <th data-field="skype" data-align="center">Скайп</th>
                                    <th data-field="pass" data-align="center">Пароль</th>
                                    <th data-field="datareg" data-align="center" data-sortable="true">Дата рег.</th>
                                    <th data-field="actions" data-align="center">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($managers as $manager): ?>
                                    <tr>
                                        <td><?php echo $manager['userSurname'].' '.$manager['userFirstName'].' '.$manager['userLastName']; ?></td>
                                        <td>
                                            <?php foreach ($allDepartments as $depart){
                                                if($manager['userDepartment'] == $depart['id']){
                                                    echo $depart['nameDepartment'];
                                                }
                                            };?>
                                        </td>
                                        <td>
                                            <?php foreach ($allPosts as $posts){
                                                if($manager['userRole'] == $posts['id']){
                                                    echo $posts['postDepartment'];
                                                }
                                            };?>
                                        </td>
                                        <td><?php echo $manager['userWorkPhone']; ?></td>
                                        <td><?php echo $manager['userPersonalPhone']; ?></td>
                                        <td><?php echo $manager['userMail']; ?></td>
                                        <td><?php echo $manager['userSkype']; ?></td>
                                        <td><?php echo $manager['userPwd']; ?></td>
                                        <td><?php echo $manager['timeReg']; ?></td>
                                        <td>
                                            <a href="<?php echo '/admin/edit/'.$manager['id']; ?>" class="btn btn-xs btn-outline green-jungle btn-success" title="Редактировать данные пользователя">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!--<button type="button" class="btn btn-xs btn-outline red sweetAlertAdminDelete" data-delete="<?php //echo '/admin/del/'.$manager['id']; ?>">
                                                <i class="fa fa-trash-o"></i>
                                            </button>-->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tableUser');
        table.bootstrapTable('hideColumn','phonehome');
        table.bootstrapTable('hideColumn','skype');
        table.bootstrapTable('hideColumn','pass');

        $('.sweetAlertAdminDelete').on('click', function(){
            var urlDelete = $(this).data('delete');
            swal({
                title: "Удалить пользователя?",
                type: "warning",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Отмена",
                confirmButtonText: "Да",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) $(location).attr('href',urlDelete);
            });
        });
    });
</script>