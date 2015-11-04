<?php

class API extends Controller {
	
	public function index() {
		
	}
	
	#list of required parameters for each API function
	private $required_params = array(
		'getArticles' => array('limit', 'offset'),
	);
	
	
	/**
	 * Returns all REQUEST and POST parameters
	 * also checks if the required parameters are present
	 * @return array
	 */
	private function getRequestParams(){
		$params = array();
		
		#merge the request and post params
		$_REQUEST = array_merge($_REQUEST, $_POST);
		
		#extract all request params
		foreach($_REQUEST as $key => $value){
			$key = trim($key);
			$value = trim($value);
			$params[$key] = $value;
		}
		
		#check if the API call contains all the required params
		if(isset($params['url'])){
			$function = array_pop(explode('/', $params['url']));
			
			foreach($this->required_params[$function] as $param){
				if(!isset($params[$param])){
					die(json_encode(array('status' => 0, 'error' => "Missing $param parameter.")));
				}
			}
			
		}else{
			die(json_encode(array('status' => 0, 'error' => "Invalid request.")));
		}
		
		return $params;
	}
	

	/**
	 * Returns all articles from the specified category
	 * 
	 * Required params:
	 * @param int limit
	 * @param int offset
	 * 
	 * Optional params:
	 * @param string category
	 */
	public function getArticles() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			
			$params = $this->getRequestParams();
			
			#set default category
			if(!in_array($params['category'], $this->valid_categories)){
				$params['category'] = null;
			}
						
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getArticles($params['category'], $params['limit'], $params['offset']);
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
