<?php
namespace engine\classes;

class Routing
{
    public $method;
    public $url = array();
    public $validemethod = ["showdata", "update", "add", "editcat", "addcat"];
    public $valideaction = ["addcat", "del", "delcat","search"];
    public $page;
    public $validetot = ["5", "10", "20", "50", "100"];
    public $validorder = ["asc", "desc"];
    public $get;
    public $view;
    public $viewfile;
    public $data;
    public $datagrid;
    public $post;

    function __construct($get, $post)
    {
        self::route($get, $post);
    }

    public function route($get, $post)
    {
        // http://labo/datagrid/index.php?method=hacker&order=desc&p=10&tot=50&column_order=title&column_search=description&search=jesuisunblablabla

        $this->url = $get;
        $this->post = $post;

        if (!isset($this->url['tot']) || (!in_array($this->url['tot'], $this->validetot))) {
            $this->url['tot'] = $this->validetot['1'];
        }
        if (!isset($this->url['action']) || (!in_array($this->url['action'], $this->valideaction))) {
            $this->url['action'] = '';
        }
        if (!isset($this->url['search']) || (!in_array($this->url['search'], $this->valideaction))) {
            $this->url['search'] = '';
        }
        if (!isset($this->url['method']) || (!in_array($this->url['method'], $this->validemethod))) {
            $this->url['method'] = $this->validemethod['0'];
        }
        if (!isset($this->url['order']) || (!in_array($this->url['order'], $this->validorder))) {
            $this->url['order'] = $this->validorder['0'];
        } else {
            if ($this->url['order'] == $this->validorder['0']) {
                $this->url['order'] = $this->validorder['1'];
            } else {
                $this->url['order'] = $this->validorder['0'];
            }
        }
        if (!isset($this->url['p']) || (!is_numeric($this->url['p'])) || (($this->url['p']) <= 1 )) {
            $this->url['p'] = "1";
        }

        if (!isset($this->url['ordercolumn'])) {
            $this->url['ordercolumn'] = "id";
        }


        echo "<pre>";
        var_dump($this->url);
        echo "</pre>";


        $this->datagrid = new Datagrid($this->url, $this->validemethod, $this->post, $this->valideaction);
        $this->template();
    }

    public function template()
    {
        //if($this->url['method'] != $this->validemethod['3']){
        $this->viewfile = "engine/views/" . $this->url['method'] . ".php";
        //}else{
        //$this->viewfile = "engine/views/".$this->validemethod['0'].".php";
        //}
        ob_start();
        require_once $this->viewfile;
        $content = ob_get_clean();
        require_once "engine/templates/template.php";
    }


}

/*
if(!file_exists("engine/views/".$this->view.".php"))
    {
        // si la page demandée existe pas
          $this->view = $this->validemethod['0'];
    }
*/
?>
