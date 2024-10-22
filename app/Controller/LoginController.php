<?php

namespace App\Controller;
use App\Controller\BaseController;
use Atova\Eshoper\Foundation\Request;
use PDO;
use App\Models\UserModel;

use function PHPSTORM_META\type;

class LoginController extends BaseController
{
    public function index(){
        if(hasAdminLogin()){
            return redirect("admin");
        }
        return view("admin.login");
    }

    public function attempt()
    {
        $data = $_POST;
        $errors = [];

        if(is_null($data['email']) || $data['email'] == '' ){
            $errors['email_error']  = "The Email field is required";
        }
        
        if(is_null($data['password']) || $data['password'] == '' ){
            $errors['password_error']  = "The Password field is required";
        }
        
        if(!empty($errors)){
            session()->flash("login_validation_errors",$errors);
            return redirect("login");
        }

        $model = new UserModel();
        $hasLogin = $model->loginAttempt($data['email'],$data['password']);
        if(is_string($hasLogin)){
            session()->flash("login_error",$hasLogin);
            return redirect("login");
        }

        session()->flash("login_success","Successfully Login");
        return redirect("admin");
    }
}