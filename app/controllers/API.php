<?php

class API extends Controller {

	public function index() {
		
	}

	public function getArticles($limit = 6, $offset = 0) {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getArticles($limit, $offset);
			$result = array('status' => 1, 'data' => $data);
		} else {
			$result = array('status' => 0, 'error' => Controller::ACCESS_DENIED);
		}

		die(json_encode($result));
	}

	public function getArticlesBySearch($search_value) {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {
			$search_value = urldecode($search_value);
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getArticlesBySearch($search_value);


			$result = array('status' => 1, 'data' => $data);
			

		} else {
			$result = array('status' => 0, 'error' => Controller::ACCESS_DENIED);
		}
		
		die(json_encode($result));
	}

}
