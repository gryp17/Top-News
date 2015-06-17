<?php

class API extends Controller{
    
    public function index(){
        
    }
    
    public function getLatestArticles($limit = 6){        
        $api_model = $this->load_model('API_model', true);
        echo $api_model->getLatestArticles($limit);
    }
    
}

