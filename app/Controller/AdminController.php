<?php
namespace App\Controller;
use App\Controller\BaseController;
class AdminController extends BaseController {

    public function index(){
        if(!isset($_SESSION['has_loggedin']) || !$_SESSION['has_loggedin']){
            throwException("Un Authorized login");
        }
        return view("admin.index");
    }

    public function logout(){
     unset($_SESSION['has_loggedin']);
     $redirectUrl = url("login");
    header("Location:$redirectUrl");   
    }

}