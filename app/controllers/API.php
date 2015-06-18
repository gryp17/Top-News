<?php

class API extends Controller{
    
    public function index(){
        
    }
    
    public function getArticles($limit = 6, $offset = 0){        
        $api_model = $this->load_model('API_model', true);
        echo $api_model->getArticles($limit, $offset);
    }
    
}

