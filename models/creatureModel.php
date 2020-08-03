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
    public $width = '';
    public $height = '';
    public $weight = '';
    public $predatory = '';
    public $diet = '';
    private $db = NULL;

    // je créé une fonction magique pour me connecter a ma BDD facilement entre chaque methodes
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=referosauria;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function getSingleDinoInfo($id){
        //Je récupère dans ma BDD avec un query les informations dont j'ai besoin
        //Je recupère tout avec * dans ma table 'creatures' (car j'ai besoin de tout)
        $creatureQuery = $this->db->query(
            'SELECT 
                *
            FROM
                `r3f3r0_creatures`
            WHERE 
                `id` = '.$id .'
            ');
            $data = $creatureQuery->fetch(PDO::FETCH_OBJ);
            return $data;
    }

    //recupere les infos de toutes les creatures
    public function getDinosInfo(){

        $creatureQuery = $this->db->query(
            'SELECT 
                *
            FROM
                `r3f3r0_creatures`
            ');
            $data = $creatureQuery->fetchAll(PDO::FETCH_OBJ);
            return $data;
    }


}

