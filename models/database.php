<?php

class database {

    private static $instance = NULL;
    public $db = NULL;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=referosauria;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new database();
        }
        return self::$instance->db;
    }
}
?>