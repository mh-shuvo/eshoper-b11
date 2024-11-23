<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Model;
use PDO;
use PDOException;

class Slider extends Model{
    protected $table = "sliders";

    public function getAll(){
        $sql = "SELECT * FROM {$this->table} ORDER BY `id` DESC;";
        $this->query($sql);

        if($this->getErrors()){
            return "Something went wrong. The Error is: ".$this->getErrors();
        }
        
        return $this->results();
    }

    public function getAllActiveSliders(){
        $sql = "SELECT * FROM {$this->table} WHERE `status`=:status ORDER BY `id` DESC;";
        $this->query($sql);
        $this->bind('status',"ACTIVE",PDO::PARAM_STR);

        if($this->getErrors()){
            return "Something went wrong. The Error is: ".$this->getErrors();
        }
        
        return $this->results();
    }

    public function store($data){
        $sql = "INSERT INTO {$this->table} (`title`,`image`,`description`,`show_btn`,`btn_text`,`btn_link`,`status`) VALUES (:title,:image,:desc,:show_btn,:btn_txt,:btn_link,:status)";
        $this->query($sql);
        $this->bind("title",$data['title'],PDO::PARAM_STR);
        $this->bind("image",$data['image'],PDO::PARAM_STR);
        $this->bind("desc",$data['description'],PDO::PARAM_STR);
        $this->bind("show_btn",$data['show_btn'],PDO::PARAM_STR);
        $this->bind("btn_txt",$data['btn_text'],PDO::PARAM_STR);
        $this->bind("btn_link",$data['btn_link'],PDO::PARAM_STR);
        $this->bind("status",$data['status'],PDO::PARAM_STR);
        $this->execute();
        if($this->getErrors()){
            return ''. $this->getErrors();
        }
        return true;
    }
}
