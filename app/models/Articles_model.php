<?php

class Articles_model {

    private $connection;
	
    public function __construct() {	
		$this->connection = DB::getInstance()->connection;
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

        return $data;
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

		return $data;
    }

}
