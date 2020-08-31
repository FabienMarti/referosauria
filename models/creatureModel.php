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
                , `crea`.`minWidth`
                , `crea`.`maxWidth`
                , `crea`.`minHeight`
                , `crea`.`maxHeight`
                , `crea`.`minWeight`
                , `crea`.`maxWeight`
                , `crea`.`predatory`
                , `crea`.`id_r3f3r0_categories`
                , `crea`.`id_r3f3r0_period` AS `period`
                , `crea`.`id_r3f3r0_discoverer`
                , `crea`.`id_r3f3r0_diet` AS `diet`
                ,`perTab`.`id` AS `perId`
                ,`perTab`.`name` AS `perName`
                ,`dietTab`.`id` AS `dietId`
                ,`dietTab`.`name` AS `dietName`
                ,`envTab`.`id` AS `envId`
                ,`envTab`.`name` AS `envName`
            FROM
                `r3f3r0_creatures` AS `crea`
            INNER JOIN `r3f3r0_period` AS `perTab` ON `crea`.`id_r3f3r0_period` = `perTab`.`id`
            INNER JOIN `r3f3r0_diet` AS `dietTab` ON `crea`.`id_r3f3r0_diet` = `dietTab`.`id`
            INNER JOIN `r3f3r0_environment` AS `envTab` ON `crea`.`id_r3f3r0_environment` = `envTab`.`id`
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
                , `miniImage`
                , `name`
            FROM
                `r3f3r0_creatures`
            ORDER BY `name` ASC
            ');
            return $creaturesQuery->fetchAll(PDO::FETCH_OBJ);
    }

    //récupère les 3 derniers dinosaures ajoutés par la Date d'ajout
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

    // ATTENTION : pas de `magic quotes` dans dans VALUES
    public function addCreatureSimple(){
        $addCreatureQuery = $this->db->prepare(
            'INSERT INTO 
                `r3f3r0_creatures` 
                (`name`, `addDate`, `mainImage`, `miniImage`, `description`, `id_r3f3r0_environment`, `id_r3f3r0_diet`, `id_r3f3r0_categories`, `id_r3f3r0_period`, `discovery`)
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

    //récupère le nom des alimentations
    public function getCreaDiets(){
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
    //récupère le nom des catégories
    public function getCreaCategories(){
        $catQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_categories`
        ');
        return $catQuery->fetchAll(PDO::FETCH_OBJ);
    }
    //récupère le nom des périodes
    public function getCreaPeriods(){
        $periodQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_period`
        ');
        return $periodQuery->fetchAll(PDO::FETCH_OBJ);
    }

    //récupère le nom des habitats
    public function getCreaEnvironments(){
        $envQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_environment`
        ');
        return $envQuery->fetchAll(PDO::FETCH_OBJ);
    }

    //non fonctionnel
    public function getCreaDiscoverers(){
        $discovererQuery = $this->db->query(
            'SELECT
                `id`
                ,`name`
            FROM
                `r3f3r0_period`
        ');
        return $discovererQuery->fetchAll(PDO::FETCH_OBJ);
    }

    //récupère les creatures en fonction de la période (page créature)
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

    //method pour recherche dans un champ de recherche avec le NOM
    public function searchCreaByName($search) {
        $searchCreaByNameQuery = $this->db->prepare(
            'SELECT 
                `crea`.`id`
                , `crea`.`miniImage`
                , `crea`.`name`
            FROM 
                `r3f3r0_creatures` AS `crea`
            WHERE `name` LIKE :search
            ORDER BY `name` 
        ');
        $searchCreaByNameQuery->bindValue(':search', $search . '%', PDO::PARAM_STR);
        $searchCreaByNameQuery->execute();
        return $searchCreaByNameQuery->fetchAll(PDO::FETCH_OBJ);  
    }

    //compte le nombre de resultats de notre recherche
    public function countSearchResult($search) {
        $searchCreaByNameQuery = $this->db->prepare(
            'SELECT 
                COUNT(`id`) AS searchResult
            FROM 
                `r3f3r0_creatures`
            WHERE `name` LIKE :search 
        ');
        $searchCreaByNameQuery->bindValue(':search', $search . '%', PDO::PARAM_STR);
        $searchCreaByNameQuery->execute();
        $data = $searchCreaByNameQuery->fetch(PDO::FETCH_OBJ); 
        return $data->searchResult; 
    }

    public function checkCreatureExists(){
        $creatureExistsQuery = $this->db->prepare(
            'SELECT 
                COUNT(`id`) AS isCreatureExists
            FROM
                `r3f3r0_creatures`
            WHERE
                `name` = :name
        ');
        $creatureExistsQuery->bindValue(':name', $this->name, PDO::PARAM_STR);
        $creatureExistsQuery->execute();
        $data = $creatureExistsQuery->fetch(PDO::FETCH_OBJ);
        return $data->isCreatureExists;
    }

/******************************************************************************************/

//Methode de filtrage (recherche)
    function getCreaList($limitArray = array() ,$searchArray = array()) {
        //Si nos champs de recherche contiennent des valeurs alors on stock notre clause WHERE dans une variable avec tous nos paramètres
        if(count($searchArray) > 0){
            $where = 'WHERE ';
            foreach($searchArray as $fieldName => $search) {
                //Vérifie si un JOKER existe dans nos champs de recherche
                if (strrchr($search, '%')){
                    //Ajoute LIKE si un JOKER est présent
                    $whereArray[] = '`' . $fieldName . '` LIKE :' . $fieldName ;
                }else {
                    //Compare sans LIKE
                    $whereArray[] = '`' . $fieldName . '` = :' . $fieldName ;
                }
            }
            //Concatène le tableau whereArray avec un séparateur 'AND'
            $where .= implode(' AND ', $whereArray);
        }
        /* Requete SQL : On concatène notre variable $where qui contient notre clause à l'aide
        d'une ternaire pour ne l'ajouter qu'à condition quelle existe */
        $creaListQuery = $this->db->prepare(
            'SELECT
                `id`
                , `miniImage`
                , `name`
            FROM
                `r3f3r0_creatures`
            ' . (isset($where) ? $where : '') . '
            ORDER BY `name` ASC '
                . (count($limitArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        //Boucle pour créer nos bindValues qui dépendent de nos champs de recherche
        foreach($searchArray as $fieldName => $search) {
            $creaListQuery->bindvalue(':' . $fieldName, $search , PDO::PARAM_STR);
        }
        if (count($limitArray) == 2){
            $creaListQuery->bindvalue(':limit', $limitArray['limit'], PDO::PARAM_INT);
            $creaListQuery->bindvalue(':offset', $limitArray['offset'], PDO::PARAM_INT);
        }
        $creaListQuery->execute();
        return $creaListQuery->fetchAll(PDO::FETCH_OBJ); 
    }
}