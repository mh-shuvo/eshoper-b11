<?php
namespace Atova\Eshoper\Foundation;
use \PDO;
class Database{

    protected $driver;
    protected $host;
    protected $user;
    protected $password;
    protected $dbname;
    protected $connection = FALSE;
    
    public function __construct()
    {
        // $dbDetails = getConfig("database.*");
        // $this->driver = $dbDetails["DB_DRIVER"];
        // $this->host = $dbDetails["DB_HOST"];
        // $this->user = $dbDetails["DB_USER"]  ;     
        // $this->password = $dbDetails["DB_PASSWORD"];
        if($this->connection == false){
            $this->connect();
        }
        
    }

    public function connect(){
        //new PDO("mysql:host=localhost;dbname=lab17","root",null);

        try {
            // $pdo = new PDO("$this->driver:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
            $pdo = new PDO("mysql:host=localhost;dbname=lab20","root",null);;
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
           throwException($e->getMessage());
        }
        
    }
    public function getConnection(){
        return $this->connection;
    }


}