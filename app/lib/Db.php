<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 11.04.2018
 * Time: 20:22
 */

namespace app\lib;

use PDO;

class Db
{
    protected $db;

    public function __construct()
    {
        $config = require 'app/config/db.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].'', $config['user'], $config['pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
//запрос
    public function query($sql, array $params=[])
    {
        $stmt = $this->db->prepare($sql);
        if(!empty($params)){
            foreach ($params as $key => $value){
                $stmt->bindValue(':'.$key, $value);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, array $params=[])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount($sql, array $params=[])
    {
        $result = $this->query($sql, $params);
        return $result->rowCount();
    }

    public function column($sql, array $params=[])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}