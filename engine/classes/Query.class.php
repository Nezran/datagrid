<?php
namespace engine\classes;

class Query
{

  public $var;
  public $database;
  public $column = array();
  public $category;
  public $url;

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

  function getCategory(){
    $req = $this->database->conn->prepare("SELECT * FROM category");
    $req->execute();
    if($req->rowCount()> 0){
      // on recupere le resultat sous forme de tableau imbriqué avec clé
      $this->category = $req->fetchAll();      
      return $this->category;
    }else{
      echo "Error lors de la requête sql";
    }    

  }

  function getData($url){
    $this->url = $url;
    $req = $this->database->conn->prepare("SELECT COUNT(id) AS nbrarticle FROM article");
    $req->execute();
    if($req->rowCount()> 0){
      $total = $req->fetch();
    }else{
      echo "Error lors de la requête sql";
    }
    self::getColumn();
    
    if(!isset($this->url['ordercolumn']) || (!in_array($this->url['ordercolumn'],$this->column))){
      $this->url['ordercolumn'] = "id";
    }

    $req = $this->database->conn->prepare("SELECT * FROM article ORDER BY ".$this->url['ordercolumn']." ".$url['order']." ");
    $req->execute();
    if($req->rowCount()> 0){
      // on recupere le resultat sous forme de tableau imbriqué avec clé
      $data = $req->fetchAll(\PDO::FETCH_OBJ);
      return $data;
    }else{
      echo "Error lors de la requête sql";
    } 
  }

  function getTotaldata(){
    $req = $this->database->conn->prepare("SELECT COUNT(id) AS FROM article");
    $req->execute();
    if($req->rowCount()> 0){
      $data = $req->fetchAll(\PDO::FETCH_OBJ);
      return $data;
    }else{
      echo "Error lors de la requête sql";
    }
  }

  function deleteData($article_id){
    $req = $this->database->conn->prepare("DELETE FROM article WHERE id = ".$article_id."");
    $req->execute();
    if($req->rowCount()> 0){
    }else{
      echo "Error lors de la requête sql";
    }    

  }

  function getDataDetail($article_id){
    $req = $this->database->conn->prepare("SELECT * FROM article WHERE id = ".$article_id."");
    $req->execute();
    if($req->rowCount()> 0){
      $data = $req->fetchAll(\PDO::FETCH_OBJ);
      return $data;
    }else{
      echo "Error lors de la requête sql";
    }
  }

  function insertData($col,$val){
 //INSERT INTO `article` (`id`, `category_id`, `name`, `title`, `description`, `superapp`, `fabi`, `salut`) VALUES (NULL, '2', 'das', 'asd', 'asd', 'asd', 'asd', 'asd');
    $req = $this->database->conn->prepare("INSERT INTO article ($col) VALUES ($val) ");
    var_dump($req);
    $req->execute(); 

  }

  function updateData($requete,$article_id){
    $req = $this->database->conn->prepare("UPDATE article SET $requete WHERE `article`.`id` = $article_id;");
    $req->execute();   

  }

  function addData($requete,$article_id){

    $req = $this->database->conn->prepare("UPDATE article SET $requete WHERE `article`.`id` = $article_id;");
    $req->execute();   
  }

  
  

  function test(){
    return $this->column;
  }
}

?>
