<?php

function base_path($path=null){

    return PROJECT_ROOT."/".$path; 
}

function getConfig($key,$default=null){
    $keyArr = explode(".",$key); 

    if(count($keyArr) == 1 || is_null($key)){
        return $default;
    }

    $config = new Atova\Eshoper\Foundation\Config($keyArr[0]);
    return $config->get($keyArr[1]) ?? $default;
}

function view($view,$data=[]){
    $viewFilePath = base_path("views/".str_replace(".","/",$view).".php");
    if(file_exists($viewFilePath)){
        require_once $viewFilePath;
        return true;
    }
    throwViewNotFoundException(sprintf("[%s] view not found",$viewFilePath));
}

function throwViewNotFoundException($msg){
    echo($msg);
    exit;
}

function throwException($msg){
    echo $msg;
    exit;
}

function asset($file){
    $absoluteFilePath = URLROOT.'/'.$file;
    return $absoluteFilePath;
}

function include_components($path,$ext="php"){
    $view = PROJECT_ROOT.'/views/'.str_replace(".","/",$path).".".$ext;
    include_once $view;
    if(file_exists($view)){
        include_once $view;
    }else{
        die(sprintf("The view file [%s] could not found.",$view));
    }
}

function url($url=null)
{
    $absoluteUrl = str_ends_with(URLROOT,"/") ? URLROOT.''.$url : URLROOT.'/'.$url;
    return $absoluteUrl;
}

function toCamelCase($string) {
    // Replace dashes and underscores with spaces
    $str = str_replace(['-', '_'], ' ', strtolower($string));

    // Capitalize the first letter of each word (except the first word)
    $str = lcfirst(str_replace(' ', '', ucwords($str)));

    return $str;
}