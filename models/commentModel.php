<?php
class comment{
    
    public $content = '';
    public $postDate = '0000-00-00 00:00:00';
    public $userId = 0;
    public $creaId = 0;

    private $db = NULL;

    //Methode magique pour initialiser ma BDD
    public function __construct() {
        $this->db = database::getInstance();
    } 

    //Méthode pour récuperer tous les commentaires d'une créature
    public function getAllCommentsByCreaId(){
        $allCommentsByCreaId = $this->db->prepare(
            'SELECT
                `com`.`content`
                ,DATE_FORMAT(`postDate`, \'%d/%m/%Y\') AS `comDate`
                ,DATE_FORMAT(`postDate`, \'%H:%i\') AS `comHour`
                ,`usr`.`username`
            FROM
                `r3f3r0_comments` AS `com`
            INNER JOIN `r3f3r0_users` AS `usr` ON `com`.`id_r3f3r0_users` = `usr`.`id`
            WHERE
                `id_r3f3r0_creatures` = :creaId
            ORDER BY `postDate` DESC
        ');
        $allCommentsByCreaId->bindValue('creaId', $this->creaId, PDO::PARAM_INT);
        $allCommentsByCreaId->execute();
        return $allCommentsByCreaId->fetchAll(PDO::FETCH_OBJ);
    }

    public function addCommentOnCreature(){
        $commentCreatureQuery = $this->db->prepare(
            'INSERT INTO 
                `r3f3r0_comments` (`content`, `postDate`, `id_r3f3r0_users`, `id_r3f3r0_creatures`)
            VALUES 
                (:content, :postDate, :userId, :creaId) 
        ');
        $commentCreatureQuery->bindValue(':content', $this->content, PDO::PARAM_STR);
        $commentCreatureQuery->bindValue(':postDate', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $commentCreatureQuery->bindValue(':userId', $this->userId, PDO::PARAM_INT);
        $commentCreatureQuery->bindValue(':creaId', $this->creaId, PDO::PARAM_INT);
        return $commentCreatureQuery->execute();
    }

    public function lastCommentDateInsertById(){
        $lastCommentDateInsertById = $this->db->prepare(
            'SELECT 
                MAX(`postDate`) AS `lastDate`
            FROM
                `r3f3r0_comments`
            WHERE `id_r3f3r0_users` = :userId AND `id_r3f3r0_creatures` = :creaId
           ');
        $lastCommentDateInsertById->bindValue(':userId', $this->userId, PDO::PARAM_INT);
        $lastCommentDateInsertById->bindValue(':creaId', $this->creaId, PDO::PARAM_INT);
        $lastCommentDateInsertById->execute();
        $data = $lastCommentDateInsertById->fetch(PDO::FETCH_OBJ);
        return $data->lastDate;

    }


}