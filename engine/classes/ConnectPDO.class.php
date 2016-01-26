<?php
namespace engine\classes;

use PDO;

class ConnectPDO
{
  public $_pdo;
  public $config;
  public $conn;

  public function __construct($config){
    $this->config = $config;
  }
  public function connect(){
      try{
          $this->conn = new \PDO("mysql:host=" . $this->config['db']['host'] . ";dbname=" . $this->config['db']['dbname'], $this->config['db']['user'], $this->config['db']['password'],  array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
          $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }catch(PDOException $exception){
          echo "Connection error: " . $exception->getMessage();
      }

      return ($this->conn);
  }


}
?>
