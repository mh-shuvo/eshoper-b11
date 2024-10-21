<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Model;
use PDO;
class UserModel extends Model{
    protected $table = "users";

    public function getData(){
        $this->query("SELECT * FROM users;");
        if(!$this->getErrors()){
          $data = $this->results(true);
          return $data;
        }
        return null;
      }
}
