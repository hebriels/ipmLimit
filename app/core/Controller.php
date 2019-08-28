<?php
/**
 *Базовый контроллер
 * User: Slava
 * Date: 09.04.2018
 * Time: 21:41
 */

namespace app\core;

use app\core\View;


abstract class Controller
{
    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        if(!$this->checkAcl()){
            header('location: /');
            //View::errorCode(403);
        };
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
        //bugs($this->model);
    }

    public function loadModel($modelName)//автозагрузка модели
    {
        $path = 'app\models\\'.ucfirst($modelName);
        if(class_exists($path)){
            return new $path;
        }
    }

    public function checkAcl()
    {
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';
        if($this->isAcl('all')){
            return true;
        }elseif(isset($_SESSION['admin']) && $this->isAcl('admin')){
            return true;
        }elseif(isset($_SESSION['mngr']) && $this->isAcl('mngr')){
            return true;
        }

        return false;
    }

    public function isAcl($key)
    {
        return in_array($this->route['action'],$this->acl[$key]);
    }
}