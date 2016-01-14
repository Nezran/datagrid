<?php
namespace engine\classes;

class Routing
{
  public $method;
  public $url = array();
  public $validemethod = ["list","update","add","del"];
  public $page;
  public $validetot = ["5","10","20","50","100"];
  public $validorder = ["asc","desc"];
  public $get;
  public $view;
  public $viewfile;

  function __construct($get){
    self::route($get);
  }

  public function route($get){
    // http://labo/datagrid/index.php?method=hacker&order=desc&p=10&tot=50&column_order=title&column_search=description&search=jesuisunblablabla

    $this->url = $get;

    if(!isset($this->url['tot']) || (!in_array($this->url['tot'],$this->validetot))){
      $this->url['tot'] = $this->validetot['1'];
    }
    if(!isset($this->url['method']) || (!in_array($this->url['method'],$this->validemethod))){
      $this->url['method'] = $this->validemethod['0'];
    }
    if(!isset($this->url['order']) || (!in_array($this->url['order'],$this->validorder))){
      $this->url['order'] = $this->validorder['0'];
    }
    if(!isset($this->url['p']) || (!is_numeric($this->url['p']))){
      $this->url['p'] ="1";
    }

    echo "<pre>";
    var_dump($this->url);
    echo "</pre>";


    $datagrid = new Datagrid($this->url);

    self::template($this->method);
  }

  public function template($view){
    $this->view = $view;
    if(!file_exists("engine/views/".$this->view.".php"))
		{
		    // si la page demandée existe pas
		      $this->view = "list";
		}
    $this->viewfile = "engine/views/".$this->view.".php";
    ob_start();
  	require_once $this->viewfile;
    $content = ob_get_clean();
    require_once "engine/templates/template.php";
  }






}
?>
