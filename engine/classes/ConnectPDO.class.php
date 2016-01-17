<?php
namespace engine\classes;

use PDO;

class ConnectPDO
{
  public $_pdo;
  public $config;

  public function __construct($config){
    $this->config = $config;
  }
  public function connect(){
    $this->conn = null;
      try{
          $this->conn = new \PDO("mysql:host=" . $this->config['host'] . ";dbname=" . $this->config['dbname'], $this->config['user'], $this->config['password']);
          $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }catch(PDOException $exception){
          echo "Connection error: " . $exception->getMessage();
      }

      return ($this->conn);
  }


}
?>
