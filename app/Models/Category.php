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

    // Method to fetch paginated categories
    public function getPaginatedCategories($limit, $offset)
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT :limit OFFSET :offset";
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
    public function getTotalCategoriesCount()
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
}
