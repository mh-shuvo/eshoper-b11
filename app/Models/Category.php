<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Model;
use PDO;
use PDOException;

class Category extends Model{
    protected $table = "categories";

    public function getAll(){
        $sql = "SELECT * FROM {$this->table} ORDER BY `id` DESC;";
        $this->query($sql);

        if($this->getErrors()){
            return "Something went wrong. The Error is: ".$this->getErrors();
        }
        
        return $this->results();
    }

    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE `id` = :id;";
        $this->query($sql);
        $this->bind("id",$id,PDO::PARAM_INT);

        if(!$this->execute()){
            return $this->getErrors();
        }

        return true;
    }
}
