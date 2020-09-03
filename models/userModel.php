<?php
class user
{
    public $id = 0;
    public $username = '';
    public $role = 3;
    public $mail = '';
    public $pass = '';
    public $inscriptionDate = '0000-00-00';

    private $db = NULL;
    
    //Méthode magique pour me connecter a ma BDD facilement entre chaque methodes
    public function __construct() {
        //récupère l'instance de PDO de la classe database avec la méthode statique getInstance()
        $this->db = database::getInstance();
        $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    //Recupère les information des utilisateurs
    public function getAllUsersInfos(){
        $userInfosQuery = $this->db->query(
            'SELECT
                `usr`.`id` AS `usrId`
                ,`username`
                ,`mail`
                ,DATE_FORMAT(`inscriptionDate`, \'%d/%m/%Y\') AS `inscDate`
                ,`rol`.`name` AS `role`
                , `rol`.`id` AS `rolId`
            FROM
                `r3f3r0_users` AS `usr`
            INNER JOIN `r3f3r0_roles` AS `rol` ON `id_r3f3r0_roles` = `rol`.`id`
            ORDER BY `usr`.`id` ASC
        ');
        return $userInfosQuery->fetchAll(PDO::FETCH_OBJ);
    }

    //recupère les infos d'un utilisateur en particulier
    public function getUserInfos(){
        $userInfosQuery = $this->db->prepare(
            'SELECT
                `id`
                ,`username`
                ,`mail`
                ,DATE_FORMAT(`inscriptionDate`, \'%d/%m/%Y\') AS `inscDate`
            FROM
                `r3f3r0_users`
            WHERE
                `id`= :id
        ');
        $userInfosQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $userInfosQuery->execute();
        return $userInfosQuery->fetch(PDO::FETCH_OBJ);
    }

    ##### Méthodes admin #####

    public function deleteUserById(){
        $deleteUserByIdQuery = $this->db->prepare(
            'DELETE FROM
                `r3f3r0_users`
            WHERE `id` = :id
        ');
        $deleteUserByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteUserByIdQuery->execute();
    }

    function getUserList($limitArray = array(), $searchArray = array()) {
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
        $getUserListQuery = $this->db->prepare(
            'SELECT
            `usr`.`id` AS `usrId`
            ,`username`
            ,`mail`
            ,DATE_FORMAT(`inscriptionDate`, \'%d/%m/%Y\') AS `inscDate`
            ,`rol`.`name` AS `role`
            , `rol`.`id` AS `rolId`
            FROM
            `r3f3r0_users` AS `usr`
            INNER JOIN `r3f3r0_roles` AS `rol` ON `id_r3f3r0_roles` = `rol`.`id`
            ' . (isset($where) ? $where : '') . '
            ORDER BY `usr`.`id` ASC '
                . (count($limitArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        //Boucle pour créer nos bindValues qui dépendent de nos champs de recherche
        foreach($searchArray as $fieldName => $search) {
            $getUserListQuery->bindvalue(':' . $fieldName, $search , PDO::PARAM_STR);
        }
        if (count($limitArray) == 2){
            $getUserListQuery->bindvalue(':limit', $limitArray['limit'], PDO::PARAM_INT);
            $getUserListQuery->bindvalue(':offset', $limitArray['offset'], PDO::PARAM_INT);
        }
        $getUserListQuery->execute();
        return $getUserListQuery->fetchAll(PDO::FETCH_OBJ); 
    }

    ##########################

    //permet d'editer le nom d'utilisateur et le mail
    public function editUserInfo(){
        $userEditInfos = $this->db->prepare(
            'UPDATE
                `r3f3r0_users`
            SET `username` = :username, `mail` = :mail
            WHERE `id` = 3
            ');
        $userEditInfos->bindvalue(':username', $this->username, PDO::PARAM_STR);
        $userEditInfos->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        return $userEditInfos->execute();
    }

    //permet d'éditer le mot de passe
    public function editUserPW(){
        $userEditPW = $this->db->prepare(
            'UPDATE
                `r3f3r0_users`
            SET `password` = :pass
            WHERE `id` = 3
            ');
        $userEditPW->bindvalue(':pass', $this->password, PDO::PARAM_STR);
        return $userEditPW->execute();
    }

    //recupere le mdp utilisateur
    public function getCurrentPassword(){
        $userPassword = $this->db->query(
            'SELECT
                `password`
            FROM
                `r3f3r0_users`
            WHERE `id` = 3
            ');
        return $userPassword->fetch(PDO::FETCH_OBJ);
    }

    public function deleteSelectedUser(){
        $userToRemove = $this->db->query(
            'DELETE FROM 
                `r3f3r0_users`
            WHERE
                `id` = 3
            ');
            return $userToRemove->execute();
    }

    public function addNewUser(){
        $addUser = $this->db->prepare(
            'INSERT INTO 
                `r3f3r0_users` (`username`, `mail`, `password`, `inscriptionDate`)
            VALUES (:username, :mail, :pass, :inscriptionDate)
            ');
        $addUser->bindvalue(':username', $this->username, PDO::PARAM_STR);
        $addUser->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $addUser->bindvalue(':pass', $this->pass, PDO::PARAM_STR);
        $addUser->bindvalue(':inscriptionDate', date('Y-m-d'), PDO::PARAM_STR);
        return $addUser->execute();
    }
    /******* METHODE MICKAEL **********/
    
    public function checkUserUnavailabilityByFieldName($field){
        $whereArray = [];
        foreach($field as $fieldName ){
            $whereArray[] = '`' . $fieldName . '` = :' . $fieldName;
        }
        $where = ' WHERE ' . implode(' AND ', $whereArray);
        $checkUserUnavailabilityByFieldName = $this->db->prepare('
            SELECT COUNT(`id`) as `isUnavailable`
            FROM ' . $this->table 
            . $where
        ); 
        foreach($field as $fieldName ){
            $checkUserUnavailabilityByFieldName->bindValue(':'.$fieldName,$this->$fieldName,PDO::PARAM_STR);
        }
        $checkUserUnavailabilityByFieldName->execute();
        return $checkUserUnavailabilityByFieldName->fetch(PDO::FETCH_OBJ)->isUnavailable;
    }
    
    /*****************/
    public function checkUserExist()
    {
        $addUserSameQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUserExist`
            FROM `r3f3r0_users` 
            WHERE `username` = :username AND `mail` = :mail'
        );
        $addUserSameQuery->bindvalue(':username', $this->username, PDO::PARAM_STR);
        $addUserSameQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $addUserSameQuery->execute();
        $data = $addUserSameQuery->fetch(PDO::FETCH_OBJ);
        return $data->isUserExist; 
    } 

    public function connectUser($username){
        $userDataQuery = $this->db->query(
            'SELECT
                `usr`.`id`
                ,`username`
                ,`password`
                ,`rol`.`name`
            FROM 
                `r3f3r0_users` AS `usr`
            INNER JOIN `r3f3r0_roles` AS `rol` ON `id_r3f3r0_roles` = `rol`.`id`
            WHERE `username` =' . $username
        );
        return $userDataQuery->fetch(PDO::FETCH_OBJ);
    }
}

