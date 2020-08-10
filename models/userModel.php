<?php

class user
{
    public $username = '';
    public $role = '';
    public $mail = '';
    public $pass = '';
    public $inscriptionDate = '0000-00-00';

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

    public function getUserInfos(){
        $userInfosQuery = $this->db->query(
            'SELECT
                `username`
                ,`mail`
                ,DATE_FORMAT(`inscriptionDate`, \'%d-%m-%Y\') AS `inscDate`
            FROM
                `r3f3r0_users`
            WHERE
                `id`= 1
        ');
        $data = $userInfosQuery->fetch(PDO::FETCH_OBJ);
        return $data;
    }

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
        $data = $userPassword->fetch(PDO::FETCH_OBJ);
        return $data;
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
        $addUser->bindvalue(':inscriptionDate', $this->inscriptionDate, PDO::PARAM_STR);
        return $addUser->execute();
    }
}

