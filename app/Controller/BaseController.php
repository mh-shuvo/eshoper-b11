<?php

namespace App\Controller;

abstract class BaseController
{
    protected $middlewares = [];
    public function index()
    {

        echo "<h1>This is the index page</h1>";

    }
    public function getMiddlewares(){
        return $this->middlewares;
    }
}