<?php
namespace engine\classes;

class Query
{

  public $var;
  public $database;
  public $column = array();

  function __construct($database){
    $this->database = $database;
    //$test = new ConnectPDO();
  }

  function getColumn(){
    $req = $this->database->conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='article'");
    $req->execute();
    if($req->rowCount()> 0){
      // on recupere le resultat sous forme de tableau imbriqué avec clé
      $data = $req->fetchAll();
      for($i = 0; $i <= count($data) - 1; $i++ ){
        $this->column[$i] = $data[$i]['COLUMN_NAME'];
      }
      return $this->column;
    }else{
      echo "Error lors de la requête sql";
    }    
  }

  function getData(){
    $req = $this->database->conn->prepare("SELECT * FROM article");
    $req->execute();
    if($req->rowCount()> 0){
      // on recupere le resultat sous forme de tableau imbriqué avec clé
      $data = $req->fetchAll(\PDO::FETCH_OBJ);
      return $data;
    }else{
      echo "Error lors de la requête sql";
    }    

  }

  function test(){
    return $this->column;
  }
}

?>
