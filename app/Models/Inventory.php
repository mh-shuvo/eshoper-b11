<?php 
namespace App\Models;
use Atova\Eshoper\Foundation\Model;
use PDO;
class Inventory extends Model{
    protected $table = "inventories";


    public function stock_add($data){
        $sql = "INSERT INTO {$this->table} (`stock_input_date`,`product_id`,`quantity`,`action`,`price`,`total`,`note`) VALUES (:sid,:p_id,:qty,:act,:price,:total,:note)";
        $this->query($sql); 
        $this->bind('sid',$data['stock_input_date'],PDO::PARAM_STR);
        $this->bind('p_id',$data['product'],PDO::PARAM_STR);
        $this->bind('qty',$data['quantity'],PDO::PARAM_STR);
        $this->bind('act',$data['action'],PDO::PARAM_STR);
        $this->bind('price',$data['price'],PDO::PARAM_STR);
        $this->bind('total',$data['total'],PDO::PARAM_STR);
        $this->bind('note',$data['note'],PDO::PARAM_STR);
        $this->execute();

        if($this->getErrors()){
            return "".$this->getErrors()."";
        }
        return true;
    }
    public function getPaginatedInventories($limit, $offset)
    {
        $sql = " SELECT inv.*,products.product_name FROM {$this->table} as inv JOIN products ON inv.product_id = products.id WHERE inv.`action`='IN' ORDER BY inv.`id` DESC LIMIT :limit OFFSET :offset";
        $this->query($sql);

        // Bind parameters for pagination
        $this->bind("limit", $limit, PDO::PARAM_INT);
        $this->bind("offset", $offset, PDO::PARAM_INT);

        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }

        return $this->results();
    }

    // Method to count total inventories
    public function getTotalInventoriesCount()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE `action`='IN'";
        $this->query($sql);

        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }

        // Fetching a single result as an object with the 'results' method (not an array)
        $result = $this->results(false);

        return $result ? (int) $result->count : 0; // Return total count as integer
    }

    public function getAvailableStockByProductId($product_id){
        $totalIn = $this->getTotalStockByProductIdAndAction($product_id,"IN");
        $totalOut = $this->getTotalStockByProductIdAndAction($product_id,"OUT");

        if(is_string($totalIn) || is_string($totalOut)){
            return "Something went wrong to get available stock Error: {$totalIn},-{$totalOut}";
        }
        return $totalIn-$totalOut;
    }
    private function getTotalStockByProductIdAndAction($product_id,$action){
        $sql = "SELECT SUM(`quantity`) AS total FROM {$this->table} WHERE `product_id`=:pid AND `action`=:act";
        $this->query($sql);
        $this->bind("pid", $product_id, PDO::PARAM_INT);
        $this->bind("act", $action, PDO::PARAM_STR);
        
        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }
        $result = $this->results(false);
        return $result ? (int) $result->total :0;
    }
}