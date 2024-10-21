<?php

namespace App\Controller;
use App\Controller\BaseController;
use Atova\Eshoper\Foundation\Database;
use PDO;

class LoginController extends BaseController
{
    public function index(){
        return view("admin.login");
    }

    public function attempt()
    {
        $data = $_POST;
        $db = (new Database())->connect();

        if(isset($data['email']) && isset($data['password'])){
            $query = "SELECT * FROM `users` WHERE `email`='".$data['email']."' and type='admin';";
            $result = $db->query($query);

            if($result->rowCount()  > 0){
                $user = $result->fetch(PDO::FETCH_ASSOC);
                   if(password_verify($data['password'],$user['password'])){
                        $_SESSION['has_loggedin'] = true;
                        $redirectUrl = url("admin");
                        header("Location:$redirectUrl");
                   }else{
                    echo "Incorrect password";
                   }
            }else{
                echo "User Not FOund";
            }
        }
        
    }
}