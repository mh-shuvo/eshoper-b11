<?php
namespace App\Controller;
use App\Controller\BaseController;
class WelcomeController extends BaseController{
    public function index(){
        return view("web.index");
    }
}