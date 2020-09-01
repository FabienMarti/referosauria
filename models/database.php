<?php
//private : accessible uniquement dans la classe
//protected : accessible dans la classe et les enfants
//public : accessible dans classe, enfants et les instances
class database {

    private static $instance = null;
    public $db = null;

    //Instancie automatiquement PDO en public
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=referosauria;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //$this->db = new PDO('mysql:host=localhost;dbname=referosauria;charset=utf8', 'fmarti', 'nekrose12', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    //SINGLETON : Permet d'obtenir une intance de database, qui est une instance de PDO
    //Static = empeche d'acceder par instance, uniquement sous la forme $db = database::instance
    public static function getInstance() {
        //self permet d'acceder à l'attribut dans une methode statique plutot que $this->
        //is_null permet de savoir si la variable est null
        if (is_null(self::$instance)) {
            self::$instance = new database();
        }
        return self::$instance->db;
    }
}
?>