<?php
namespace Atova\Eshoper\Foundation;

class Session{

    public function __construct()
    {
        $this->start();
    }

    private function start(){
        session_start();
    }

}