<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 11.04.2018
 * Time: 20:06
 */

namespace app\core;

use app\lib\Db;

abstract  class Model
{
   public $db;

   public function __construct()
   {
       $this->db = new Db;
   }

}