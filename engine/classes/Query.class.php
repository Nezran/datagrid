<?php
namespace engine\classes;

class Query
{

  public $var;
  public $database;

  function __construct($database){
    $this->database = $database;
    self::getColumn();
    //$test = new ConnectPDO();
  }

  function getColumn(){
    $req = $this->database->conn->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='article'");
    $req->execute();
    if($req->rowCount()> 0){
      // on recupere le resultat sous forme de tableau imbriqué avec clé
      $data = $req->fetchAll();
    }else{
      echo "Error lors de la requête sql";

    }


  }

}

?>
