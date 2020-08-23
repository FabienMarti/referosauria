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
            $this->db = new PDO('mysql:host=localhost;dbname=referosauria;charset=utf8', 'fmarti', 'nekrose12');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    //récupère les info de la creature en question (par rapport à l'ID)
    public function getSingleDinoInfo(){
        //récupère dans ma BDD avec un query les informations dont j'ai besoin
        //récupère tout avec * dans ma table 'creatures' (car j'ai besoin de tout)
        $creatureQuery = $this->db->prepare(
            'SELECT 
                *
            FROM
                `r3f3r0_creatures`
            WHERE 
                `id` = :id
            ');
            $creatureQuery->bindvalue(':id', $this->id, PDO::PARAM_INT);
            $creatureQuery->execute();  
            return $creatureQuery->fetch(PDO::FETCH_OBJ);
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
            return $creaturesQuery->fetchAll(PDO::FETCH_OBJ);
    }

    //récupère uniquement les infos dont j'ai besoin pour mon filtrage
    public function getDinoFilters(){
        $creatureQuery = $this->db->query(
            'SELECT 
               `name`, `id_period`
            FROM
                 `r3f3r0_period`
            ');
        return $creatureQuery->fetchAll(PDO::FETCH_OBJ);
            
    }

    public function getLatestCreatures(){
        $latestCreatureQuery = $this->db->query(
            'SELECT
                `crea`.`id`
                ,`id_r3f3r0_diet`
                ,`crea`.`name`
                ,`miniImage`
                ,`addDate`
                ,`description`
            FROM 
                `r3f3r0_creatures` AS `crea`
            ORDER BY `addDate` ASC
            LIMIT 2
            ');
            return $latestCreatureQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function filterCreaByDiet(){
        $dietQuery = $this->db->query(
            'SELECT 
                `crea`.`name`
                ,`miniImage`
                ,`diet`.`name`
            FROM
              `r3f3r0_creatures` AS `crea`
            INNER JOIN `r3f3r0_diet` AS `diet` ON `id_r3f3r0_diet` = `diet`.`id`
            WHERE `diet`.`name` = \'Herbivore\'
            ');
    }

    /* temporaire */
    public function filterDino($diet){
        $latestCreatureQuery = $this->db->query(
            'SELECT
                *
            FROM 
                `r3f3r0_creatures`
            WHERE 
                 `id_r3f3r0_diet` =' . $diet
            );
            return $latestCreatureQuery->fetchAll(PDO::FETCH_OBJ);
    }

}

