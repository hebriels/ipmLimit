<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 09.04.2018
 * Time: 18:31
 */

namespace app\core;


class Router
{
    protected $routes =[];
    protected $params =[];

  function __construct()
  {
      $arrRoutes = require 'app/acl/routes.php';
      foreach ($arrRoutes as $key => $val){
          $this->add($key, $val);
      }
      //bugs($this->routes);
  }
//add route
  public function add($route, $params)
  {
     $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
     $route = '#^'.$route.'$#';
     $this->routes[$route] = $params;
  }
  //проверяем есть ли такой маршрут
    //$matches содержит то что найдено
    public function match() {
        //$URIParts = explode('?',$_SERVER['REQUEST_URI']);
        $URIParts = explode('?',$_SERVER['REQUEST_URI']);
        //$url = explode('/',$URIParts[0]);
        $url = trim($URIParts[0], '/');
        //$url = explode('?',$url);
        //$url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
  /*public function match()
  {
      $url = trim($_SERVER['REQUEST_URI'], '/');
      foreach ($this->routes as $route => $params) {
          if (preg_match($route, $url, $matches)) {
              foreach ($matches as $key => $match) {
                  if (is_string($key)) {
                      if (is_numeric($match)) {
                          $match = (int) $match;
                      }
                      $params[$key] = $match;
                  }
              }
              $this->params = $params;
              return true;
          }
      }
      return false;
  }*/

  public function run()
  {
      //bugs($action);
      /*if(!isset($_SESSION['mngr'])){
          //$this->location('/mngr/login');
          header("Location: /");
          exit();
      }*/

     if($this->match()) {
         $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
         if(class_exists($path)){
             $action = $this->params['action'].'Action';
             //bugs($_SESSION);
            //if($action != 'tableAction'){
                //if($action != 'loginAction' && !isset($_SESSION['mngr'])){
                //    header("Location: /mngr/login");
                //    exit();
                //}
            //}


             if(method_exists($path, $action)){
                 $controller = new $path($this->params);
                 $controller->$action();
             }else{
                 View::errorCode(404);
             }
         }else{
             View::errorCode(404);
         }
     }else{
         View::errorCode(404);
     }
  }
}