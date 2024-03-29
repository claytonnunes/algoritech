<?php
namespace core;

class System extends Router {
    private $url;
    private $explode;
    private $area;
    private $controller;
    private $action;
    private $params;
    private $init;

    public function __construct(){
        $this->_setUrl();
        $this->_setExplode();
        $this->_setArea();
        $this->_setController();
        $this->_setAction();
        $this->_setParams();
    }

    private function _setUrl(){
        $this->url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
    }
    private function _setExplode(){
        $this->explode = explode('/', $this->url);
    }
    private function _setArea(){
        foreach ($this->routers as $i => $v){
            if ($this->onDefault && $this->explode[0] == $i){
                $this->area = $v;
                $this->onDefault = false;
            }
        }

        $this->area = empty($this->area) ? $this->routers[$this->routerOnDefault] : $this->area;

        if (!defined('APP_AREA')){
            define('APP_AREA', $this->area);
        }
    }
    private function _setController(){
        $this->controller = $this->onDefault ? $this->explode[0] :
            (empty($this->explode[1]) || is_null($this->explode[1]) || !isset($this->explode[1]) ? 'home' : $this->explode[1]);
    }
    private function _setAction(){
        $this->action = $this->onDefault ?
            (!isset($this->explode[1]) || is_null($this->explode[1]) || empty($this->explode[1]) ? 'index' : $this->explode[1]) :
            (!isset($this->explode[2]) || is_null($this->explode[2]) || empty($this->explode[2]) ? 'index' : $this->explode[2]);
    }
    private function _setParams(){
        if ($this->onDefault){
            unset($this->explode[0], $this->explode[1]);
        } else {
            unset($this->explode[0], $this->explode[1], $this->explode[2]);
        }

        if (end($this->explode) == null){
            array_pop($this->explode);
        }

        if (empty($this->explode)){
            $this->params = array();
        } else {
            foreach ($this->explode as $val){
                $this->params[] = $val;
            }
        }
    }

    public function getArea(){
        return $this->area;
    }
    public function getController(){
        return $this->controller;
    }
    public function getAction(){
        return $this->action;
    }
    public function getParams($indice){
        return isset($this->params[$indice]) ? $this->params[$indice] : null;
    }

    private function _validarController(){
        if (!(class_exists($this->init))) {
            header("HTTP/1.0 404 Not Found");
            define('ERROR', 'N�o foi localizado o Controller: ' . $this->controller);
            include("content/{$this->area}/shared/404.phtml");
            exit();
        }
    }
    private function _validarAction(){
        if (!(method_exists($this->init, $this->action))) {
            header("HTTP/1.0 404 Not Found");
            define('ERROR', 'N�o foi localizado o Action: ' . $this->action);
            include("content/{$this->area}/shared/404.phtml");
            exit();
        }
    }

    public function run(){
        $this->init = 'controller\' . $this->area . '\' . $this->controller . 'Controller';
        $this->_validarController();
        $this->init = new $this->init();
        $this->_validarAction();
        $act = $this->action;
        $this->init->$act();
    }
}
