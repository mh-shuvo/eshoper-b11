<?php
namespace App\Controller;
use App\Controller\BaseController;
class AdminController extends BaseController {

    public function index(){
        if(!hasAdminLogin()){
            throwException(sprintf("Un Authorized access. <a href='%s'>Login</a>",url("login")));
        }
        return view("admin.index");
    }

    public function logout(){
     session()->remove(ADMIN_AUTH_KEY);
     $redirectUrl = url("login");
    header("Location:$redirectUrl");   
    }

}