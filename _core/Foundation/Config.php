<?php
namespace Atova\Eshoper\Foundation;

class Config{
    private $denoteAllConfigIdentifier = "*";

    private $data = [];

    // Hold the instance of the class
    private static $instance = null;

    // Private constructor to prevent creating a new instance with 'new'
    private function __construct()
    {
        // Initialization code here
    }

    // Public method to get the instance of the class
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }


    // public function __construct($fileName){
    //     $this->fileName = "config/".$fileName.".php";
    // }
    
    public function get($key=[],$default=null){
        $fileName = base_path("config/".$key[0].".php");

        if(!file_exists($fileName)){
            return false;
        }

        $configValues = require $fileName;

        if($key[1] == $this->denoteAllConfigIdentifier){
            return $configValues;
        }
        
        return array_key_exists($key[1],$configValues) ? $configValues[$key[1]] : $default;
    }







}