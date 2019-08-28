<?php

/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 17.04.2018
 * Time: 20:04
 */
namespace app\models;
use app\core\Model;

class Admin extends Model
{
    public $err;

    public function getAllEntry()
    {
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(registrationDate,"%d-%m-%Y")) AS timeReg FROM users');
    }

    public function getOneEntry($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
    }

    public function isEntryExists($id)
    {
        $params = ['id' => $id];
        return $this->db->column('SELECT id FROM users WHERE id = :id', $params);
    }

    public function getNoticeSettings()
    {
        return $this->db->row('SELECT * FROM noticeSettings');
    }

    public function loginValidate()
    {
        $config = require 'app/config/admin.php';
        //проверка данных формы
        if($config['login'] != $_POST['login'] or $config['pass'] != $_POST['pass']){
            $this->err = 'Неверные данные для входа!';
            return false;
        }
     return true;
    }

    public function postValidate($type)
    {
        /*
        if(empty($_FILES['img']['tmp_name'] && $type == 'add')){
            $this->err = 'Файл не выбран';
            return false;
        }*/
        return true;
    }
//получение массива отделов
    public function getAllDepartments()
    {
        return $this->db->row('SELECT * FROM departments');
    }
//получение массива организаций
    public function getAllOrganization()
    {
        return $this->db->row('SELECT * FROM organization');
    }
//получение массива должностей
    public function getAllPosts()
    {
        return $this->db->row('SELECT * FROM departmentPost');
    }
//получение массива опций сайта
    public function getAllOptions()
    {
        return $this->db->row('SELECT * FROM optionSettings');
    }
//получить значение конкретной опции
    public function getOneOption($str)
    {
        $params = ['optionName' => $str];
        return $this->db->column('SELECT optionValue FROM optionSettings WHERE optionName=:optionName',$params);
    }
//получение массива валюты
    public function getAllCurrency()
    {
        return $this->db->row('SELECT * FROM currency');
    }

    public function addEntry()
    {
        $params = ['userSurname' => $_POST['userSurname'],
            'userFirstName' => $_POST['userFirstName'],
            'userLastName' => $_POST['userLastName'],
            'userDepartment' => $_POST['userDepartment'],
            'userRole' => $_POST['userRole'],
            'userToMail' => '',
            'userToMailPay' => '',
            'holiday' => 'false',
            'userWorkPhone' => $_POST['userWorkPhone'],
            'userPersonalPhone' => $_POST['userPersonalPhone'],
            'userMail' => $_POST['userMail'],
            'userInitiatorTable' => '',
            'userSkype' => $_POST['userSkype'],
            'userPwd' => $_POST['userPwd'],
            'userAvatar' => 'nophoto.jpg'];
        $this->db->query('INSERT INTO users (userSurname, userFirstName, userLastName, userDepartment, userRole, 
                            userToMail, userToMailPay, holiday, userWorkPhone, userPersonalPhone, userMail, userInitiatorTable, userSkype, userPwd, userAvatar)
                    VALUES (:userSurname, :userFirstName, :userLastName, :userDepartment, :userRole, :userToMail, :userToMailPay, :holiday, 
                    :userWorkPhone, :userPersonalPhone, :userMail, :userInitiatorTable, :userSkype, :userPwd, :userAvatar)', $params);

        return $this->db->lastInsertId();
    }
//добавление пользователя в таблицу noticeSettings
    public function addNoticeSettings($id)
    {
        $params = ['userID' => $id];
        $this->db->query('INSERT INTO noticeSettings (user_id, noticeMailAddInvoice, noticeMailSignInvoice, noticeMailFailure, noticeMailSuccess, 
                            noticeMailComment, noticeDashAddInvoice, noticeDashSignInvoice, noticeDashFailure, noticeDashSuccess, noticeDashComment)
                    VALUES (:userID, "true", "true", "true", "true", "true", "true", "true", "true", "true", "true")', $params);
    }

    public function editEntry($id) {
        $params = ['id' => $id,
            'userSurname' => $_POST['userSurname'],
            'userFirstName' => $_POST['userFirstName'],
            'userLastName' => $_POST['userLastName'],
            'userDepartment' => $_POST['userDepartment'],
            'userRole' => $_POST['userRole'],
            'userWorkPhone' => $_POST['userWorkPhone'],
            'userPersonalPhone' => $_POST['userPersonalPhone'],
            'userMail' => $_POST['userMail'],
            'userSkype' => $_POST['userSkype'],
            'userPwd' => $_POST['userPwd']];
        $this->db->query('UPDATE users SET userSurname = :userSurname,
                          userFirstName = :userFirstName,
                          userLastName = :userLastName,
                          userDepartment = :userDepartment,
                          userRole = :userRole,
                          userWorkPhone = :userWorkPhone,
                          userPersonalPhone = :userPersonalPhone,
                          userMail = :userMail,
                          userSkype = :userSkype,
                          userPwd = :userPwd
                          WHERE id = :id', $params);
    }

    public function postDelete($id) {
        $params = ['id' => $id];
        $this->db->query('DELETE FROM users WHERE id = :id', $params);
        //unlink('public/materials/'.$id.'.jpg');
    }
}