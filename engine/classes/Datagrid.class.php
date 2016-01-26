<?php
namespace engine\classes;

class Datagrid extends Application
{

    public $url = array();
    public $query;
    public $validetable = ['article','category'];
    public $validemethod = array();
    public $valideaction = array();
    public $column;
    public $category;
    public $post;
    public $requete;
    public $col;
    public $val;
    public $valsearch;
    public $where;
    public $correct;


    function __construct($url, $validemethod, $post, $valideaction)
    {
        $this->validemethod = $validemethod;
        $this->valideaction = $valideaction;
        $this->url = $url;
        $this->post = $post;
        $this->query = new Query(self::getDatabase());
        $this->init();
    }

    public function init()
    {


        $this->column = $this->query->getColumn();
        $this->category = $this->query->getCategory();

        if (!empty($this->post)) {
            $this->getdatafromclient();
        }

        if (in_array($this->url['action'], $this->valideaction)) {
            $m = $this->url['action'];
            $this->$m();
        }

        if (in_array($this->url['method'], $this->validemethod)) {
            $m = $this->url['method'];
            $this->$m();
        }


    }

    // action
    public function search()
    {
        $this->valsearch = $this->query->getColumn();
        foreach ($this->url as $key => $value) {
            if (in_array($key, $this->valsearch)) {
                if (!empty($value)) {
                    $this->where .= " " . $key . " LIKE '%" . $value . "%' AND";
                    $this->url['where'] = "&" . $key . "=" . $value;
                }
            }
        }
        if (!is_null($this->where)) {
            $this->where = rtrim($this->where, "AND");
            $this->where = "WHERE " . $this->where;
            $this->url['where'] = "&action=search" . $this->url['where'];
        }

    }

    // method
    public function showdata()
    {
        $this->data = $this->query->getData($this->url, $this->where);
    }

    // method
    public function update()
    {

        $this->detail = $this->query->getDataDetail($this->url['article_id']);
    }

    // method
    public function add()
    {
    }

    // action
    public function delcat()
    {
        $this->query->delcategory($this->url['category_id']);
        $this->editcat();
    }

    // method
    public function editcat()
    {
        $this->category = $this->query->getCategory();
    }

    // action
    public function addcat()
    {
        $this->query->addcategory();
    }




    // action
    public function del()
    {
        $this->query->deleteData($this->url['article_id']);
    }

    public function getdatafromclient()
    {
        if (!empty($this->post)) {
            if ($this->post['action'] == 'updatecat') {
                foreach ($this->post as $key => $value) {
                    if ($key != 'action') {
                        // $this->requete .= "$key = '$value' ,";
                        $this->query->updatecategory($key, $value);
                        //UPDATE category SET `name` = 'Microsofta' WHERE `category`.`id` = 2;
                    }
                }
            } elseif ($this->post['action'] == 'insertdata') {
                if (!empty($this->post['id'])) {
                    foreach ($this->post as $key => $value) {
                        if ($key != 'id') {
                            if ($key != 'action') {
                                $this->requete .= "$key = '$value' ,";
                            }
                        }
                    }
                    $this->requete = trim($this->requete, ",");
                    $this->query->updateData($this->requete, $this->post['id']);
                } else {
                    foreach ($this->post as $key => $value) {
                        if ($key != 'action') {
                            $this->col .= "$key,";
                            $this->val .= "'$value',";
                        }
                    }
                    $this->col = trim($this->col, ",");
                    $this->val = trim($this->val, ",");
                    $this->query->insertData($this->col, $this->val);
                }
            }
        }
    }

    public function returnTorouteur($method, $data)
    {
        try {
            Routing::template($method, $this->column, $data);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}

?>
