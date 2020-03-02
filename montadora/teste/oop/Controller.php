<?php

namespace core;

class Controller extends System {
    public $dados;
    public $layout = '_layout';
    public $path;
    public $pathRender;

    public $captionController;
    public $captionAction;
    public $captionParams;

    //Metatag
    public $title;
    public $description;
    public $keywords;
    public $image;
    public $movie;

    private $scripts;
    private $style;

    public function __construct(){
        parent::__construct();
    }

    public function view($name = null){
        //Run function set path
        $this->_setPath($name);

        if (is_null($this->layout)) {
            $this->render();
        } else {
            $this->layout = "content/{$this->getArea()}/shared/{$this->layout}.phtml";
            if (file_exists($this->layout)) {
                $this->render($this->layout);
            } else {
                define('ERROR', "Não foi localizado o layout! {$this->layout}");
                header("HTTP/1.0 404 Not Found");
                include('content/' . $this->getArea() . '/shared/404.phtml');
                exit();
            }
        }
    }

    public function render($view = null){
        if (is_array($this->dados) && count($this->dados) > 0) {
            extract($this->dados, EXTR_PREFIX_ALL, 'view');
            extract(array(
                'controller' => (is_null($this->captionController) ? '' : $this->captionController),
                'action' => (is_null($this->captionAction) ? '' : $this->captionAction),
                'params' => (is_null($this->captionParams) ? '' : $this->captionParams)
            ), EXTR_PREFIX_ALL, 'caption');
        }

        if (!is_null($view) && is_array($view)) {
            foreach ($view as $l) {
                include($l);
            }
        } elseif (is_null($view) && is_array($this->path)) {
            foreach ($this->path as $l) {
                include($l);
            }
        } else {
            $file = is_null($view) ? $this->path : $view;
            file_exists($file) ? include ($file) : die($file);
        }
    }

    private function _setPath($render) {
        if (is_array($render)){
            foreach ($render as $l) {
                $path = 'view/' . $this->getArea() . '/' . $this->getController() . '/' . $l . '.phtml';
                $this->_fileExists($path);
                $this->path[] = $path;
            }
        } else {
            //Set path render
            $this->pathRender = is_null($render) ? $this->getAction() : $render;
            //Set path
            $this->path = 'view/' . $this->getArea() . '/' . $this->getController() . '/' . $this->pathRender . '.phtml';
            $this->_fileExists($this->path);
        }
    }

    private function _fileExists($file) {
        if (!file_exists($file)) {
            define('ERROR', "Não foi localizado a view! {$file}");
            header("HTTP/1.0 404 Not Found");
            include('content/' . $this->getArea() . '/shared/404.phtml');
            exit();
        }
    }
}
