<?php
namespace engine\classes;

class Datagrid extends Application
{

  public $url = array();
  public $query;
  public $validemethod = array();

  function __construct($url,$validemethod){
      $this->validemethod = $validemethod;
      $this->url = $url;
      $this->init();
  }

  public function init(){
    $this->query = new Query(self::getDatabase());
    $this->query->getColumn();
    print_r($this->query);

    switch ($this->url['method']) {
      case $this->validemethod[0]:
        $m = $this->validemethod[0];
        $this->$m();
        break;
      case $this->validemethod[1]:
        $m = $this->validemethod[1];
        $this->$m();
        break;
      case $this->validemethod[2]:
        $m = $this->validemethod[2];
        $this->$m();
        break;
      case $this->validemethod[3]:
        $m = $this->validemethod[3];
        $this->$m();
        break;
    }
  }

  public function showdata(){
    try{
      Routing::template($this->validemethod[0]);
    }
    catch(Exception $e){
	     die('Error: '.$e->getMessage());
    }

  }

  public function update(){
    echo "update";

  }

  public function add(){
    echo "add";

  }

  public function del(){
    echo "del";

  }

}
?>
