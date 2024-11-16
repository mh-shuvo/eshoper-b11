<?php
namespace App\Controller;
use App\Controller\BaseController;
use App\Middleware\AdminLoginMiddleware;
class AdminController extends BaseController {
    protected $middlewares = [AdminLoginMiddleware::class];
    public function index(){
        return view("admin.index");
    }

    public function logout(){
     session()->remove(ADMIN_AUTH_KEY);
     $redirectUrl = url("login");
    header("Location:$redirectUrl");   
    }

}