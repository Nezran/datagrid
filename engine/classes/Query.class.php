<?php
namespace engine\classes;

class Query
{

    public $var;
    public $database;
    public $column = array();
    public $category;
    public $url;
    public $nbrpage;
    public $totaldata;
    public $alert;

    function __construct($database)
    {
        $this->database = $database;

        //$test = new ConnectPDO();
    }

    function getColumn()
    {
        $req = $this->database->conn->prepare("SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$this->database->config['schema']['table_data']."' AND TABLE_SCHEMA='".$this->database->config['db']['dbname']."'");
        $req->execute();
        if ($req->rowCount() > 0) {
            // on recupere le resultat sous forme de tableau imbriqué avec clé
            $data = $req->fetchAll();
            for ($i = 0; $i <= count($data) - 1; $i++) {
                $this->column[$i] = $data[$i]['COLUMN_NAME'];
            }
            return $this->column;
        } else {
            echo "Error lors de la requête sql";
        }
    }

    function getCategory()
    {
        $req = $this->database->conn->prepare("SELECT * FROM ".$this->database->config['schema']['table_category']."");
        $req->execute();
        if ($req->rowCount() > 0) {
            // on recupere le resultat sous forme de tableau imbriqué avec clé
            $this->category = $req->fetchAll();


            return $this->category;
        } else {
            echo "Error lors de la requête sql";
        }
    }

    function getData($url,$where)
    {
        if(!isset($where)){$where="";}
        $this->url = $url;
        $req = $this->database->conn->prepare("SELECT COUNT(".$this->database->config['schema']['table_data_id'].") AS nbrarticle FROM ".$this->database->config['schema']['table_data']."");
        $req->execute();
        if ($req->rowCount() > 0) {
            $total = $req->fetch();
            $this->totaldata = $total;
        } else {
            echo "Error lors de la requête sql";
        }
        self::getColumn();

        if (!isset($this->url['ordercolumn']) || (!in_array($this->url['ordercolumn'], $this->column))) {
            $this->url['ordercolumn'] = "id";
        }

        $this->nbrpage = ceil($total['nbrarticle'] / $this->url['tot']);
        if (!isset($this->url['p']) || (!is_numeric($this->url['p'])) || ($this->url['p'] > $this->nbrpage)) {
            $this->url['p'] = "1";
        }
        $req = $this->database->conn->prepare("SELECT * FROM ".$this->database->config['schema']['table_data']." ".$where." ORDER BY " . $this->url['ordercolumn'] . " " . $url['order'] . " LIMIT " . (($this->url['p'] - 1) * $this->url['tot']) . "," . $this->url['tot'] . " ");
        // requete imbriquée pour trier la page courante
        // SELECT * FROM (SELECT * FROM article   LIMIT " . (($this->url['p'] - 1) * $this->url['tot']) . "," . $this->url['tot'] . ") a ".$where." ORDER BY a." . $this->url['ordercolumn'] . " " . $url['order'] . " ");
        $req->execute();
        if ($req->rowCount() > 0) {
            // on recupere le resultat sous forme de tableau imbriqué avec clé
            $data = $req->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } else {
            $this->alert = "Aucun résultat";
        }
    }

    function getTotaldata()
    {
        $req = $this->database->conn->prepare("SELECT COUNT(".$this->database->config['schema']['table_data_id'].") AS FROM ".$this->database->config['schema']['table_data']."");
        $req->execute();
        if ($req->rowCount() > 0) {
            $data = $req->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } else {
            echo "Error lors de la requête sql";
        }
    }

    function deleteData($article_id)
    {
        $req = $this->database->conn->prepare("DELETE FROM ".$this->database->config['schema']['table_data']." WHERE ".$this->database->config['schema']['table_data_id']." = " . $article_id . "");
        $req->execute();
        if ($req->rowCount() > 0) {
            $this->alert = "Entrée supprimée";
        } else {
            echo "Error lors de la requête sql";
        }

    }

    function getDataDetail($article_id)
    {
        $req = $this->database->conn->prepare("SELECT * FROM ".$this->database->config['schema']['table_data']." WHERE ".$this->database->config['schema']['table_data_id']." = " . $article_id . "");
        $req->execute();
        if ($req->rowCount() > 0) {
            $data = $req->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } else {
            echo "Error lors de la requête sql";
        }
    }

    function insertData($col, $val)
    {
        //INSERT INTO `article` (`id`, `category_id`, `name`, `title`, `description`, `superapp`, `fabi`, `salut`) VALUES (NULL, '2', 'das', 'asd', 'asd', 'asd', 'asd', 'asd');
        $req = $this->database->conn->prepare("INSERT INTO ".$this->database->config['schema']['table_data']." ($col) VALUES ($val) ");
        $req->execute();
        if ($req->rowCount() > 0) {
            $this->alert = "Informations ajoutées";
        } else {
            echo "Error lors de la requête sql";
        }
    }

    function updateData($requete, $article_id)
    {
        $req = $this->database->conn->prepare("UPDATE ".$this->database->config['schema']['table_data']." SET $requete WHERE ".$this->database->config['schema']['table_data'].".".$this->database->config['schema']['table_data_id']." = $article_id;");
        $req->execute();
        if ($req->rowCount() > 0) {
            $this->alert = "Informations mises à jour";
        } else {
            $this->alert = "Aucun changement";
        }
    }

    function addcategory()
    {
        $req = $this->database->conn->prepare("INSERT INTO ".$this->database->config['schema']['table_category']." (".$this->database->config['schema']['table_category_id'].", ".$this->database->config['schema']['table_category_name'].") VALUES (NULL, '')");
        $req->execute();
        if ($req->rowCount() > 0) {
            $this->alert = "Nouvelle catégorie créée";
        } else {
            echo "Error lors de la requête sql";
        }
    }

    function updatecategory($category_id, $name){
        $req = $this->database->conn->prepare("UPDATE ".$this->database->config['schema']['table_category']." SET ".$this->database->config['schema']['table_category_name']." = '$name' WHERE ".$this->database->config['schema']['table_category'].".".$this->database->config['schema']['table_category_id']." = $category_id");
        $req->execute();
        if ($req->rowCount() > 0) {
            $this->alert = "Catégorie mise à jour";
        }
    }

    function delcategory($category_id)
    {
        $req = $this->database->conn->prepare("DELETE FROM ".$this->database->config['schema']['table_category']." WHERE ".$this->database->config['schema']['table_category_id']." = " . $category_id . "");
        $req->execute();
        if ($req->rowCount() > 0) {
            $this->alert = "Catégorie supprimée";
        } else {
            echo "Error lors de la requête sql";
        }

    }


    function test()
    {
        return $this->column;
    }
}

?>
