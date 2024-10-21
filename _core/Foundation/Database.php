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
        $this->driver = getConfig("database.DB_DRIVER");
        $this->host = getConfig("database.DB_HOST");
        $this->user = getConfig("database.DB_USER");   
        $this->password = getConfig("database.DB_PASSWORD");
        $this->dbname = getConfig("datbase.DB_NAME");
        if($this->connection == false){
            print_r(getConfig("app.*","Test"));
            echo "<br>";
            $this->connect();
        }
        
    }

    public function connect(){
        //new PDO("mysql:host=localhost;dbname=lab17","root",null);

        try {
            $pdo = new PDO("$this->driver:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
            // $pdo = new PDO("mysql:host=localhost;dbname=lab26","root",null);;
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