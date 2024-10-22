<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Model;
use PDO;
class UserModel extends Model{
    protected $table = "users";

    public function getData(){
        $this->query("SELECT * FROM users WHERE `email`=:u_email AND `user_type` = :u_type AND `status` = :u_status;");
        $this->bind("u_email","mehedi@atova.com");
        $this->bind("u_type","ADMIN");
        $this->bind("u_status","ACTIVE");
        if(!$this->getErrors()){
          $data = $this->results(true);
          return $data;
        }
        return null;
    }

    public function loginAttempt($email,$password,$type="ADMIN",$status="ACTIVE"):bool|string{
      $sql = "SELECT * FROM users WHERE `email`=:u_email AND `user_type` = :u_type AND `status` = :u_status;";
      $this->query($sql);

        $this->bind("u_email",$email,PDO::PARAM_STR);
        $this->bind("u_status",$status,PDO::PARAM_STR);
        $this->bind("u_type",$type,PDO::PARAM_STR);


        if($this->getErrors()){
          return "Something went wrong. The error is: {$this->getErrors()}";  
        }
        
        $user = $this->results(false);
        
        if($this->rowCount() == 0){
          return "User not found with the given credentials";
        }

        if(!password_verify($password,$user->password)){
          return "Password doesn't match";
        }

        session()->set(ADMIN_AUTH_KEY,[
          "id" => $user->id,
          "name" => $user->name
        ]);
        
        return true;

    }
    
    
}
