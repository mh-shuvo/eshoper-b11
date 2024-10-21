<?php

namespace App\Controller;
use App\Controller\BaseController;
use Atova\Eshoper\Foundation\Request;
use PDO;

class LoginController extends BaseController
{
    public function index(){
        return view("admin.login");
    }

    public function attempt()
    {
        $data = $_POST;
        $hasError = false;
        
        // if(!isset($data["email"]) || is_null($data['email'])){
        //     session()->setError("email",'The Email field is required');
        //     $hasError = true;
        // }
        
        // if(!isset($data['password']) || is_null($data['password'])){
        //     session()->setError("password",'The Password field is required');
        //     $hasError = true;
        // }

        // if($hasError){
        //     return redirect("login");
        // }

        session()->set("email_error",'The Email field is required');

        session()->flash("login_success","Successfully Login");
        return redirect("login");
    }
}