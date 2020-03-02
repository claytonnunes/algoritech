<?php
namespace core;

class Router {
    protected $routers = array(
        'admin' => 'admin',
        'web'=>'web'
    );

    protected $routerOnDefault = 'web';

    protected $onDefault = true;
}
