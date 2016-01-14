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



/*
try{
  $strConnection = 'mysql:host='.$this->config['host'].';dbname='.$this->config['dbname'];
  $arrExtraParam= array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
  $this->_pdo = new \PDO($strConnection, $this->config['user'], $this->config['password'], $arrExtraParam);
  $this->_pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
  $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
}catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
}
return ($this->conn);
}
*/
?>
