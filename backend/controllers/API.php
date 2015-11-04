<?php

class API extends Controller {
	
	public function index() {
		
	}
	

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	private $required_params = array(
		'getArticles' => array(
			'limit' => 'int',
			'offset' => 'int'
		),
		'getArticlesBySearch' => array(
			'search_val' => '+'
		),
		'getLatestArticleDate' => array(),
		
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
			
			foreach($this->required_params[$function] as $param => $type){
				#check if the param exists
				if(!isset($params[$param])){
					die(json_encode(array('status' => 0, 'error' => "Missing $param parameter.")));
				}
				
				#check if the param meets the requirements
				if($this->checkParam($params[$param], $type) == false){
					die(json_encode(array('status' => 0, 'error' => "Invalid $param parameter.")));
				}
			}
			
		}else{
			die(json_encode(array('status' => 0, 'error' => "Invalid request.")));
		}
		
		return $params;
	}
	
	
	/**
	 * Checks if the passed parameter value meets the type requirements
	 * @param string $value
	 * @param string $type
	 * @return boolean
	 */
	private function checkParam($value, $type){
		$result = true;
		
		switch ($type) {
			#valid integer
			case 'int':
				if(!ctype_digit($value)){
					$result = false;
				}
				break;
			#not an empty string
			case '+':
				if(strlen($value) == 0){
					$result = false;
				}
				break;
		}
		
		return $result;
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
	

	/**
	 * Returns all articles from the specified category that contain the search value
	 * 
	 * Required params:
	 * @param string search_val
	 * 
	 * Optional params:
	 * @param string category
	 */
	public function getArticlesBySearch() {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {
			
			$params = $this->getRequestParams();
			
			if(!in_array($params['category'], $this->valid_categories)){
				$params['category'] = null;
			}
			
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getArticlesBySearch($params['category'], $params['search_val']);
			
			$result = array('status' => 1, 'data' => $data);
		} else {
			$result = array('status' => 0, 'error' => Controller::ACCESS_DENIED);
		}
		
		die(json_encode($result));
	}
	
	
	/**
	 * Returns the date of the latest article from the specified category
	 * 
	 * Optional params:
	 * @param string category
	 */
	public function getLatestArticleDate(){
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			
			$params = $this->getRequestParams();
			
			if(!in_array($params['category'], $this->valid_categories)){
				$params['category'] = null;
			}
			
			$articles_model = $this->load_model('Articles_model');
			$data = $articles_model->getLatestArticleDate($params['category']);
			
			$result = array('status' => 1, 'data' => $data);
		} else {
			$result = array('status' => 0, 'error' => Controller::ACCESS_DENIED);
		}
		
		die(json_encode($result));
	}

}
