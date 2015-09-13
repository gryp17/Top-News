<?php

class API_model {

    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            #$dsn = "mysql:host=mysql7.000webhost.com;dbname=a5166961_newsdb";
            #$user = 'a5166961_admin';
            #$password = 'p123456';
			$dsn = "mysql:host=localhost;dbname=topnews";
			$user = 'root';
			$password = '1234';
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

    public function getArticles($limit, $offset) {
        $data = array();

        $limit = (int) $limit;
        $offset = (int) $offset;

        $query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID order by date desc limit $limit offset $offset");
        $query->execute();

        while ($row = $query->fetch()) {
            $data[] = $row;
        }

        return json_encode($data);
    }

    public function getArticlesBySearch($search_value) {
        $data = array();
        $query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and title like ? order by date desc");
        $like_value = '%' . $search_value . '%';
        $query->bindParam(1, $like_value);
        $query->execute();

        while ($row = $query->fetch()) {
            $data[] = $row;
        }

        if (count($data) == 0) {
            $data = array("error" => "No articles found");
        }

        return json_encode($data);
    }

}

//select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and title like "%obama%" order by date desc