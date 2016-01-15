<?php
namespace engine\classes;

class Datagrid extends Application
{

  public $url = array();
  public $query;
  public $validemethod = array();
  public $column;

  function __construct($url,$validemethod){
      $this->validemethod = $validemethod;
      $this->url = $url;
      $this->init();
  }

  public function init(){
    $this->query = new Query(self::getDatabase());
    $this->column = $this->query->getColumn();

    if(in_array($this->url['method'], $this->validemethod)){
      $m = $this->url['method'];
      $this->$m();
    }    
  }

  public function showdata(){
    $this->query->getData();
    $this->returnTorouteur(__FUNCTION__,$this->query->getData());

  }

  public function update(){
    $this->returnTorouteur(__FUNCTION__);
  }

  public function add(){
    $this->returnTorouteur(__FUNCTION__);
  }

  public function del(){
    $this->returnTorouteur(__FUNCTION__);
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
