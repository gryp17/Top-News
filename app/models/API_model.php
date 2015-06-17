<?php

class API_model {

    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $dsn = "mysql:host=mysql7.000webhost.com;dbname=a5166961_newsdb";
            $user = 'a5166961_admin';
            $password = 'p123456';
            $this->connection = new PDO($dsn, $user, $password, $opc);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new API_model();
        }

        return self::$instance;
    }

    public function getLatestArticles($limit) {

        $data = array();
        
        $query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID order by date desc limit $limit");
        $query->execute();
        
        while ($row = $query->fetch()) {
            $data[] = $row;
        }

        return json_encode($data);
    }

}
