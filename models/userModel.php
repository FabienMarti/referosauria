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
    private $table = '`r3f3r0_users`';
    
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

    //Permet d'éditer le nom d'utilisateur et le mail par l'ID.
    public function editUserInfo(){
        $userEditInfos = $this->db->prepare(
            'UPDATE
                `r3f3r0_users`
            SET `username` = :username, `mail` = :mail
            WHERE `id` = :id
            ');
        $userEditInfos->bindvalue(':username', $this->username, PDO::PARAM_STR);
        $userEditInfos->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $userEditInfos->bindvalue(':id', $this->id, PDO::PARAM_INT);
        return $userEditInfos->execute();
    }

    //Permet d'éditer le mot de passe par l'ID.
    public function editUserPW(){
        $userEditPW = $this->db->prepare(
            'UPDATE
                `r3f3r0_users`
            SET `password` = :pass
            WHERE `id` = :id
            ');
        $userEditPW->bindvalue(':pass', $this->password, PDO::PARAM_STR);
        $userEditPW->bindvalue(':id', $this->id, PDO::PARAM_INT);
        return $userEditPW->execute();
    }

    //Récupère le mot de passe de l'utilisateur par son ID.
    public function getCurrentPasswordById(){
        $userPassword = $this->db->prepare(
            'SELECT
                `password`
            FROM
                `r3f3r0_users`
            WHERE `id` = :id
            ');
        $userPassword->bindvalue(':id', $this->id, PDO::PARAM_INT);
        $userPassword->execute();
        $data = $userPassword->fetch(PDO::FETCH_OBJ);
        return $data->password;
    }

    public function deleteSelectedUser(){
        $userToRemove = $this->db->query(
            'DELETE FROM 
                `r3f3r0_users`
            WHERE
                `id` = :id
            ');
            $userToRemove->bindvalue(':id', $this->id, PDO::PARAM_INT);
            return $userToRemove->execute();
    }

    public function addUser(){
        $addUser = $this->db->prepare(
            'INSERT INTO 
                `r3f3r0_users` (`username`, `mail`, `password`, `inscriptionDate`)
            VALUES (:username, :mail, :password, :inscriptionDate)
            ');
        $addUser->bindvalue(':username', $this->username, PDO::PARAM_STR);
        $addUser->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $addUser->bindvalue(':password', $this->password, PDO::PARAM_STR);
        $addUser->bindvalue(':inscriptionDate', date('Y-m-d'), PDO::PARAM_STR);
        return $addUser->execute();
    }
  
    public function checkUserUnavailabilityByFieldName($field){
        $whereArray = array();
        foreach($field as $fieldName ){
            $whereArray[] = '`' . $fieldName . '` = :' . $fieldName;
        }
        $where = ' WHERE ' . implode(' AND ', $whereArray);
        $checkUserUnavailabilityByFieldName = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUnavailable`
            FROM `r3f3r0_users`'
            . $where
        ); 
        foreach($field as $fieldName ){
            $checkUserUnavailabilityByFieldName->bindValue(':'.$fieldName, $this->$fieldName, PDO::PARAM_STR);
        }
        $checkUserUnavailabilityByFieldName->execute();
        return $checkUserUnavailabilityByFieldName->fetch(PDO::FETCH_OBJ)->isUnavailable;
    }
    
    /********* VERIFICATION D'EXISTENCE ********/


    public function checkMailExists()
    {
        $addUserSameQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isMailExist`
            FROM `r3f3r0_users` 
            WHERE `mail` = :mail'
        );
        $addUserSameQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $addUserSameQuery->execute();
        $data = $addUserSameQuery->fetch(PDO::FETCH_OBJ);
        return $data->isMailExist; 
    } 

    public function checkUsernameExists()
    {
        $addUserSameQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUsernameExist`
            FROM `r3f3r0_users` 
            WHERE `username` = :username'
        );
        $addUserSameQuery->bindvalue(':username', $this->username, PDO::PARAM_STR);
        $addUserSameQuery->execute();
        $data = $addUserSameQuery->fetch(PDO::FETCH_OBJ);
        return $data->isUsernameExist; 
    } 

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


    public function getUserPasswordHash(){
        $getUserPasswordHash = $this->db->prepare(
            'SELECT 
                `password` 
            FROM 
                `r3f3r0_users`
            WHERE `username` = :username'
        );
        $getUserPasswordHash->bindValue(':username', $this->username, PDO::PARAM_STR);
        $getUserPasswordHash->execute();
        $response = $getUserPasswordHash->fetch(PDO::FETCH_OBJ);
        if(is_object($response)){
            return $response->password;
        }else{
            return '';
        }
    }

    public function getUserProfile(){
        $getUserProfile = $this->db->prepare(
            'SELECT 
                `usr`.`id`
                , `usr`.`username`
                , `usr`.`id_r3f3r0_roles` AS `rolId`
                , `rol`.`name` AS `rolName`
            FROM 
                `r3f3r0_users` AS `usr`
            INNER JOIN `r3f3r0_roles` AS `rol` ON `id_r3f3r0_roles` = `rol`.`id`
            WHERE `username` = :username'
        );
        $getUserProfile->bindValue(':username', $this->username, PDO::PARAM_STR);
        $getUserProfile->execute();
        return $getUserProfile->fetch(PDO::FETCH_OBJ);
    }
}

