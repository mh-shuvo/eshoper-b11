<?php
namespace Atova\Eshoper\Foundation;
use Atova\Eshoper\Foundation\Database;

class Model extends Database{

    protected $tableScript = "1_create_users.sql";
    
    public function __construct()
    {
        parent::__construct();
    }

    public function create_table(){
      $absolutePath = base_path("databases/migrations/".$this->tableScript);
      echo $absolutePath;  
    }

}