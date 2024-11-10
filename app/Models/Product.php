<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Model;
use PDO;
use PDOException;

class Product extends Model{
    protected $table = "products";


    public function store($data){
        $sql = "INSERT INTO `{$this->table}` (`category_id`,`product_name`,`image`,`status`,`is_featured`,`price`,`description`) VALUES (:cate_id,:name,:image,:status,:is_featured,:price,:desc)";
        $this->query($sql);
        $this->bind("cate_id",$data['category'], PDO::PARAM_STR);
        $this->bind("price",$data['price'],PDO::PARAM_STR);
        $this->bind("desc",$data['description'],PDO::PARAM_STR);
        $this->bind("name",$data['name'],PDO::PARAM_STR);
        $this->bind("image",$data['image'],PDO::PARAM_STR);
        $this->bind("status",$data['status'],PDO::PARAM_STR);
        $this->bind("is_featured",$data['is_featured'],PDO::PARAM_STR);

        $this->execute();
        if($this->getErrors()){
            return ''. $this->getErrors();
        }
        return true;
    }

    public function getPaginatedProducts($limit, $offset)
    {
        $sql = "SELECT pt.*,ct.name AS category_name FROM {$this->table} as pt JOIN `categories` AS ct ON pt.category_id = ct.id  ORDER BY pt.`id` DESC LIMIT :limit OFFSET :offset";
        $this->query($sql);

        // Bind parameters for pagination
        $this->bind("limit", $limit, PDO::PARAM_INT);
        $this->bind("offset", $offset, PDO::PARAM_INT);

        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }

        return $this->results();
    }

    // Method to count total categories
    public function getTotalProductsCount()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $this->query($sql);

        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }

        // Fetching a single result as an object with the 'results' method (not an array)
        $result = $this->results(false);

        return $result ? (int) $result->count : 0; // Return total count as integer
    }

    
    public function getProductDetailsById($id){
        $sql = "SELECT pt.*,ct.name AS category_name FROM {$this->table} as pt JOIN `categories` AS ct ON pt.category_id = ct.id WHERE pt.`id` =:id";
        $this->query($sql);

        $this->bind("id",$id,PDO::PARAM_INT);

        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }

        // Fetching a single result as an object with the 'results' method (not an array)
        $result = $this->results(false);

        return $result ? $result : "No Product Found.";

    }
}
