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
    
    //créé une fonction magique pour me connecter a ma BDD facilement entre chaque methodes
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=referosauria;charset=utf8', 'fmarti', 'nekrose12');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    //recupère les information des utilisateurs
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
        $userInfosQuery = $this->db->query(
            'SELECT
                `id`
                ,`username`
                ,`mail`
                ,DATE_FORMAT(`inscriptionDate`, \'%d/%m/%Y\') AS `inscDate`
            FROM
                `r3f3r0_users`
            WHERE
                `id`= 2
        ');
        return $userInfosQuery->fetch(PDO::FETCH_OBJ);
    }

    ##### Méthodes admin #####

    public function getUserInfosAsAdmin($id){
        $userInfosQuery = $this->db->query(
            'SELECT
                `id`
                ,`username`
                ,`mail`
                ,DATE_FORMAT(`inscriptionDate`, \'%d/%m/%Y\') AS `inscDate`
            FROM
                `r3f3r0_users`
            WHERE
                `id`=' . $id . '
        ');
        return $userInfosQuery->fetch(PDO::FETCH_OBJ);
    }

    ##########################

    //permet d'editer le nom d'utilisateur et le mail
    public function editUserInfo(){
        $userEditInfos = $this->db->prepare(
            'UPDATE
                `r3f3r0_users`
            SET `username` = :username, `mail` = :mail
            WHERE `id` = 1
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
            WHERE `id` = 1
            ');
        $userEditPW->bindvalue(':pass', $this->password, PDO::PARAM_STR);
        return $userEditPW->execute();
    }


    public function getCurrentPassword(){
        $userPassword = $this->db->query(
            'SELECT
                `password`
            FROM
                `r3f3r0_users`
            WHERE `id` = 1
            ');
        return $userPassword->fetch(PDO::FETCH_OBJ);
    }

    public function deleteSelectedUser(){
        $userToRemove = $this->db->query(
            'DELETE FROM 
                `r3f3r0_users`
            WHERE
                `id` = 1
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
}

