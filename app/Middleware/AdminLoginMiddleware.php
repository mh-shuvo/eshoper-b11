<?php
namespace App\Middleware;
use App\Interfaces\MiddlewareInterface;
class AdminLoginMiddleware implements MiddlewareInterface{
    public function handle(){
        if(!hasAdminLogin()){
            throwException("Un Authorized Login");
        }
    }
}