<?php

class Articles_model {

    private $connection;
	
    public function __construct() {	
		$this->connection = DB::getInstance()->connection;
    }

    public function getArticles($category, $limit, $offset) {
        $data = array();
		
        $limit = (int) $limit;
        $offset = (int) $offset;
		
		if($category != null){
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and category.name = ? order by date desc limit $limit offset $offset");
			$query->bindParam(1, $category);
		}else{
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID order by date desc limit $limit offset $offset");
		}
		
		$query->execute();

        while ($row = $query->fetch()) {
            $data[] = $row;
        }

        return $data;
    }

    public function getArticlesBySearch($category, $search_value) {
        $data = array();
		
		$like_value = '%' . $search_value . '%';
		
		if($category != null){
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and category.name = ? and title like ? order by date desc");
			$query->bindParam(1, $category);
			$query->bindParam(2, $like_value);
		}else{
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and title like ? order by date desc");
			$query->bindParam(1, $like_value);
		}
		
		$query->execute();
		
        while ($row = $query->fetch()) {
            $data[] = $row;
        }

		return $data;
    }
	
	
	/**
	 * Returns the latest article date in format YYY-mm-dd
	 * @return string
	 */
	public function getLatestArticleDate($category){
		$data = null;
		
		if($category != null){
			$query = $this->connection->prepare("select DATE_FORMAT(max(date), '%Y-%m-%d') from article, category where article.categoryID = category.ID and category.name = ?");
			$query->bindParam(1, $category);
		}else{
			$query = $this->connection->prepare("select DATE_FORMAT(max(date), '%Y-%m-%d') from article");
		}
		
		$query->execute();
		$row = $query->fetch();
		
		if(isset($row[0])){
			$data = $row[0];
		}
		
		return $data;
	}

}

