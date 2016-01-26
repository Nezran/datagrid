<?php
namespace engine\classes;

class Application
{
    private static $config;
    private static $database;

    public function __construct()
    {
        // lancement de l'autoloadx
        spl_autoload_register(array(__CLASS__, 'autoload'));
        // lance le routing de l'app
        self::geturl();
        // connexion à la bd
        self::getDatabase();


    }

    static function autoload($className)
    {
        $file = str_replace('\\', '/', $className) . '.class.php';
        if (file_exists($file))
            require_once $file;
        else
            throw new \Exception("Fichier " . $file . " introuvable");
    }


    function geturl()
    {
        $routing = new Routing(array_map('htmlentities', array_map('addslashes', $_GET)), array_map('htmlentities', array_map('addslashes', $_POST)));
    }



    public static function getDatabase()
    {
        if(!file_exists("engine/config/config.php")){
            echo "Merci de remplir et renommer votre config en config.php<br> A cette adresse engine/config/config.php";
            die();
        }
        $config = require("engine/config/config.php");

        if (count($config["db"]) != 4) {
            throw new \Exception("Le nombre d'arguments de la config n'est pas valable!");
        }
        self::$config = $config;
        self::$database = new ConnectPDO(self::$config);
        self::$database->connect();
        //$name = new Query(self::$database);

        return self::$database;
    }




}


?>
