<?php
class creature
{
    public $id = 0;
    public $name = '';
    public $date = '0000-00-00';
    public $miniImage = '';
    public $mainImage = '';
    public $detailImage = '';
    public $description = '';
    public $discovery = '';
    public $etymology = '';
    public $paleobiology = '';
    public $environment = '';
    public $period = 0;
    public $type = '';
    public $width = 0;
    public $height = 0;
    public $weight = 0;
    public $predatory = '';
    public $diet = 0;

    private $db = NULL;

    //créé une fonction magique pour me connecter a ma BDD facilement entre chaque methodes
    public function __construct() {
        $this->db = database::getInstance();
        $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } 

    //récupère les info de la creature en question (par rapport à l'ID)
    public function getSingleDinoInfo(){
        //récupère dans ma BDD avec un query les informations dont j'ai besoin
        //récupère tout avec * dans ma table 'creatures' (car j'ai besoin de tout)
        $creatureQuery = $this->db->prepare(
            'SELECT 
                `crea`.`id`
                , `crea`.`name`
                , `crea`.`mainImage`
                , `crea`.`detailImage`
                , `crea`.`description`
                , `crea`.`discovery`
                , `crea`.`etymology`
                , `crea`.`paleobiology`
                , `crea`.`environment`
                , `crea`.`width`
                , `crea`.`height`
                , `crea`.`weight`
                , `crea`.`predatory`
                , `crea`.`id_r3f3r0_categories`
                , `crea`.`id_r3f3r0_period` AS `period`
                , `crea`.`id_r3f3r0_discoverer`
                , `crea`.`id_r3f3r0_diet` AS `diet`
                ,`perTab`.`name` AS `perName`
                ,`dietTab`.`name` AS `dietName`
            FROM
                `r3f3r0_creatures` AS `crea`
            INNER JOIN `r3f3r0_period` AS `perTab` ON `crea`.`id_r3f3r0_period` = `perTab`.`id`
            INNER JOIN `r3f3r0_diet` AS `dietTab` ON `crea`.`id_r3f3r0_diet` = `dietTab`.`id`

            WHERE 
                `crea`.`id` = :id 
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
                ,`miniImage`
                ,`name`
            FROM
                `r3f3r0_creatures`
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
            ORDER BY `addDate` DESC
            LIMIT 3
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

    /* TEMPORAIRE */
    public function filterDino($diet){
        $latestCreatureQuery = $this->db->prepare(
            'SELECT
                *
            FROM 
                `r3f3r0_creatures`
            WHERE 
                 `id_r3f3r0_diet` = :diet
            ');
            $latestCreatureQuery->bindValue(':diet', $diet, PDO::PARAM_INT);
            $latestCreatureQuery->execute();
            return $latestCreatureQuery->fetchAll(PDO::FETCH_OBJ);
    }
    ##############################

    // pas de magic quotes dans dans VALUES
    public function addCreatureSimple(){
        $addCreatureQuery = $this->db->prepare(
            'INSERT INTO 
                `r3f3r0_creatures` 
                (`name`, `addDate`, `mainImage`, `miniImage`, `description`, `environment`, `id_r3f3r0_diet`, `id_r3f3r0_categories`, `id_r3f3r0_period`, `discovery`)
            VALUES 
                (:name, :addDate, :mainImage, :miniImage, :description, :environment, :diet, :categories, :period, :discovery)
            ');
            $addCreatureQuery->bindValue(':name', $this->name, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':environment', $this->environment, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':addDate', $this->date, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':mainImage', $this->mainImage, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':miniImage', $this->miniImage, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':description', $this->description, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':diet', $this->diet, PDO::PARAM_INT);
            $addCreatureQuery->bindValue(':categories', $this->type, PDO::PARAM_INT);
            $addCreatureQuery->bindValue(':period', $this->period, PDO::PARAM_INT);
            $addCreatureQuery->bindValue(':discovery', $this->discovery, PDO::PARAM_STR);
            return $addCreatureQuery->execute();
    }

    //Alimentation
    public function getDiets(){
        $dietQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_diet`
        ');
        return $dietQuery->fetchAll(PDO::FETCH_OBJ);
    }
    public function checkDietExistsById(){

    }

    public function getCategories(){
        $catQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_categories`
        ');
        return $catQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPeriod(){
        $periodQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_period`
        ');
        return $periodQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function getDiscoverer(){
        $discovererQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_period`
        ');
        return $discovererQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCreaturesByPeriod(){
        $creaturesByPeriodQuery = $this->db->prepare(
            'SELECT
                `id`
                , `miniImage`
            FROM
                `r3f3r0_creatures`
            WHERE
                `id_r3f3r0_period` = :period
            ORDER BY RAND ()  
            LIMIT 3
            
        ');
        $creaturesByPeriodQuery->bindValue(':period', $this->period, PDO::PARAM_STR);
        $creaturesByPeriodQuery->execute();
        return $creaturesByPeriodQuery->fetchAll(PDO::FETCH_OBJ);
    }
}