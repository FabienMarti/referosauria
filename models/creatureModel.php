<?php
class creature
{
    public $id = 0;
    public $name = '';
    public $addDate = '0000-00-00';
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

    //Fonction magique pour initialiser ma BDD
    public function __construct() {
        $this->db = database::getInstance();
    } 

    /******************** TRANSACTIONS : Methodes liées à l'instance PDO à n'utiliser que dans le permier modele ************************/

    //Methode pour acceder à l'objet db qui est en privé (getter/setter)
    public function beginTransaction(){
        return $this->db->beginTransaction();
    }

    public function rollBack(){
        return $this->db->rollBack();
    }

    public function lastInsertId(){
        return $this->db->lastInsertId();
    }

    public function commit(){
        return $this->db->commit();
    }

    /*****************************************************************************/

    //récupère les info de la creature en question (par rapport à l'ID)
    public function getSingleDinoInfo(){
        //récupère dans ma BDD avec un query les informations dont j'ai besoin
        $creatureQuery = $this->db->prepare(
            'SELECT 
                `crea`.`id`
                , `crea`.`name`
                , `crea`.`mainImage`
                , `crea`.`miniImage`
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
                , `crea`.`available`
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
                ,`catTab`.`id` AS `catId`
                ,`catTab`.`name` AS `catName`
            FROM
                `r3f3r0_creatures` AS `crea`
            INNER JOIN `r3f3r0_period` AS `perTab` ON `crea`.`id_r3f3r0_period` = `perTab`.`id`
            INNER JOIN `r3f3r0_diet` AS `dietTab` ON `crea`.`id_r3f3r0_diet` = `dietTab`.`id`
            INNER JOIN `r3f3r0_environment` AS `envTab` ON `crea`.`id_r3f3r0_environment` = `envTab`.`id`
            INNER JOIN `r3f3r0_categories` AS `catTab` ON `crea`.`id_r3f3r0_categories` = `catTab`.`id`
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
                , `available`
                , `addDate`
            FROM
                `r3f3r0_creatures`
            ORDER BY `name` ASC
            ');
            return $creaturesQuery->fetchAll(PDO::FETCH_OBJ);
    }
    //! ADMIN PANEL récupère les infos de toutes les creatures pour afficher la liste
    public function getDinosInfoAsAdmin(){

        $creaturesQuery = $this->db->query(
            'SELECT
                `id`   
                , `name`
                , `available`
                , `addDate`
            FROM
                `r3f3r0_creatures`
            ORDER BY `available` ASC
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
            WHERE `available` = \'Validé\'
            ORDER BY `addDate` DESC
            LIMIT 3
            ');
            return $latestCreatureQuery->fetchAll(PDO::FETCH_OBJ);
    }

    // ATTENTION : pas de `magic quotes` dans dans VALUES
    public function addCreature(){
        $addCreatureQuery = $this->db->prepare(
            'INSERT INTO 
                `r3f3r0_creatures` 
                (`name`, `addDate`, `mainImage`, `miniImage`, `description`, `id_r3f3r0_environment`, `id_r3f3r0_diet`, `id_r3f3r0_categories`, `id_r3f3r0_period`, `discovery`, `minWidth`, `maxWidth`, `minHeight`, `maxHeight`, `minWeight`, `maxWeight`)
            VALUES 
                (:name, :addDate, :mainImage, :miniImage, :description, :environment, :diet, :categories, :period, :discovery, :minWidth, :maxWidth, :minHeight, :maxHeight, :minWeight, :maxWeight)
            ');
            $addCreatureQuery->bindValue(':name', $this->name, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':environment', $this->environment, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':addDate', date('Y-m-d H:i:s'), PDO::PARAM_STR); //date("Y-m-d H:i:s")
            $addCreatureQuery->bindValue(':mainImage', $this->mainImage, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':miniImage', $this->miniImage, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':description', $this->description, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':diet', $this->diet, PDO::PARAM_INT);
            $addCreatureQuery->bindValue(':categories', $this->type, PDO::PARAM_INT);
            $addCreatureQuery->bindValue(':period', $this->period, PDO::PARAM_INT);
            $addCreatureQuery->bindValue(':discovery', $this->discovery, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':minWidth', $this->minWidth, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':minHeight', $this->minHeight, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':minWeight', $this->minWeight, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':maxWidth', $this->maxWidth, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':maxHeight', $this->maxHeight, PDO::PARAM_STR);
            $addCreatureQuery->bindValue(':maxWeight', $this->maxWeight, PDO::PARAM_STR);
            return $addCreatureQuery->execute();
    }

    //! UPDATE CREATURE ADMIN
    public function updateCreaAsAdmin(){
        $updateCreaAsAdmin = $this->db->prepare(
            'UPDATE 
                `r3f3r0_creatures`
            SET
                `name` = :name
                , `mainImage` = :mainImage
                , `miniImage` = :miniImage
                , `description` = :description
                , `id_r3f3r0_environment` = :environment
                , `id_r3f3r0_diet` = :diet
                , `id_r3f3r0_categories` = :categories
                , `id_r3f3r0_period` = :period
                , `discovery` = :discovery
                , `minWidth` = :minWidth
                , `maxWidth` = :maxWidth
                , `minHeight` = :minHeight
                , `maxHeight` = :maxHeight
                , `minWeight` = :minWeight
                , `maxWeight` = :maxWeight
            WHERE
                `id` = :id
        ');
        $updateCreaAsAdmin->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateCreaAsAdmin->bindValue(':name', $this->name, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':environment', $this->environment, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':mainImage', $this->mainImage, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':miniImage', $this->miniImage, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':description', $this->description, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':diet', $this->diet, PDO::PARAM_INT);
        $updateCreaAsAdmin->bindValue(':categories', $this->categories, PDO::PARAM_INT);
        $updateCreaAsAdmin->bindValue(':period', $this->period, PDO::PARAM_INT);
        $updateCreaAsAdmin->bindValue(':discovery', $this->discovery, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':minWidth', $this->minWidth, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':minHeight', $this->minHeight, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':minWeight', $this->minWeight, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':maxWidth', $this->maxWidth, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':maxHeight', $this->maxHeight, PDO::PARAM_STR);
        $updateCreaAsAdmin->bindValue(':maxWeight', $this->maxWeight, PDO::PARAM_STR);
        return $updateCreaAsAdmin->execute();
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
                `id_r3f3r0_period` = :period AND `available` = \'Validé\'
            ORDER BY RAND ()  
            LIMIT 3
            
        ');
        $creaturesByPeriodQuery->bindValue(':period', $this->period, PDO::PARAM_STR);
        $creaturesByPeriodQuery->execute();
        return $creaturesByPeriodQuery->fetchAll(PDO::FETCH_OBJ);
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
    public function checkCreatureExistsById(){
        $creatureExistsQuery = $this->db->prepare(
            'SELECT 
                COUNT(`id`) AS isCreatureExists
            FROM
                `r3f3r0_creatures`
            WHERE
                `id` = :id
        ');
        $creatureExistsQuery->bindValue(':id', $this->id, PDO::PARAM_STR);
        $creatureExistsQuery->execute();
        $data = $creatureExistsQuery->fetch(PDO::FETCH_OBJ);
        return $data->isCreatureExists;
    }

/******************************************************************************************/

//Methode de filtrage (recherche)
    function getCreaList($limitArray = array(), $searchArray = array()) {
        //Si nos champs de recherche contiennent des valeurs alors on stock notre clause WHERE dans une variable avec tous nos paramètres
        if(count($searchArray) > 0){
            $where = ' ';
            foreach($searchArray as $fieldName => $search) {
                //Vérifie si un JOKER existe dans nos champs de recherche
                if (strrchr($search, '%')){
                    //Ajoute LIKE si un JOKER est présent
                    $whereArray[] = '`' . $fieldName . '` LIKE :' . $fieldName ;
                }
                else if(is_int($search)){
                    $whereArray[] = '`id_r3f3r0_' . $fieldName . '` = :' . $fieldName ;
                }
                else {
                    //Compare sans LIKE
                    $whereArray[] = '`' . $fieldName . '` = :' . $fieldName ;
                }
            }
            //Concatène le tableau whereArray avec un séparateur 'AND'
            $where .= implode(' AND ', $whereArray) . ' AND ';
        }
        /* Requete SQL : On concatène notre variable $where qui contient notre clause à l'aide
        d'une ternaire pour ne l'ajouter qu'à condition quelle existe */
        $creaListQuery = $this->db->prepare(
            'SELECT
                `id`
                , `miniImage`
                , `name`
                , `available`
            FROM
                `r3f3r0_creatures`
            WHERE ' . (isset($where) ? $where : '') . ' `available` = \'Validé\'
            ORDER BY `name` ASC '
                . (count($limitArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        var_dump($creaListQuery);
        //Boucle pour créer nos bindValues qui dépendent de nos champs de recherche
        foreach($searchArray as $fieldName => $search) {
            if(is_int($search)){
                $creaListQuery->bindvalue(':' . $fieldName, $search , PDO::PARAM_INT);
            }else{
                $creaListQuery->bindvalue(':' . $fieldName, $search , PDO::PARAM_STR);
            }
        }
        if (count($limitArray) == 2){
            $creaListQuery->bindvalue(':limit', $limitArray['limit'], PDO::PARAM_INT);
            $creaListQuery->bindvalue(':offset', $limitArray['offset'], PDO::PARAM_INT);
        }
        $creaListQuery->execute();
        return $creaListQuery->fetchAll(PDO::FETCH_OBJ); 
    }

    function getCreaListAsAdmin($limitArray = array() ,$searchArray = array()) {
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
                , `available`
                , `addDate`
            FROM
                `r3f3r0_creatures`
            ' . (isset($where) ? $where : '') . '
            ORDER BY `available` ASC '
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


    //Méthode pour récuperer tous les commentaires d'une créature
    public function getAllCommentsByCreaId(){
        $allCommentsByCreaId = $this->db->prepare(
            'SELECT
                `comment`
            FROM
                `r3f3r0_comments`
            WHERE
                `id_r3f3r0_creatures` = :creaId
        ');
        $allCommentsByCreaId->bindValue('creaId', $this->creaId, PDO::PARAM_INT);
        $allCommentsByCreaId->execute();
        return $allCommentsByCreaId->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function deleteCreaById(){
        $deleteCreaById = $this->db->prepare(
            'DELETE FROM
                `r3f3r0_creatures`
            WHERE
                `id` = :id
            ');
        $deleteCreaById->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteCreaById->execute();
    }

    public function validateCrea(){
        $validateCreaQuery = $this->db->prepare(
            'UPDATE
                `r3f3r0_creatures`
            SET
                `available` = \'Validé\'
            WHERE
                `id` = :id
            ');
        $validateCreaQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $validateCreaQuery->execute();
    }
}