<?php
namespace engine\classes;

class Datagrid extends Application
{

  public $url = array();

  function __construct($url){
      var_dump(self::getDatabase());
      $test = new Query(self::getDatabase());
      $this->url = $url;
      $this->init();

  }

  public function init(){
      var_dump($this->url);
  }

  public function showdata(){

}

  public function update(){


  }

  public function add(){


  }

  public function del(){


  }

}
?>
