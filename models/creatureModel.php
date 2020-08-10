<?php

class creature
{
    public $id = 0;
    public $name = '';
    public $miniImage = '';
    public $mainImage = '';
    public $detailImage = '';
    public $description = '';
    public $discovery = '';
    public $etymology = '';
    public $paleobiology = '';
    public $environment = '';
    public $period = '';
    public $width = 0;
    public $height = 0;
    public $weight = 0;
    public $predatory = '';
    public $diet = '';
    private $db = NULL;

    //créé une fonction magique pour me connecter a ma BDD facilement entre chaque methodes
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=referosauria;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    //récupère les info de la creature en question (par rapport à l'ID)
    public function getSingleDinoInfo($id){
        //récupère dans ma BDD avec un query les informations dont j'ai besoin
        //récupère tout avec * dans ma table 'creatures' (car j'ai besoin de tout)
        $creatureQuery = $this->db->query(
            'SELECT 
                *
            FROM
                `r3f3r0_creatures`
            WHERE 
                `id` = '. $id .'
            ');
            $data = $creatureQuery->fetch(PDO::FETCH_OBJ);
            return $data;
    }

    //récupère les infos de toutes les creatures pour afficher la liste
    public function getDinosInfo(){

        $creaturesQuery = $this->db->query(
            'SELECT
                `id`
                ,`id_r3f3r0_diet`
                ,`miniImage`
                ,`crea`.`name`
                ,`per`.`id_period`
                ,`per`.`name` AS `periodName`
            FROM
                `r3f3r0_creatures` AS `crea`
            INNER JOIN `r3f3r0_period` AS `per` ON `id_r3f3r0_period` = `id_period`
            ');
            $data = $creaturesQuery->fetchAll(PDO::FETCH_OBJ);
            return $data;
    }

    //récupère uniquement les infos dont j'ai besoin pour mon filtrage
    public function getDinoFilters(){
        $creatureQuery = $this->db->query(
            'SELECT 
               `name`, `id_period`
            FROM
                 `r3f3r0_period`
            ');
            $data = $creatureQuery->fetchAll(PDO::FETCH_OBJ);
            return $data;
    }
}

