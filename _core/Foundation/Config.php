<?php
namespace Atova\Eshoper\Foundation;

class Config{
    
    private $fileName;
    private $denoteAllConfigIdentifier = "*";


    public function __construct($fileName){
        $this->fileName = "config/".$fileName.".php";
    }

    
    
    public function get($key){
        if(!file_exists(base_path($this->fileName))){
            return false;
        }

        $configValues = require_once base_path($this->fileName);

        if($key == $this->denoteAllConfigIdentifier){
            return $configValues;
        }
        
        return array_key_exists($key,$configValues) ? $configValues[$key] : false;
    }







}