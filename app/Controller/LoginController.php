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
        

        session()->flash("login_success","Successfully Login");
        return redirect("login");
    }
}