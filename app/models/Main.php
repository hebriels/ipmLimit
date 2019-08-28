<?php

namespace app\models;
use app\core\Model;

class Main extends Model
{
    public $err;
    public function getAllEntry()
    {
        return $this->db->row('SELECT * FROM users');
    }
//получить значение конкретной опции
    public function getOneOption($str)
    {
        $params = ['optionName' => $str];
        return $this->db->column('SELECT optionValue FROM optionSettings WHERE optionName=:optionName',$params);
    }
//получаем timezone
    public function getTimezone()
    {
        $idTimezone = $this->getOneOption('timezone');
        $params = ['id' => $idTimezone];
        return $this->db->column('SELECT correct_time FROM timezone WHERE id = :id', $params);
    }
}