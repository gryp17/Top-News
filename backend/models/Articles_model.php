<?php

class Articles_model {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	/**
	 * Returns all articles from the specified category
	 * @param string $category
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function getArticles($category, $limit, $offset) {
		$data = array();

		$limit = (int) $limit;
		$offset = (int) $offset;

		if ($category != null) {
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and category.name = ? order by date desc limit $limit offset $offset");
			$query->bindParam(1, $category);
		} else {
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID order by date desc limit $limit offset $offset");
		}

		$query->execute();

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}

		return $data;
	}

	/**
	 * Returns all articles from the specified category that contain the search_value
	 * @param string $category
	 * @param string $search_value
	 * @return array
	 */
	public function getArticlesBySearch($category, $search_value) {
		$data = array();

		$like_value = '%' . $search_value . '%';

		if ($category != null) {
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and category.name = ? and title like ? order by date desc");
			$query->bindParam(1, $category);
			$query->bindParam(2, $like_value);
		} else {
			$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and title like ? order by date desc");
			$query->bindParam(1, $like_value);
		}

		$query->execute();

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}

		return $data;
	}

	/**
	 * Returns all articles from the specified date
	 * @param string $date
	 * @return array
	 */
	public function getArticlesByDate($date) {
		$data = array();

		$query = $this->connection->prepare("select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID and date = ? order by date desc");
		$query->bindParam(1, $date);
		$query->execute();

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}

		return $data;
	}

	/**
	 * Returns the latest article date in format YYY-mm-dd
	 * @param string $category
	 * @return string
	 */
	public function getLatestArticleDate($category) {
		$data = null;

		if ($category != null) {
			$query = $this->connection->prepare("select DATE_FORMAT(max(date), '%Y-%m-%d') from article, category where article.categoryID = category.ID and category.name = ?");
			$query->bindParam(1, $category);
		} else {
			$query = $this->connection->prepare("select DATE_FORMAT(max(date), '%Y-%m-%d') from article");
		}

		$query->execute();
		$row = $query->fetch();

		if (isset($row[0])) {
			$data = $row[0];
		}

		return $data;
	}

	/**
	 * Returns a single article data
	 * @param int $id
	 * @return array
	 */
	public function getArticle($id) {
		$data = null;

		$id = (int) $id;

		$query = $this->connection->prepare("select * from article where id = ?");
		$query->bindParam(1, $id);

		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data;
	}

	/**
	 * Increments the article views
	 * @param int $id
	 */
	public function addArticleView($id) {
		$id = (int) $id;
		$query = $this->connection->prepare("update article set views = views + 1 where id = ?");
		$query->bindParam(1, $id);
		$query->execute();
	}

}
