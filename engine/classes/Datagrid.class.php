<?php
namespace engine\classes;

class Datagrid extends Application
{

  public $url = array();
  public $query;
  public $validemethod = array();
  public $column;
  public $category;


  function __construct($url,$validemethod){
      $this->validemethod = $validemethod;
      $this->url = $url;
      $this->init();
  }

  public function init(){
    $this->query = new Query(self::getDatabase());
    $this->column = $this->query->getColumn();
    $this->category = $this->query->getCategory();

    if(in_array($this->url['method'], $this->validemethod)){
      $m = $this->url['method'];
      $this->$m();
    }    
  }

  public function showdata(){
    
    $this->data = $this->query->getData();
    //$this->returnTorouteur(__FUNCTION__,$this->query->getData());

  }

  public function update(){
    $this->query->getDataDetail($this->url['article_id']);
    //$this->returnTorouteur(__FUNCTION__);
  }

  public function add(){
    //$this->returnTorouteur(__FUNCTION__);
  }

  public function del(){
    $this->query->deleteData($this->url['article_id']);
    //$this->returnTorouteur(__FUNCTION__);
  }

  public function returnTorouteur($method,$data){
     try{
      Routing::template($method,$this->column,$data);
    }
    catch(Exception $e){
       die('Error: '.$e->getMessage());
    }
  }

}
?>
