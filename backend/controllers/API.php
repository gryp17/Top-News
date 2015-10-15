<?php

class API extends Controller {

	public function index() {
		
	}

	public function getArticles($category, $limit = 6, $offset = 0) {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			
			if(!in_array($category, $this->valid_categories)){
				$category = null;
			}
			
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getArticles($category, $limit, $offset);
			$result = array('status' => 1, 'data' => $data);
		} else {
			$result = array('status' => 0, 'error' => Controller::ACCESS_DENIED);
		}

		die(json_encode($result));
	}

	public function getArticlesBySearch($category, $search_value) {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {
			
			if(!in_array($category, $this->valid_categories)){
				$category = null;
			}
			
			$search_value = urldecode($search_value);
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getArticlesBySearch($category, $search_value);
			
			$result = array('status' => 1, 'data' => $data);
		} else {
			$result = array('status' => 0, 'error' => Controller::ACCESS_DENIED);
		}
		
		die(json_encode($result));
	}
	
	public function getLatestArticleDate($category = null){
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			
			if(!in_array($category, $this->valid_categories)){
				$category = null;
			}
			
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getLatestArticleDate($category);
			
			$result = array('status' => 1, 'data' => $data);
		} else {
			$result = array('status' => 0, 'error' => Controller::ACCESS_DENIED);
		}
		
		die(json_encode($result));
	}

}
