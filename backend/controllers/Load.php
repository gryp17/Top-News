<?php

class Load extends Controller {

	public function index() {


		try {
			$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
			$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME;
			$user = Config::DB_USER;
			$password = Config::DB_PASS;
			$connection = new PDO($dsn, $user, $password, $opc);
		} catch (Exception $e) {
			die($e->getMessage());
		}


		$json = json_decode(file_get_contents("http://top-news.netau.net/res/articles/articles.json"));

		foreach ($json as $key => $value) {
			$title = $value->title;
			$category = $value->category;
			$date = $value->date;
			$summary = $value->summary;
			$content = $value->content;
			$image_name = $value->image_name;

			switch ($category) {
				case "politics":
					$category_id = 1;
					break;
				case "world":
					$category_id = 2;
					break;
				case "technology":
					$category_id = 3;
					break;
				case "economy":
					$category_id = 4;
					break;
				case "sports":
					$category_id = 5;
					break;
			}


			$query = $connection->prepare("insert into article (title, summary, content, image_path, views, date, authorID, categoryID) values (?, ?, ?, ?, ?, ?, ?, ?)");
			$query->bindParam(1, $title);
			$query->bindParam(2, $summary);
			$query->bindParam(3, $content);
			$query->bindParam(4, $image_name);
			$query->bindParam(5, $a = 0);
			$query->bindParam(6, $date);
			$query->bindParam(7, $a = 2);
			$query->bindParam(8, $category_id);
			$query->execute();
			echo "OK";
			#$this->load_model->addArticle($title, $summary, $content, $image_name, 0, $date, 2, $category_id);
		}
	}

}
